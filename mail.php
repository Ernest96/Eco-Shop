<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require './PHPMailer/src/Exception.php';
	require './PHPMailer/src/PHPMailer.php';
	require './PHPMailer/src/SMTP.php';

	if (isset($_POST["question"]) && isset($_POST["email"]))
	{
		try
		{
			$question = $_POST["question"];
			$from = $_POST["email"];

			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = "465";
			$mail->Username = "your_email";
			$mail->Password = "your_password";
			$mail->SetFrom($from);
			$mail->Body = $question;
			$mail->Subject = $from;
			$mail->AddAddress("address");

			$mail->Send();
		} catch(Exception $e)
		{
			echo "Error:" . $e ;
		}
	}
	else
	{
		echo "Not Found";
	}
	
?>