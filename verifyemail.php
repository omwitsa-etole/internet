<?php 
session_start();
$email = $_SESSION["email"];


$err = $code = '';

if(isset($_POST["verify"]))
{
	require_once "database.php";
	/*if(empty(trim($_POST["verify_code"]))){
		$err = 'Enter code';
	}else if(trim($_POST["verify_code"]) < 4 || trim($_POST["verify_code"]) > 8){
		$err = 'invalid code';
	}*/
	$code = trim($_POST["verify_code"]);
	$vcode = trim($_POST["vcode"]);
	if($code == $vcode){
		
		$sql = 'UPDATE users SET activated=1 where email=?';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, 's', $param_email);
			
			$param_email = $email;
			if(mysqli_stmt_execute($stmt))
			{
				echo '<div class="alert_success">
					  <span class="closebtn">&times;</span>
					  Email verified suceesfully...
					</div>';
				header("refresh: 2;url=signup.php?step=2");
			}else { echo 'error';}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($link);
		
	}else { echo 'invalid code entered';}
	
	
}

?>
<div>
<center><p style="font-family: Arial;font-size: 18px;">A VERIFICATION CODE HAS TO BE SENT TO THE EMAIL <?php echo $email;?><br>in order to verify it Click send<form method="POST" action="">
<input type="submit" name="send" id="send" value="send" onclick="document.getElementById('send').style.display='none'" style="padding: 10px;"></form><br>Back to <a href="register.php">Login</a><p></center>
<?php 
if(isset($_POST["send"])){
$verify_code = rand(1047, 8000);
$vcode = $verify_code;
$subject = 'EMAIL VERIFICATION FOR myJOBS ACCOUNT ';
$message = 'Please use the code below to verify your account/r/n email: '.$email.'/r/n Code: '.$verify_code.'';
$header = "MyJobs Network\r\n";

$retval = mail($email,$subject,$message,$header);
if($retval == true)
{
	?>
<center>

<table width="200px" height="300px" border="1px" style="border-collapse: collapse;">
<th>ENTER CODE:</th>
<tr>
<td>
<form method="POST" action=""><input type="text" name="vcode" value="<?php echo $vcode;?>" style="display: none;">
<span style="color: red;font-size: 14px;"><?php echo $err;?></span><br>
<input type="number" placeholder="enter code" style="padding: 15px;" name="verify_code"><br><br>
<center><input type="submit" name="verify" value="submit"></center>
</form>
</td>
</tr>
</table>
</center>
<?php
}
}?>
</div>
