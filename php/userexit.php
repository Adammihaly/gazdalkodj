<?php
$roomID = $_POST['roomID'];
$profileID = $_POST['profileID'];

$sql = "SELECT * FROM games WHERE roomID = $roomID";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $p2 = $row['p2'];
    $p3 = $row['p3'];
    $p4 = $row['p4'];
    $p5 = $row['p5'];
    $p6 = $row['p6'];
}

$player = NULL;

if ($p2 == $profileID) {
    $player = 'p2';
} elseif ($p3 == $profileID) {
    $player = 'p3';
} elseif ($p4 == $profileID) {
    $player = 'p4';
} elseif ($p5 == $profileID) {
    $player = 'p5';
} elseif ($p6 == $profileID) {
    $player = 'p6';
}

switch($player)
{
    case $player == 'p2':
        $sql = "UPDATE games SET p2 = null WHERE roomID = $roomID";
        $conn->query($sql);
        break;
    case $player == 'p3':
        $sql = "UPDATE games SET p3 = null WHERE roomID = $roomID";
        $conn->query($sql);
        break;
    case $player == 'p4':
        $sql = "UPDATE games SET p4 = null WHERE roomID = $roomID";
        $conn->query($sql);
        break;
    case $player == 'p5':
        $sql = "UPDATE games SET p5 = null WHERE roomID = $roomID";
        $conn->query($sql);
        break;
    case $player == 'p6':
        $sql = "UPDATE games SET p6 = null WHERE roomID = $roomID";
        $conn->query($sql);
        break;
    default:
        
}
?>