<?php
if(isset($_POST['submit'])) {
	$email_error = '';

	//Validate E-mail Address
	if(trim($_POST['email']) === '')  {
		$errorFlag = true;
		$email_error = 'An email is required.';
	}
	else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
		$errorFlag = true;
		$email_error = 'Enter a valid email address.';
	}
	else {
		$email = trim($_POST['email']);
	}

	//If there were no errors, send the mail.
	if(!isset($errorFlag)) {
		$to 		= 'saagar_1982@yahoo.com'; //Replace this email address with yours
		$subject 	= 'Subscription request from '.$email;
		$body 		= "Email: $email";
		$headers 	= 'From: My WebSite <'.$to.'>' . "\r\n" . 'Reply-To: ' . $email;

		if(mail($to, $subject, $body, $headers))
		{
			if($_POST['ajax'])
				echo 'sent';
			else
				echo('<h3>Your subscription was done successfully.</h3>');
		}
		else
			echo('<h3>Your request could not be completed at this moment.</h3>');
	}
	else {
		echo('<h3>The following errors occured while processing your request</h3>');
		if($email_error != '')
			echo $email_error."<br/>";
		echo('<small>Kindly use the browser back button to edit the required fields.</small>');
	}
} ?>