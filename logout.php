<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
echo "Please whait a moment while we log you out.";
header( "refresh:2; url=register.php" );
exit;
?>