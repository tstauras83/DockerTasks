<?php
//comment
#comment
/*multi line comment*/
/*
$i = 5 * 2;
echo $i;*/
// $ = let in js
// adding strings using . symbol
/*$cars = ['Volvo', 'BMW', 'Toyota', 'Audi'];
$arrLength = count($cars);
for ($i = 0; $i < $arrLength; $i++){
    echo $cars[$i] . '<br>';
}
$age = array("Peter"=>'35', "John"=>'37', "Ben"=>'55');
foreach($age as $x => $x_value){
    echo 'Key= ' . $x . ', Value=  ' . $x_value;
    echo '<br>';
}*/

$ceu = [
    "Italy" => "Rome",
    "Luxembourg" => "Luxembourg",
    "Belgium" => "Brussels",
    "Denmark" => "Copenhagen",
    "Finland" => "Helsinki",
    "France" => "Paris",
    "Slovakia" => "Bratislava",
    "Slovenia" => "Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland" => "Dublin",
    "Netherlands" => "Amsterdam",
    "Portugal" => "Lisbon",
    "Spain" => "Madrid",
    "Sweden" => "Stockholm",
    "United Kingdom" => "London",
    "Cyprus" => "Nicosia",
    "Lithuania" => "Vilnius",
    "Czech Republic" => "Prague",
    "Estonia" => "Tallin",
    "Hungary" => "Budapest",
    "Latvia" => "Riga",
    "Malta" => "Valetta",
    "Austria" => "Vienna",
    "Poland" => "Warsaw",
] ;
function Unordered($ceu)
{
    echo 'Task 1<br>';
    foreach ($ceu as $key => $key_value){
        echo 'Key: ' . $key . ', Value:' . $key_value . '<br>';
    }
}
Unordered($ceu);

function aSorted($ceu){
    echo '<br>Task 2<br>';
    $sorted = $ceu;
    ksort($sorted);
    foreach ($sorted as $key => $key_value){
        echo 'Key: ' . $key . ', Value:' . $key_value . '<br>';
    }
}
aSorted($ceu);

/*function xthElement($ceu){
    echo '<br>Task3<br>';
    $x = 2; //variable of how many nth elements are shown
    $i = 0;
    foreach($ceu as $key => $key_value){
        if ($i % $x == 0) { // if i % x == o echo out the below code
            echo 'Key: ' . $key . ', Value:' . $key_value . '<br>';
        }
        $i++;
    }
}
xthElement($ceu);*/

function xthElement($ceu){
    echo '<br>Task3<br>';
    $x = 2; //variable of how many nth elements are shown

    for ($i = 0; $i < count($ceu); $i++) {
        if ($i % $x == 0) {
            $key = array_keys($ceu)[$i];
            $key_value = $ceu[$key];
            echo 'Key: ' . $key . ', Value:' . $key_value . '<br>';
        }
    }
}
xthElement($ceu);

function aLetter($ceu){
    echo '<br>Task4<br>';
    $char = 'A';
    $filteredArray = array_filter($ceu, function($key) use ($char) {
        return strpos($key, $char) !== false;
    });
    foreach ($filteredArray as $key => $key_value) {
        echo 'Key: ' . $key . ', Value:' . $key_value . '<br>';
    }
}
aLetter($ceu);

function aLetterb($ceu){
    echo '<br>Task4 alternative<br>';
    $char = 'A';
    $keys = array_keys($ceu);
    $filteredKeys = array_filter($keys, function($key) use ($char) {
        return strpos($key, $char) !== false;
    });
    foreach ($filteredKeys as $key) {
        $value = $ceu[$key];
        echo 'Key: ' . $key . ', Value:' . $value . '<br>';
    }
}
aLetterb($ceu);

function splitArray($ceu){
    echo '<br>Task5<br>';
    $arrayChunks = array_chunk($ceu, ceil(count($ceu) / 2));
    echo '<div style="display: flex;">';
    foreach ($arrayChunks as $chunk) {
        echo '<div>';
        foreach ($chunk as $element) {
            echo $element . '<br>';
        }
        echo '</div>';
    }
    echo '</div>';
}
splitArray($ceu);




