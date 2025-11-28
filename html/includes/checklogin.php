<?php
if (isset($_SESSION['personid'])) {
    $loggedin = True;
    $displayname = $_SESSION["displayname"];
    if (isset($_SESSION['enabledebug'])) {
        $enabledebug = $_SESSION["enabledebug"];
    } else {
        $enabledebug = 0;
    }
    $isadmin = $_SESSION["isadmin"];
} else {
    $loggedin = False;
    if ($sitesec != "home") {
        header('Location: /');
    }
}
