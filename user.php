<?php
require_once 'Database.php';

class User {
    protected $db;
    public $email;
    public $password;

    public function __construct() {
        $this->db = new Database();
        session_start();
    }

    public function register($name, $course, $year, $contact, $email, $password) {
        $students = $this->db->read();

        foreach ($students as $s) {
            if ($s['email'] === $email) return "Email already registered!";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newStudent = [
            "id" => count($students) + 1,
            "name" => $name,
            "course" => $course,
            "year" => $year,
            "contact" => $contact,
            "email" => $email,
            "password" => $hashedPassword
        ];

        $students[] = $newStudent;
        $this->db->write($students);
        return "Registration successful! <a href='login.php'>Login here</a>";
    }

    public function login($email, $password) {
        $students = $this->db->read();
        foreach ($students as $s) {
            if ($s['email'] === $email && password_verify($password, $s['password'])) {
                $_SESSION['email'] = $email;
                return true;
            }
        }
        return false;
    }

    public function logout() {
        session_destroy();
    }

    public function isLoggedIn() {
        return isset($_SESSION['email']);
    }

    public function getCurrentUser() {
        $students = $this->db->read();
        foreach ($students as $s) {
            if ($s['email'] === $_SESSION['email']) return $s;
        }
        return null;
    }

    public function changePassword($currentPassword, $newPassword) {
    $students = $this->db->read();

    foreach ($students as &$s) {
        if ($s['email'] === $_SESSION['email']) {
            if (!password_verify($currentPassword, $s['password'])) {
                return "Current password is incorrect!";
            }
            $s['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $this->db->write($students);
            return "Password updated successfully!";
        }
    }
    return "Error updating password!";
}

}

