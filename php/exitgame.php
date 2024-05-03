<?php

session_start();
require_once 'conn.php';

if (isset($_POST['sub']) AND isset($_SESSION['ID'])) {
	
	$gameID = $_POST['id'];

	$stmt = $conn->prepare("DELETE FROM games WHERE ID = ?");
	$stmt->bind_param("i", $gameID);
	$stmt->execute();
	$stmt->close();

	header("Location: ../lobby.php");
}
else
{
	header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=error");
	exit();
}