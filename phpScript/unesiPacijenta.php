<?php 

include '../connectToDatabase.php';

$dbc = mysqli_connect($host,$user,$pass,$database) 
or die('Pogreška kod spajanja na bazu podataka');

mysqli_query( $dbc, "SET NAMES 'utf8'");
mysqli_query(  $dbc, "SET CHARACTER SET utf8");
mysqli_query(  $dbc, "SET COLLATION_CONNECTION = 'utf8_general_ci'");

$redirect = $_POST['mobileUnos'];

$ime=$_POST['firstName'];
$prezime=$_POST['lastName'];
$spol=$_POST['gender'];
$datumRodjenja=$_POST['birthDate'];
$mjestoRodjenja=$_POST['birthPlace'];
$mjestoStanovanja=$_POST['address'];
$krv1=$_POST['krvnaGrupa'];
$krv2=$_POST['vrstaKrvneGrupe'];
$krvnaGrupa=$krv1.$krv2;	
$tegobeDaNe=$_POST['illnes'];
$tegobeOpis=$_POST['tegobe'];
$lijekovi=$_POST['vacine'];

//Ako nisu popunjena sva polja
if ( !empty($ime) && !empty($prezime) && !empty($spol) && !empty($datumRodjenja) && !empty($datumRodjenja) && !empty($mjestoRodjenja) && !empty($mjestoStanovanja) && !empty($tegobeDaNe) && !empty($tegobeOpis) && !empty($lijekovi) )  {
	
	mysqli_query( $dbc, "INSERT INTO unesenipacijenti (ime, prezime, spol, datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe, tegobe, lijekovi) VALUES ('$ime', '$prezime', '$spol', '$datumRodjenja', '$mjestoRodjenja', '$mjestoStanovanja', '$krvnaGrupa', '$tegobeDaNe', '$tegobeOpis', '$lijekovi')");

	mysqli_close($dbc);

	if ($redirect == 'desktopUnos') {
		header("location: ../unosPacijenta.php");
	}else{
		header("location: ../lab8/mobileSite.php");
	}
	

}else{
	
	if ($redirect == 'desktopUnos') {
		header("location: ../unosPacijenta.php");
	}else{
		header("location: ../lab8/mobileSite.php");
	}
	

}








?>