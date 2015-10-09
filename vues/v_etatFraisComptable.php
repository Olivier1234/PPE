<form 
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
		</tr>
        <tr>
        <?php
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
		?>
                <td class="qteForfait"><?php echo $quantite?> </td>
		 <?php
          }
		?>
		</tr>
    </table>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>      
                <th class='Action'>Action</th> 
             </tr>
        <?php       
        $_session['frais']=array();
          foreach ( $lesFraisHorsForfait as $key => $unFraisHorsForfait ) 
		  { 
                   

                        $idVisiteur = $unFraisHorsForfait['idVisiteur'];
                        $mois = $unFraisHorsForfait['mois'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
                        
                        $_SESSION['frais'][$key]['montant']=$montant;
                       $_SESSION['frais'][$key]['mois']=$mois;
                      $_SESSION['frais'][$key]['idVisiteurClic']=$idVisiteur;
                        $_SESSION['frais'][$key]['libelle']=$libelle;
                      $_SESSION['frais'][$key]['date']=$date;
                      
                        $res=$pdo->supprimer($idVisiteur ,$mois,$montant);
		?>
             <tr>
                 <?php  ;?>
                     <?php if (empty($res)){?>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td> <a href="index.php?uc=ValiderVisiteur&action=historique&key=<?php echo $key;?>"> supprimer </a> </td>
                
                    
                
                    <?php }
                else { ?>
                <td><?php echo $date ?></td>
                <td><?php echo "refusé ".$libelle ?></td>
                <td><?php echo $montant ?></td>
               <?php } ?>
                            
             </tr>
        <?php 
        }
		?>
    </table>
  </div>
 













