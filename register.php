<?php 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("url=index.php");
    exit;
}
require_once "database.php";
$email = $username = $id = $passwordb = $phone = '';
$email_err = $password_err = '';
$uri = 'index.php';
if(isset($_GET["next"])){
	$uri = trim($_GET["next"]);
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty(trim($_POST["email"]))){
		$email_err = "enter email";
	}else{ $email = trim($_POST["email"]);}
	
	if(empty(trim($_POST["password"]))){
		$password_err = "please enter the password";
	}else{ $passworddb = trim($_POST["password"]);}
	$active = 1;
	
	if(empty($email_err) && empty($password_err))
	{
		$sql = 'SELECT id, email, name, password, username, activated FROM users where email = ?';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
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
							echo '<div class="alert_succ">
							  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
							  Login Successfull
							</div>';
							header('refresh:1;url='.$uri.'');
							
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
									echo '<div class="alert_succ">
									  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
									  Login Successfull
									</div>';
									header('refresh:1;url='.$uri.'');
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
									echo '<div class="alert_succ">
									  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
									  Login Successfull
									</div>';
									header('refresh:1;url='.$uri.'');
									
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
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="Jobs, online, posts, comments, hire, freelance, freelancer, images, share, jobprofile">
<meta name="google-signin-client_id" content="75332547705-428c5vr23v4dmlrvd1un82pa099r3q0c.apps.googleusercontent.com">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.login {
	width: 45%;
	height: 85%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 1%;
	font-size: 17px;
	text-align: justify;
	overflow: auto;
}
.btn-sign{
	padding: 3% 17%;
	background: green;
	color: white;
	border-radius: 15px;
}
.btn-opt-google{
	margin-top: 2%;
	background: #00BFFF;
	color: white;
	text-align: center;
	padding: 3% 20%;
	border-radius: 15px;
	margin-left: 4%;
	text-align: justify;
}
.btn-opt-apple {
	margin-top: 4%;
	background: white;
	color: black;
	text-align: center;
	padding: 3% 20%;
	border-radius: 15px;
}

.bottom {
	margin-top: 2%;
}
.bottom button{
	padding: 3% 16%;
	background: white;
	color: green;
	border-radius: 15px;
	margin-top: 2%;
}
.login span{
	color: red;
	font-size: 17px;
	font-weight: bold;
}
.alert_succ {
  padding: 20px;
  background-color: green; 
  color: white;
  width: 65%;
  position: fixed;
  top: 1%;
  left: 15%;
  z-index: 2;
  
}
</style>
</head>
<body>
<div style="color: green;font-size: 18px;font-weight: bold;font-family:Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif ;">
<h3>My Jobs</h3>
</div>
<hr/>
<center>
<div class="login">
<form method="post" action="">
<center>EMAIL:<br><input type="text" placeholder="enter email/username/phone" name="email" value="<?php echo $username;?>" style="width: 60%;height: 7%; border: line;"><br>
<span ><?php echo $email_err?></span><br>
PASSWORD:<br><input type="password" placeholder="enter password" name="password" id="password" style="width: 60%;height: 7%; border: line;"><br>
<span ><?php echo $password_err?></span><br>
<input type="checkbox" onchange="showpass()">show password<br>
<a href="forgotpass.php">forgot password?</a><br><br>
<button type="submit" class="btn-sign">SIGN IN</button><br>
<hr/>
<div  data-onsuccess="onSignIn"></div>
<button class="btn-opt-google" type="button"><i class="fa fa-google"></i>Continue with Google</button><br>
<button class="btn-opt-apple" type="button"><i class="fa fa-apple"></i>Continue with Apple</button><br>
<hr/>
<div class="bottom">DONT HAVE AN ACCOUNT? <br><a href="signup.php?step=1"><button type="button">Sign up</button></a></div><br>
</center>
</form>
</div>
</center>
</body>
<script>
function showpass(){
	var x = document.getElementById("password");
	if(x.type == "password"){ x.type = "text";}else{x.type = "password";}
}
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); 
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
  $.post("header.php", {"username":profile.getId(), "name":profile.getName(), "email": profile.getEmail()});
}
function close_alert(x){
	x.style.display='none';
}
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>