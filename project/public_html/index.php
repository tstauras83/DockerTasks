<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use KCS\SakykLabas;
use KCS\DbConnect as DB;

echo "<meta charset='utf-8'>";
SakykLabas::vardas('Vardenis');

$host = 'db';
$user = 'devuser';
$password = 'devpass';
$db = 'kcs_db';

DB::tikrintiPrisijungima($host, $user, $password, $db);

if(!empty($_REQUEST)){
    echo '<hr>Gauti užklausos duomenys:<br><br>';
    var_dump($_REQUEST);
}
