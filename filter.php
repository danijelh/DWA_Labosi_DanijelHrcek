<!doctype html>
<?php

	session_start();

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Unos Pacijenta</title>

	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
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
	 			<li><a href="#">Generiraj pdf</a></li>
	 			<li><a href="odaberiGraf.php">Generiraj Graf</a></li>
	 			<li><a href="json.php">Doktori</a></li>
	 			<li><a href="lab8/mobileSite.php">Unos Pacijenta Mobile</a></li>
			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">

		<h3>Pronađite pacijente..</h3>
	
	<section class="formaWrapper" style="margin:20px;">
		
		<form action="generirajPDF.php" method="POST">
			
			<label for="username">Ime: </label>
			<input type="text" name="ime">

			<label for="password">Prezime:</label>
			<input type="password" name="prezime">
			<br>
			<input class="button" type="submit" name="login" value="Filter" style="width:100px; margin:0;">

		</form>

	</section>


		

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>
