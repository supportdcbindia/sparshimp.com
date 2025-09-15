<?php
error_reporting(0);
require_once("PHPMailer/class.phpmailer.php");


if(ISSET($_POST["name"]))
{
	if(ISSET($_POST["name"])){
		if(ISSET($_POST["email"])){
		    
//require("PHPMailerAutoload.php");

            

$mail = new PHPMailer();
		//	$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.sparshimp.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                   // enable SMTP authentication
//$mail->SMTPSecure = "tls";                  // sets the prefix to the servier
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "sales@sparshimp.com";  // GMAIL username
$mail->Password   = "$y4]TiC}59cm";            // GMAIL password

$mail->WordWrap = 150;


$mail->Subject  = "Enquiry Form Notification";

$name=$_POST["name"];
$companyname=$_POST["companyname"];
$email=$_POST["email"];
$phoneno=$_POST["phoneno"];
$message=$_POST["message"];

$mail->SetFrom("sales@sparshimp.com", "Sparsh Impex");

//$mail->addAddress('sales@sparshimp.com', 'Sparsh Impex'); 
$mail->addAddress('vishal@rathinfotech.com', 'Sparsh Impex'); 

$mail->MsgHTML('You have a new inquiry from sparshimp.com   <div class="row">
                                    <div class="col-md-6">
                                        <label for="name"><b>Name : </b><span class="required"></span></label>
                                       '.$name.'
                                    </div>
									<div class="col-md-6">
                                        <label for="companyname"><b>Company Name : </b><span class="required"></span></label>
                                     '.$companyname.'
                                    </div>
									<div class="col-md-6">
                                        <label for="email"><b>Email : </b><span class="required"></span></label>
                                       '.$email.'
                                    </div>                                    
									<div class="col-md-6">
                                        <label for="phoneno"><b>Phone Number : </b></label>
                                       '.$phoneno.'
                                    </div>
                                </div>                              
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="message"><b>Enquiry Details  : </b></label>
                                       '.$message.'');
              



if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
 //echo '<center><b><font color="red">Thank You. We have received your message. You will be redirected in 5 seconds </font></b></center>';
//	echo '<meta http-equiv="refresh" content="5;url=http://www.sparshimp.com/" />';
header("Location: thanks.html");
}



}

}
}

else{
 echo '<center><b>Something missing. Please go back and try again</b></center>';
}
function VerifyRecaptcha($g_recaptcha_response)
{
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => "https://www.google.com/recaptcha/api/siteverify",
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS     => array(
            'secret' => '6Ldb06gUAAAAAJOFHrNvIRWo8O5UsEw6eIJPt27G',
            'response' => $g_recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        )
    );
    curl_setopt_array($ch, $curlConfig);
	
    if($result = curl_exec($ch))
    {
        curl_close($ch);
		//echo"result===<pre>";print_r($result);
	
        $response = json_decode($result,true);
        // echo"res==".$response['success'];
	    //	die();
        return $response['success'];
        //return true;
    }else{
      //  var_dump(curl_error($ch)); // this for debug remove after you test it
        return false;
    }
 }
?>