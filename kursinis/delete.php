<?php
//Operacijos temos pašalinimui iš siūlomų temų pagal id 
$id = $_GET['id'];
$dbc = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
$query = "DELETE FROM siulomos_temos WHERE id = '$id'";mysqli_query($dbc, $query) or die('Database error!');
 header("Location: operacija3.php");