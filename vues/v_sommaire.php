    <!-- Division pour le sommaire --> <style>
            
            @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);

                    #cssmenu,
                    #cssmenu ul,
                    #cssmenu ul li,
                    #cssmenu ul ul {
                      list-style: none;
                      margin-top: 0;
                      padding: 0;
                      border: 0;
                      float: left;
                    }
                    #cssmenu ul {
                      position: relative;
                      z-index: 597;
                      float: left;
                    }
                    #cssmenu ul li {
                      float: left;
                      min-height: 1px;
                      line-height: 1em;
                      vertical-align: middle;
                    }
                    #cssmenu ul li.hover,
                    #cssmenu ul li:hover {
                      position: relative;
                      z-index: 599;
                      cursor: default;
                    }
                    #cssmenu ul ul {
                      margin-top: 1px;
                      visibility: hidden;
                      position: absolute;
                      top: 1px;
                      left: 99%;
                      z-index: 598;
                      width: 100%;
                    }
                    #cssmenu ul ul li {
                      float: none;
                    }
                    #cssmenu ul ul ul {
                      top: 1px;
                      left: 99%;
                    }
                    #cssmenu ul li:hover > ul {
                      visibility: visible;
                    }
                    #cssmenu ul li {
                      float: none;
                    }
                    #cssmenu ul ul li {
                      font-weight: normal;
                    }
                    /* Custom CSS Styles */
                    #cssmenu {
                      
                      font-size: 18px;
                      width: 180px;
                    }
                    #cssmenu ul a,
                    #cssmenu ul a:link,
                    #cssmenu ul a:visited {
                      display: block;
                      color: #848889;
                      text-decoration: none;
                      font-weight: 300;
                    }
                    #cssmenu > ul {
                      float: none;
                    }
                    #cssmenu ul {
                      background: #fff;
                    }
                   
                    #cssmenu > ul > li > a {
                      padding:  10px 20px ;
                      float: left;
                    }
                   
                    #cssmenu ul li:hover > a {
                      color: black;
                    }
                    
                    /* Sub Menu */
                    #cssmenu ul ul a:link,
                    #cssmenu ul ul a:visited {
                      font-weight: 400;
                      font-size: 14px;
                    }
                    #cssmenu ul ul {
                      width: 180px;
                      background: none;
                     
                    #cssmenu ul ul a {
                      padding: 8px 0;
                    }
                    #cssmenu ul ul li {
                      padding: 0 20px;
                     
                    }
                    #cssmenu ul ul li:last-child {
                  
                      padding-bottom: 10px;
                    }
                    #cssmenu ul ul li:first-child {
                      padding-top: 10px;
                    }
                   
                    #cssmenu ul ul li:first-child:after {
                      content: '';
                      display: block;
                      width: 0;
                      height: 0;
                      position: absolute;
                      left: -20px;
                      top: 13px;
                     
                    }
        </style>
    <div id="cssmenu">
   
        
       
 <?php      

        if(isset($_SESSION['type']))
        {
            if($_SESSION['type'] == "commercial")
            {
                ?>
                <ul id="menuList"  >
                    <li class="smenu">
                        Visiteur :<br> <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
                    </li>
                    <li class="last">
                        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
                    </li>
                </ul><?php
            }
            if($_SESSION['type'] == "comptable") 
                {  ?>            
        <ul id="menuList" style="text-decoration:none; border:0px;" >
                    
                     <h3 style="margin-left:25px;">Comptable :<br> <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?></h3>
                   
                     <li class="smenu" style="color:lightblue;text-decoration:none; border:0px;">
                        <a href="index.php?uc=connexion&action=accueil" >Accueil</a>
                    </li>
                    <li class="smenu" style="color:lightblue;text-decoration:none; border:0px;">
                        <a href="index.php?uc=ValiderVisiteur&action=historique" >Valider fiches Frais</a>
                    </li>
                    <li class="smenu" style="color:lightblue;text-decoration:none; border:0px;">
                        <a href="index.php?uc=suiviFrais&action=listFrais">Rembousement des frais </a>
                    </li>
                    <li class="last" >
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
    
    