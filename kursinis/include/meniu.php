<?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
    <table width=100% border="0" cellspacing="1" cellpadding="3" class="meniu">
        <?php
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>$session->username</b> <br>";
        echo "</td></tr><tr><td>";
        echo "[<a href=\"" . $path . "useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
		 if ($session->isStudent() ||$session->isManager()) {
            echo "[<a href=\"" . $path . "operacija1.php\">Siūlyti temas</a>] &nbsp;&nbsp;" . "[<a href=\"" . $path . "operacija2.php\">Peržiūrėti patvirtintas/užrezervuotas temas</a>] &nbsp;&nbsp;";
        }
        //Trečia operacija rodoma vadovui
        if ($session->isManager()) {
            echo "[<a href=\"" . $path . "operacija3.php\">Įvesti/trinti temas</a>] &nbsp;&nbsp;";
			 echo "[<a href=\"" . $path . "operacija4.php\">Surasti studentą</a>] &nbsp;&nbsp;";
        }
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($session->isAdmin()) {
            echo "[<a href=\"" . $path . "admin/admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"" . $path . "process.php\">Atsijungti</a>]";
        echo "</td></tr>";
        ?>
    </table>
    <?php
}//Meniu baigtas
?>

