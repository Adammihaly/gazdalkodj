<?php

if (isset($_POST['submit'])) {
	

	$name = $_POST['un'];
	$kod = $_POST['code'];


	
	require_once 'conn.php';
	require_once 'bis.php';



    $kod = bis($kod);		  
    $name = bis($name);



	$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
		    $adatbaziskod = $row['v_code'];
		}
	$stmt->close();

	$szam = 1;
	echo "$adatbaziskod";


	if ($adatbaziskod == $kod){
		$sql2 = "UPDATE users SET ver = '$szam' WHERE username = '$name';";
		mysqli_query($conn, $sql2);

		header("Location: ../login?true=t");
		exit();

	}
	else
	{

		//header("Location: ../hitelesites?un=$name&error=error");
		//exit();
	}
}