<?php 

$success = $username = $email = $password = $confirmpassword = $firstname = $lastname = $name = $gender = $phone = $date = '';
$email_err = $password_err = $p_err =  $phone_err =  $username_err = $fname_err = $gender_err = $date_err = $name_err ='';

if(isset($_POST["create-freelancer"]))
{
	if(empty(trim($_POST["firstname"]))){
		$name_err = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter first name
			</div>';
	}else{ $firstname = trim($_POST["firstname"]);}
	
	if(empty(trim($_POST["lastname"]))){
		$name_err = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter last name
			</div>';
	}else{ $lastname = trim($_POST["lastname"]);}
	
	if(empty($fname_err)){ $name = ''.$firstname .'	'. $lastname.'';}else{ $name_err = "name error";}
	if(empty(trim($_POST["email"]))){
		$email_err = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter Email
			</div>';
	}else{ $email = trim($_POST["email"]);}
	
	if(empty(trim($_POST["username"]))){
		$username_err = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter username
			</div>';
	}else{ $username = trim($_POST["username"]);}
	
	if(empty(trim($_POST["password"]))){
		$password_err = 'error'; 
        echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter a password
			</div>';   
    } else if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	$all_err = $email_err || $password_err || $username_err || $name_err;
if(empty($all_err))
{ 
	$sql = "SELECT email, username FROM users WHERE email = ?";
	
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_email);
			$param_email = $email;
			
			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1)
				{
					mysqli_stmt_bind_result($stmt, $email, $username);
					if(mysqli_stmt_fetch($stmt))
					{
						if($email == trim($_POST["email"]) || $username == trim($_POST["username"])){
							echo '<div class="alert_fail">
								  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
								  User already exists
								</div>';
						}
					}
				}else{
				$sql2 = 'INSERT INTO users (email, name, password, username) VALUES (?, ?, ?, ?)';
				
				if($stmt2 = mysqli_prepare($link, $sql2))
				{
					mysqli_stmt_bind_param($stmt2, "ssss", $param_email, $param_name, $param_password, $param_username);
					
					$param_email = $email;
					$param_name = $name;
					$param_password = $password;
					$param_username = $username;
					
					if(mysqli_stmt_execute($stmt2)){
						$_SESSION["email"] = $email;
						$_SESSION["name"] = $name;
						$_SESSION["username"] = $username;
						echo '<script>window.location="verifyemail.php"</script>';
					} else{
						echo '<div class="alert_fail">
							  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
							  Failed to create account try again
							</div>';
					}
				}
				mysqli_stmt_close($stmt2);
				}
			}
			mysqli_stmt_close($stmt);
	}
	mysqli_close($link);
}
}
?>


<center>
<span><?php echo $password_err; ?></span>
<div class="box-1" id="box">
<h1>Join as a Client or Freelancer</h1>
<button class="check-button" name="client" onclick="changecheck(this.name)"><p><input id="client" type="radio" name="join-option" value="Join as Client"></p><span><i class="fa fa-file" aria-hidden="true"></i><br>I’m a client, hiring for a project</span></button>
<button class="check-button" name="freelancer" onclick="changecheck(this.name)"><p><input id="freelancer" type="radio" name="join-option" value="Applly as Freelancer"></p><span><i class="fa fa-file-text-o" aria-hidden="true"></i><br>I’m a freelancer, looking for work</span></button><br>
<button class="sub-btn" type="button" onclick="generateform(this.innerHTML)" id="join-option">Create Account</button>
<div style="color: black;font-size: 18px;margin-top: 3%;">Already have an account <a href="register.php" style="color: green;">Login</a></div>
</div></center>
<div id="clientform" style="display: none;position: fixed;z-index: 1;width: 100%;height: 100%;top: 5%;left: 15%;">
<div class="client-form" >
<form method="POST" action="" enctype="multipart/form-data">
<h2>Client Registration form</h2>
<p style="float: right;cursor: pointer;color:red;margin-top: -7%;"><a style="zoom: 150%;"onclick="exit()">&times</a></p>
<center><button class="btn-opt-google" type="button"><i class="fa fa-google"></i>Continue with Google</button><br>
<button type="button" class="btn-opt-apple" type="button"><i class="fa fa-apple"></i>Continue with Apple</button><br></center>
<hr/>
<input type="text" placeholder="First name" name="firstname"> <input type="text" name="lastname" placeholder="Last name"><br>
<input type="text" placeholder="Email" name="email"><input type="text" name="username" placeholder="Username"><br>
<input list="country" name="country" placeholder="Country">
<datalist id="country" >
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="Sudan">Sudan</option>
</datalist>
<input type="password" id="password" placeholder="Password" name="password"><a style="zoom: 100%;position: relative;cursor: pointer;" onclick="document.getElementById('myPopup').style.display='block'" class="fa fa-question" aria-hidden="true"></a>
<div class="popuptext" id="myPopup">
<a style="float: right;cursor: pointer;" onclick="document.getElementById('myPopup').style.display='none'">&times</a>
<ul><li>Password Should contain atleast 6 characters</li>
<li>Password should not be commonly used</li>
<li>Use a password that you will easily remember</li>
</ul>
</div>

<br><input type="checkbox" onchange="uncheck()">I accept the <a href="terms.html">terms and conditions</a> and <a href="privacy.html">privacy policy</a><br>
<center><button type="submit" name="create-client" class="submit-reg" title="Submit details" >Create My account</button><br>
<a onclick="exit()" style="color: green;font-size: 17px;cursor: pointer;font-weight: bold;margin-top: -4%;" title="Close form">Cancel</a></center>
</form>
</div>
</div>
<div id="freelanceform" style="display: none;position: fixed;z-index: 1;width: 100%;height: 100%;top: 5%;left: 15%;">
<div class="freelance-form" >
<form method="POST" action="">
<h2>Freelance Registration form</h2>
<p style="float: right;cursor: pointer;color:red;margin-top: -7%;"><a style="zoom: 150%;"onclick="exit()">&times</a></p>
<center><button class="btn-opt-google" type="button"><i class="fa fa-google"></i>Continue with Google</button><br>
<button type="button" class="btn-opt-apple" type="button"><i class="fa fa-apple"></i>Continue with Apple</button><br></center>
<hr/>
<input type="text" placeholder="First name" name="firstname"> <input type="text" name="lastname" placeholder="Last name"><br>
<input type="text" placeholder="Email" name="email"><input type="text" name="username" placeholder="Username"><br>
<input list="country" name="country" placeholder="Country">
<datalist id="country" >
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="Sudan">Sudan</option>
</datalist>
<input type="password" id="password" placeholder="Password" name="password"><a style="zoom: 100%;position: relative;cursor: pointer;" onclick="document.getElementById('myPopup2').style.display='block'" class="fa fa-question" aria-hidden="true"></a>
<div class="popuptext" id="myPopup2">
<a style="float: right;cursor: pointer;" onclick="document.getElementById('myPopup2').style.display='none'">&times</a>
<ul><li>Password Should contain atleast 6 characters</li>
<li>Password should not be commonly used</li>
<li>Use a password that you will easily remember</li>
</ul>
</div>
<br><input type="checkbox" onchange="uncheck()">I accept the <a href="terms.html">terms and conditions</a> and <a href="privacy.html">privacy policy</a><br>
<center><button type="submit" name="create-freelancer" class="submit-reg" title="Submit details">Create My account</button><br>
Already have an account? <a href="register.php" style="color: green;font-size: 17px;cursor: pointer;font-weight: bold;margin-top: -4%;">Login</a></center>
</form>
</div>
</div>