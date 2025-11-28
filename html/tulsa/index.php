<?php
// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Get Access Token
$authuser = 1;
$rsaccess = mysqli_query($dbconn, "SELECT `accesstoken` FROM `users` WHERE `pkid` = $authuser") or die("Error in Selecting " . mysqli_error($dbconn));
$rowaccess = mysqli_fetch_assoc($rsaccess);
$accesstoken = $rowaccess["accesstoken"];


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
		<div>
			<table class="default">
				<thead>
					<tr>
						<th>Room</th>
						<th>In Use</th>
						<th>Count</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i = 0; $i < $roomcount; $i++) {
						echo ("					<tr>\n");

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
						//print_r($devicearray);
						if (isset($devicearray->id)) {
							echo ("						<td>" . $devicearray->displayName . "</td>\n");
						} else {
							echo ("						<td>&nbsp;</td>\n");
						}
						echo ("						<td>&nbsp;</td>\n");
						echo ("						<td>&nbsp;</td>\n");
						echo ("					</tr>\n");
					}
					?>
				</tbody>
				<thead>
					<tr>
						<th colspan="2">Total</th>
						<th>X</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</body>

</html>