<?php
    $vrstaGrafa=$_POST['pChart'];
    include('phpgraphlib/phpgraphlib.php');

    if ($vrstaGrafa=='pChart') {

        $graph = new PHPGraphLib(700,550);
        $data = array(2000, 5535, 43373, 22223, 90432, 23332, 15544, 24523,
         32778, 38878, 28787, 33243, 34832, 32302);
        $graph->addData($data);
        $graph->setTitle('Primjer grafa');
        $graph->setGradient('black', 'red');
        $graph->createGraph();

    }elseif ($vrstaGrafa=='customStupac') {

        include('../connectToDatabase.php');


        $dbc = mysqli_connect($host,$user,$pass,$database) 
                    or die('Pogreška kod spajanja na bazu podataka');

        mysqli_query($dbc, "SET NAMES 'utf8'");
        mysqli_query($dbc, "SET CHARACTER SET utf8");
        mysqli_query($dbc, "SET COLLATION_CONNECTION = 'utf8_general_ci'");
        

        $maleNumberUpit = mysqli_query($dbc, "SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE spol='M'");
        $brojMuskih = mysqli_fetch_array($maleNumberUpit);
        $femalenumberUpit = mysqli_query($dbc, "SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE spol='Ž'");
        $brojZenskih = mysqli_fetch_array($femalenumberUpit);
        $pacijentiSaTegobamaUpit = mysqli_query($dbc, "SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE prijasnjeTegobe='DA'");
        $tegobeDA = mysqli_fetch_array($pacijentiSaTegobamaUpit);
        $pacijentiBezTegobaUpit = mysqli_query($dbc, "SELECT COUNT(idUneseniPacijenti) FROM unesenipacijenti WHERE prijasnjeTegobe='NE'");
        $tegobeNE = mysqli_fetch_array($pacijentiBezTegobaUpit);


        $graph = new PHPGraphLib(700,550);
        $data = array("Male"=>"$brojMuskih[0]","Female"=>"$brojZenskih[0]","Imategoba"=>"$tegobeDA[0]","NemaTegoba"=>"$tegobeNE[0]");
        $graph->addData($data);
        $graph->setTitle('Omjeri M / Z i imaju tegobe / Nemaju tegobe');
        $graph->setGradient('red', 'maroon');
        $graph->createGraph();

            
    }



?>