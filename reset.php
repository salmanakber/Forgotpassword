<?php
$conn = mysqli_connect('localhost','root','','persnoal');

require 'basurl.php';
require 'PHPMailer1/class.phpmailer.php';
?>
<?php



if(isset($_POST['sub']))
{
$pass = $_POST['pas'];
	$qry = "SELECT * from user where email='$pass'";
	$res = mysqli_query($conn,$qry);

	if(mysqli_num_rows($res) > 0)

{
	function generateRandomString($length = 60) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	$row = mysqli_fetch_assoc($res);

$link = '<a href="'. $_SERVER['SERVER_NAME'].'/'. basename(__DIR__).'/new.php?key='.base64_encode($row['email']).'">"'.$_SERVER['SERVER_NAME'].'/new?'.generateRandomString().'"</a>';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port     = 465;  
$mail->Username = "Youremailaddress@gmail.com";//your email address will goes here make sure all smtp setting must be trun on fro your gmail account you can trun on by this link https://myaccount.google.com/security scroll down at end of the page [{"Allow less secure apps"}] trun on this button then try 
$mail->Password = "YOurpassword";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("youremail@gmail.com", "Adress");
$mail->AddReplyTo($row['email'],"");
$mail->AddAddress($row['email']);
$mail->Subject = "www.shopping.com";
$mail->WordWrap   = 80;
$content = $link;
  $mail->MsgHTML($content);
$mail->IsHTML(false);
if(!$mail->Send()) 
echo '$mail->SetError();';
else 

 echo "200";





}
else{
	echo "400";
}
}






?>



<form action="reset.php" method="POST">
	
<table border="1" align="center" cellpadding="10">
<thead>
	<th align="center" colspan="3">Reset Password</th>

</thead>
<tbody>
	<tr>
		<td>Enter Your Email</td>
		<td>
			
<input type="text" name="pas">
	</td>
	<td><button type="submit" name="sub" >Reset</button></td>
</tr>
</tbody>

	


</table>
</form>