<?php

//var_dump($_POST);

if($_POST['Name'] == 'tauras' && $_POST['Password'] == '123'){
    echo 'Hello,' . $_POST['Name'];}
else{
    echo 'Wrong Passowrd';
}