<!doctype html>
<?php

session_start();

$ime = null;
$prezime = null;

if (isset($_POST['firstName'])) {

	$ime=$_POST['firstName'];

}
if (isset($_POST['lastName'])) {

	$prezime=$_POST['lastName'];
}
/*
var_dump($ime);
var_dump($prezime);
*/
	unset($sql);

	if ($ime) {
		$sql[] = " ime = '$ime' ";
	}

	if ($prezime) {
		$sql[] = " prezime = '$prezime' ";
	}

//Dohvaćanje podataka iz baze podataka
$upit = "SELECT ime, prezime, spol, datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe,tegobe, lijekovi FROM unesenipacijenti";

/* Dodavanje WHERE dijela na upit */
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
	<title>Unos Pacijenta</title>

	<link rel="stylesheet" href="css/style.css">

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

<body onload="prvi(0)">
	
	<header class="headerWrapper">

	<div class="container">

		<img src="img/logo.png" alt="">

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

	</header>


<div class="wrapperLogin">	
	
	<div class="meniWrapper">
	<h3>Meni</h3>
		<nav class="">
			<ul>
				<li><a href="osobniPodaci.php">Osobni Podaci</a></li>
				<li><a href="popisPacijenata.php">Popis Pacijenata</a></li>
	 			<li><a href="unosPacijenta.php">Unos Pacijenta</a></li>
	 			<li><a href="popisUnesenihPacijenata.php">Popis Unesenih pacijenata</a></li>
	 			<li><a href="filter.php">Generiraj pdf</a></li>
	 			<li><a href="odaberiGraf.php">Generiraj Graf</a></li>
	 			<li><a href="#">Doktori</a></li>
			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		<h3>Popis unesenih pacijenata</h3>

		<a class="button" href="json.php">Filtriraj Doktore [JSON]</a>

		<form style="margin:30px;" action="jsonJavascript.php" method="POST">
			
			<input style="width:50%;" type="text" name="firstName" placeholder="Ime pacijenta">
			<input style="width:50%;" type="text" name="lastName" placeholder="Prezime Pacijenta">

			<input style="width:50%;" type="submit" value="Filtriraj">

		</form>

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

		</div>
		

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

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>


</html>