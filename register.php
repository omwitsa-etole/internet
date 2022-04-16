<?php 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("url=index.php");
    exit;
}
require_once "database.php";
$email = $username = $id = $passwordb = $phone = '';
$email_err = $password_err = '';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//CHECK IF EMAIL IS EMMPTY
	if(empty(trim($_POST["email"]))){
		$email_err = "enter email";
	}else{ $email = trim($_POST["email"]);}
	
	//CHECK IF PASSWORD IS EMPTY
	if(empty(trim($_POST["password"]))){
		$password_err = "please enter the password";
	}else{ $passworddb = trim($_POST["password"]);}
	$active = 1;
	
	if(empty($email_err) && empty($password_err))
	{
		$sql = 'SELECT id, email, name, password, username, activated FROM users where email = ?';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
			//mysqli bind param
			mysqli_stmt_bind_param($stmt, 's', $param_email);
			
			$param_email = $email;
			
			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1)
				{
					mysqli_stmt_bind_result($stmt, $id, $email, $name, $password, $username, $activated);
					if(mysqli_stmt_fetch($stmt))
					{	
				
						$hash = password_hash($password, PASSWORD_DEFAULT);
						if(password_verify($passworddb, $hash)){
							session_start();
							$_SESSION["loggedin"] = true;
							$_SESSION["name"] = $name;
							$_SESSION["username"] = $username;
							$_SESSION["id"] = $id;
							echo 'success';
							header("refresh:1;url=index.php");
							
							
						}else{ $password_err = 'invalid password';}
					}else{  echo 'something went wrong';}
				}else
				{ 
				$sql1 = 'SELECT id, email, name, password, username, activated FROM users where username = ?';
		
				if($stmt1 = mysqli_prepare($link, $sql1))
				{
					//mysqli bind param
					mysqli_stmt_bind_param($stmt1, 's', $param_username);
					
					$param_username = trim($_POST["email"]);
					
					if(mysqli_stmt_execute($stmt1))
					{
						mysqli_stmt_store_result($stmt1);
						
						if(mysqli_stmt_num_rows($stmt1) == 1)
						{
							mysqli_stmt_bind_result($stmt1, $id, $email, $name, $password, $username, $activated);
							if(mysqli_stmt_fetch($stmt1))
							{	
						
								$hash = password_hash($password, PASSWORD_DEFAULT);
								if(password_verify($passworddb, $hash)){
									session_start();
								
									$_SESSION["loggedin"] = true;
									$_SESSION["name"] = $name;
									$_SESSION["username"] = $username;
									$_SESSION["id"] = $id;
									echo 'success';
									header("refresh:1;url=index.php");
									
									
								}else{ $password_err = 'invalid password';}
							}else{  echo 'something went wrong';}
						}else {  
						$sql2 = 'SELECT id, email, name, password, phone, username, activated FROM users where phone = ?';
		
				if($stmt2 = mysqli_prepare($link, $sql2))
				{
					//mysqli bind param
					mysqli_stmt_bind_param($stmt2, 's', $param_phone);
					
					$param_phone = trim($_POST["email"]);
					
					if(mysqli_stmt_execute($stmt2))
					{
						mysqli_stmt_store_result($stmt2);
						
						if(mysqli_stmt_num_rows($stmt2) == 1)
						{
							mysqli_stmt_bind_result($stmt2, $id, $email, $name, $password, $phone, $username, $activated);
							if(mysqli_stmt_fetch($stmt2))
							{	
						
								$hash = password_hash($password, PASSWORD_DEFAULT);
								if(password_verify($passworddb, $hash)){
									session_start();
									
									$_SESSION["loggedin"] = true;
									$_SESSION["name"] = $name;
									$_SESSION["username"] = $username;
									$_SESSION["id"] = $id;
									echo 'success';
									header("refresh:1;url=index.php");
									
								}else{ $password_err = 'invalid password';}
							}else{  echo 'something went wrong';}
						}else { $email_err = 'user NOT found';}
					}
				}
						}
					}
				}
				
			
				}
			}
			
		}else{  echo 'something went wrong';}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($link);

}
?>
<link rel="stylesheet" href="style.css">
<body>
<center>
<table border="1px" width="100%" height="100%" style="border-collapse: collapse;">
<td>
<center>
<div style="align-items: center; justify-content: center;">
<table border="1px" width="42%" style="border-collapse: collapse;">
<td>
<form method="post" action="">
<center>EMAIL:<br><input type="text" placeholder="enter email/username/phone" name="email" style="padding: 5%; border: line;"><br>
<span ><?php echo $email_err?></span><br><br>
PASSWORD:<br><input type="password" placeholder="enter password" name="password" id="password" value="<?php $password;?>" style="padding: 5%; border: line;"><br><br>
<span ><?php echo $password_err?></span><br>
<input type="checkbox" onchange="showpass()">show password<br>
<a href="forgotpass.php">forgot password?</a><br><br>
<input type="submit" value="NEXT" style="padding: 12px 22px; background-color: green;">
<input type="reset" value="CANCEL" style="padding: 12px 22px; background-color:Blue;"><br><br>
DONT HAVE AN ACCOUNT? <a href="signup.php">Sign up</a><br>
</center>
</form>
</td>
</table>
</div>
</center>
</table>
</td>
</center>
</body>
<script>
function showpass(){
	var x = document.getElementById("password");
	if(x.type == "password"){ x.type = "text";}else{x.type = "password";}
}
</script>