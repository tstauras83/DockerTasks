<?php

include 'Car2.php';
class Kuper extends Car2 {
    public bool $openDoor;

    //Alternate constructor
    //    public function __construct($make, $model, public bool $openDoor) {
    //        parent::__construct($make, $model);
    //    }
    public function __construct($make, $model, $openDoor) {
        parent::__construct($make, $model);
        $this->openDoor = $openDoor;
    }

    public function CarInformation() {
        $info = parent::CarInformation();
        $doorBool = $this->openDoor ? "Taip" : "Ne";
        $info .= ", ar durys atidarytos: " . $doorBool;
            return $info;
    }
}