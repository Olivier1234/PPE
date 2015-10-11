<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
var $ProcessingTable=false;
var $aCols=array();
var $TableX;
var $HeaderColor;
var $RowColors;
var $ColorIndex;

function Header()
{
	//Print the table header if necessary
	if($this->ProcessingTable)
		$this->TableHeader();
}

function TableHeader()
{
	$this->SetFont('Arial','B',12);
	$this->SetX($this->TableX);
	$fill=!empty($this->HeaderColor);
	if($fill)
		$this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
	foreach($this->aCols as $col)
		$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
	$this->Ln();
}

function Row($data)
{
	$this->SetX($this->TableX);
	$ci=$this->ColorIndex;
	$fill=!empty($this->RowColors[$ci]);
	if($fill)
		$this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
	foreach($this->aCols as $col)
		$this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
	$this->Ln();
	$this->ColorIndex=1-$ci;
}

function CalcWidths($width,$align)
{
	//Compute the widths of the columns
	$TableWidth=0;
	foreach($this->aCols as $i=>$col)
	{
		$w=$col['w'];
		if($w==-1)
			$w=$width/count($this->aCols);
		elseif(substr($w,-1)=='%')
			$w=$w/100*$width;
		$this->aCols[$i]['w']=$w;
		$TableWidth+=$w;
	}
	//Compute the abscissa of the table
	if($align=='C')
		$this->TableX=max(($this->w-$TableWidth)/2,0);
	elseif($align=='R')
		$this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
	else
		$this->TableX=$this->lMargin;
}

function AddCol($field=-1,$width=-1,$caption='',$align='L')
{
	//Add a column to the table
	if($field==-1)
		$field=count($this->aCols);
	$this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}

function Table($query,$prop=array())
{
	//Issue query
	$res=mysql_query($query) or die('Error: '.mysql_error()."<BR>Query: $query");
	//Add all columns if none was specified
	if(count($this->aCols)==0)
	{
		$nb=mysql_num_fields($res);
		for($i=0;$i<$nb;$i++)
			$this->AddCol();
	}
	//Retrieve column names when not specified
	foreach($this->aCols as $i=>$col)
	{
		if($col['c']=='')
		{
			if(is_string($col['f']))
				$this->aCols[$i]['c']=ucfirst($col['f']);
			else
				$this->aCols[$i]['c']=ucfirst(mysql_field_name($res,$col['f']));
		}
	}
	//Handle properties
	if(!isset($prop['width']))
		$prop['width']=0;
	if($prop['width']==0)
		$prop['width']=$this->w-$this->lMargin-$this->rMargin;
	if(!isset($prop['align']))
		$prop['align']='C';
	if(!isset($prop['padding']))
		$prop['padding']=$this->cMargin;
	$cMargin=$this->cMargin;
	$this->cMargin=$prop['padding'];
	if(!isset($prop['HeaderColor']))
		$prop['HeaderColor']=array();
	$this->HeaderColor=$prop['HeaderColor'];
	if(!isset($prop['color1']))
		$prop['color1']=array();
	if(!isset($prop['color2']))
		$prop['color2']=array();
	$this->RowColors=array($prop['color1'],$prop['color2']);
	//Compute column widths
	$this->CalcWidths($prop['width'],$prop['align']);
	//Print header
	$this->TableHeader();
	//Print rows
	$this->SetFont('Arial','',11);
	$this->ColorIndex=0;
	$this->ProcessingTable=true;
	while($row=mysql_fetch_array($res))
		$this->Row($row);
	$this->ProcessingTable=false;
	$this->cMargin=$cMargin;
	$this->aCols=array();
}
function SetWidths($w)
{
    //Tableau des largeurs de colonnes
    $this->widths=$w;
}

function SetAligns($a)
{
    //Tableau des alignements de colonnes
    $this->aligns=$a;
}

function Row2($data)
{
    //Calcule la hauteur de la ligne
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=7*$nb;
    //Effectue un saut de page si nécessaire
    $this->CheckPageBreak($h);
    //Dessine les cellules
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Sauve la position courante
        $x=$this->GetX();
        $y=$this->GetY();
        //Dessine le cadre
        $this->Rect($x,$y,$w,$h);
        //Imprime le texte
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Repositionne à droite
        $this->SetXY($x+$w,$y);
    }
    //Va à la ligne
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //Si la hauteur h provoque un débordement, saut de page manuel
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}
?>