<?php
session_start();
session_destroy(); // Destroy all sessions
header("Location: index.php"); // Redirect to the login page
exit();
?>
