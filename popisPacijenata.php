<!doctype html>

<?php
	
	session_start();

?>


<html>
<head>
	<!-- <meta charset="UTF-8"> -->
	<title>Popis Pacijenata</title>

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
				<li><a href="#">Popis Pacijenata</a></li>
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
		<h3>Popis pacijenata</h3>

		<input type="search" class="tableSearch" data-table="popisPacijenataTable" placeholder="Search">

		<table class="popisPacijenataTable" id="dataTable">
				<?php
					$row = 1;
					$file = fopen("podaci.csv", "r");
					while ($row<=21) {
						$data = fgetcsv($file, 8000);
					    $splitdata=explode(';', $data[0]);
					    echo '<tr>';
					    for ($i=0; $i <= 6; $i++) {
							echo '<td>';
					        echo $splitdata[$i];
					        echo '</td>';
					    }
						echo '</tr>';
						$row++;
					}
					fclose($file);
				?>
		</table>
		

	</div>

</div>

<footer class="footerWrapper">
		<p>CopyRight ZDK.2014</p>
</footer>

<!-- Skripta za filtriranje i to -->

<script type="text/javascript">
	
	(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('tableSearch');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);

</script>
	
</body>
</html>