      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=ValiderVisiteur&action=historique" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Visiteur : </label>
        <select id="lstMois" name="idVisiteur">
            <?php
			foreach ($listVisiteur as $unMois)
			{
                            ?>
				<option selected value="<?php echo $unMois["id"]  ?>" ><?php echo  " ".$unMois['prenom']." ".$unMois['nom']." " ?> </option>
				<?php 			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
          <input type="hidden" name="lstMois" value="<?php echo $mois?>">
          <?php if (isset($idVisiteur)){?>
          <input type="hidden" name="lstMois" value="<?php echo $idVisiteur?>
              <?php }?>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>