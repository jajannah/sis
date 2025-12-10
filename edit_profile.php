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

$message = '';
if (isset($_POST['update_profile'])) {
    foreach ($data as &$s) {
        if ($s['email'] == $_SESSION['email']) {
            $s['name'] = $_POST['name'];
            $s['course'] = $_POST['course'];
            $s['year'] = $_POST['year'];
            $s['contact'] = $_POST['contact'];
            $student = $s;
            break;
        }
    }
    file_put_contents('students.json', json_encode($data, JSON_PRETTY_PRINT));
    $message = "Profile updated successfully!";
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
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
            <input type="text" name="course" value="<?php echo $student['course']; ?>" required>
            <input type="text" name="year" value="<?php echo $student['year']; ?>" required>
            <input type="text" name="contact" value="<?php echo $student['contact']; ?>" required>
            <input type="email" value="<?php echo $student['email']; ?>" disabled>
            <button type="submit" name="update_profile">Save Changes</button>
        </form>
        <a href="profile.php">Back to Profile</a>
    </div>
</body>

</html>

