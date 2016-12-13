<?php
//Operacijos temos patvirtinimui
include("include/session.php");
$id = $_GET['id'];
$kiek = $_GET['kiek'];
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
define('TIMEZONE', 'Europe/Vilnius');
date_default_timezone_set(TIMEZONE);
$date = date('Y/m/d H:i:s');
$records = mysqli_query($conn, "Select * FROM siulomos_temos WHERE id = '$id'");
$record = mysqli_fetch_assoc($records);
$query2=mysqli_query($conn, "
							INSERT INTO patvirtintos_temos(pavadinimas,patvirtines_vadovas, stud_kiekis, data )
								VALUES (
										'". $record["pavadinimas"]."',
										'".$_SESSION['username']."','$kiek',
														'$date')
														");
														$query = "DELETE FROM siulomos_temos WHERE id = '$id'";
mysqli_query($conn, $query) or die('Database error!');
 header("Location: operacija3.php");