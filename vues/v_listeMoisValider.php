
      <h2>Liste fiches de frais</h2>
      <h3>Mois à sélectionner : </h3>
      <form action="index.php?uc=ValiderVisiteur&action=historique" method="post" onchange="submit()">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
             <option selected >... </option>
            <?php
            
             
            if($mois){
               
			foreach ($lesMois as $unMois)
			{
                                $moisValider = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
                                if($mois==$moisValider){
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
                                if($mois == $moisASelectionner){
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
            }

            else{
                
                foreach ($lesMois as $unMois)
			{
                                $mois = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
                               
				if($mois == $moisASelectionner){
				?>
				<option  value="<?php echo $mois ?>" ><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
                                
			
                               
			}
            }
           
		   ?>    
            
        </select>
      </p>
      </div>
     
      </form>