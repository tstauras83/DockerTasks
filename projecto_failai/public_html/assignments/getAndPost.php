<?php

// get Json file and decode it
$json = file_get_contents('peopleArray.json');
$arr = json_decode($json, true);

//print json data into table structure in getHTML.php file
function tableFE($filtered_arr){
    foreach($filtered_arr as $id => $person){
        echo "<tr>";
        echo "<th scope=row>$id</th>";
        echo "<td>$person[Name]</td>";
        echo "<td>$person[Age]</td>";
        echo "<td>$person[Profession]</td>";
        echo "</tr>";
    }
}



//delete a specific user from json database
if (isset($_POST['user_id'])) {
    foreach ($arr as $id => $person) {
        if ($id == $_POST['user_id']) {
            unset($arr[$id]);
            echo "<p>Successfully deleted: <br> ID:". $id . "<br> Name: " . $person['Name'] . "<br> Age: " . $person['Age'] . "<br> Profession: " . $person['Profession'] . "</p>";
        }
    }
    file_put_contents('peopleArray.json', json_encode($arr));
}



//filter age and exclude students from the printed results
$age_from = isset($_REQUEST['age_from']) ? (int)$_REQUEST['age_from'] : null;
$exclude_students = isset($_REQUEST['exclude_students']) ? (bool)$_REQUEST['exclude_students'] : false;

$filtered_arr = array_filter($arr, function ($person) use ($age_from, $exclude_students) {
    return ($age_from === null || (int)$person['Age'] >= $age_from) && (!$exclude_students || !in_array($person['Profession'], ['Studente', 'Studentas']));
});

if(isset($_POST['user_id2']) && isset($_POST['Name']) && isset($_POST['Age']) && isset($_POST['Profession'])){
    // Find the user with the specified ID
    foreach ($filtered_arr as $id => $person) {
        if ($id == $_POST['user_id2']) {
            // Update the user's details
            $Name = $_POST['Name'];
            $Age = $_POST['Age'];
            $Profession  = $_POST['Profession'];
            echo "<p>Successfully Edited: <br> ID:". $id . "<br> Name: " . $person['Name'] . "<br> Age: " . $person['Age'] . "<br> Profession: " . $person['Profession'] . "</p>";

            return '<p>Successfully updated user details!</p>';
        }
    }
    // Write the updated array back to the JSON file
    file_put_contents('peopleArray.json', json_encode($arr));
}

// add new people to the json array data
if (isset($_POST['form_submitted'])) {
    if (isset($_POST['form_Name']) && isset($_POST['form_Age']) && isset($_POST['form_Prof'])) {
        $form_Name = $_POST['form_Name'];
        $form_Age = $_POST['form_Age'];
        $form_Prof  = $_POST['form_Prof'];

        $newPerson = [
            'Name' => $form_Name,
            'Age' => $form_Age,
            'Profession' => $form_Prof
        ];

        // Read the contents of the file into a string
        $json = file_get_contents('peopleArray.json');

        // Decode the JSON string into an array
        $filtered_arr = json_decode($json, true);

        // Add the new person to the array
        $filtered_arr[] = $newPerson;

        // Encode the array back into a JSON string
        $json = json_encode($filtered_arr);

        // Write the JSON string back to the file
        file_put_contents('peopleArray.json', $json);

        // Display a success message and clear the form fields
        echo "<p>Form submitted successfully!</p>";

        //unset fields
        unset($form_Name);
        unset($form_Age);
        unset($form_Prof);
    }
}




