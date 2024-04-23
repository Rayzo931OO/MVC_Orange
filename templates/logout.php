<?php
session_start();
// Remove all session variables
$_SESSION = array();
// Destroy the session
session_destroy();

// Redirect the user to the login page or any other desired location
header("Location: /mvc_orange/index.php");