<h2>Liste visiteurs validés</h2>
    <table class="listeLegere">
        <tr>
            <th style="text-align: left;padding:0.2em;font-size:1.1em;"> Nom </th>
            <th style="text-align: left;padding:0.2em;font-size:1.1em;"> Prenom </th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Justficatifs</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Montant</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Date</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Etat </th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Vue détaillée </th>
        </tr>
<?php
foreach($_SESSION['listFraisV'] as $fiche => $cle)
{   echo"<tr style='text-align:center;'>";    
    print_r("<td style='text-align:left;'>".$cle["nom"]."</td>"
            . "<td style='text-align:left;'>".$cle["prenom"]."</td>"
            . "<td style='text-align:center;'>".$cle["nbJustificatifs"]."</td>"
            . "<td style='text-align:center;'>".$cle["montantValide"]." €</td>"
            . "<td style='width:15%;text-align:center;' > ".$cle["dateModif"]."</td>"
            . "<td style='text-align:center;'>".$cle["idEtat"]."</td>"
            . "<td style='width: 20%;text-align: center;'><a  id ='aDetail' style=''href='index.php?uc=suiviFrais&action=listFrais&numero=$fiche'> Fiche détaillée </a> </td>");
    echo"</tr>";
    
}
?>
    </table><br/>
<h2>Liste visiteurs Remboursés</h2>
    <table class="listeLegere">
        <tr>
            <th style="text-align: left;padding:0.2em;font-size:1.1em;"> Nom </th>
            <th style="text-align: left;padding:0.2em;font-size:1.1em;"> Prenom </th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Justficatifs</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Montant</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Date</th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Etat </th>
            <th style="text-align: center;padding:0.2em;font-size:1.1em;"> Vue détaillée </th>
        </tr>
<?php 
foreach($_SESSION['listFraisR'] as $fiche => $cle)
{   echo"<tr style='text-align:center;'>";    
    print_r("<td style='padding-top: 15px;text-align:left;'>".$cle["nom"]."</td>"
            . "<td style='text-align:left;padding-top: 15px;'>".$cle["prenom"]."</td>"
            . "<td style='text-align:center;padding-top: 15px;'>".$cle["nbJustificatifs"]."</td>"
            . "<td style='text-align:center;padding-top: 15px;'>".$cle["montantValide"]." €</td>"
            . "<td style='width:15%;padding-top: 15px;text-align:center;'> ".$cle["dateModif"]."</td>"
            . "<td style='text-align:center;padding-top: 15px;'>".$cle["idEtat"]."</td>"
            . "<td style='width: 20%;padding-left: 7%;text-align:center;padding-right: 5%;'><a target='_blank' href='index.php?uc=voirPdf&action=vuPdf&numeroPDF=$fiche'> <img src='images/pdf_logo.jpg' title='voir Pdf'/> </a> </td>");
    echo"</tr>";
    
}
?>
    </table>
