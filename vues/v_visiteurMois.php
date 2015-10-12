      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=ValiderVisiteur&action=historique" method="post" onchange="submit()">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Visiteur : </label>
        <select id="lstMois" name="idVisiteur">
            <option selected >... </option>
            <?php
			
            if($_REQUEST["idVisiteur"]) {
               
                foreach ($listVisiteur as $unMois)
			{ 
                    if($_REQUEST['idVisiteur']==$unMois["id"]){
                            ?>
				<option  value="<?php echo $unMois["id"]  ?>" selected><?php echo  " ".$unMois['prenom']." ".$unMois['nom']." " ?> </option>
				<?php 			
			} else{
                            ?>
				<option  value="<?php echo $unMois["id"]  ?>" ><?php echo  " ".$unMois['prenom']." ".$unMois['nom']." " ?> </option>
				<?php 			
			}
                    }
                   
                            
                    
            }
    
                else{
                  foreach ($listVisiteur as $unMois)
			{
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
          <input type="hidden" name="lstMois" value="<?php echo $mois?>">
          <?php if (isset($idVisiteur)){?>
          <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur?>">
              <?php }?>
      </p> 
      </div>
        
      </form>