<?
include "class.phpmailer.php"; 
include "class.smtp.php"; 

$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "smtp.gmail.com"; // specify main and backup server
$mail->Port = 25; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
//$mail->SMTPSecure = 'ssl';
$mail->Username = "phpmailer1080@gmail.com"; // your SMTP username or your gmail username
$mail->Password = "rehzoawpfsazshvo"; // your SMTP password or your gmail password
$from = "phpmailer1080@gmail.com"; // Reply to this email
$to="taidqt@matbao.com"; // Recipients email ID
$name="Dinh Quoc Thien Tai"; // Recipient's name
$mail->From = $from;
$mail->FromName = "Dinh Quoc Thien Tai"; // Name to indicate where the email came from when the recepient received
$mail->AddAddress($to,$name);
$mail->AddReplyTo($from,"Dinh Quoc Thien Tai");
$mail->WordWrap = 50; // set word wrap
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Test mail script from bloghoctap.com";
$mail->Body = "<b>Mail nay duoc goi bang phpmailer class.</b>"; //HTML Body
$mail->AltBody = "Mail nay duoc goi bang phpmailer class."; //Text Body
//$mail->SMTPDebug = 2;
if(!$mail->Send())
{
	echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
}
else
{
	echo "<h1>Send mail thanh cong</h1>";
}
?>
