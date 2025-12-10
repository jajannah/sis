<?php
session_start();
if (!isset($_SESSION['email'])) header("Location: login.php");

$data = json_decode(file_get_contents('students.json'), true) ?: [];
$student = null;

foreach ($data as $s) {
    if ($s['email'] === $_SESSION['email']) {
        $student = $s;
        break;
    }
}

$message = '';

if (isset($_POST['change_password'])) {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if (!password_verify($old, $student['password'])) {
        $message = "Old password is incorrect!";

    } elseif ($new !== $confirm) {
        $message = "New passwords do not match!";

    } else {
        foreach ($data as &$s) {
            if ($s['email'] === $_SESSION['email']) {
                $s['password'] = password_hash($new, PASSWORD_DEFAULT);
                $student = $s;
                break;
            }
        }

        file_put_contents('students.json', json_encode($data, JSON_PRETTY_PRINT));
        $message = "Password changed successfully!";
    }
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
        <?php if ($message != '') echo "<p class='message'>$message</p>"; ?>

        <form method="POST">
            <input type="password" name="old_password" placeholder="Old Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit" name="change_password">Change Password</button>
        </form>

        <a href="profile.php">Back to Profile</a>
    </div>
</body>

</html>

