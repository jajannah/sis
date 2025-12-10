<?php
session_start();
if (!isset($_SESSION['email'])) header("Location: login.php");

$data = json_decode(file_get_contents('students.json'), true) ?: [];
$student = null;
foreach ($data as $s) {
    if ($s['email'] == $_SESSION['email']) {
        $student = $s;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="title-wrapper">
        <h1>Student Information System</h1>
    </div>
    <div class="profile-card">
        <h2>Welcome, <?php echo $student['name']; ?>!</h2>
        <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
        <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
        <p><strong>Year:</strong> <?php echo $student['year']; ?></p>
        <p><strong>Contact:</strong> <?php echo $student['contact']; ?></p>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
        <div class="button-group">
            <a href="edit_profile.php" class="button-link">Edit Profile</a>
            <a href="change_password.php" class="button-link">Change Password</a>
            <a href="logout.php" class="button-link">Logout</a>
        </div>
    </div>
</body>

</html>

