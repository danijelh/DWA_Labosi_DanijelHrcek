<!doctype html>
<?php

	session_start();

?>

<html>
<head>
	<!-- <meta charset="UTF-8"> -->
	<title>Document</title>

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
			</ul>
		</nav>
	</div>
	

	<div class="sadrzajWrapper">
		<h3>Preuzmite PDF</h3>

		<?php

			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];

			require('FPDF/fpdf.php');


			class PDF extends FPDF
			{

			function Header()
			{
			    $this->SetFont('Arial','B',15);
			    $this->Cell(80);
			    $this->Cell(20,40,"Uspjesno generiran PDF",0,0,'C');
				$this->SetFont('Arial','B',9);
			    $this->Ln(20);
			}

			function Footer()
			{
			   
			}

			function LoadData($file)
			{
				
				$lines=file($file);
				$data=array();
				foreach($lines as $line)
				$data[]=explode(';',chop($line));
				return $data;
			}

			function BasicTable($header,$data)
			{ 

			$this->SetFillColor(255,0,0);
			$this->SetDrawColor(128,0,0);
			$w=array(20,20,20,20,20,20,20,20,20);

				
				for($i=0;$i<count($header);$i++)
					$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
				$this->Ln();
				
				foreach ($data as $eachResult) 
				{ 
					$this->Cell(20,6,$eachResult["ime"],1);
					$this->Cell(20,6,$eachResult["prezime"],1);
					$this->Cell(20,6,$eachResult["spol"],1);
					$this->Cell(20,6,$eachResult["datumRodjenja"],1);
					$this->Cell(20,6,$eachResult["mjesto"],1);
					$this->Cell(20,6,$eachResult["adresa"],1);
					/*$this->Cell(20,6,$eachResult["KrvnaGrupa"],1);
					$this->Cell(20,6,$eachResult["Tegobe"],1);*/
					$this->Ln();
					 	 	 	 	
				}
			}

			}

			$pdf=new PDF();
			$header=array('Ime','Prezime','Spol','DatumRodenja','MjestoRodjenja', 'Adresa');

			$objConnect = mysql_connect("localhost","root","root") or die("Error:Please check your database username & password");
			$objDB = mysql_select_db("dwalabos");
			$strSQL = 'SELECT * FROM pacijenti WHERE ime = "'.$ime.'" OR prezime = "'.$prezime.'"';
			$objQuery = mysql_query($strSQL);
			$resultData = array();
			for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
				$result = mysql_fetch_array($objQuery);
				array_push($resultData,$result);
			}

			function forme()
			{
				echo "<p style='margin:20px;'>PDF uspjesno generiran. Preuzmite ga <a href=generiraniPDF.pdf>OVDJE</a> </p>";
			}


			$pdf->SetFont('Arial','',6);

			$pdf->AddPage();
			$pdf->Ln(35);
			$pdf->BasicTable($header,$resultData);
			forme();
			$pdf->Output("generiraniPDF.pdf","F");
		
		?>



		
		

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>



</body>
</html>