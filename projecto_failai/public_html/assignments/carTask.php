<?php

include '../../src/Cars.php';

$bmw = new Car();
$bmw->color = 'Raudonas';
$bmw->speed = 100;
$bmw->setFuelTankCapacity(50); // set fuel tank capacity

// Drive 86 km
$distance = 86;
$hours = $distance / $bmw->speed;
$bmw->drive($hours, 50);
echo '<br>Remaining fuel after driving 86 km: ' . $bmw->getRemainingFuel();

// Increase speed from 0 to 55 km/h in 0.5 min and drive 20 km
$stopTime = 0.5 * 60; // 0.5 min in seconds
$speedIncrease = 55 - $bmw->speed;
$acceleration = $speedIncrease / $stopTime;
$distanceCovered = 0.5 * $bmw->speed + 0.5 * $acceleration * $stopTime * $stopTime;
$bmw->speed = $bmw->speed + $acceleration * $stopTime;
$bmw->drive($stopTime, $distanceCovered / 10);

// Stop the car for 30 sec
$stopTime = 30 / 3600;
$bmw->speed = 0;
$bmw->drive($stopTime, $bmw->getRemainingFuel());
echo '<br>Remaining fuel after driving and stopping: ' . $bmw->getRemainingFuel();