<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // We grab the ID and Password from the login form
    $login_student_id = trim($_POST['student_ID']); 
    $login_pass = $_POST['password'];

    //  Check if ANY user is registered in the session
    if (!isset($_SESSION['student_id'])) {
        $_SESSION['login_error'] = "No account found. Please register first.";
        header("Location: login.php");
        exit();
    }

    //  The Verification
    // Compare the typed ID with the one stored in Session
    $stored_id = $_SESSION['student_id'];
    $stored_hash = $_SESSION['password_storage']; // This is the hashed password from signup

    if ($login_student_id === $stored_id && password_verify($login_pass, $stored_hash)) {
        
        // SUCCESS: Mark them as officially logged in
        $_SESSION['is_logged_in'] = true;
        
        // Clear any old login errors
        unset($_SESSION['login_error']);

        // Send them to the Group 5 Dashboard
        header("Location: dashboard.php");
        exit();
        
    } else {
        // FAIL: Wrong ID or Password
        $_SESSION['login_error'] = "Invalid Student ID or Password!";
        header("Location: login.php");
        exit();
    }
}