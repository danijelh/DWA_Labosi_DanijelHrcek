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

echo json_encode($uneseniPacijenti);


?>