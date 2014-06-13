<!doctype html>

<?php
	
	session_start();

?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Osobni Podaci</title>

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
	 			<li><a href="filter.php">Generiraj pdf</a></li>
	 			<li><a href="odaberiGraf.php">Generiraj Graf</a></li>
	 			<li><a href="json.php">Doktori</a></li>
	 			<li><a href="lab8/mobileSite.php">Unos Pacijenta Mobile</a></li>

			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		<h3>Popis unesenih pacijenata</h3>
		<div class="popisUnesenihWrapper">

		<?php

			include 'connectToDatabase.php';

			$mysqlConnection = new mysqli($host, $user, $pass, $database);

		    $upit = $mysqlConnection -> prepare("SET NAMES 'utf8'");
		    $upit -> execute();

		    $upit = $mysqlConnection -> prepare("SET CHARACTER SET utf8");
		    $upit -> execute();

		    $upit = $mysqlConnection -> prepare("SET COLLATION_CONNECTION = 'utf8_general_ci'");
		    $upit -> execute();

		    $stmt = $mysqlConnection -> prepare("SELECT idUneseniPacijenti, ime, prezime, spol, datumRodjenja, adresaStanovanja, krvnaGrupa FROM unesenipacijenti");
			$stmt -> execute();
			$stmt -> bind_result($id, $ime, $prezime, $spol, $datum, $adresa, $krvnagrupa);
			

			echo "<div>";
				    echo <<< EOT
				        <table border="1" class="" style="border-collapse:collapse;" >
				        	<tr>
					            <th> ID#: </td>
					            <th> Ime: </td>
					            <th> Prezime: </td>
					            <th> Spol: </td>
					            <th> Datum rođenja: </td>
					            <th> Adresa stanovanja: </td>
					            <th> Krvna grupa: </td>
				        	</tr>
EOT;
			
			while ($stmt->fetch()) {
        		
        		echo <<< EOT
			          	<tr class='red'>
			            	<td> {$id} </td>
				            <td> {$ime} </td>
				            <td> {$prezime} </td>
				            <td> {$spol} </td>
				            <td> {$datum} </td>
				            <td> {$adresa} </td>
				            <td> {$krvnagrupa} </td>
			          	</tr>
EOT;

    		}

    		echo "</table></div>";
		?>
		
	</div>
	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>