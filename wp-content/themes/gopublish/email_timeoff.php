<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['email'])) {
         
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
	
	function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    // validation expected data exists
    if(!isset($_POST['employee']) ||
        !isset($_POST['date_submitted']) ||
        !isset($_POST['pay_type']) ||
        !isset($_POST['days_or_hours']) ||
     	 !isset($_POST['datefrom']) ||
    	 !isset($_POST['dateto']) ||
    	 !isset($_POST['reason']) ||
      	 !isset($_POST['email']) ||
    	 !isset($_POST['requesting']) ||
        !isset($_POST['supervisor'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
	
	// EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to      = 'timeoff@specialtyim.com';
    $email_subject = 'SCHEDULED AND UNSCHEDULED TIME OFF REQUEST FORM';
    
	// set vars
    $employee       = $_POST['employee']; 
	$date_submitted = $_POST['date_submitted'];
    $pay_type       = $_POST['pay_type'];      
	$days_or_hours  = $_POST['days_or_hours']; 
    $datefrom       = $_POST['datefrom']; 
    $dateto         = $_POST['dateto'];    
    $reason         = $_POST['reason']; 
	$email_from     = $_POST['email']; 
	$requesting     = $_POST['requesting']; 
	$supervisor     = $_POST['supervisor']; 
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}
	
	if(!preg_match($email_exp,$supervisor)) {
		$error_message .= 'The Supervisor Email Address does not appear to be valid.<br />';
	}
	
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$employee)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }
	
    if(strlen($reason) < 2) {
		$error_message .= 'The Reason you entered does not appear to be valid text.<br />';
    }
	
    if(strlen($error_message) > 0) {
		died($error_message);
    }
	
    $email_message = "Form details below.\n\n";
          
    $reason = clean_string($reason);
	$email_message .= <<<MSG
This is a copy of the Time Off Request Form sent by $employee
Supervisors: to approve this request press 'Reply to All' and type APPROVED then press 'Send'

From
Employee Name: $employee
Email Address: $email
Date submitted: $date_submitted

Requesting $requesting $days_or_hours of $pay_type time off.
Beginning $datefrom to $dateto.

The reason for this request:
$reason
MSG;
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'Cc: '.$supervisor."\r\n" .
'Bcc: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
?>
 
<!-- include success html here -->
<html><head><title>Time Off Request Form - Thank You</title></head>
<body bgcolor="#E0D4A8">
<center>Thank You</center><p>
<center><h3>Please verify the entries from your submission.</h3></center>
</center>
<p></p>
<table border="1" width="590" align="center">
   <tr>
      <td>
	<font face="arial" size="3">
Date submitted: <b><?php echo $date_submitted; ?></b>
<br>Thank you <b><?php echo $employee; ?></b> 
<br>Your email address is: <b><?php echo $email; ?></b> 
<p>You are requesting <b><?php echo $requesting . ' ' . $days_or_hours; ?></b> 
of <b><?php echo $pay_type; ?> time off.</b> 
<br>From <b><?php echo $datefrom; ?></b> to <b><?php echo $dateto; ?></b> 

<p><u><b>The reason for this request:</b></u><br>
<?php echo $reason; ?>

<p>Your request has been sent to <b><?php echo $supervisor; ?></p>
<p>Thank You!</b></p>
<p><a href="javascript:history.go(-1);">To Return to form</a></p>
	</font>
      </td>
   </tr>
</table>
</body></html>
 
<?php
}
?>