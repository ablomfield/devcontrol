<?php
session_start();

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Load Settings
$rssettings = mysqli_query($dbconn, "SELECT * FROM settings") or die("Error in Selecting " . mysqli_error($dbconn));
$rowsettings = mysqli_fetch_assoc($rssettings);
$client_id = $rowsettings["client_id"];
$client_secret = $rowsettings["client_secret"];
$integration_id = $rowsettings["integration_id"];
$oauth_url = $rowsettings["oauth_url"];

if(isset($_GET['code'])){
     // Retrieve Code
     $oauth_code = $_GET['code'];
     $oauth_state = $_GET['state'];
     $accessarr = array (
        'grant_type' => 'authorization_code',
        'redirect_uri' => 'https://devcontrol.click/',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $oauth_code
      );
     $accessenc = http_build_query($accessarr);
     $getaccess = curl_init();
     curl_setopt_array($getaccess, array(
          CURLOPT_URL => 'https://webexapis.com/v1/access_token',
          CURLOPT_RETURNTRANSFER => true, // return the transfer as a string of the return value
          CURLOPT_TIMEOUT => 0,   // The maximum number of seconds to allow cURL functions to execute.
          CURLOPT_POST => true,   // This line must place before CURLOPT_POSTFIELDS
          CURLOPT_POSTFIELDS => $accessenc // Data that will send
     ));
     $accessdata = curl_exec($getaccess);
     $accessjson = json_decode($accessdata);
     $authtoken = $accessjson->access_token;
     $authexpires = $accessjson->expires_in;
     $refreshtoken = $accessjson->refresh_token;
     $refreshexpires = $accessjson->refresh_token_expires_in;
     $authexpires = date("Y-m-d H:i:s", time() + $authexpires);
     $refreshexpires = date("Y-m-d H:i:s", time() + $refreshexpires);
     $lastaccess = date("Y-m-d H:i:s", time());

     // Retrieve Details using authtoken
     $personurl = "https://webexapis.com/v1/people/me";
     $getperson = curl_init($personurl);
     curl_setopt($getperson, CURLOPT_CUSTOMREQUEST, "GET");
     curl_setopt($getperson, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($getperson, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json',
         'Authorization: Bearer ' . $authtoken)
     );
     $persondata = curl_exec($getperson);
     $personjson = json_decode($persondata);
     $personid = $personjson->id;
     $displayname = $personjson->displayName;
     $emailarr = $personjson->emails;
     $email = $emailarr[0];
     $avatar = $personjson->avatar;
     $orgid = $personjson->orgId;
     $_SESSION["personid"] = $personid;
     setcookie("personid", $personid, strtotime("+1 year"),"/");

     // Check if User Exists in Database
     $rsusercheck = mysqli_query($dbconn, "SELECT * FROM users WHERE personid = '" . $personid . "'");
     if(mysqli_fetch_array($rsusercheck) == false) {
         $insertsql = "INSERT INTO users (personid, displayname, email, avatar, orgid, accesstoken, accessexpires, refreshtoken, refreshexpires, lastaccess) VALUES('" . $personid . "', '" . str_replace("'", "''", $displayname) . "', '" . $email . "', '" . $avatar . "', '" . $orgid . "', '" . $authtoken . "', '" . $authexpires . "', '" . $refreshtoken . "', '" . $refreshexpires . "', '" . $lastaccess . "')";
         //echo($insertsql);
	 //die();
         mysqli_query($dbconn, $insertsql);
         if ($avatar !== "" ) {
	     $savepath = fopen("../avatars/" . $personid . ".png", 'wb');
             $size = getimagesize($avatar);
             $avsave = imagecreatetruecolor(250,250);
             $avsource = imagecreatefromjpeg($avatar);
             imagecopyresampled($avsave, $avsource, 0, 0, 0, 0, 250, 250, $size[0], $size[1]);
             imagepng($avsave,$savepath);
	 }
         header("Location: /");
       } else {
         $updatesql = "UPDATE users SET displayname = '" . str_replace("'", "''", $displayname) . "', email = '" . $email . "', avatar = '" . $avatar . "', orgid = '" . $orgid . "', accesstoken = '" . $authtoken . "', accessexpires = '" . $authexpires . "', refreshtoken = '" . $refreshtoken . "' , refreshexpires = '" . $refreshexpires . "', lastaccess = '" . $lastaccess . "' WHERE personid = '" . $personid . "'";
	 //echo($updatesql);
	 //die();
         mysqli_query($dbconn, $updatesql);
         header("Location: /");
     }
 } else {
     header("Location: /");
}
?>
