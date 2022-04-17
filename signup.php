<?php 
require_once "database.php";

$success = $email = $password = $confirmpassword = $firstname = $lastname = $name = $gender = $phone = $date = '';
$email_err = $password_err = $p_err =  $phone_err =  $username_err = $fname_err = $gender_err = $date_err = $name_err ='';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty(trim($_POST["firstname"]))){
		$fname_err = "enter firstname";
	}else{ $firstname = trim($_POST["firstname"]);}
	
	if(empty(trim($_POST["lastname"]))){
		$fname_err = "enter lastname";
	}else{ $lastname = trim($_POST["lastname"]);}
	
	if(empty($fname_err)){ $name = ''.$firstname .'	'. $lastname.'';}else{ $name_err = "name error";}
	if(empty(trim($_POST["email"]))){
		$email_err = "enter email";
	}else{ $email = trim($_POST["email"]);}
	
	if(empty(trim($_POST["username"]))){
		$username_err = "enter username";
	}else{ $username = trim($_POST["username"]);}
	
	if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
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
						echo '<div class="alert_succ">
							  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
							  Account Created Succesfully
							</div>';
					} else{
						echo '<div class="alert_fail">
							  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
							  Failed to create account
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
<head>
<title>Sign up</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="Jobs, online, posts, comments, hire, freelance, freelancer, images, share, jobprofile">
<meta name="google-signin-client_id" content="75332547705-428c5vr23v4dmlrvd1un82pa099r3q0c.apps.googleusercontent.com">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
.box-1 {
	width: 50%;
	height: 75%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 5%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
	position: fixed;
	z-index: 1;
	left: 25%;
}
.box h1{ margin-top: 3%; }
.check-button{
	width: 33%;
	height: 50%;
	display: inline-block;
	background: white;
	border-radius: 13px;
	margin-top: 5%;
	position: relative;
}
.check-button p{
	position: absolute;
	right: 0;
	top: 0;
}
.box-1 i{
	zoom: 250%;
} 
.sub-btn{
	padding: 2.5% 9%;
	border-radius: 12px;
	background: green;
	color: white;
	margin-top: 3%;
}
.client-form {
    width: 65%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 2%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
}
.client-form input{
	padding: 2% 9%;
	margin-top: 1.5%;
	text-align: left;
	
}
.freelance-form {
    width: 65%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 2%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
}
.freelance-form input{
	padding: 2% 9%;
	margin-top: 1.5%;
	text-align: left;
	
}
.freelance-form h2{ text-align: center;text-shadow: 2px 2px 4px #000000;margin-top: 2%;}
.client-form h2{ text-align: center;text-shadow: 2px 2px 4px rgb(20, 35, 100);margin-top: 2%;}
.btn-opt-apple {
	margin-top: 2%;
	background: white;
	color: black;
	text-align: center;
	padding: 2% 12%;
	border-radius: 15px;
	text-align: justify;
}
.btn-opt-google{
	margin-top: 2%;
	background: #00BFFF;
	color: white;
	text-align: center;
	padding: 2% 12%;
	border-radius: 15px;
	margin-left: 4%;
	text-align: justify;
}
.submit-reg {
	padding: 2% 40%;
	background: green;
	color: white;
	border-radius: 15px;
	margin-top: 3%;
	cursor: pointer;
	margin-bottom: 1%;
}
.client-form a:hover{ text-decoration: underline; }
h2 {
  overflow: hidden;
  text-align: center;
}

h2:before,
h2:after {
  background-color: #000;
  content: "";
  display: inline-block;
  height: 1px;
  position: relative;
  vertical-align: middle;
  width: 50%;
}

h2:before {
  right: 0.5em;
  margin-left: -50%;
}

h2:after {
  left: 0.5em;
  margin-right: -50%;
}
.popuptext {
  display: none;
  position: absolute;
  margin-left: 25%;
  width: 30%;
  text-align: justify;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  position: absolute;
  z-index: 1;
   -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}
.alert_fail {
  padding: 20px;
  background-color: #f44336; 
  color: white;
  width: 65%;
  margin-top: 1%;
  margin-left: 15%;
}

.alert_succ {
  padding: 20px;
  background-color: green; 
  color: white;
  width: 65%;
  margin-top: 1%;
  margin-left: 15%;
}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="color: green;font-size: 18px;font-weight: bold;font-family:Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif ;">
<h3>My Jobs</h3>
</div>
<hr/>
<center><div class="box-1" id="box">
<h1>Join as a Client or Freelancer</h1>
<button class="check-button" name="client" onclick="changecheck(this.name)"><p><input id="client" type="radio" name="join-option" value="Join as Client"></p><span><i class="fa fa-file" aria-hidden="true"></i><br>I’m a client, hiring for a project</span></button>
<button class="check-button" name="freelancer" onclick="changecheck(this.name)"><p><input id="freelancer" type="radio" name="join-option" value="Applly as Freelancer"></p><span><i class="fa fa-file-text-o" aria-hidden="true"></i><br>I’m a freelancer, looking for work</span></button><br>
<button class="sub-btn" type="button" onclick="generateform(this.innerHTML)" id="join-option">Create Account</button>
<div style="color: black;font-size: 18px;margin-top: 3%;">Already have an account <a href="register.php" style="color: green;">Login</a></div>
</div></center>
<div id="clientform" style="display: none;position: fixed;z-index: 1;width: 100%;height: 100%;top: 5%;left: 15%;">
<div class="client-form" >
<form method="POST">
<h2>Client Registration form</h2>
<p style="float: right;cursor: pointer;color:red;margin-top: -7%;"><a style="zoom: 150%;"onclick="exit()">&times</a></p>
<center><button class="btn-opt-google" type="button"><i class="fa fa-google"></i>Continue with Google</button><br>
<button type="button" class="btn-opt-apple" type="button"><i class="fa fa-apple"></i>Continue with Apple</button><br></center>
<hr/>
<input type="text" placeholder="First name" name="firstname"> <input type="text" name="lastname" placeholder="Last name"><br>
<input type="text" placeholder="Email" name="email">
<input type="text" placeholder="Password" name="password"><a style="zoom: 100%;position: relative;cursor: pointer;" onclick="document.getElementById('myPopup').style.display='block'" class="fa fa-question" aria-hidden="true"></a>
<div class="popuptext" id="myPopup">
<a style="float: right;cursor: pointer;" onclick="document.getElementById('myPopup').style.display='none'">&times</a>
<ul><li>Password Should contain atleast 6 characters</li>
<li>Password should not be commonly used</li>
<li>Use a password that you will easily remember</li>
</ul>
</div>
<br>
<input list="country" name="country" placeholder="Country">
<datalist id="country" >
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="Sudan">Sudan</option>
</datalist>
<input type="checkbox" onchange="uncheck()">I accept the <a href="terms.html">terms and conditions</a> and <a href="privacy.html">privacy policy</a><br>
<center><button type="submit" name="create-client" class="submit-reg" title="Submit details" disabled>Create My account</button><br>
<a onclick="exit()" style="color: green;font-size: 17px;cursor: pointer;font-weight: bold;margin-top: -4%;" title="Close form">Cancel</a></center>
</form>
</div>
</div>
<div id="freelanceform" style="display: none;position: fixed;z-index: 1;width: 100%;height: 100%;top: 5%;left: 15%;">
<div class="freelance-form" >
<form method="POST">
<h2>Freelance Registration form</h2>
<p style="float: right;cursor: pointer;color:red;margin-top: -7%;"><a style="zoom: 150%;"onclick="exit()">&times</a></p>
<center><button class="btn-opt-google" type="button"><i class="fa fa-google"></i>Continue with Google</button><br>
<button type="button" class="btn-opt-apple" type="button"><i class="fa fa-apple"></i>Continue with Apple</button><br></center>
<hr/>
<input type="text" placeholder="First name" name="firstname"> <input type="text" name="lastname" placeholder="Last name"><br>
<input type="text" placeholder="Email" name="email">
<input type="text" placeholder="Password" name="password"><a style="zoom: 100%;position: relative;cursor: pointer;" onclick="document.getElementById('myPopup2').style.display='block'" class="fa fa-question" aria-hidden="true"></a>
<div class="popuptext" id="myPopup2">
<a style="float: right;cursor: pointer;" onclick="document.getElementById('myPopup2').style.display='none'">&times</a>
<ul><li>Password Should contain atleast 6 characters</li>
<li>Password should not be commonly used</li>
<li>Use a password that you will easily remember</li>
</ul>
</div>
<br>
<input list="country" name="country" placeholder="Country">
<datalist id="country" >
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="Sudan">Sudan</option>
</datalist>
<input type="checkbox" onchange="uncheck()">I accept the <a href="terms.html">terms and conditions</a> and <a href="privacy.html">privacy policy</a><br>
<center><button type="submit" name="create-client" class="submit-reg" title="Submit details" disabled>Create My account</button><br>
Already have an account? <a href="register.php" style="color: green;font-size: 17px;cursor: pointer;font-weight: bold;margin-top: -4%;">Login</a></center>
</form>
</div>
</div>
<script>
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.style.display = 'block';
}
function changecheck(id){
	document.getElementById(id).checked = true;
	document.getElementById("join-option").innerHTML = id;
}
function generateform(text){
	if(text == "client"){
		document.getElementById("clientform").style.display = 'block';
		document.getElementById("box").style.display = 'none';
	}else if(text == "freelancer"){
		document.getElementById("freelanceform").style.display = 'block';
		document.getElementById("box").style.display = 'none';
	}else{
		document.getElementById("box").style.display = 'block';
		document.getElementById("clientform").style.display = 'none';
		document.getElementById("freelanceform").style.display = 'none';
	}
}
function exit(){
	var x = document.getElementById("clientform");
	var y = document.getElementById("freelanceform");
	x.style.display = 'none';
	y.style.display = 'none';				
	document.getElementById("box").style.display = 'block';
}
function uncheck(){
	var x = document.getElementById("submit");
	if(x.disabled == true){ x.disabled = false;}else{ x.disabled = true;}
}
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); 
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); 
}
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>