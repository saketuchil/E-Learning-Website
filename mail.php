<?php
require_once "Mail.php";
$from = "ZEAL";
$to = $_GET['id'];
$host = "ssl://smtp.gmail.com";
$port = "465";
$username = "EMAIL_ID";
$password = "PASSWORD";
$subject = "ZEAL - Password Recovery";
$r=rand(100000,999999);
session_start();
$_SESSION['code']=$r;
$body = "<div style=\"color:#58585b;background-color:#f9f9f9;text-align:center\"><table style=\"width:600px;padding:56px 81px;margin:auto;margin-top:22px;background-color:#fff\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">            <tbody>            <tr style=\"vertical-align:middle\">                </tr>    <tr>        <td style=\"width:100%;height:56px\"></td>    </tr>    <tr style=\"text-align:center\">        <td colspan=\"2\"><h2 style=\"font-size:35px;font-weight:100;line-height:48px;margin:0px\"><span id=\"m_294308908841002736userName\" style=\"font-family:CiscoSans,helvetica,arial,sans-serif\"><span class=\"il\">Password</span> Recovery</span></h2>        </td>    </tr>    <tr>        <td style=\"width:100%;height:24px\"></td>    </tr>    <tr style=\"text-align:center\">        <td colspan=\"2\" style=\"height:62px;margin:0px\">            <p style=\"font-size:16px;line-height:20px;margin:0px\">                <span style=\"font-family:CiscoSans,helvetica,arial,sans-serif\">You recently requested <span class=\"il\">password</span> reset for account associated with this email.</span>            </p>            <p style=\"font-size:16px;line-height:20px;margin:20px\">                <span style=\"font-family:CiscoSans,helvetica,arial,sans-serif\"> Enter this code on the <span class=\"il\">password</span> reset screen.</span>            </p>        </td>    </tr>    <tr style=\"text-align:center\">        <td>            <p style=\"font-size:16px;line-height:20px;margin:0px;text-align:center\">                <strong style=\"font-family:CiscoSans,helvetica,arial,sans-serif\">".$r."</strong>            </p>            <p style=\"font-size:16px;line-height:20px;margin:20px;text-align:center\">                <strong style=\"font-family:CiscoSans,helvetica,arial,sans-serif\">Valid up to next 2 hours</strong>            </p>        </td>    </tr>  <tr>        <td style=\"width:100%;height:48px\"></td>    </tr> </tbody></table></div>";

$content = "text/html";
$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject, 'Content-Type' => $content);
$smtp = Mail::factory('smtp',
array ('host' => $host,
'port' => $port,
'auth' => true,
'username' => $username,
'password' => $password));
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
echo($mail->getMessage());
} else {	
	header("Location: http://localhost:8080/project/check_code.php");
}
?>

