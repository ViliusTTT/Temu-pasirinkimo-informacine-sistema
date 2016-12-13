<?php
include("include/session.php");
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
if ($session->logged_in) {
    ?>
    <html>
        <head>  
		<body style="background-color:powderblue;">
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Temos</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet"
			href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        </head>
        <body>
            <table class="center" >
                <tr><td>
                      
                    </td></tr><tr><td> 
					 <?php
                        include("include/meniu.php");
                        ?> 
                        <?php
                        //Jei vartotojas prisijungęs
                        ?>
							<?php 

							         
?>
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>   
   <div style="text-align: center;color:blue">                   
                            <h1>Patvirtintų ir rezervuotų temų sąrašai</h1>		
							<center><label >Rikiuoti patvirtintas/rezervuotas temas pagal:</label></center>
									<form action="operacija2.php" method="post">
									<input type="radio" name="sort" value="name">Pagal pavadinimą<br>
									<input type="radio" name="sort" value="amount">Pagal studentų skaičių/Pagal kas rezervavo<br>
									<input type="submit" value="rikiuoti" />
							</form>
							<?php    $old_error_reporting = error_reporting(0);

									$answer = $_POST['sort'];  
									if ($answer == "name") {          
										$records = mysqli_query($conn, "SELECT * FROM patvirtintos_temos Order by pavadinimas asc");
										$records2 = mysqli_query($conn, "SELECT * FROM rezervuotos_temos Order by pavadinimas asc");     
											}
												else if ($answer == "amount") {
												$records = mysqli_query($conn, "SELECT * FROM patvirtintos_temos Order by stud_kiekis desc");
												 $records2 = mysqli_query($conn, "SELECT * FROM rezervuotos_temos Order by pasirinkes_stud asc ");
															}
														else{$records = mysqli_query($conn, "SELECT * FROM patvirtintos_temos ");
															 $records2 = mysqli_query($conn, "SELECT * FROM rezervuotos_temos ");  }
																	 error_reporting($old_error_reporting);
																						 ?>
                      <div class="container">
		<table class="table table-hover">
			<thead>
			 <center><label >Patvirtintos temos:</label></center>
				<tr>
					<th>Nr.</th>
					<th>Temos pavadinimas</th>
					<th>Studentų skaičius</th>
					<th>Kada patvirtinta</th>
					<th>Kas patvirtino</th>
				</tr>
			</thead>
			<tbody>
			
				<?php //Grąžinami įrašai kol jų yra
			
				
					while($record = mysqli_fetch_assoc($records)):
					$id=$record["id"];					?>
					
					<tr>
						<td><?php echo iconv("windows-1257", "utf-8", $record["id"]);?></td>
						
						<td><?php echo iconv("windows-1257", "utf-8", $record["pavadinimas"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["stud_kiekis"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["data"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record["patvirtines_vadovas"]);?></td>
						<td><?php if($session->isStudent()) echo  "<td><a href='reservation.php?id=$id'>Rezervuoti</a></td>";?></td>
					</tr>
				<?php endwhile; 
				if($session->isManager())
				 echo  "<a href='delete2.php?'>Ištrinti visas patvirtintas temas</a>";?>
			
			</tbody>
		</table>			
					</div>
	
	<div class="container">
		<table class="table table-hover">
			<thead>
			 <center><label >Rezervuotos temos:</label></center>
				<tr>
					<th>Nr.</th>
					<th>Pavadinimas</th>
					<th>Kas rezervavo</th>
					<th>Rezervacijos data</th>
				</tr>
			</thead>
			<tbody>
			
				<?php //Grąžinami įrašai kol jų yra
			
					while($record2 = mysqli_fetch_assoc($records2)): ?>
					<tr>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["id"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["pavadinimas"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["pasirinkes_stud"]);?></td>
						<td><?php echo iconv("windows-1257", "utf-8", $record2["data"]);?></td>
						
					</tr>
				<?php endwhile; 
				if($session->isManager())
				 echo  "<a href='delete3.php?'>Ištrinti visas rezervuotas temas</a>";?>
			</tbody>
		</table>
	
	</div>
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