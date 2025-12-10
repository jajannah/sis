<?php
require_once 'User.php';

class Student extends User {

    public function updateProfile($name, $course, $year, $contact) {
        $students = $this->db->read();
        foreach ($students as &$s) {
            if ($s['email'] === $_SESSION['email']) {
                $s['name'] = $name;
                $s['course'] = $course;
                $s['year'] = $year;
                $s['contact'] = $contact;
                $this->db->write($students);
                return "Profile updated successfully!";
            }
        }
        return "Error updating profile!";
    }
}
