<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a login page or any other desired page after logout
header("Location: login/");
exit();
?>
