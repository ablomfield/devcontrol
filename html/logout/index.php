<?php
session_start();

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Log Out
session_destroy();
header('Location: /');
?>