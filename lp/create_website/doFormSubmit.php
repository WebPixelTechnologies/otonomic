<?php 
	if(!empty($_POST)){
		$myFile = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR .'data.txt';
		$message = $_POST['username'] ."\t\t".$_POST['email'] ."\t\t".$_POST['fanpage'] ."\t\t".$_POST['phone']."\t\t".date("Y-m-d H:i:s");
		if (file_exists($myFile)) {
			$fh = fopen($myFile, 'a');
			fwrite($fh, $message."\n");
		} else {
			$fh = fopen($myFile, 'w');
			fwrite($fh, $message."\n");
		}
		fclose($fh);		
		
		//send email
		function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		}
		
		$email_to = "omri@page2site.com";			//please update the admin email address
		$email_subject = "A new lead is received.";
		
		$email_message = "Form details below.\n\n";		 
		$email_message .= "Name: ".clean_string($_POST['name'])."\n";
		$email_message .= "Email: ".clean_string($_POST['email'])."\n";
		$email_message .= "Fanpage: ".clean_string($_POST['fanpage'])."\n";
		$email_message .= "Phone: ".clean_string($_POST['phone'])."\n";
		 
		// create email headers
		$headers = 'From: '.$email_from."\r\n".
				'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);
		
		header("location:index.php?success=1");
	}
?>