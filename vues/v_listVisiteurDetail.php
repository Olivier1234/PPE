<h2>Liste visiteur valider</h2>
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
<div id="ficheRem">
    <p>Fiche frais de : <?php print_r($nom." ".$prenom."<br/>"
            . "Nombre de justificatifs : ".$nbJustificatifs."") ?></p>
</div>

