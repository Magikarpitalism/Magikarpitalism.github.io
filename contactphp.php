<meta charset="utf-8" />
<?php
ini_set("SMTP","smtp.free.fr" );
$errors = '';
$myemail = "sebastienb199@gmail.com";//<-----Put Your email address here.
if(empty($_POST['Prenom'])  || 
   empty($_POST['Nom'])  || 
   empty($_POST['mail']) || 
   empty($_POST['objet']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name1 = $_POST["Prenom"];
$name2 = $_POST["Nom"];
$email_address = $_POST["mail"];
$sujet = $_POST["objet"];
$message = $_POST["message"]; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Sujet: $sujet";
	$email_body = "Vous avez reçu un nouveau message, ".
	" Les détails sont:\n Nom: $name2 \n Prenom: $name1 \n Email: $email_address \n Message: \n $message"; 
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	$headers .= "X-Priority: 1 (Highest)\n";
    $headers .= "X-MSMail-Priority: High\n";
    $headers .= "Importance: High\n";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	echo "le message a bien été envoyé.";
	
} 
