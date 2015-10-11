<?php $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
                        $supprimer = $pdo->supprimer($idVisiteur,$mois);
                        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
                        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);
                        $numAnnee =substr( $mois,0,4);
                        $numMois =substr( $mois,4,2);
                        $libEtat = $lesInfosFicheFrais['libEtat'];
                        $montantValide = $lesInfosFicheFrais['montantValide'];
                        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                        $dateModif =  $lesInfosFicheFrais['dateModif'];
                        $dateModif =  dateAnglaisVersFrancais($dateModif);
                        
                        ?>
                        