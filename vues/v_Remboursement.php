
<ul>
<?php
        echo "<b style='font-size:15px;font-family: 'Open Sans',minion pro, sans-serif;'>Remboursement en cours de ".$nom." ".$prenom."</b>";       
?>
</ul>
</div>

<script type="text/javascript">
function timedRefresh(timeoutPeriod) {
	console.log(timeoutPeriod);
    setTimeout("window.location=\"./index.php?uc=suiviFrais&action=listFrais\";",timeoutPeriod);
    }timedRefresh(1000);
</script>