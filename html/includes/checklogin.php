<?php
if (isset($_SESSION['personid'])) {
    $loggedin = True;
    $displayname = $_SESSION["displayname"];
    $authtoken = $_SESSION["authtoken"];
    $userpkid = $_SESSION["userpkid"];
    $timezone = $_SESSION["timezone"];
    $email = $_SESSION["email"];
    if (isset($_SESSION['enabledebug'])) {
        $enabledebug = $_SESSION["enabledebug"];
    } else {
        $enabledebug = 0;
    }
    if (isset($_SESSION['isadmin'])) {
        $isadmin = $_SESSION["isadmin"];
    } else {
        $isadmin = 0;
    }
} else {
    $loggedin = False;
    if ($sitesec != "home") {
        header('Location: /');
    }
}
