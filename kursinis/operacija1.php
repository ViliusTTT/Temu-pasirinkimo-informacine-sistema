<?php
include("include/session.php");
$conn = mysqli_connect('db.if.ktu.lt', 'viltur', 'imas5ooGohth6wee', 'viltur') or die('Connection error!'); 
if ($session->logged_in) {
    ?>
    <html>
	<body style="background-color:powderblue;">
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Temų siūlymas</title>
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
						if (isset($_POST['Submit1'])) {
							define('TIMEZONE', 'Europe/Vilnius');
							date_default_timezone_set(TIMEZONE);
							$date = date('Y/m/d H:i:s');
							//iconv() funkcija, užkoduojanti UTF-8 raides į latin1 
							$query=mysqli_query($conn, "
							INSERT INTO siulomos_temos(pavadinimas, autorius, data )
								VALUES (
										'".iconv("utf-8", "windows-1257", $_POST["pavadinimas"])."',
										'".iconv("utf-8", "windows-1257", $_SESSION['username'])."',
														'$date')
				");
				if($query)
				{
					$message = "Jūsų pasiūlymas priimtas";
					echo "<script type='text/javascript'>alert('$message');</script>";
					
				}
				else{$message = "Temos pridėti nepavyko";
					echo "<script type='text/javascript'>alert('$message');</script>"; }
				 
				
}
                        ?>              
    <table style="border-width: 2px; border-style: dotted;">
	<tr><td>
    Atgal į [<a href="index.php">Pradžia</a>]
    </td></tr></table>   
	<div style="text-align: center;color:blue">                   
                            <h1>Pasiūlyti temą</h1>								
                     <div class="container">
	<form method='post'>
	<div class="form-group col-lg-12">
	<label for="pavadinimas" class="control-label">Įveskite siūlomos temos pavadinimą</label>
	<textarea name='pavadinimas' class="form-control input-sm" required="true"></textarea>
	</div>
	<div class="form-group">
	<input type='submit' name='Submit1' value='pateikti' class="btn btn-default">
	</div>
	</form>
	</div>              
                <tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                </tr> </td> 
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>