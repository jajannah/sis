<?php
session_start();
if (isset($_SESSION['email'])) header("Location: profile.php");

$message = '';
if (isset($_POST['register'])) {
    $data = json_decode(file_get_contents('students.json'), true) ?: [];

    foreach ($data as $s) {
        if ($s['email'] == $_POST['email']) {
            $message = "Email already registered!";
            break;
        }
    }

    if ($message == '') {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $newStudent = [
            "id" => count($data) + 1,
            "name" => $_POST['name'],
            "course" => $_POST['course'],
            "year" => $_POST['year'],
            "contact" => $_POST['contact'],
            "email" => $_POST['email'],
            "password" => $hashedPassword 
        ];

        $data[] = $newStudent;
        file_put_contents('students.json', json_encode($data, JSON_PRETTY_PRINT));
        $message = "Registration successful! <a href='login.php'>Login here</a>";
    }
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

