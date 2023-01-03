<?php

class Car
{
// Declare class variables as private
    public string $color;
    public string $speed;
    private float $mileage;
    private float $remainingFuel;
    private float $averageFC;
    private float $fuelTankCapacity; // fuel tank capacity

    public function __construct()
    {
        $this->mileage = 0;
        $this->remainingFuel = 0;
        $this->averageFC = 0;
    }

    public function setFuelTankCapacity(float $capacity): void
    {
        $this->fuelTankCapacity = $capacity;
    }

    public function drive(float $hours, float $fuelConsumed): void
    {
        echo $this->getColor() . " automobilis važiuoja " . $this->speed . "km/h greičiu";
        $this->mileage += $this->speed * $hours;
        $this->remainingFuel -= $fuelConsumed; // decrease remaining fuel by consumed fuel
        $this->averageFC = ($fuelConsumed * 100) / $this->mileage;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getMileage(): float
    {
        return $this->mileage;
    }

    public function getRemainingFuel(): float
    {
        return $this->remainingFuel;
    }

    public function getAverageFC(): float
    {
        return $this->averageFC;
    }
}
