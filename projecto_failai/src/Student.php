<?php

class Student {
    public float $id;
    public string $name;
    public string $surname;
    public float $age;
    public string $group;
    public string $address;

    public function __construct($id, $name, $surname, $age, $group, $address) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->group = $group;
        $this->address = $address;
    }

    public static function createStudents($studentsArray, $groups) {
        $students = [];
        foreach ($studentsArray as $studentArray) {
            $student = new Student(
                $studentArray['id'],
                $studentArray['name'],
                $studentArray['surname'],
                $studentArray['age'],
                $studentArray['group'],
                $studentArray['address']
            );
            $students[] = $student;

            // Find the group and increment the student count
            foreach ($groups as &$group) {
                if ($group->name == $student->group) {
                    $group->student_count++;
                    $group->students[] = $student;
                    break;
                }
            }
        }

        return $students;
    }


    public static function sortByGender($students) {
        $males = [];
        $females = [];

        foreach ($students as $student) {
            if (str_starts_with($student->id, '3')) {
                $males[] = $student;
            } else {
                $females[] = $student;
            }
        }

        return [
            'males' => $males,
            'females' => $females
        ];
    }
    public static function printStudentsByGender($students, $title) {
        echo '<h2>' . $title . '</h2>';
        echo '<ul>';
        foreach ($students as $student) {
            echo '<li>' . $student->name . '</li>';
        }
        echo '</ul>';
    }

    public static function findYO($students) {
        $youngest = PHP_INT_MAX;
        $oldest = PHP_INT_MIN;
        $youngestStudent = null;
        $oldestStudent = null;

        foreach ($students as $student) {
            if ($student->age < $youngest) {
                $youngest = $student->age;
                $youngestStudent = $student;
            }
            if ($student->age > $oldest) {
                $oldest = $student->age;
                $oldestStudent = $student;
            }
        }

        return [
            'youngest' => $youngestStudent,
            'oldest' => $oldestStudent
        ];
    }

    public static function printStudentYO($student, $color) {
        echo '<span style="color: ' . $color . '">' . $student->name . ' (' . $student->age . ' years old)</span><br>';
    }

}