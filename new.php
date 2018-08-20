<?php
$conn = mysqli_connect('localhost','root','','persnoal');
session_start();
require 'basurl.php';
require 'PHPMailer1/class.phpmailer.php';
?>
<?php

$ab='';
if(isset($_GET['key']))
{

$ab = base64_decode($_GET['key']);
$_SESSION['pass'] = $ab;

//$ab = base64_decode($_GET['key']);

}





if(isset($_POST['sub']))
{
	$pass = $_POST['pas'];
	$qry = "SELECT * from user where email='".$_SESSION['pass']."'";
	$res = mysqli_query($conn,$qry);
	if(mysqli_num_rows($res) > 0)
{
$row = mysqli_fetch_assoc($res);

$id = $row['id'];

//echo $id;	
	$insert = "UPDATE `user` SET  `userpass`='$pass' where id='$id'";
	$result = mysqli_query($conn,$insert);

	if($result == true)
	{
		echo "your password has been updated successfully";
		session_start();
		session_destroy();
	}
	else{
		echo "please contact to costumar care";
	}
}
}





?>



<form action="new.php" method="POST">
	
<table border="1" align="center" cellpadding="10">
<thead>
	<th align="center" colspan="3">Enter New Password</th>

</thead>
<tbody>
	<tr>
		<td>Enter Your Password</td>
		<td>
			
<input type="text" name="pas">
	</td>
	<td><button type="submit" name="sub" >Change</button></td>
</tr>
</tbody>

	


</table>
</form>