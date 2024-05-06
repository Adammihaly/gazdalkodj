<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload1.php';


if(isset($_POST["sub"])) {
	
	require_once 'functions.inc.php';
    require_once 'conn.php';
    require_once 'bis.php';


	$name = $_POST['felhasznalonev'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
    $pwds = $_POST['pwds'];
    $id = rand(10000,100000);
    $token = rand(10000000000000000,199999999999999999);
    $ip = getIPAddress(); 
    $verification_code = rand(10000,100000);


    if ($pwd != $pwds) {
        header("Location: ../register?error=pwdnm");
        exit();
    }


    $name = bis($name);  
    $pwd = vedelem_sql($pwd);      
    $email = bis($email);        
	  
		
        
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  
        header("Location: ../register?error=wrongemail");
        exit();
  }


		if (uidLetezik($conn, $name, $email) !== false) {
            header("Location: ../register?error=uidEx");
            exit();
		}

		$mail = new PHPMailer(true);
 
        try {
					            
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'mail.nethely.hu';
            $mail->SMTPAuth = true;
            $mail->Username = 'system@codeefyit.com';
            $mail->Password = 'CodITfee0025';
            $mail->SMTPSecure = "tls";
            $mail->Port = 1025;
            $mail->setFrom('system@codeefyit.com', 'Gazdalkodj');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);       

            $mail->Subject = 'Gazdalkodj kod';
            $mail->Body    = '

            <h1 style="text-align: center;">Hitelesito kod</h1>
            <p>
            Itt a kod: ' . $verification_code . '
            </p><br>
            <p style="font-size: 90%; text-align: center;">A rendszert készítette és üzemelteti a Codeefy | <a href="https://codeefyit.com">CodeefyIT.com</a> - 2024</p>

            ';
 
            $mail->send();

            createUser($conn, $id, $name, $email, $pwd, $token, $ip, $verification_code);

}
catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Hiba lépett fel: $e')</script>";
}
}

else
{
      header("Location: ../register?error=problem");
            exit();
}