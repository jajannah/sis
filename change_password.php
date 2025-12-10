<?php
require_once 'Student.php';
$student = new Student();

if (!$student->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$message = '';
if (isset($_POST['change_password'])) {
    $message = $student->changePassword($_POST['current_password'], $_POST['new_password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Change Password</h2>
    <?php if($message != '') echo "<p class='message'>$message</p>"; ?>
    <form method="POST">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <button type="submit" name="change_password">Update Password</button>
    </form>
    <a href="profile.php">Back to Dashboard</a>
</div>
</body>
</html>
