<?php
$sitesec = "devices";
session_start();
date_default_timezone_set("America/Chicago");

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Get Login Details
include($_SERVER['DOCUMENT_ROOT'] . "/includes/checklogin.php");

// Get Device ID
if (isset($_REQUEST["deviceid"])) {
	$deviceid = $_REQUEST["deviceid"];
} else {
	header('Location: /devices/');
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title><?php echo ($sitetitle); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="/assets/css/main.css" />
	<link rel="icon" type="image/x-icon" href="/images/devcontrol.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="is-preload">
	<div id="page-wrapper">
		<!-- Header -->
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"); ?>
		<!-- Main Content -->
		<section class="wrapper style1">
			<div class="container">
				<div class="row gtr-200">
<?php
					$deviceurl = "https://webexapis.com/v1/devices/$deviceid";
					$getdevices = curl_init($deviceurl);
					curl_setopt($getdevices, CURLOPT_CUSTOMREQUEST, "GET");
					curl_setopt($getdevices, CURLOPT_RETURNTRANSFER, true);
					curl_setopt(
						$getdevices,
						CURLOPT_HTTPHEADER,
						array(
							'Content-Type: application/json',
							'Authorization: Bearer ' . $authtoken
						)
					);
					$devicejson = curl_exec($getdevices);
					$devicearray = json_decode($devicejson);
					print_r($devicearray);
					if (isset($devicearray->id)) {
						echo("				<table class=\"default\">\n");
						echo("				  <tr>\n");
						echo("				    <td>Name:</td>\n");
						echo("				    <td>" . $devicearray->displayName . "</td>\n");
						echo("				  </tr>\n");
						echo("				  <tr>\n");
						echo("				    <td>MAC Address:</td>\n");
						echo("				    <td>" . $devicearray->mac . "</td>\n");
						echo("				  </tr>\n");						
						echo("				  <tr>\n");
						echo("				    <td>IP Address:</td>\n");
						echo("				    <td>" . $devicearray->ip . "</td>\n");
						echo("				  </tr>\n");												
						echo("				</table>\n");
					} else {
						echo ("Device not found.<br>\n");
					}
?></div>
			</div>
		</section>
		<!-- Footer -->
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); ?>
	</div>
	<!-- Scripts -->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery.dropotron.min.js"></script>
	<script src="/assets/js/browser.min.js"></script>
	<script src="/assets/js/breakpoints.min.js"></script>
	<script src="/assets/js/util.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>