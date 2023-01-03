<?php

include 'Person.php';
 class DataOutput {
     public function outputPersons($people) {
         foreach ($people as $person) {
             echo 'Name: ' . $person->getName() . ", Age: " . $person->getAge() . " years old.<br>";
         }
     }

     public function outputPD($persons, $year) {
         foreach ($persons as $person) {
             if ($person->getDob() == $year) {
                 echo 'Name: ' . $person->getName() . ", Age: " . $person->getAge() . " years old<br>";
             }
         }
     }
     public function outputTable($people) {
         echo '<br><table class="table table-dark table-striped table-hover table-bordered border-secondary ">';
         echo '<tr><th scope="col">Name</th><th>Age</th></tr>';
         foreach ($people as $person) {
             echo "<tr><td>" . $person->getName() . "</td><td>" . $person->getAge() . "</td></tr>";
         }
         echo "</table>";
     }
 }