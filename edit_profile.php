<?php
require_once 'Student.php';
$student = new Student();

if (!$student->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user = $student->getCurrentUser();
$message = '';

if (isset($_POST['update_profile'])) {
    $message = $student->updateProfile(
        $_POST['name'],
        $_POST['course'],
        $_POST['year'],
        $_POST['contact']
    );
    $user = $student->getCurrentUser(); // refresh user data
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Profile</h2>
    <?php if($message != '') echo "<p class='message'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="name" value="<?= $user['name'] ?>" required>
        <input type="text" name="course" value="<?= $user['course'] ?>" required>
        <input type="text" name="year" value="<?= $user['year'] ?>" required>
        <input type="text" name="contact" value="<?= $user['contact'] ?>" required>
        <input type="email" value="<?= $user['email'] ?>" disabled>
        <button type="submit" name="update_profile">Save Changes</button>
    </form>
    <a href="profile.php">Back to Dashboard</a>
</div>
</body>
</html>
