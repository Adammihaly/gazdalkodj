<!DOCTYPE html>
<html>
<head>
    <title>Gazdalkodj</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css ">
    <script src="./js/main.js"></script>
</head>
<body>
 
<?php 

session_start();
if (!isset($_SESSION['ID'])) {
    header("Location: login");
    exit();
}

?>

<nav>
    <a href="php/logout.php">Kijelentkezes</a>
    <a href="php/creategame.php">Create game</a>
</nav>
<br><br><br>
<form method="POST" action="php/join.php">
    <input type="number" name="j_code" required>
    <button name="sub">Join</button>
</form>

</body>
</html>