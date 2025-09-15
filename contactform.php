<?php
error_reporting(0);
require_once("PHPMailer/class.phpmailer.php");

if(ISSET($_POST["name"]))
{
    if(ISSET($_POST["name"])){
        if(ISSET($_POST["email"])){

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
            
            $mail->addAddress('sales@sparshimp.com', 'Sparsh Impex'); 
            //$mail->addAddress('vishal@rathinfotech.com', 'Sparsh Impex');

            // Add the new code here
            if(!empty($_POST['name']))
            {
                $body = "Name : ".$_POST['name']."\n\r";
                if(!empty($_POST['companyname'])){
                    $body .= "Company Name : ".$_POST['companyname']."\n\r";
                }
                if(!empty($_POST['email'])){
                    $body .= "Email : ".$_POST['email']."\n\r";
                }
                if(!empty($_POST['phoneno'])){
                    $body .= "Phone no. : ".$_POST['phoneno']."\n\r";
                }
                if(!empty($_POST['message'])){
                    $body .= "Message : ".$_POST['message']."\n\r";
                }
                $mail->Body = $body;
            }
            // End of the new code

            if(!$mail->Send()) {
              echo 'Message was not sent.';
              echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                header("Location: thanks.html");
            }
        }
    }
} else {
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
            'secret' => '6LdjcrsqAAAAAJR_EavAXdhcF9yXhlWxVHvlF1PV',
            'response' => $g_recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        )
    );
    curl_setopt_array($ch, $curlConfig);

    if($result = curl_exec($ch))
    {
        curl_close($ch);
        $response = json_decode($result,true);
        return $response['success'];
    }else{
        return false;
    }
}
?>
