
      <h2>Liste fiches de frais</h2>
      <h3>Mois à sélectionner : </h3>
      <form action="index.php?uc=ValiderVisiteur&action=historique" method="post" onchange="submit()">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
            <?php

                foreach ($lesMois as $unMois)
			{
                                $moisValider = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
                                if($moisClic==$moisValider){
				if($moisValider == $moisASelectionner){
				?>
				<option  value="<?php echo $moisValider ?>" selected><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $moisValider ?>"selected><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
                                }
			
                                else{
                                if($moisValider == $moisASelectionner){
				?>
				<option  value="<?php echo $moisValider ?>" ><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $moisValider ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
                                }
			}

		   ?>    
            
        </select>
      </p>
      </div>
           <h3>Visiteur à sélectionner : </h3>
  
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Visiteur : </label>
        <select id="lstMois" name="idVisiteur">
            <?php
	
                   
                            
                    
            
                
                   foreach ($listVisiteur as $unMois)
			{ 
                    if($idVisiteurclic==$unMois["id"]){
                            ?>
				<option  value="<?php echo $unMois["id"]  ?>" selected><?php echo  " ".$unMois['prenom']." ".$unMois['nom']." " ?> </option>
				<?php 			
			} else{
                            ?>
				<option  value="<?php echo $unMois["id"]  ?>" ><?php echo  " ".$unMois['prenom']." ".$unMois['nom']." " ?> </option>
				<?php 			
			}
                    }                
                    ?>
         
              
           
		  
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
          <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteurclic?>">
          <input type="hidden" name="lstMois" value="<?php echo $moisValider?>">
          
      </p> 
      </div>
        
      </form>
   