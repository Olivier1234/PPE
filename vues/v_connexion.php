<div id="contenu">
    <h2>Authentification</h2>
        <div id="coForm">  
            <form method="POST" action="index.php?uc=connexion&action=valideConnexion">
                <center style="text-align:left;">
                    <p id="coP"><label id="coLabel" for='login'>Login</label>
                    <input for='login' id="coInput" type="text" placeholder=" Login" name="login" maxlength="20"></p>
                </center>
                <center style="text-align:left;">
                    <p><label id="coLabel" for='mdp'>Mot de passe</label>
                    <input for='mdp' id="coInput"  type="password" placeholder=" Mot de passe" name="mdp" maxlength="40"></p>
                </center>
                 <center>
                     <input id="vaInput" type="submit" value="Connexion" name="valider">
                 </center>
                  </p>
            </form>
        </div>
</div>