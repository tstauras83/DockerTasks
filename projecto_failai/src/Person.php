<?php

class Person {
    private $name;
    private $dob;

    public function __construct($name, $dob) {
        $this->name = $name;
        $this->dob = $dob;
    }

    public function getName() {
        return $this->name;
    }


    //alt method for getting Age
    //    public function getAge() {
    //        $currentDate = new DateTime();
    //        $dob = new DateTime($this->dob);
    //        $age = date_diff($dob, $currentDate);
    //
    //        return $age->y . " years, " . $age->m . " months, " . $age->d . " days";
    //    }

    public function getAge() {
        $currentYear = date("Y");
        return $currentYear - $this->dob;
    }

    public function getDob() {
        return $this->dob;
    }
}