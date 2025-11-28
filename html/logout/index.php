<?php
session_start();

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Log Out
session_destroy();

// Remove Cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}

header('Location: /');
?>