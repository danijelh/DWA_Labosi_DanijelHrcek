<!doctype html>
<?php

	session_start();

	//Provjera ako se radi o mobilnom uređaju ili tabletu
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		header('Location: lab8/mobileSite.php');

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
	 			<li><a href="#">Unos Pacijenta</a></li>
	 			<li><a href="popisUnesenihPacijenata.php">Popis Unesenih pacijenata</a></li>
	 			<li><a href="filter.php">Generiraj pdf</a></li>
	 			<li><a href="odaberiGraf.php">Generiraj Graf</a></li>
	 			<li><a href="json.php">Doktori</a></li>
	 			<li><a href="lab8/mobileSite.php">Unos Pacijenta Mobile</a></li>
			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		<h3>Unesite novog pacijenta</h3>

		<form class="unosPacijentaForm" action="phpScript/unesiPacijenta.php" method="POST">

						<input type="hidden" value="desktopUnos" name="mobileUnos">

						<label for="name">Ime:</label>
						<input type="text" name="firstName" id="name">

						<label for="surname">Prezime:</label></td>
						<input type="text" name="lastName" id="surname">

						<br>
					
						<label for="genderspol">Spol:</label>
						<input type="radio" name="gender" value="M" id="spol">M
						<input type="radio" name="gender" value="Ž" id="spol">Ž

						<br>

						<label for="date">Datum rođenja:</label></td>
						<input type="date" name="birthDate" id="date">

						<br>

						<label for="city">Mjesto rođenja:</label>
						<input type="text" name="birthPlace" id="city">

						<br>

						<label for="adresa">Adresa i mjesto stanovanja:</label>
						<input type="text" name="address" id"adresa">

						<br>

						<label for="krvnaGrupa">Krvna grupa:</label>
						<select name="krvnaGrupa">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="AB">AB</option>		
								<option value="0">0</option>			
							</select>
							<select name="vrstaKrvneGrupe">
								<option value="+">+ (pos)</option>
								<option value="-">- (neg)</option>
							</select>

						<br><br>

						<label for="bolesti">Prijašnje medicinske tegobe (srčane tegobe, talk, virusne, bolesti (Hepatitis, HIV)):</label>

						<br>

						<input type="radio" name="illnes" value="DA" id="bolest">Da<br>
						<input type="radio" name="illnes" value="NE" id="bolest">Ne<br>
						<input type="radio" name="illnes" value="NEZNA" id="bolest">Ne zna

						<br>

						<label for="tegobe">Koje tegobe osoba ima:</label>
						<input type="text" name="tegobe" id"tegobe">

						<br>

						<label for="lijek">Na koje lijekove je osoba alergična:</label>
						<input type="text" name="vacine" id="lijek">

						<input class="button" type="submit" value="Spremi" style="margin:0;">

			</form>

		

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

	
</body>
</html>