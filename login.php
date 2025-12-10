<?php
require_once 'Student.php';
$student = new Student();
$message = '';

if (isset($_POST['login'])) {
    if ($student->login($_POST['email'], $_POST['password'])) {
        header("Location: profile.php");
        exit();
    } else {
        $message = "Incorrect email or password!";
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title-wrapper">
    <h1>Student Information System</h1>
</div>
<div class="container">
    <h2>Login</h2>
    <?php if($message != '') echo "<p style='color:red;'>$message</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
