
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> :   </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
            <th>Description</th>
            <th>Quantité</th>
            <th>Montant unitaire</th>
            <th style="text-align:right;">Total</th>
        </tr>
        
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
	{
            $libelle = $unFraisForfait['libelle'];
            $quantite = $unFraisForfait['quantite'];
            $montant = $unFraisForfait['montant'];
            $total = $montant * $quantite ?>
            <tr>
                <th> <?php echo $libelle?></th>
                <td style="text-align:center;"><?php echo $quantite?> </td>
                <td style="text-align:center;"><?php echo $montant." €"?> </td>
                <td style="text-align:right;"><?php echo $total." €"?> </td>        
            </tr><?php
        }?>
    </table>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>      
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
                        $idVisiteur = $unFraisHorsForfait['idVisiteur'];
                        $mois = $unFraisHorsForfait['mois'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
                        
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td style="text-align:right;"><?php echo $montant." €" ?></td>                           
             </tr>
        <?php 
          }
          foreach ( $supprimer as  $unsupprimer ) 
		  { 
                	$date = $unsupprimer['date'];
			$libelle = $unsupprimer['libelle'];
			$montant = $unsupprimer['montant'];
                        
		?>
             <tr>
                 
                <td><?php echo $date ?></td>
                <td><?php echo " refusé ".$libelle ?></td>
                <td style="text-align:right;"><?php echo $montant." €" ?></td>
                
              
                            
             </tr>
          <?php  }  ?>
    </table>
   
  </div>
<form action="index.php?uc=suiviFrais&action=listFrais" method="POST">
    <input type="hidden" name ="numero" value ="<?php echo $num ;?>">
    <input style="height: 50px;width:50%;margin-right: auto;margin-left: 24%;"type="submit" id="vaInput" value="Rembourser" name="rembourser">
</form>
<?php 












