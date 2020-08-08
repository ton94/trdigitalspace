<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "sns.fb.toni@gmail.com";
    $email_subject = "A message drop by!";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['sender']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
		{
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
        }
 
     
 
    $sname = $_POST['sender']; // required
    $email_from = $_POST['email']; // required
    $mymessage = $_POST['subject']; // not required

 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$sname)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 

  if(strlen($mymessage) < 2) {
    $error_message .= 'Invalid/No Message.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Sender: ".clean_string($sname)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Subject/Message: ".clean_string($mymessage)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>