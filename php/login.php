<?php

if (isset($_POST['sub'])) {
	

	$name = $_POST['username'];
	$pwd = $_POST['pwd'];	

		require_once 'functions.inc.php';
		require_once 'conn.php';
		require_once 'bis.php';
		
		
		$name = bis($name);	
		$pwd = vedelem_sql($pwd);

		
$sql = "SELECT * FROM users WHERE username = '$name' OR email = '$name';";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$adatbaziskod = $row['ver'];
	}

	if ($adatbaziskod == 1) {
		loginUser($conn, $name, $pwd);
	}
	else
	{
		header("Location: ../login?error=notv");
		exit();
	}

}
