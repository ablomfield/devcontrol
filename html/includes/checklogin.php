<?php
if (isset($_SESSION['personid'])) {
    $loggedin = True;
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
