<?php
//Open the existing session so we can access it
session_start();

// Remove all user data from the session (name, student_id, etc.)
session_unset();

// Completely destroy the session on the server
session_destroy();


// Send the student back to the login page
header("Location: login.php");
exit();
?>