<?php
/* send email with lead details */
$mail_to = 'edik@otonomic.com';

$headers = 'From: omri@otonomic.com' . "\r\n" .
    'Reply-To: omri@otonomic.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

$server = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
$mail_subject = 'New lead(hair stylists) generated on '.$server;
$mail_content = '';
foreach($_REQUEST as $key=>$value) {
    $mail_content .= ucfirst(str_replace("_", " ", $key)).": ".$value."\n";
}

/*
$mail_content = "Page Name: ".$_REQUEST['page_name'];
$mail_content .= "\nPage ID: ".$_REQUEST['page_id'];
$mail_content .= "\nPage Category: ".$_REQUEST['category'];
*/
$mail_content .= "IP: ".$ip;

@mail($mail_to, $mail_subject, $mail_content, $headers);

echo 'success';