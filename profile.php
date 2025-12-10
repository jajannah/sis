<?php
require_once 'Student.php';
$student = new Student();

if (!$student->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user = $student->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title-wrapper"><h1>Student Information System</h1></div>
<div class="profile-card">
    <h2>Welcome, <?= $user['name'] ?>!</h2>
    <p><strong>Name:</strong> <?= $user['name'] ?></p>
    <p><strong>Course:</strong> <?= $user['course'] ?></p>
    <p><strong>Year:</strong> <?= $user['year'] ?></p>
    <p><strong>Contact:</strong> <?= $user['contact'] ?></p>
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <div class="button-group">
        <a href="edit_profile.php" class="button-link">Edit Profile</a>
        <a href="change_password.php" class="button-link">Change Password</a>
        <a href="logout.php" class="button-link">Logout</a>
    </div>
</div>
</body>
</html>
