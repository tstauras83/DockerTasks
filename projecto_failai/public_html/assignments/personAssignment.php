<?php
echo '<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>';



//include '../../src/Person.php';
include '../../src/DataRendering.php';
$userData = [
    ['name' => 'Jonas', 'dob' => 1965],
    ['name' => 'Petras1', 'dob' => 1970],
    ['name' => 'Petras5', 'dob' => 1970],
    ['name' => 'Petras3', 'dob' => 1970],
    ['name' => 'Petras2', 'dob' => 1970],
    ['name' => 'Antanas', 'dob' => 1980],
    ['name' => 'Ona', 'dob' => 1990],
    ['name' => 'Maryte', 'dob' => 2000],
    ['name' => 'Petras', 'dob' => 1986],
    ['name' => 'Antanas', 'dob' => 2005],
];


/*$person = new Person('Tauras', 19990309);
echo "Name: " . $person->getName() . "<br>";
echo "Age: " . $person->getAge() . "<br>";*/

$people = [];
foreach ($userData as $data) {
    $people[] = new Person($data["name"], $data["dob"]);
}

$output = new DataOutput();
$output->outputPersons($people);
echo '<br>';
$output->outputPD($people, 1970);
echo '<br>';
$output->outputTable($people);




/*
1. loop through each entry in the $userData array
2. and each time we create a new "newPerson()" object
3. we put the newly created object in the $persons array
4. You create a DataOutput class
5. In the DataOutput class, we create a method to outputPersons($persons)
6. The method outputPersons($persons) must print all persons
7. BONUS: The method outputPersonsByDate($persons, $gmmd) should print persons by year of birth
8. BONUS: The method outputPersons in Table($persons) must print the persons in the <table> HTML element*/