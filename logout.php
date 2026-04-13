<?php
include 'config.php';

// LOG LOGOUT
log_activity("Logout");

session_destroy();
header("Location: login.php");
exit;