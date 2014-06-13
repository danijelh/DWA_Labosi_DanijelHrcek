<!doctype html>
<?php

session_start();

$ime = null;
$prezime = null;

if (isset($_GET['firstName'])) {

	$ime=$_GET['firstName'];

}
if (isset($_GET['lastName'])) {

	$prezime=$_GET['lastName'];
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


$upit = "SELECT ime, prezime, spol, datumRodjenja, mjestoRodjenja, adresaStanovanja, krvnaGrupa, prijasnjeTegobe,tegobe, lijekovi FROM unesenipacijenti";

/* Dodavanje WHERE dijela na upit -- vidio sam ovo na stack overflow */
if (!empty($sql)) {
	$upit .= ' WHERE ' . implode(' AND ', $sql);
}

$dbc = new PDO('mysql:host=localhost;dbname=dwalabos;charset=UTF8', 'root', 'root');

$bla = $dbc -> prepare("SET NAMES 'utf8'");
$bla -> execute();

$bla = $dbc -> prepare("SET CHARACTER SET utf8");
$bla -> execute();

$bla = $dbc -> prepare("SET COLLATION_CONNECTION = 'utf8_general_ci'");
$bla -> execute();

//var_dump($upit);

$query = $dbc->prepare("$upit");
$query->execute();
$uneseniPacijenti = $query->fetchAll();

//var_dump($uneseniPacijenti);

echo json_encode($uneseniPacijenti);

//var_dump($uneseniPacijenti);




?>