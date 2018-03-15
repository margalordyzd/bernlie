<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$tel = $_POST['tel'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'maldonadoraulqro@gmail.com';

$email_subject = "Mensaje Web de: $name.";

$email_body = "$name te ah enviado un mensaje desde la pagina web\n".
					"email: $email\n".
					"telefono: $tel\n"
						"mensaje:\n $message".

$to = "maldonadoraulqro@gmail.com";

$headers = "From: $email_from \r\n";

$headers .= "Reply-To: $visitor_email \r\n";

mail($to,$email_subject,$email_body,$headers);

function IsInjected($str)
{
	$injections = array('(\n+)',
		   '(\r+)',
		   '(\t+)',
		   '(%0A+)',
		   '(%0D+)',
		   '(%08+)',
		   '(%09+)'
		   );
			   
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	
	if(preg_match($inject,$str))
	{
	  return true;
	}
	else
	{
	  return false;
	}
}
?>
