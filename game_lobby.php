<!DOCTYPE html>
<html>
<head>
    <title>Gazdalkodj - Game lobby</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css ">
    <script src="./js/main.js"></script>
</head>
<body>
 
<?php 

session_start();
require_once 'php/conn.php';

if (!isset($_SESSION['ID'])) {
    header("Location: login");
    exit();
}
if(!isset($_GET['room_id'])) {
    header("Location: lobby");
    exit();
}
else
{
    $roomID = $_GET['room_id'];
}

    $sql = "SELECT * FROM games WHERE roomID = $roomID;";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        $createrID = $row['createrID'];
        $gameID = $row['ID'];
    }

    $sql = "SELECT * FROM users WHERE ID = $createrID;";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        $username = $row['username'];
    }


?>

<nav>
    <form method="POST" action="php/exitgame.php">
        <input type="hidden" name="id" value="<?php echo $gameID ?>">
        <button name="sub">Lobby torlese</button>
    </form>
    <h1>Jatek lobby</h1>
    <h2>Lobby tulaj: <?php echo $username; ?></h2>
    <h2>Lobby kod: <?php echo $roomID; ?></h2>
</nav>

</body>
</html>