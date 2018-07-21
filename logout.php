<?php
// clear all session variables for user and destroy session
require_once "db.php";
//require_once "settings.php";

if (!isset($_COOKIE['logged'])) {
	header("Location: index.html");
	die();
}

$check = $db->prepare("UPDATE users SET sessionId = NULL WHERE sessionId = :sessid");
$check->execute(array(":sessid" => $_COOKIE['logged']));
setcookie("logged", "");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Logout</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link rel="shortcut icon" href="favicon.png" / -->
</head>
<body>
	<script>
        // permanent redirect to index.html
		window.location.href = 'index.html';
	</script>
</body>