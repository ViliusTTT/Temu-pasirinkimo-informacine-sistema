<?php
//Operacijos rezervuotų temų išvalymui 
$dbc = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
$query = "TRUNCATE TABLE rezervuotos_temos ";
mysqli_query($dbc, $query) or die('Database error!');
 header("Location: operacija2.php");