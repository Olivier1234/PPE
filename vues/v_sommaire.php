﻿    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
    </h2>
    
       </div> <?php      
        if(!$_SESSION['type'] == "comptable")
            {
                ?>
                <ul id="menuList">
                    <li>
                        Visiteur :<br> <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
                    </li>
                </ul><?php
            }
            
            else {  ?>            
                 <ul id="menuList">
                    <li>
                        Comptable :<br> <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=afficherMoisAnnee" title="Afficher fiche mois ">Afficher fiche des mois/annee</a>
                    </li>
                    
                </ul>
                    
                    
                   <?php } ?>
                    
                 
    </div>
    