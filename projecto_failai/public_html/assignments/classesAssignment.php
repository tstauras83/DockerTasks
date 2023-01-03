<?php


include '../../src/Student.php';
include '../../src/Group.php';
//task 1 Create an array of 20 students.



$studentsArray = [
    0 => [
        "id" => 41566201562,
        "name" => "Gabija",
        "surname" => "TEST",
        "age" => "27",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    1 => [
        "id" => 45618963785,
        "name" => "Živilė",
        "surname" => "TEST",
        "age" => "18",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    2 => [
        "id" => 46791852375,
        "name" => "Ugnė",
        "surname" => "TEST",
        "age" => "36",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
    3 => [
        "id" => 36798531267,
        "name" => "Rolandas",
        "surname" => "TEST",
        "age" => "33",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    4 => [
        "id" => 45619785266,
        "name" => "Rimantė",
        "surname" => "TEST",
        "age" => "57",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
    5 => [
        "id" => 46152379856,
        "name" => "Roberta",
        "surname" => "TEST",
        "age" => "56",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    6 => [
        "id" => 36451254678,
        "name" => "Nojus",
        "surname" => "TEST",
        "age" => "21",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    7 => [
        "id" => 461579253796,
        "name" => "Nikolė",
        "surname" => "TEST",
        "age" => "26",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
    8 => [
        "id" => 345651294549,
        "name" => "Liutauras",
        "surname" => "TEST",
        "age" => "27",
        "group" => "CS1V",
        "address" => "CS1V"
    ],
    9 => [
        "id" => 459729637967,
        "name" => "Laura",
        "surname" => "TEST",
        "age" => "62",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    10 => [
        "id" => 469376372679,
        "name" => "Gintarė",
        "surname" => "TEST",
        "age" => "45",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    11 => [
        "id" => 346215971544,
        "name" => "Gabrielius",
        "surname" => "TEST",
        "age" => "49",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
    12 => [
        "id" => 492723976161,
        "name" => "Eglė",
        "surname" => "TEST",
        "age" => "53",
        "group" => "CS1V",
        "address" => "CS1V"
    ],
    13 => [
        "id" => 314159719764,
        "name" => "Erikas",
        "surname" => "TEST",
        "age" => "55",
        "group" => "CS1V",
        "address" => "CS1V"
    ],
    14 => [
        "id" => 419637923379,
        "name" => "Dovilė",
        "surname" => "TEST",
        "age" => "33",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    15 => [
        "id" => 341295744697,
        "name" => "Domas",
        "surname" => "TEST",
        "age" => "29",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    16 => [
        "id" => 349527654196,
        "name" => "Borisas",
        "surname" => "TEST",
        "age" => "53",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    17 => [
        "id" => 41962721626,
        "name" => "Brigita",
        "surname" => "TEST",
        "age" => "23",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    18 => [
        "id" => 349546159672,
        "name" => "Adas",
        "surname" => "TEST",
        "age" => "38",
        "group" => "CS1V",
        "address" => "CS1V"
    ],
    19 => [
        "id" => 469562929746,
        "name" => "Agnė",
        "surname" => "TEST",
        "age" => "33",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    20 => [
        "id" => 34956549761,
        "name" => "Arnas",
        "surname" => "TEST",
        "age" => "18",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    21 => [
        "id" => 497526529132,
        "name" => "Ieva",
        "surname" => "TEST",
        "age" => "27",
        "group" => "CS1V",
        "address" => "CS1V"
    ],
    22 => [
        "id" => 23412954651,
        "name" => "Tadas",
        "surname" => "TEST",
        "age" => "23",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
    23 => [
        "id" => 374965491237,
        "name" => "Kestutis",
        "surname" => "TEST",
        "age" => "30",
        "group" => "CS1D",
        "address" => "CS1D"
    ],
    24 => [
        "id" => 349516415937,
        "name" => "Petras",
        "surname" => "TEST",
        "age" => "37",
        "group" => "CS2D",
        "address" => "CS2D"
    ],
    25 => [
        "id" => 379156312647,
        "name" => "Tomas",
        "surname" => "TEST",
        "age" => "48",
        "group" => "CS2V",
        "address" => "CS2V"
    ],
];


//task 2 Create several groups (eg: “CS*V” (* group number, V-evening, D-day) ) assign these groups to students

$groups = Group::createGroups();
$students = Student::createStudents($studentsArray, $groups);

foreach ($groups as $group) {
    echo '<h2>' . $group->name . '</h2>';
    echo '<ul>';
    foreach ($group->students as $student) {
        echo '<li>' . $student->name . '</li>';
    }
    echo '</ul>';
}

echo '<li>' . $student->name . ' (' . $student->age . ' years old)';


//task 3 Sort and print students by gender (in different lists <ul>)
$sortedStudents = Student::sortByGender($students);
echo '<h2>Males</h2>';
echo '<ul>';
foreach ($sortedStudents['males'] as $student) {
    echo '<li>' . $student->name . '</li>';
}
echo '</ul>';

echo '<h2>Females</h2>';
echo '<ul>';
foreach ($sortedStudents['females'] as $student) {
    echo '<li>' . $student->name . '</li>';
}
echo '</ul>';

//task 4 Find the youngest and oldest students. Screen print in different colors

$youngestOldest = Student::findYO($students);
Student::printStudentYO($youngestOldest['youngest'], 'green');
Student::printStudentYO($youngestOldest['oldest'], 'red');

echo '<br>';

//task 5  Create Day/Evening groups filtering form.

echo '<form method="POST"><label for="group_type">Group Type:</label><select name="group_type" id="group_type"><option value="">All</option><option value="D">Day</option><option value="V">Evening</option></select><button type="submit">Filter</button></form>';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $groupType = $_POST['group_type'];
    $filteredGroups = Group::filterGroups($groups, $groupType);
} else {
    $filteredGroups = $groups;
}

echo '<h2>Groups</h2>';
foreach ($filteredGroups as $group) {
    echo '<h3>' . $group->name . '</h3>';
    echo '<ul>';
    foreach ($group->students as $student) {
        echo '<li>' . $student->name . '</li>';
    }
    echo '</ul>';
}

//6 BONUS: Invent and describe an Address class and its properties and assign this class to a Student or Group via the $addess property