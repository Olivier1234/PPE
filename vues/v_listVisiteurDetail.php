<?php
$id = $_SESSION['listFraisV'][$num]["id"];
$nom = $_SESSION['listFraisV'][$num]["nom"];
$prenom = $_SESSION['listFraisV'][$num]["prenom"];
$mois = $_SESSION['listFraisV'][$num]["mois"];
$nbJustificatifs = $_SESSION['listFraisV'][$num]["nbJustificatifs"];
$montantValide = $_SESSION['listFraisV'][$num]["montantValide"];
$dateModif = $_SESSION['listFraisV'][$num]["dateModif"];
$idEtat = $_SESSION['listFraisV'][$num]["idEtat"];
?>
<h2>Fiche validée de <?php echo $nom." ".$prenom ?></h2>
<div id="ficheRem">
    <p>Fiche frais de : <?php print_r($nom." ".$prenom."<br/>"
            . "Nombre de justificatifs : ".$nbJustificatifs."") ?></p>
</div>

