<html>
<head>
	<title>Suivi des frais de visite</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			.titre { width : 180 ;  clear:left; float:left; } 
			.zone { float : left; color:7091BB } -->
	</style>
</head>
<body>
<div name="gauche" style="clear:left;float:left;width:18%; background-color:white; height:100%;">
<div name="coin" style="height:10%;text-align:center;"><img src="logo.jpg" width="100" height="60"/></div>
<div name="menu" >
	<h2>Outils</h2>
	<ul><li>Frais</li>
		<ul>

		</ul>
	</ul>
</div>
</div>
<div name="droite" style="float:left;width:80%;">
	<div name="haut" style="margin: 2 2 2 2 ;height:10%;float:left;"><h1>Suivi de remboursement des Frais</h1></div>	
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
	<form name="formConsultFrais" method="post" action="chercheFrais.php" > <!--  -->
		<h1> Période </h1>
			<label class="titre">Mois/Année :</label> <input class="zone" type="text" name="dateConsult" size="12" />
		<p class="titre" />
		<div style="clear:left;"><h2>Frais au forfait </h2></div>
		<table style="color:white;" border="1">
			<tr><th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th><th>Date opération</th><th>Remboursement</th></tr>
			<tr align="center"><td width="80"><label  size="3" name="repas"/></td>
				<td width="80"><label size="3" name="nuitee"/></td> 
				<td width="80"> <label size="3" name="etape"/></td>
				<td width="80"> <label size="3" name="km" /></td>
				<td width="80"> <label size="3" name="situation" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>	
				<td width="80"> <label size="3" name="dateOper" /></td>						
			</tr>
		</table>
		
		<p class="titre" /><div style="clear:left;"><h2>Hors Forfait</h2></div>
		<table style="color:white;" border="1">
			<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th><th>Date opération</th></tr>
			<tr align="center"><td width="100" ><label size="12" name="hfDate1"/></td>
				<td width="220"><label size="30" name="hfLib1"/></td> 
				<td width="90" ><label size="10" name="hfMont1"/></td>
				<td width="80"> <label size="3" name="hfSitu1" /></td>
				<td width="80"> <label size="3" name="hfDateOper1" /></td>		
				</tr>
		</table>	
		<p class="titre"></p>
		<div class="titre">Nb Justificatifs</div><input type="text" class="zone" size="4" name="hcMontant"/>
	</form>
	</div>
</div>
</body>
</html>