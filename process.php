<?php
/* 
 * Project: Student Management Portal - Group 5
 * Purpose: Handling secure registration and profile image uploads
 */

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* --- DATA COLLECTION & SANITIZATION --- 
       Capturing user input and cleaning it to prevent Cross-Site Scripting (XSS) 
    */
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $student_id = htmlspecialchars(trim($_POST['student_ID']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    /* --- INPUT VALIDATION --- 
       Ensuring no fields are empty before proceeding to database logic 
    */
    if (empty($fullname) || empty($student_id) || empty($email)) {
        $_SESSION['register_error'] = "All fields are required!";
        header("Location: register.php");
        exit();
    }

    /* --- SECURITY CONSTRAINT: PASSWORD LENGTH --- 
       Enforcing a minimum of 8 characters to protect against brute-force attacks 
    */
    if (strlen($password) < 8) {
        $_SESSION['register_error'] = "Security Alert: Password must be at least 8 characters long!";
        header("Location: register.php");
        exit();
    }

    /* --- PASSWORD VERIFICATION --- 
       Confirming that the user has typed the same password correctly twice 
    */
    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    /* --- CRYPTOGRAPHIC HASHING --- 
       Converting the plain-text password into a secure hash before storage 
    */
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    /* --- FILE UPLOAD CONFIGURATION --- 
       Setting the target directory and gathering metadata for the profile image 
    */
    $target_dir = "uploads/";
    
    if (!isset($_FILES["profile_image"]) || $_FILES["profile_image"]["error"] != 0) {
        $_SESSION['register_error'] = "Please upload a profile picture.";
        header("Location: register.php");
        exit();
    }

    $file_tmp = $_FILES["profile_image"]["tmp_name"];
    $file_name = $_FILES["profile_image"]["name"];
    $file_size = $_FILES["profile_image"]["size"];
    
    /* --- DIRECTORY MANAGEMENT --- 
       Automatically creating the uploads folder if it does not exist on the server 
    */
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    /* --- UPLOAD RESTRICTIONS: FILE SIZE --- 
       Limiting uploads to 2MB to save server storage and improve loading speed 
    */
    if ($file_size > 2 * 1024 * 1024) {
        $_SESSION['register_error'] = "File too large! Max 2MB.";
        header("Location: register.php");
        exit();
    }

    /* --- UPLOAD RESTRICTIONS: FILE TYPE --- 
       Restricting extensions to prevent execution of malicious scripts (.php, .exe) 
    */
    $allowed_exts = ["jpg", "jpeg", "png", "gif"];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $allowed_exts)) {
        $_SESSION['register_error'] = "Only JPG, PNG, and GIF allowed.";
        header("Location: register.php");
        exit();
    }

    /* --- SECURE FILE RENAMING --- 
       Generating a unique filename using the Student ID and current timestamp 
    */
    $new_filename = $student_id . "_" . time() . "." . $file_extension;
    $target_file = $target_dir . $new_filename;

    /* --- FINAL PROCESSING & REDIRECTION --- 
       Moving the file to the server and initializing the success state for Login 
    */
    if (move_uploaded_file($file_tmp, $target_file)) {
        
        $_SESSION['full_name'] = $fullname;
        $_SESSION['student_id'] = $student_id;
        $_SESSION['email'] = $email;
        $_SESSION['password_storage'] = $hashed_password; 
        $_SESSION['profile_pic'] = $target_file; 

        $_SESSION['login_success'] = "Registration successful! Please login with your Student ID.";
        header("Location: login.php");
        exit();
        
    } else {
        $_SESSION['register_error'] = "Upload failed. Check folder permissions.";
    }

    header("Location: register.php");
    exit();
}