    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
    </h2>
    
       </div> <?php      
        if(isset($_SESSION['type']))
        {
            if($_SESSION['type'] == "commercial")
            {
                ?>
                <ul id="menuList">
                    <li class="smenu">
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
            if($_SESSION['type'] == "comptable") 
                {  ?>            
                 <ul id="menuList">
                    <li>
                        Comptable :<br> <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=ValiderVisiteur&action=historique" >Valider fiches Frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=suiviFrais&action=listFrais">Rembousement des frais </a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
                    </li>
                                    
                </ul>
        <?php   }       
        }
        else
        {?>
            <ul id="menuList">
                    <li>
                         <?php echo"Bienvenue <br>Meci de vous connecter";?>
                    </li>
            <ul>
  <?php }?>
                    
                 
    </div>
﻿ <div id="contenu">
    
    