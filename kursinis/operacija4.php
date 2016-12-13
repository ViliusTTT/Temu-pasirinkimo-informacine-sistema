<?php
include("include/session.php");
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
if ($session->logged_in) {
    ?>
    <html>
	<body style="background-color:powderblue;">
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Studento radimas</title>
				<link rel="stylesheet"
			href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                       
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");

                        ?>              
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>   
<div style="text-align: center;color:blue">                   
                            <h1>Rasti studento informaciją</h1>								
                     <div class="container">
	<form method='post'>
		<div class="form-group col-lg-8">
			<label for="vardas" class="control-label">Įveskite studento prisijungimo vardą:</label>
			<input name='vardas' id='vardas' type='text' class="form-control input-sm" required="true">
		</div>
		<div class="form-group col-lg-8">
			<input type='submit' name='Submit1' value='ieškoti' class="btn btn-default">
		</div>
	</form>
		</div>  
		<table class="table table-hover">
			<thead>
			 <center><label >Informacija apie studentą:</label></center>
				<tr>
					<th>Vardas</th>
					<th>Rezervuotų temų kiekis</th>
					<th>Pasiūlytų temų kiekis</th>
				</tr>
			</thead>
		
			<tbody>
			
				<?php //Grąžinami įrašai kol jų yra
if (isset($_POST['Submit1'])) {
		define('TIMEZONE', 'Europe/Vilnius');
		date_default_timezone_set(TIMEZONE);
		$date = date('Y/m/d H:i:s');
		//iconv() funkcija, užkoduojanti UTF-8 raides į latin1 
		$vardas=$_POST['vardas'];	
		$siulytuKiek=0;
		$rezervuotuKiek=0;
		$querry = mysqli_query($conn, "SELECT * FROM siulomos_temos where autorius = '$vardas' ");
		$querry2 = mysqli_query($conn, "SELECT * FROM rezervuotos_temos where pasirinkes_stud = '$vardas' ");
		$query = mysqli_query($conn, "SELECT COUNT(autorius) AS total FROM siulomos_temos where autorius = '$vardas' ");
		$query2=mysqli_query($conn, "SELECT COUNT(pasirinkes_stud) AS total FROM rezervuotos_temos where pasirinkes_stud = '$vardas'");
			if($query||$query2){
				$rows = mysqli_fetch_array($query);
				$rows2 = mysqli_fetch_array($query2);
				$siulytuKiek=$rows['total'];
				$rezervuotuKiek=$rows2['total'];}
			else{$message = "Studento duomenų rasti nepavyko";
					echo "<script type='text/javascript'>alert('$message');</script>"; }
					?>
					<tr>
						<td><?php if($siulytuKiek!=0||$rezervuotuKiek!=0) echo iconv("windows-1257", "utf-8", $_POST["vardas"]);else{$message = "Studento duomenų rasti nepavyko";
					echo "<script type='text/javascript'>alert('$message');</script>"; }?></td>
						<td><?php if($siulytuKiek!=0||$rezervuotuKiek!=0) echo iconv("windows-1257", "utf-8", $rezervuotuKiek);?></td>
						<td><?php if($siulytuKiek!=0||$rezervuotuKiek!=0) echo iconv("windows-1257", "utf-8", $siulytuKiek);?></td>	
					</tr>
				<?php 							
}			?>	
			</tbody>

</table>
<table class="table table-hover">	
<thead>
			 <center><label >Studento rezervuotos temos informacija:</label></center>
			<tr>
					<th>Nr.</th>
					<th>Pavadinimas</th>
					<th>Rezervacijos data</th>
				</tr>
				<?php
				$old_error_reporting = error_reporting(0);
					while($record = mysqli_fetch_assoc($querry2)):
					$id=$record["id"];					?>
					
					<tr>
					<td><?php echo iconv("windows-1257", "utf-8", $record["id"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["pavadinimas"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["data"]);?></td>
					</tr>
				<?php endwhile;  ?>
				
			</thead>
			
</table>
<table class="table table-hover">	
<thead>
			 <center><label >Studento pasiūlytos temos informacija:</label></center>
		<tr>
					<th>Nr.</th>
					<th>Temos pavadinimas</th>
					<th>Kada pasiūlyta</th>
				
				</tr>
				<?php
					while($record2 = mysqli_fetch_assoc($querry)):
								?>
					
					<tr>
					<td><?php echo iconv("windows-1257", "utf-8", $record2["id"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["pavadinimas"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["data"]);?></td>
					
					</tr>
				<?php endwhile;error_reporting($old_error_reporting); ?>
			</thead>	
</table>
					<tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>