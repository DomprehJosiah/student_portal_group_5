<?php
session_start();

$error = "";
if(isset($_SESSION['register_error'])){
    $error = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="icon" type="image/png" href="assets/images/logo.png">
</head>
<body>

<div class="overlay">
    <div class="login-box">

        <div class="logo">
            <img src="assets/images/logo_blue.png" alt="School Logo">
            <h2>Student Registration</h2>
        </div>

        <?php if($error != ""): ?>
    <div style="background:#fee; color:#b00; padding:12px; margin-bottom:20px; border-left:5px solid #f55; border-radius:4px; font-size:14px; text-align:left;">
        ⚠️ <?php echo $error; ?>
    </div>
<?php endif; ?>

        <form action="process.php" method="POST" enctype="multipart/form-data">

            <div class="input-group">
                <input type="text" name="fullname" required>
                <label>Full Name</label>
            </div>

            <div class="input-group">
                <input type="text" name="student_ID" required>
                <label>Student ID</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="input-group">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
                <div class="file-upload">
                    <label>Upload Profile Picture</label>
                    <input type="file" name="profile_image" required>
                </div>

            <button type="submit" class="btn">Register</button>

        </form>

        <div class="extra-links">
            <a href="login.php">Already have an account? Login</a>
        </div>

    </div>
</div>

</body>
</html>