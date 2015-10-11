<h2>Liste visiteur valider</h2>
    <table>
        <tr style='text-align:center;'>
            <td> Id </td>
            <td> Nom </td>
            <td> Prenom </td>
            <td> Mois </td>
            <td> Nb justficatifs</td>
            <td> Montant valide </td>
            <td> Date modif</td>
            <td> IdEtat </td>
            <td> Vu détaillé </td>
            
        </tr>
<?php
foreach($_SESSION['listFraisV'] as $fiche => $cle)
{   echo"<tr style='text-align:center;'>";    
    print_r("<td>".$cle["id"]."</td>"
            . "<td>".$cle["nom"]."</td>"
            . "<td>".$cle["prenom"]."</td>"
            . "<td style='width:10%;'>".$cle["mois"]."</td>"
            . "<td >".$cle["nbJustificatifs"]."</td>"
            . "<td>".$cle["montantValide"]." €</td>"
            . "<td style='width:15%;' > ".$cle["dateModif"]."</td>"
            . "<td>".$cle["idEtat"]."</td>"
            . "<td style='width: 17%;'><a  id ='aDetail' href='index.php?uc=suiviFrais&action=listFrais&numero=$fiche'> Fiche détaillée </a> </td>");
    echo"</tr>";
    
}
?>
    </table>
<h2>Liste visiteur Rembourser</h2>
    <table>
        <tr style='text-align:center;'>
            <td> Id </td>
            <td> Nom </td>
            <td> Prenom </td>
            <td> Mois </td>
            <td> Nb justficatifs</td>
            <td> Montant valide </td>
            <td> Date modif</td>
            <td> IdEtat </td>
            <td> Vu détaillé </td>
            
        </tr>
<?php
foreach($_SESSION['listFraisR'] as $fiche => $cle)
{   echo"<tr style='text-align:center;'>";    
    print_r("<td>".$cle["id"]."</td>"
            . "<td style='width:15%;'>".$cle["nom"]."</td>"
            . "<td style='width:15%;'>".$cle["prenom"]."</td>"
            . "<td style='width:10%;'>".$cle["mois"]."</td>"
            . "<td >".$cle["nbJustificatifs"]."</td>"
            . "<td>".$cle["montantValide"]." €</td>"
            . "<td style='width:15%;' > ".$cle["dateModif"]."</td>"
            . "<td>".$cle["idEtat"]."</td>"
            . "<td style='width: 9%;padding-left: 2%;padding-right: 2%;'><a target='_blank' id ='aDetail' href='index.php?uc=voirPdf&action=vuPdf&numeroPDF=$fiche'> <img src='images/pdf_logo.jpg'/> </a> </td>");
    echo"</tr>";
    
}
?>
    </table>
