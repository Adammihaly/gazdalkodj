<?php

session_start();
require_once 'conn.php';

if (isset($_POST['sub']) AND isset($_SESSION['ID'])) {
	
	$room_code = $_POST['j_code'];

	$sql = "SELECT * FROM games WHERE roomID = $room_code";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$ingame = $row['ingame'];
		$p2 = $row['p2'];
		$p3 = $row['p3'];
		$p4 = $row['p4'];
		$p5 = $row['p5'];
		$p6 = $row['p6'];
	}

	if ($ingame == 1) {
		header("Location: ../lobby?error=ingame");
		exit();
	}

	$player = NULL;

	if ($p2 == NULL) {
		$player = 'p2';
	} elseif ($p3 == NULL) {
		$player = 'p3';
	} elseif ($p4 == NULL) {
		$player = 'p4';
	} elseif ($p5 == NULL) {
		$player = 'p5';
	} elseif ($p6 == NULL) {
		$player = 'p6';
	}

	switch($player)
	{
		case $player == 'p2':
			$sql = "UPDATE games SET p2 = ".$_SESSION['ID']." WHERE roomID = $room_code";
			$conn->query($sql);
			break;
		case $player == 'p3':
			$sql = "UPDATE games SET p3 = ".$_SESSION['ID']." WHERE roomID = $room_code";
			$conn->query($sql);
			break;
		case $player == 'p4':
			$sql = "UPDATE games SET p4 = ".$_SESSION['ID']." WHERE roomID = $room_code";
			$conn->query($sql);
			break;
		case $player == 'p5':
			$sql = "UPDATE games SET p5 = ".$_SESSION['ID']." WHERE roomID = $room_code";
			$conn->query($sql);
			break;
		case $player == 'p6':
			$sql = "UPDATE games SET p6 = ".$_SESSION['ID']." WHERE roomID = $room_code";
			$conn->query($sql);
			break;
		default:
			header("Location: ../lobby?error=full");
			exit();
	}

	header("Location: ../game_lobby?room_id=".$room_code);
	exit();

}
else
{
	header("Location: ". $_SERVER['HTTP_REFERER']);
	exit();
}