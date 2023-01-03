<?php

class Car2 {
public string $make;
public string $model;

public function __construct($make, $model) {
$this->make = $make;
$this->model = $model;
}

public function CarInformation() {
return "Make: " . $this->make . ", Model: " . $this->model;
}
}
