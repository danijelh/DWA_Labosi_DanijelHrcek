<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<header class="headerWrapper">

	<div class="container">

		<img src="img/logo.png" alt="">

		<div class="logoutButton">
			<?php

			 	$username = $_GET['username'];
			 	$password = $_GET['password'];
			 	// U slučaju krivog logina preusmjeravanje na login.html

			 	if($username != 'Danijel' && $password != 'lozinka')
			 	{
					header('Location: login.html');
				}

				echo "Dobrodošao " .$username. "<a href=\"login.html\"><button style=\"padding: 4px; width:100px; margin-left: 10px;\">Odjava</button> </a>";
				
			?>
		</div>

	</div>

	</header>


<div class="wrapperLogin">	
	
	<div class="meniWrapper">
	<h3>Meni</h3>
		<nav class="">
			<ul>
				<li><a href="#">Podaci</a></li>
				<li><a href="#">Popis Pacijenata</a></li>
	 			<li><a href="#">Unos Pacijenta</a></li>
			</ul>
		</nav>
	</div>

	<div class="sadrzajWrapper">
		<h3>Sadržaj</h3>
		<?php

		?>

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>
	
</body>
</html>