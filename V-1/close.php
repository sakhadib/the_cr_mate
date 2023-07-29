<?php
// Start the session (if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the session exists and has been inactive for 20 minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // Session has been inactive for 20 minutes, destroy the session
    session_unset();
    session_destroy();
}

// Update the last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();
?>
