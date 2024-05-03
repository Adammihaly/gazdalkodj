<?php

function uidLetezik($conn, $name, $email) {
$sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");
	exit();
}

mysqli_stmt_bind_param($stmt, "ss", $name, $email);
mysqli_stmt_execute($stmt);

$eredmeny = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($eredmeny)) {
		return $row;
	}
	else
	{
		$erd = false;
		return $erd;

	}

	mysqli_stmt_close($stmt);
}


function uidLetezikk($conn, $name) {
$sql = "SELECT * FROM users WHERE username = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=stmtfailed");
	exit();
}

mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);

$eredmeny = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($eredmeny)) {
		return $row;
	}
	else
	{
		$erd = false;
		return $erd;

	}

	mysqli_stmt_close($stmt);
}



function createUser($conn,  $id, $name, $email, $pwd, $token, $ip, $verification_code) {
$sql = "INSERT INTO users (ID, username, email, pwd, token, v_code, ip ) VALUES (?,?,?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {

	header("Location: ../register?error=stmtfailed");
	exit();

}

$pwdsecound = password_hash($pwd, PASSWORD_DEFAULT);

mysqli_stmt_bind_param($stmt, "sssssss", $id, $name, $email, $pwdsecound, $token, $verification_code, $ip);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

	header("Location: ../hitelesites?un=$name");
	exit();
	
}



function loginUser($conn, $name, $pwd)
{

	$uidLetezik = uidLetezik($conn, $name, $name);

	if ($uidLetezik === false) {
		header("Location: ../login?error=wronguser");
		exit();
	}

	$pwdHashed = $uidLetezik["pwd"];
	$check = password_verify($pwd, $pwdHashed);

	if ($check === false) {
		header("Location: ../login?error=wronguser");
		exit();
	}
	else if ($check === true)
	{

		session_start();
		$_SESSION['ID'] = $uidLetezik["ID"];
		$_SESSION['Felhasznalonev'] = $uidLetezik["username"];
		$_SESSION['user_token'] = $uidLetezik["token"];


		header("Location: ../lobby");
		exit();

	}

}



function getIPAddress() {  

     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  

}  

function vedelem_sql($string)
{

	$sql_szo_lista = array("SELECT", "INSERT", "UPDATE", "DELETE", "FROM", "WHERE", "DROP", "CREATE", "TABLE", "ALTER", "GRANT", "EXECUTE"); 
  foreach ($sql_szo_lista as $sql_szo) {
    if (stripos($string, $sql_szo) !== false) {
      
      header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=posdw");
      exit();
    }
  }  

  $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  $string = strip_tags($string);


  return $string;
}