<!doctype html>

<?php

session_start();

$ime = null;
$prezime = null;

if (isset($_POST['firstn'])) {

	$ime=$_POST['firstn'];

}
if (isset($_POST['lastn'])) {

	$prezime=$_POST['lastn'];
}

	unset($sql);

	if ($ime) {
		$sql[] = " ime = '$ime' ";
	}

	if ($prezime) {
		$sql[] = " prezime = '$prezime' ";
	}


$upit = "SELECT ime, prezime, spol, datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe,tegobe, lijekovi FROM unesenipacijenti";

/* Dodavanje WHERE dijela na upit -- vidio sam ovo na stack overflow */
if (!empty($sql)) {
	$upit .= ' WHERE ' . implode(' AND ', $sql);
}

$dbc = new PDO('mysql:host=localhost;dbname=dwalabos;charset=UTF8', 'root', 'root');
$query = $dbc->prepare("$upit");
$query->execute();
$uneseniPacijenti = $query->fetchAll();

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Mobile Site</title>

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<script>
		var podaci = <?php echo json_encode($uneseniPacijenti); ?>
		
		var current = 0;
		
		function sljedeci() {
			if (current < podaci.length-1){
			current++;
				document.getElementById("id").innerHTML = current+1;
				document.getElementById("ime").innerHTML = podaci[current].ime;
				document.getElementById("prezime").innerHTML = podaci[current].prezime;
				document.getElementById("spol").innerHTML = podaci[current].spol;
				document.getElementById("datumRodjenja").innerHTML = podaci[current].datumRodjenja;
				document.getElementById("mjestoRodjenja").innerHTML = podaci[current].mjestoRodjenja;
				document.getElementById("adresaStanovanja").innerHTML = podaci[current].adresaStanovanja;
				document.getElementById("krvnaGrupa").innerHTML = podaci[current].krvnaGrupa;
				document.getElementById("prijasnjeTegobe").innerHTML = podaci[current].prijasnjeTegobe;
				document.getElementById("tegobe").innerHTML = podaci[current].tegobe;
				document.getElementById("lijekovi").innerHTML = podaci[current].lijekovi;
			}
		}
		
		function prethodni() {
			if (current>0){
			current--;
				document.getElementById("id").innerHTML = current+1;
				document.getElementById("ime").innerHTML = podaci[current].ime;
				document.getElementById("prezime").innerHTML = podaci[current].prezime;
				document.getElementById("spol").innerHTML = podaci[current].spol;
				document.getElementById("datumRodjenja").innerHTML = podaci[current].datumRodjenja;
				document.getElementById("mjestoRodjenja").innerHTML = podaci[current].mjestoRodjenja;
				document.getElementById("adresaStanovanja").innerHTML = podaci[current].adresaStanovanja;
				document.getElementById("krvnaGrupa").innerHTML = podaci[current].krvnaGrupa;
				document.getElementById("prijasnjeTegobe").innerHTML = podaci[current].prijasnjeTegobe;
				document.getElementById("tegobe").innerHTML = podaci[current].tegobe;
				document.getElementById("lijekovi").innerHTML = podaci[current].lijekovi;
			}
		}

	</script>


	
</head>
<body>


<!-- Intro stranica -->

<div data-role="page" id="page1">
	<div style="min-height:30px;" data-role="header" class="ui-content">
		
		<a style="margin:10px;" href="mobileSite.php" class="ui-btn ui-btn-b">Povratak</a>

		<div class="logoutButton">
			<?php


				if (!isset($_SESSION["username"]) || (empty($_SESSION["username"]))) {
					header('Location: login.html');
				}
				
				echo "Dobrodosao " .$_SESSION["username"];
				
			?>

			<form action="ubijSession.php" method="post">
				<input type="submit" value="Logout" />
			</form>

		</div>

	</div>

	<div data-role="main" class="ui-content">

	<?php
	/*
	var_dump($upit);
	var_dump($ime);
	var_dump($prezime);
	*/
	?>
		<div class="jsonIspisWrapper">

			<table class="tableIspisUnesenihPacijenata">
				<tr>
					<td>Id Pacijenta:</td>
					<td>#<label id="id"></label></td>
				</tr>
				<tr>
					<td>Ime:</td>
					<td><label id="ime"></label></td>
				</tr>
				<tr>
					<td>Prezime:</td>
					<td><label id="prezime"></label></td>
				</tr>
				<tr>
					<td>Spol:</td>
					<td><label id="spol"></label></td>
				</tr>
				<tr>
					<td>Datum rođenja:</td>
					<td><label id="datumRodjenja"></label></td>
				</tr>
				<tr>
					<td>Mjesto rođenja:</td>
					<td><label id="mjestoRodjenja"></label></td>
				</tr>
				<tr>
					<td>Adresa:</td>
					<td><label id="adresaStanovanja"></label></td>
				</tr>
				<tr>
					<td>Krvna grupa:</td>
					<td><label id="krvnaGrupa"></label></td>
				</tr>
				<tr>
					<td>Prijašnje tegobe</td>
					<td><label id="prijasnjeTegobe"></label></td>
				</tr>
				<tr>
					<td>Tegobe</td>
					<td><label id="tegobe"></label></td>
				</tr>
				<tr>
					<td>Alergije</td>
					<td><label id="lijekovi"></label></td>
				</tr>
				<tr>
					<td><input type="button" value="Prethodni" onClick="prethodni()" /></td>
					<td><input type="button" value="Sljedeći" onClick="sljedeci()" /></td>
				</tr>
			</table>


			<script>
				document.getElementById("id").innerHTML = current+1;
				document.getElementById("ime").innerHTML = podaci[current].ime;
				document.getElementById("prezime").innerHTML = podaci[current].prezime;
				document.getElementById("spol").innerHTML = podaci[current].spol;
				document.getElementById("datumRodjenja").innerHTML = podaci[current].datumRodjenja;
				document.getElementById("mjestoRodjenja").innerHTML = podaci[current].mjestoRodjenja;
				document.getElementById("adresaStanovanja").innerHTML = podaci[current].adresaStanovanja;
				document.getElementById("krvnaGrupa").innerHTML = podaci[current].krvnaGrupa;
				document.getElementById("prijasnjeTegobe").innerHTML = podaci[current].prijasnjeTegobe;
				document.getElementById("tegobe").innerHTML = podaci[current].tegobe;
				document.getElementById("lijekovi").innerHTML = podaci[current].lijekovi;
			</script>


		</div>

	</div>

	<div data-role="footer" class="ui-content">
		<p>CopyRight ZDK.2014</p>
	</div>

	
</div>


	
</body>
</html>