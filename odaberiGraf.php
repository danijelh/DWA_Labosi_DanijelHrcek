<!doctype html>

<?php
	
	session_start();

	include 'connectToDatabase.php';

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Odaberite Graf</title>

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
				<li><a href="#">Osobni Podaci</a></li>
				<li><a href="popisPacijenata.php">Popis Pacijenata</a></li>
	 			<li><a href="unosPacijenta.php">Unos Pacijenta</a></li>
	 			<li><a href="popisUnesenihPacijenata.php">Popis Unesenih pacijenata</a></li>
	 			<li><a href="filter.php">Generiraj pdf</a></li>
	 			<li><a href="#">Generiraj Graf</a></li>
	 			<li><a href="json.php">Doktori</a></li>
	 			<li><a href="lab8/mobileSite.php">Unos Pacijenta Mobile</a></li>

			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		
		<h3>Generirajte graf</h3>

		<form action="phpScript/generirajGraf.php" method="POST">
	 			<input type="hidden" value="pChart" name="pChart">
				<input class="button" style="width:50%; display:block; margin:40px auto;" type="submit" value="Primjer Grafa">
	 		</form>

		<form action="phpScript/generirajGraf.php" method="POST">
	 			<input type="hidden" value="customStupac" name="pChart">
				<input class="button" style="width:50%; display:block; margin:40px auto;" type="submit" value="Custom Graf">
	 	</form>



	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>