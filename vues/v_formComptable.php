<script type="text/javascript">
<!--
function verif_formulaire()
{
 if(document.formulaire.nom.value == "")  {
   alert("Veuillez entrer votre nom!");
   document.formulaire.nom.focus();
   return false;
  }
  
  if(document.formulaire.ville.value == "")  {
   alert("Veuillez entrer votre ville!");
   document.formulaire.ville.focus();
   return false;
  }
   if(document.formulaire.prenom.value == "")  {
   alert("Veuillez entrer votre prenom!");
   document.formulaire.prenom.focus();
   return false;
  }
 if(document.formulaire.adresse.value == "") {
   alert("Veuillez entrer votre lieu de résidence!");
   document.formulaire.adresse.focus();
   return false;
  }

 if(document.formulaire.cp.value == "") {
   alert("Veuillez entrer votre code postal !");
   document.formulaire.cp.focus();
   return false;
  }
 var chkZ = 1;
 for(i=0;i<document.formulaire.cp.value.length;++i)
   if(document.formulaire.cp.value.charAt(i) < "0" || document.formulaire.cp.value.charAt(i) > "9")
     chkZ = -1;
 if(chkZ == -1) {  
   alert("Votre code postal doit être un nombre!");
   document.formulaire.cp.focus();
   return false;
  }
}
//-->
</script>
<div id="Tcontenu">
    <form method='POST'  action='index.php?uc=param&action=infosForm' name="formulaire" onSubmit="return verif_formulaire()">
      <fieldset style="margin-top: 4%;padding: 20px; margin-left:auto;margin-right:auto;width:60%;">
        <legend>  informations personnel</legend>
            <p id="pForm">Nom* : </p><input id="InForm" type="text" name="nom" size="30"value="<?php echo $_SESSION['nom'] ?>" /><br />
            <p id="pForm">Prenom* : </p><input id="InForm" type="text" name="prenom" size="30" value="<?php echo $_SESSION['prenom']   ?>"/><br />
            <p id="pForm">Adresse* : </p><input id="InForm" type="text" name="adresse" size="30" value="<?php echo $_SESSION['adresse']   ?>"/><br />
            <p id="pForm">ville* : </p><input id="InForm" type="text" name="ville" size="30" value="<?php echo $_SESSION['ville']  ?>"/><br />
            <p id="pForm">cp* : </p><input id="InForm" type="text" name="cp" size="30" value="<?php echo $_SESSION['cp']  ?>"/><br />

            
           <br />
            <input type='hidden' value='<?php echo $numVol; ?>' name='numero'>
            <input type="submit" value="valider" style="width:150px;margin-left:150px;"/>
            <input type="reset" value="Annuler" style="width:150px;"/>
      </fieldset>
    </form>
</div>
