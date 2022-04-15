<?php

require_once "database.php";
$err = $enter_code = $change ='';
if(isset($_POST["send_code"]))
{
	$email = trim($_POST["email"]);

	$sql = 'SELECT id, email, password FROM users where email = ?';
	
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, 's', $param_email);
		
		$param_email = $email;
		
		if(mysqli_stmt_execute($stmt))
		{
			mysqli_stmt_store_result($stmt);
			
			if(mysqli_stmt_num_rows($stmt) == 1)
			{
				$verify_code = rand(100001, 999999);
				$vcode = $verify_code;
				$subject = 'PASSWORD REQUEST FOR myJOBS ACCOUNT ';
				$message = 'Please use the code below to login to your account 
				
							Code: '.$verify_code.'';
				$header = "MyJobs Network\r\n";

				$retval = mail($email,$subject,$message,$header);
				if($retval == true)
				{
					$err = 'Check inbox or spam folder for passcode';
					$enter_code = '<form method="POST" action="" enctype="multipart/form-data">
					Enter Code<br><br>
					<input type="text" value='.$vcode.' name="vcode" style="display: none;" >
					<input type="text" value='.$email.' name="gmail" style="display: none;" >
					<input type="number" placeholder="code" name="code" style="padding: 5px 25px;"><br><br>
					<center><input type="submit" value="SUBMIT" name="get_pass" style="padding: 9px;background: green;"></center>
					<br><br></form>';
				}else { $err = '<div style="color: red;">Could not Send Email, try again</div>'; }
			}else{
				$err = '<div style="color: red;">user does not exist</div>';
			}
		}
	}
}
if(isset($_POST["get_pass"]))
{
	$vcode = trim($_POST["vcode"]);
	$gmail = trim($_POST["gmail"]);
	if(empty(trim($_POST["code"])))
	{
	$err = '<div style="color: red;">Enter Code</div>';}else{
	$code = trim($_POST["code"]);}
	if($code == $vcode)
	{
		$change = '
			<table border="1px" width= "30%" height="40%" style="position: fixed;top: 35%;left: 35%;z-index: 1;border-collapse: collapse;text-align: center;background: #ddd;">
			<td>
			<form method="POST" action="" enctype="multipart/form-data">
			<input type="text" value='.$gmail.' name="gmail" style="display: none;" >
			Enter New Password<br><input type="password" id="password" name="new_password"><br><br>
			Confrim New Password<br><input type="password" name="confirm_password" ><br><br>
			<input type="checkbox" onchange="showpass()" >show password<br>
			<input type="submit" value="Update" name="update_pass"></center>
			</form>
			</td>
			</table>';
	}else { $err = '<div style="color: red;">Invalid Code</div>';}
	
}
if(isset($_POST["update_pass"]))
{
	$email = trim($_POST["gmail"]);
		if(empty(trim($_POST["new_password"]))){
        $err = "Please enter a password.";     
		} else if(strlen(trim($_POST["new_password"])) < 6){
			$err = "Password must have atleast 6 characters.";
		} else{
			$new_password = trim($_POST["new_password"]);
		}
		if(empty(trim($_POST["confirm_password"]))){
			$err = "Please confirm password.";   		
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($err) && ($new_password != $confirm_password)){
				$err = '<div style="color: red;">Password did not match.</div>';
			}
		}
		
		if(empty($err))
		{
			$sql1 = 'UPDATE users SET password=? WHERE email=?';
			
			if($stmt1 = mysqli_prepare($link, $sql1))
			{
				mysqli_stmt_bind_param($stmt1, "ss", $param_password, $param_email);
				$param_password =$new_password;
				$param_email = $email;
				if(mysqli_stmt_execute($stmt1))
				{
					$err = 'password updated successfully<br><a href="register.php">click here</a> to login';
				}else {$err = '<div style="color: red;">Failed to change password Please try again<br>';}
				
			}
		}
}
?>
<body>
<center>
<table border="1px" width="100%" height="100%" style="border-collapse: collapse;">
<td>
<center>
<table border="1px" width= "30%" height="40%" style="border-collapse: collapse;text-align: center;">
<td>

Enter Email<br><br><form method="POST" action="" enctype="multipart/form-data">
<input type="email" placeholder="email" name="email" style="padding: 5px 25px;" required>
<input type="submit" value="send" name="send_code" style="padding: 6px;">
</form>
<span><?php echo$err;?></span><br>
<span><?php echo $enter_code;?></span>
</td>
</table>
<span><?php echo$change;?></span>
<p>Back to <a href="register.php">login</a></p>
</center>

</td>
</table>
</div>
</center>
</table>
</td>
</center>
</body>
<script>
function showpass(){ var x  = document.getElementById("password");
if(x.type == "password"){ x.type = "text"; }else { x.type="password"; }
}
</script>