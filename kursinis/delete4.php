<?php
//Operacijos siūlomų temų išvalymui 
$dbc = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
$query = "TRUNCATE TABLE siulomos_temos ";
mysqli_query($dbc, $query) or die('Database error!');
 header("Location: operacija3.php");