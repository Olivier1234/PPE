<div id="contenu">
<ul>
<?php
       
        $nom =  $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        echo "<b style='font-size:15px;font-family: 'Open Sans',minion pro, sans-serif;'>Deconnexion en cours de ".$nom." ".$prenom."</b>";
        session_destroy();        
?>
</ul>
</div>

<script type="text/javascript">
function timedRefresh(timeoutPeriod) {
	console.log(timeoutPeriod);
    setTimeout("window.location=\"./index.php\";",timeoutPeriod);
    }timedRefresh(500);
</script>