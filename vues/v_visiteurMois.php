 <div id="contenu">
      <h2>Mes fiches de frais</h2>
      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstMois" accesskey="n">Visiteur : </label>
        <select id="lstMois" name="lstMois">
            <?php
			foreach ($listVisiteur as $unMois)
			{
                            ?>
				<option selected value="<?php echo $unMois  ?>"><?php echo  $unMois['nom']." ".$listVisiteur['prenom']."" ?> </option>
				<?php 			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>