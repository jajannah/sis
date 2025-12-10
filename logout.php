<?php
require_once 'Student.php';
$student = new Student();
$student->logout();
header("Location: login.php");
exit();
