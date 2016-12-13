<?php
//Operacijos temos rezervacijos vykdymui
include("include/session.php");
$id = $_GET['id'];
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
define('TIMEZONE', 'Europe/Vilnius');
date_default_timezone_set(TIMEZONE);
$date = date('Y/m/d H:i:s');
$records = mysqli_query($conn, "Select * FROM patvirtintos_temos WHERE id = '$id'");
$record = mysqli_fetch_assoc($records);
$kiekis=$record["stud_kiekis"];
//Jei temą gali pasirinkti vienas ar daugiau studentų 
if($kiekis>=1)
{
$kiekis=$kiekis-1;
$query2=mysqli_query($conn, "
							INSERT INTO rezervuotos_temos(pavadinimas,pasirinkes_stud,data)
								VALUES (
										'".$record["pavadinimas"]."',
										'".$_SESSION['username']."','$date')
														");
if($kiekis ==0)// jei temos pasirinkimo kiekis mažiau nei 1 tema ištrinama 
{$query4 = "DELETE FROM patvirtintos_temos WHERE id = '$id'";
mysqli_query($conn, $query4) or die('Database error!');}
$query3=mysqli_query($conn, "UPDATE patvirtintos_temos SET stud_kiekis='".$kiekis."'WHERE id='".$id."'");

}
else
	{$query = "DELETE FROM patvirtintos_temos WHERE id = '$id'";
mysqli_query($conn, $query) or die('Database error!');}
 header("Location: operacija2.php");
?>