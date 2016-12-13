<?php
include("include/session.php");
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
//Jei prisijunges vadovas vykdomas temu patvirtinimo arba ištrinimo kodas
if ($session->logged_in && $session->isManager()) {
    ?>    
    <html>  
	<body style="background-color:powderblue;">
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Įvesti/trinti temas</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
					<link rel="stylesheet"
			href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
                        <br> 
                        <div style="text-align: center;color:blue">                   
                            <h1>Įvesti/trinti temas</h1>
                            <div class="container">
		<table class="table table-hover">
			<thead>
			 <center><label >Siūlomos temos:</label></center>
				<tr>
					<th>Nr.</th>
					<th>Temos pavadinimas</th>
					<th>Kas pasiūlė</th>
					<th>Kada pasiūlyta</th>
					<th>Įveskite studentų kiekį</th>
				</tr>
			</thead>
			<tbody>
			
				<?php //Grąžinami įrašai kol jų yra
				$records = mysqli_query($conn, "SELECT * FROM siulomos_temos");
					while($record = mysqli_fetch_assoc($records)):
						$idd = $record['id'];					
						?>
					<tr>
						<td><?php echo iconv("windows-1257", "utf-8", $record["id"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["pavadinimas"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["autorius"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["data"]);?></td>
						<td><form action ="confirm.php?" method="get">								             
							<input name='kiek' id='kiek' type='number_format' class="form-control input-sm" required="true" style="width: 80px;"></td>
							<input type="hidden" name="id" value="<?php echo $idd ?>">		
						<td><input type='submit' name='Submit1' value='pateikti' class="btn btn-default">
							</form>
						</td>
							</div>  
						<td><?php echo  "<td><a href='delete.php?id=$idd'>Ištrinti</a></td>";?></td>
					</tr>	
				<?php endwhile;
					echo  "<a href='delete4.php?'>Ištrinti visas siūlomas temas</a>";?>				
			</tbody>
		</table>
							</div>                
                        </div> 
                        <br>                         
                <tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>                       
            </table>     
			
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs arba prisijunges, bet ne Administratorius 
    //ar ne Valdytojas - užkraunamas pradinis puslapis   
} else {
    header("Location: index.php");
}
?>

