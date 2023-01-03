<?php

require_once 'Main.php';

if (isset($_POST['number'])) {
    $num = $_POST['number'];
    $main = new Main();
    $result = $main->run($num);
    echo  $result;
} else {
    echo "No number entered.";
}




echo '<form action="index.php" method="post"><label for="number">Enter a number:</label><br><input type="number" id="number" name="number"><br><input type="submit" value="Calculate"></form>';



