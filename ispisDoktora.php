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

			 	//$username = $_GET['username'];
			 	//$password = $_GET['password'];
			 	// U slučaju krivog logina preusmjeravanje na login.html
				/*
			 	if($_SESSION["username"] != 'Danijel' && $_SESSION["password"] != 'lozinka')
			 	{
					header('Location: login.html');
				}
				*/

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


	<div class="sadrzajIspisDoktoraWrapper">
		<h3>Ispis Doktora</h3>

		<?php
	 			$imeDohvat=$_POST['ime'];
	 			$prezimeDohvat=$_POST['prezime'];
	 			$ime=mb_strtoupper($imeDohvat, 'UTF-8');
	 			$prezime=mb_strtoupper($prezimeDohvat, 'UTF-8');

				function get_data($url) {
					$ch = curl_init();
					$timeout = 5;
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$data = curl_exec($ch);
					curl_close($ch);
					return $data;
				}

				 //echo $returned_content = get_data('http://stajp.vtszg.hr/~spredanic/DWA2/lab5/podaci.php');

				$string = get_data('http://stajp.vtszg.hr/~spredanic/DWA2/lab5/podaci.php');
				$json_a = json_decode($string, true);

				echo "<table style='border-colappse: colappse;'>";
				echo "<tr>";
				//echo "<td>ID</td>";
				//echo "<td>Područni ured</td>";
				//echo "<td>Šifra ustanove</td>";
				echo "<th>Naziv ustanove</th>";
				//echo "<td>ID broj</td>";
				echo "<th>Prezime</th>";
				echo "<th>Ime</td>";
				echo "<th>Broj osiguranika</th>";
				//echo "<td>Broj pošte</td>";
				//echo "<td>Naziv pošte</td>";
				echo "<th>Ulica</th>";
				echo "<th>Kućni broj</th>";
				echo "<th>Grad</th>";
				echo "</tr>";
				foreach ($json_a as $person_name => $person_a) {
					if ($person_a['ime']==$ime or $person_a['prezime']==$prezime) {
						echo "<tr>";
						//echo "<td> {$person_a['id']} </td>";
						//echo "<td> {$person_a['podrucni_ured']} </td>";
						//echo "<td> {$person_a['sifra_ustanove']} </td>";
						echo "<td> {$person_a['naziv_ustanove']} </td>";
						//echo "<td> {$person_a['id_broj']} </td>";
						echo "<td> {$person_a['prezime']} </td>";
						echo "<td> {$person_a['ime']} </td>";
						echo "<td> {$person_a['broj_osiguranika']} </td>";
						//echo "<td> {$person_a['broj_poste']} </td>";
						//echo "<td> {$person_a['naziv_poste']} </td>";
						echo "<td> {$person_a['ulica']} </td>";
						echo "<td> {$person_a['kucni_broj']} </td>";
						echo "<td> {$person_a['grad']} </td>";
					    echo "</tr>";
					}
				}
				echo "</table>";
	 		?>

	 		<br><br><a class="buttonPovratak" href="json.php">Povratak</a>

		

		
		

	</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>