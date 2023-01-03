<?php





$temperatures = [78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];


//[2.1] Plot the results in Celsius
function Celsius($temperatures)
{
//calculate Celsius temperature
    $celsiusTemp = array_map(function ($temp) {
        return round(($temp - 32) * 5 / 9, 2);
    }, $temperatures);

// Output the results
    echo "Temperature: ";
    sort($celsiusTemp); //sorting the results lowest to highest
    foreach ($celsiusTemp as $temp) {
        echo $temp . "°C, ";
    }
// Return the array of Celsius temperatures
    return $celsiusTemp;
}
$celsiusTemp = Celsius($temperatures);
echo '<br><br><br>';


//[2] Write a script that will calculate and display the average temperature, five lowest and highest temperatures.
function avgLHT($celsiusTemp)
{
//calculate the sum of all temperatures
    $sum = array_sum($celsiusTemp);

//calculate the average temperature
    $average = $sum / count($celsiusTemp);

//sort the temperature in ascending order
    sort($celsiusTemp);

//get the give lowers temperature
    $lowestTemps = array_slice($celsiusTemp, 0, 5);

//get the give the highest temperature
    $highestTemps = array_slice($celsiusTemp, -5);

// Display the results
    echo "Average temperature: $average °C<br>";
    echo "Five lowest temperatures: " . implode(', ', $lowestTemps) . "<br>";
    echo "Five highest temperatures: " . implode(', ', $highestTemps) . "<br>";
}
avgLHT($celsiusTemp);


//[2.2] Display results graphically (advanced)
function display($celsiusTemp){
// Calculate the maximum temperature
    $maxTemp = max($celsiusTemp);

// Calculate the scale factor
    $scaleFactor = 200 / $maxTemp;

//output
    foreach ($celsiusTemp as $temp) {
        $height = $temp * $scaleFactor;
        echo "<div style='display: inline-block; width: 60px; position: relative; background-color: #ad9f9f; border: 4px solid black; height: {$height}px'>";
        echo "<div style='position: absolute; top: -20px; left: 0; width: 60px; text-align: center;'>$temp °C</div>";
        echo "</div>";
    }
}
display($celsiusTemp);

echo '<br><br><br>';


//[2.3] Display results without duplicates (advanced)
function noDupes($celsiusTemp)
{
//find all unique results
    $uniqueTemps = array_unique($celsiusTemp);

//output results
    echo "Temperatures (Celsius): ";
    foreach ($uniqueTemps as $temp) {
        echo "$temp °C,  ";
    }
}
noDupes($celsiusTemp);


echo '<br><br><br>';

//super globals
/*$GLOBALS
$_SERVER
$_REQEST
$_POST
$_GET
$_FILES
$_ENV
$_COOKIE
$_SESSION*/


//[3] Find the shortest and longest element of an array.

$arr = ["abcd", "abc", "de", "hjjj", "g", "wer"];

//sets both answers to null
$shortest = null;
$longest = null;

//checking for shortest and longest elements
foreach($arr as $word){
    //finds the shortest length word
    if($shortest === null || strlen($word) < strlen($shortest)) {
        $shortest = $word;
    }
    //finds the longest length word
    if($longest === null || strlen($word) > strlen($longest)) {
        $longest = $word;
    }
}
//output results
echo 'Shortest word: ' . $shortest . '<br>';
echo 'Longest word: ' . $longest . '<br>';

echo '<br>';

//Duotas masyvas:Rasti Trumpiausią ir ilgiausą masyvo elementą.
$raides = ["abcd", "abc", "de", "hjjj", "g", "wer"];
function suskaiciuotRaides($array){
    $newArray = [];
    for ($i = 0; $i < count($array); $i++) {
        $ilgis = strlen(($array[$i]));
        $newArray[$ilgis][] = $array[$i];
    }
    return $newArray;
}
$newArray = suskaiciuotRaides($raides);
echo '<br>';
$first_value = reset($newArray);
$last_value = end($newArray);
echo 'Longest values: ' . implode(', ',$first_value);
echo '<br>';
echo 'Shortest values: ' . implode(', ',$last_value);


echo '<br><br><br>';

//[4] Create a new array $result by concatenating the $firstname and $surname arrays following the rules of the $map array. Output the results of the $result array
function concatNameAndSurname(): void
{
    $names = ["Jonas", "Petras", "Kazys", "Zigmas", "Ona", "Janina", "Kristina"];
    $surnames = ["Joninis", "Petrinis", "Kazinis", "Zigminis", "Onienė", "Jonė", "Kristė"];
    $map = [1, 1, 2, 2, 1, 2, 2, 3, 1, 3, 2, 1, 1, 4, 2, 4, 1, 5, 2, 7, 1, 6, 2, 5, 1, 7, 2, 6];
    $result = [];
    for ($i = 0; $i < count($map); $i++) {
        $nameIndex = $map[$i] - 1; //subtract 1 to convert 1 - based indices to 0-based indices
        $surnameIndex = $map[($i + 1) % count($map)] - 1; // use the next index in the map array as the surname index, wrapping around if necessary
        $result[] = $names[$nameIndex] . ", " . $surnames[$surnameIndex];
    }
    echo implode("<br>", $result);
}

concatNameAndSurname();

echo '<br> <br> <br>';


//[5] Given a two-dimensional array. Calculate matrix elements,   Amount, Row average, Column average, Average of all items

function matrix():void
{
    $matrix = [
        [9, 6, 8, 4, 7],
        [4, 8, 9, 3, 1],
        [3, 4, 8, 4, 6],
        [2, 6, 1, 4, 4],
        [7, 7, 5, 8, 2],
    ];

// Calculate the amount of elements in the matrix
    $num_rows = count($matrix);
    $num_cols = count($matrix[0]);
    $num_elements = $num_rows * $num_cols;
    echo "Number of elements in the matrix: $num_elements<br>";

// Calculate the row average
    foreach ($matrix as $i   $row) {
        $row_sum = array_sum($row);
        $row_avg = $row_sum / $num_cols;
        echo "Average for row $i: $row_avg<br>";
    }

// Calculate the column average
    $transposed_matrix = array_map(null, ...$matrix);
    foreach ($transposed_matrix as $i => $column) {
        $column_sum = array_sum($column);
        $column_avg = $column_sum / $num_rows;
        echo "Average for column $i: $column_avg<br>";
    }

// Calculate the average of all items in the matrix
    $matrix_sum = 0;
    foreach ($matrix as $row) {
        $matrix_sum += array_sum($row);
    }
    $matrix_avg = $matrix_sum / $num_elements;
    echo "Average for all items in the matrix: $matrix_avg<br>";

}
matrix();


//object Car assignment

include ('../../src/Cars.php');

$automobilis = new Cars();
$automobilis->spalva = 'raudona';
$automobilis->greitis = '100km/h';
$automobilis->vaziuoti(5);
echo '<br>Rida: ' . $automobilis->gautiRida();

$audi = new Cars();
$audi->spalva = 'Juoda';
$audi->greitis = '100km/h';
echo '<br>';
$audi->vaziuoti(5);
echo '<br>' . $audi->gautiRida();


//Funkcijos
//1 done ^

//[2] Create unit conversion functions

//[a] Kilometers -> miles -> kilometers

//[b] kilograms -> pounds -> kilograms

//[c] Celsius -> Fahrenheit -> Celsius

//[d] functions must accept a second parameter that specifies which measurement to convert the value to.

















