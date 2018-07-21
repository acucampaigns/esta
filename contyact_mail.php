<?php 
	$name = trim($_POST['name']); // required
	$email = trim($_POST['email']); // required
	$content = trim($_POST['nachricht']);
	 //send mail to admin//
	$from = $email;
	$to="j_weinstock@hotmail.com , info@estagov.us";
	$subject = "New Enquiry";
	$message = "<b>Feedback Form</b>"."<br/><br/>";
		$message .= "<b>Name:</b> ".$name."<br/>";
		$message .= "<b>E-mail:</b> ".$email."<br/>";
	if($content !=='')
	{
		$message .= "<b>Message:</b> ".$content."<br/>";
	}
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$from."\r\n";
	$retval = mail($to,$subject,$message,$headers);
	
	mail('jweinstock121@gmail.com',$subject,$message,$headers);
	
	//echo "to:".$to."<br/>sub:".$subject."<br/>msg:".$message."<br/>headers:".$headers;
	$_POST['name']="";
	$_POST['email']="";
	$_POST['nachricht']="";
	setcookie("success","Mail was sent successfully", time()+(10));
	header("Refresh:1; url=contact.html" );
?>
