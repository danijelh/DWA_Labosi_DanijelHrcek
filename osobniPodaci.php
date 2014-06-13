<!doctype html>

<?php
	
	session_start();

	include 'connectToDatabase.php';

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Osobni Podaci</title>

	<link rel="stylesheet" href="css/style.css">
	


	<script>

		function showInformation(idElementa) {

			var elementId = document.getElementById(idElementa);

			if(elementId.style.display == 'table'){
				elementId.style.display = 'none';
			}
			else {
				elementId.style.display = 'table';
			}

		}

	</script>


</head>
<body>
	
	<header class="headerWrapper">

	<div class="container">

		<img src="img/logo.png" alt="">

		<div class="logoutButton">
			<?php
				/*
			 	$username = $_GET['username'];
			 	$password = $_GET['password'];
			 	// U slučaju krivog logina preusmjeravanje na login.html

			 	if($username != 'Danijel' && $password != 'lozinka')
			 	{
					header('Location: login.html');
				}

				echo "Dobrodosao " .$username. "<a href=\"login.html\"><button style=\"padding: 4px; width:100px; margin-left: 10px;\">Odjava</button> </a>";
				*/

				/*var_dump($_REQUEST);*/
				
				if (isset( $_GET['username']) && !empty( $_GET['username'])) 
				{
					/* Spajanje na bazu podataka */
					$dbc = mysqli_connect($host,$user,$pass,$database) 
					or die('Pogreška kod spajanja na bazu podataka');

					$username = $_GET['username'];

					/*upit za dohvaćanje lozinke i za određeni usrename */
					$query = "SELECT password FROM account WHERE username = '$username'";

					$result = mysqli_query($dbc, $query) or die('Pogreska kod dohvacanja Username-a');

					while($row = mysqli_fetch_array($result))
					{
						$unesenaLozinka = $row['password'];
					}


					if( $_GET["password"] == $unesenaLozinka )
					{
						$_SESSION["username"] = $_GET['username'];
						$_SESSION["password"] =  $_GET['password'];
					
					}else{
						header('Location: login.html');
					}

				}
				
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
				<li><a href="#">Osobni Podaci</a></li>
				<li><a href="popisPacijenata.php">Popis Pacijenata</a></li>
	 			<li><a href="unosPacijenta.php">Unos Pacijenta</a></li>
	 			<li><a href="popisUnesenihPacijenata.php">Popis Unesenih pacijenata</a></li>
	 			<li><a href="filter.php">Generiraj pdf</a></li>
	 			<li><a href="odaberiGraf.php">Generiraj Graf</a></li>
	 			<li><a href="json.php">Doktori</a></li>
	 			<li><a href="lab8/mobileSite.php">Unos Pacijenta Mobile</a></li>

			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		<h3>Osobni Podaci</h3>

		<div class="podaciWrapper">

			<a class="informationsLink button" href="#" onclick="showInformation('personalInformation')">Osobni Podaci</a>
			<a class="informationsLink button" href="#" onclick="showInformation('educationInformation')">Podaci o obrazovanju</a>
			<a class="informationsLink button" href="#" onclick="showInformation('skillsInformation')">Znanja i vještine</a>

			<div id="personalInformation">

				<h2>Osobni podaci</h2>

				Ime i prezime: Danijel Hrček <br>
				Mjesto: Đurmanec <br>
				Datum rođenja: 01.09.1992 <br>
				Mjesto rođenja: Zabok <br>

			</div>

			<div id="educationInformation">

				<h2>Podaci o obrazovanju</h2>

				Osnovna škola:	Osnovna Škola Đurmanec <br>
				Srednja škola:	Tehničar za računalstvo ( Krapina ) <br>
				Fakultet:	Tehničko veleučilište u Zagrebu <br>

			</div>

			<div id="skillsInformation">

				<h2>Podaci o obrazovanju</h2>

				
				Programiranje:	C, C++, C#, Java, PHP, .NET MVC <br>
				Baze podataka:	MySQL <br>
				Dizajniranje:	HTML5, CSS3, jQuery <br>

			</div>


		</div>
		

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>