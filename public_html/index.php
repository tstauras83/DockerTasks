<?php

echo "<meta charset='utf-8'>";
echo "Jus sveikina KCS<br>";

$host = 'db';
$user = 'devuser';
$password = 'devpass';
$db = 'kcs_db';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    // Nustatome PDO Klaid7 rėžimą į 'Exception'
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<br>Duomenų bazė veikia";
} catch(PDOException $e) {
    echo "<br>Duomenų bazė neveikia: " . $e->getMessage();
}

if(!empty($_REQUEST)){
    echo "<hr>Gauti užklausos duomenys:<br><br>";
    var_dump($_REQUEST);
}
