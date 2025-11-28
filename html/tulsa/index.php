<?php
$sitesec = "home";
session_start();
date_default_timezone_set("America/Chicago");

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Get Login Details
include($_SERVER['DOCUMENT_ROOT'] . "/includes/checklogin.php");

// Tulsa Device Array
$tuldevarr = ['Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS9hNzUyZjQ4My1hODRkLTRjODMtOGY4OS1iOTViNzYyYjk0YTk']; // Lobby
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS9mZGZkMTlkNi05ZjM5LTRlOTQtYWRiMi1lMGZlMTcxZGZiYzc'; // Lounge
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS8wOWQwYjEwYi1mZWQ3LTQ0YmQtOWNjOS1kZTI3ZGIxMmY4N2I'; // Drillers
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS8wZTBlYjE1Yy03Y2Y1LTQ2N2ItYTdmYy03MDAxYzE1MWFmNDk'; // Oilers
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS9jYWY1YzMyZi1lNGE2LTQ0ZmYtOTllYy1iODYyMjY4NzNlODg'; // Huddle
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS82ZTY5YWUyZS0xNDc5LTRmY2YtYmVhYy0zZTRjZGZiODAwNWQ'; // Adam
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS84MWQ3Y2FjZC1mYzk1LTRhZWYtYTQ2NS1mN2JlOTZiOTA0YTU'; // Troy
$tuldevarr[] = 'Y2lzY29zcGFyazovL3VybjpURUFNOnVzLWVhc3QtMl9hL0RFVklDRS8wYmZhYzUwYy1iMDg3LTRlYTgtOWYyYy1iOTU3OGRlMTdiZTA'; // Bret
$roomcount = count($tuldevarr);
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
		 <div>
			<h3>Tulsa - <?php echo($roomcount); ?> Rooms</h3><br>
		 </div>
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