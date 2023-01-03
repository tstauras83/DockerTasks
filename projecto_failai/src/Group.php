<?php

class Group {
    public float $id;
    public string $name;
    public string $address;
    public float $student_count;
    public array $students;

    public function __construct($id, $name, $address, $student_count) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->student_count = $student_count;
        $this->students = [];
    }

    public static function createGroups() {
        return [
            new Group(1, 'CS1V', 'Address 1', 0),
            new Group(2, 'CS1D', 'Address 2', 0),
            new Group(3, 'CS2D', 'Address 3', 0),
            new Group(4, 'CS2V', 'Address 4', 0)
        ];
    }
    public static function filterGroups($groups, $groupType) {
        if ($groupType == 'D') {
            return array_filter($groups, function($group) {
                return substr($group->name, -1) == 'D';
            });
        } elseif ($groupType == 'V') {
            return array_filter($groups, function($group) {
                return substr($group->name, -1) == 'V';
            });
        } else {
            return $groups;
        }
    }


}