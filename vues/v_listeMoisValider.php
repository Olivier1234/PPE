
      <h2>Liste fiches de frais</h2>
      <h3>Mois à sélectionner : </h3>
      <form action="index.php?uc=ValiderVisiteur&action=historique" method="post" onchange="submit()">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
            <?php
            
             
            if($_REQUEST['lstMois']){
               
			foreach ($lesMois as $unMois)
			{
                                $moisValider = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
                                if($_REQUEST['lstMois']==$moisValider){
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
            elseif ( isset($moisC) )
                {
                
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
            }
            
            
            
            else{
                
                foreach ($lesMois as $unMois)
			{
                                $mois = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
                               
				if($mois == $moisASelectionner){
				?>
				<option selected value="<?php echo $mois ?>" ><?php echo  $numMois."/".$numAnnee ?> </option>
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