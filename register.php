<?php
require_once 'Student.php';
$student = new Student();
$message = '';

if (isset($_POST['register'])) {
    $message = $student->register(
        $_POST['name'],
        $_POST['course'],
        $_POST['year'],
        $_POST['contact'],
        $_POST['email'],
        $_POST['password']
    );
    // redirect to login automatically if registration is successful
    if (strpos($message, 'successful') !== false) {
        header("Refresh:2; url=login.php");
    }
}

if ($student->isLoggedIn()) {
    header("Location: profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title-wrapper">
    <h1>Student Information System</h1>
</div>
<div class="container">
    <h2>Register</h2>
    <?php if($message != '') echo "<p class='message'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="year" placeholder="Year" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
