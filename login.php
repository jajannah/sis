<?php
session_start();
if (isset($_SESSION['email'])) header("Location: profile.php");

$message = '';

if (isset($_POST['login'])) {
    $data = json_decode(file_get_contents('students.json'), true) ?: [];
    $foundEmail = false;

    foreach ($data as $s) {

        if ($s['email'] === $_POST['email']) {
            $foundEmail = true;

            if (password_verify($_POST['password'], $s['password'])) {

                $_SESSION['email'] = $s['email'];
                header("Location: profile.php");
                exit();

            } else {
                $message = "Incorrect password!";
            }
            break;
        }
    }

    if (!$foundEmail) {
        $message = "Email not found!";
    }
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

