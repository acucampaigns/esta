<?php
/**
 * Check if user is logged
 */
require_once "db.php";
require_once "settings.php";

if (!isset($_COOKIE['logged'])) {
	header("Location: index.html");
	die();
}

$check = $db->prepare("SELECT login, is_admin FROM users WHERE sessionId = :sessid");
$check->execute(array(":sessid" => $_COOKIE['logged']));
$user = $check->fetch();

if (!isset($user['login'])) { // if user is not logged - redirect permanently to index.html	
	header("Location: index.html");
	die();
} 