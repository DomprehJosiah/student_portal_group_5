<?php 
session_start();

//  Handle Error Messages (Red)
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : "";
unset($_SESSION['login_error']); 

//  Handle Success Messages (Green)
$success = isset($_SESSION['login_success']) ? $_SESSION['login_success'] : "";
unset($_SESSION['login_success']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 5 - Student Login</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="icon" type="image/png" href="assets/images/logo.png">
</head>
<body>

<div class="overlay">
    <div class="login-box login-card"> <div class="logo">
            <img src="assets/images/logo_blue.png" alt="School Logo">
            <h2>Student Login</h2>
        </div>

        <?php if($error != ""): ?>
    <div style="background:#fee; color:#b00; padding:12px; margin-bottom:20px; border-left:5px solid #f55; border-radius:4px; font-size:14px; text-align:left;">
        ⚠️ <?php echo $error; ?>
    </div>
<?php endif; ?>

        <form action="login_action.php" method="POST">

            <div class="input-group full-width">
                <input type="text" name="student_ID" required>
                <label>Student ID</label>
            </div>

            <div class="input-group full-width">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit" class="btn">Sign In</button>

        </form>

        <div class="extra-links">
            <a href="register.php">New student? Create an account</a>
        </div>

    </div>
</div>

</body>
</html>