<?php
	if(isset($_POST["make_edit"]))
	{
		$err = $gender = $name = $email = $name = $phone = $username = '';
		$passwordn = trim($_POST["password"]);
		$sql = 'SELECT password FROM users WHERE id=?';
			
			if($stmt = mysqli_prepare($link, $sql))
			{
				mysqli_stmt_bind_param($stmt, 's', $param_id);
					
					$param_id = $_SESSION["id"];
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $password);
					if(mysqli_stmt_fetch($stmt)){
						$hash = password_hash($password, PASSWORD_DEFAULT);
						if(password_verify($passwordn, $hash))
						{					
							if(empty(trim($_POST["name"])))
							{
								$name = $_SESSION["name"];
							}else { $name = trim($_POST["name"]);}
							
							if(empty(trim($_POST["email"])))
							{
								$email = $_SESSION["email"];
							}else { $email = trim($_POST["email"]);}
							
							if(empty(trim($_POST["username"])))
							{
								$username = $_SESSION["username"];
							}else { $username = trim($_POST["username"]);}
							
							if(empty(trim($_POST["phone"])))
							{
								$phone = $_SESSION["phone"];
							}else { $phone = trim($_POST["phone"]);}
														
							if($name != $_SESSION["name"])
							{
								$sql0 = 'UPDATE users SET name=? WHERE id='.$_SESSION["id"].'';

								if($stmt0 = mysqli_prepare($link, $sql0))
								{
									mysqli_stmt_bind_param($stmt0, "s", $param_name);
									$param_name = $name;
									if(mysqli_stmt_execute($stmt0))
									{
										echo '<div class="alert_succ">
											  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
											  Name Updated Succesfully
											</div>';
										$_SESSION["name"] = $name;
									}else{
										echo '<div class="alert_fail">
											  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
											 Failed to update name
											</div>';
									}
								}
								mysqli_stmt_close($stmt0);
							}
							
							else if($email != $_SESSION["email"])
							{
								$sql1 = 'SELECT email FROM users WHERE email=?';
									if($stmt1 = mysqli_prepare($link, $sql1))
								{
									mysqli_stmt_bind_param($stmt1, 's', $param_email);
									
									$param_email = $email;
									
									if(mysqli_stmt_execute($stmt1))
									{
										mysqli_stmt_store_result($stmt1);
										
										if(mysqli_stmt_num_rows($stmt1) == 1)
										{
											$err = 'Email not Available ';
											echo '<div class="alert_fail">
											  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
											  '.$err.'
											</div>';
										}else
										{
											$sql11 = 'UPDATE users SET email=?, activated=0 WHERE id='.$_SESSION["id"].'';
								
												if($stmt11 = mysqli_prepare($link, $sql11))
												{
													mysqli_stmt_bind_param($stmt11, "s", $param_email);
													$param_email = $email;
													if(mysqli_stmt_execute($stmt11))
													{
														echo '<div class="alert_succ">
														  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
														  Email Updated Succesfully
														</div>';
														$_SESSION["email"] = $email;
													}
												}
												mysqli_stmt_close($stmt11);
										}
									}
								}
								mysqli_stmt_close($stmt1);
							}
							
									
							else if($username != $_SESSION["username"])
							{
								$sql3 = 'SELECT username FROM users WHERE username=?';
									if($stmt3 = mysqli_prepare($link, $sql3))
								{
									mysqli_stmt_bind_param($stmt3, 's', $param_username);
									
									$param_username = $username;
									
									if(mysqli_stmt_execute($stmt3))
									{
										mysqli_stmt_store_result($stmt3);
										
										if(mysqli_stmt_num_rows($stmt3) == 1)
										{
											$err = 'Username Already Exists';
											echo '<div class="alert_fail">
											  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
											  '.$err.'
											</div>';
										}else
										{
												$sql31 = 'UPDATE users SET username=? WHERE id='.$_SESSION["id"].'';
								
												if($stmt31 = mysqli_prepare($link, $sql31))
												{
													mysqli_stmt_bind_param($stmt31, "s", $param_username);
													$param_username = $username;
													if(mysqli_stmt_execute($stmt31))
													{
														echo '<div class="alert_succ">
													  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
													  username Updated Succesfully
													</div>';
														$_SESSION["username"] = $username;
													}
												}
												mysqli_stmt_close($stmt31);
										}
									}
								}
								mysqli_stmt_close($stmt3);
							}
							else if($phone != $_SESSION["phone"])
							{
								if(strlen(trim($_POST["phone"])) < 10 || strlen(trim($_POST["phone"])) > 10)
								{
									$errp = 'Please Enter Valid Phone Number';
								}
								$sql2 = 'SELECT phone FROM users WHERE phone=?';
									if($stmt2 = mysqli_prepare($link, $sql2))
								{
									mysqli_stmt_bind_param($stmt2, 's', $param_phone);
									
									$param_phone = $phone;
									
									if(mysqli_stmt_execute($stmt2))
									{
										mysqli_stmt_store_result($stmt2);
										
										if(mysqli_stmt_num_rows($stmt2) == 1)
										{
											$err = 'Phone Number already registered ';
											echo '<div class="alert_fail">
											  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
											  '.$err.'
											</div>';
										}else
										{
											$sql21 = 'UPDATE users SET phone=?, phone_activated=0 WHERE id='.$_SESSION["id"].'';
								
												if($stmt21 = mysqli_prepare($link, $sql21))
												{
													mysqli_stmt_bind_param($stmt21, "s", $param_phone);
													$param_phone= $phone;
													if(mysqli_stmt_execute($stmt21))
													{
														echo '<div class="alert_succ">
														  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
														  Phone Updated Succesfully
														</div>';
														$_SESSION["Phone"] = $phone;
													}
												}
												mysqli_stmt_close($stmt21);
										}
									}
								}
								mysqli_stmt_close($stmt2);
							}
						}else
						{
							$err = 'Invalid Password';
							echo '<div class="alert_fail">
								  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
								  '.$err.'
								</div>';
						}
					}
				}
				mysqli_stmt_close($stmt);
			}
		
		
	}
	if(isset($_POST["delete"])) 
	{
		$passwordn = trim($_POST["password"]);
		$sql0 = 'SELECT password FROM users WHERE id=?';
			
			if($stmt = mysqli_prepare($link, $sql0))
			{
				mysqli_stmt_bind_param($stmt, 's', $param_id);
					
					$param_id = $_SESSION["id"];
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $password);
					if(mysqli_stmt_fetch($stmt)){
						$hash = password_hash($password, PASSWORD_DEFAULT);
						if(password_verify($passwordn, $hash))
						{
							 $sql = 'DELETE FROM users WHERE id='.$_SESSION["id"].'';
							 $execute = $link->query($sql);
							    if (!$execute) {
									 echo '<div class="alert_fail">
										  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
										 Failed to delete account
										</div>';
									
								} else {
									$email = $_SESSION["email"];
									$subject = 'ACCOUNT DELETED ';
									$message = 'This is to inform you that your account at myJOBS was successfully deleted';
									$header = "MyJobs Network\r\n";
									$ret = mail($email,$subject,$message,$header);
									if($ret){
										header("refresh: 0;url=register.php");
									}
								    
						        }
								
						}else{
							echo '<div class="alert_fail">
							  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
							 Invalid Password
							</div>';
						}
					}
				}
				mysqli_stmt_close($stmt);
			}

	}
	
?>
<style>
.account {
	width: 50%;
	height: 80%;
	border-radius: 8px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.account input[type=text]{
	padding: 9px 18px;
	margin-top: 2%;
	border: none;
	background: white;
}
.account a:hover{
	cursor: pointer;
	text-decoration: underline;
}
.make_edit {
	display: none;
	margin-top: 4%;
}
.additional_accounts {
	width: 50%;
	height: 60%;
	text-align: justify;
	border-radius: 8px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.additional_accounts p{
	font-weight: light;
	overflow: hidden;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 1;
	text-color: black;
}
.additional_accounts button{
	width: 30%;
	height: 16%;
	border-radius: 10px;
	color: green;
	background: white;
	float: right;
	margin-top: -3.5%;
}
.additional_accounts button:hover{
	background: #88888;
}
.location {
	width: 50%;
	height: 60%;
	border-radius: 8px;
	text-align: justify;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.location input[type=text]{
	padding: 9px 18px;
	border: none;
	background: white;
}
.location textarea{
	resize: none;
	min-height: 50px;
	border: none;
	background: white;
}
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%;
  height: 100%; 
  overflow: auto; 
  padding-top: 50px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; 
  border: 1px solid #888;
  width: 80%; 
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
    width: 100%;
  }
}
.enter-popup {
  display: block;
  position: fixed;
  background-color: white;
  border: 1px solid #888;
  margin-left: 30%;
  margin-top: 5%;
  width: 40%; 
  height: 50%;
}
.enter-popup2 {
  display: block;
  position: fixed;
  width: 45%;
	height: 65%;
	margin-left: 20%;
	background: white;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	font-size: 23px;
	font-weight: bold;
	text-align: center;	;
}

.enter-popup input{
	width: 90%;
	margin-left: 5%;
	margin-top: 2%;
	margin-bottom: 2%;
	padding: 3%;
}
.enter-popup2 input{
	width: 90%;
	margin-left: 5%;
	margin-top: 2%;
	margin-bottom: 2%;
	padding: 3%;
}
.enter-popup2 button{
	width: 65%;
	margin-left: 5%;
	padding: 4%;
	border-radius: 15px;
	background: green;
	color: white;
	margin-top: 10%;
	font-size: 20px;
	font-weight: bold;
	cursor: pointer;
}
.enter-popup input:focus {
  background-color: #ddd;
  outline: none;
}
.enter-popup a{
	margin-left: -10%;
	z-index: 1;
	cursor: pointer;
}
.enter-popup .bnt {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}
.enter-popup .cancel {
  background-color: red;
}

.enter-popup .bnt:hover, .open-button:hover {
  opacity: 1;
}
.success {
  display: block; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: #474e5d;
  
}
.success-content {
	background-color: #ddd;
  margin: 2% auto; 
  padding: 20px;
  border: 1px solid #888;
  height: 20%;
  width: 50%; 
}
.button_submit {
	padding: 10px 15%;
	background: green;
	color: white;
	border-radius: 10px;
	margin-top: -5%;
}
.new-client {
	width: 75%;
	height:60%;
	margin-top: 5%;
	background: white;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
}
.low-foot {
	float: right;
}
.low-foot button{
	padding: 3% 13%;
	background: white;
	color: green;
}
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

.cancelbtn {
  background-color: #ccc;
  color: black;
}

.deletebtn {
  background-color: #f44336;
}

.container {
  padding: 16px;
  text-align: center;
}

</style>

<div>
<form method="POST" action="" enctype="multipart/form-data">
<h1>Contact info</h1>
<div class="account">
<h2>Account<p style="float: right;margin-top: -0.2%;"><i onclick="edit()" class="fa fa-edit"></i></p></h2>
<hr>
User ID<br>
<input type="text" name="username" value="<?php echo $_SESSION["username"];?>" id="id" disabled><br>
Name<br>
<input type="text" name="name" value="<?php echo $_SESSION["name"];?>" id="name" disabled><br>
Phone<br>
<p><input type="text" id="phone" name="phone" value="<?php echo $_SESSION["phone"];?>" disabled></p>
<?php 
 require_once "database.php"; 
$sql0 = 'SELECT * FROM users where id='.$_SESSION["id"].'';
$result = $link->query($sql0);

while($rows=$result->fetch_assoc())
{
	if($rows["phone_activated"] == 1)
	{
		?>
<button style="border-radius: 5px;color: green;background: white;float: right;">verified</button>
<?php
	}else{
?>
<a href="#" target="_blank"><button type="button" style="border-radius: 5px;color: red;background: white;float: right;margin-top: -2%;" onclick="">Not verified</button></a>
<?php } }
?>
Email<br>
<input type="text" name="email" value="<?php echo $_SESSION["email"];?>" id="email" disabled>
<?php 
 require_once "database.php"; 
$sql0 = 'SELECT * FROM users where id='.$_SESSION["id"].'';
$result = $link->query($sql0);

while($rows=$result->fetch_assoc())
{
	if($rows["activated"] == 1)
	{
		?>
<button style="border-radius: 5px;color: green;background: white;float: right;">verified</button>
<?php
	}else{
?>
<a href="verifyemail.php?email=<?php $_SESSION["email"];?>" target="_blank"><button type="button" style="border-radius: 5px;color: red;background: white;float: right;margin-top: -2%;">Not verified</button></a>
<?php } }?>
<br>
<div class="make_edit" id="make_edit">
<button type="button" class="button_submit" onclick="document.getElementById('enterpassedit').style.display = 'block'" >Update</button>
<p style="color: green;font-size: 18px;margin-left: 45%;margin-top: -5%;"><a onclick="close_edit('make_edit')">Cancel</a></p>
</div>
<p style="float: right;margin-right: 2%;color: green;font-size: 18px;"><a onclick="document.getElementById('id01').style.display='block'">Close Account</a></p>
</div>
<div class="additional_accounts">
<h2>Additional Accounts</h2>
<p>Creating a new account allows you to use Myjobsapp in different ways, while still having just one login.</p>
<hr/>
<h4>Client Account</h4>
<p>Hire, manage and pay as a different company.Each company has its own freelancers, payment methods and reports</p>
<button onclick="newClient()">New Client Account</button>
<h4>Agency Account</h4>
<p>Find jobs and earn money as manager of a team of freelancers.</p>
<button onclick="newAgency()">New Agency Account</button>
</div>
<div class="location">
<h2>Location and Other<p style="float: right;margin-top: -0.2%;"><i onclick="editother()" class="fa fa-edit"></i></p></h2>
<hr/>
<h4>Time Zone</h4>
<p>UTC+03:00 Baghdad, Kuwait, Nairobi, Riyadh</p>
<h4>Address</h4>
<p><textarea id="address" name="address" disabled>21 makadara
Nairobi, Nairobi Area 42613-0010
Kenya</textarea></p>
<h4>Gender</h4>
<p><input type="text" id="gender" name="gender" value="<?php echo $_SESSION["gender"];?>" disabled></p>
<div class="make_edit" id="make_otheredit">
<button type="button" class="button_submit" onclick="document.getElementById('enterpassedit').style.display = 'block'">Update</button>
<p style="color: green;font-size: 18px;margin-left: 45%;margin-top: -5%;"><a onclick="close_edit('make_otheredit')">Cancel</a></p>
</div>
</div>
<div id="newclient" style="display:none;position: fixed;top: 10%;left: 10%;height: 100%;width: 100%;">
<div class="new-client">
<h1>Create a client account<p style="float: right;"><a onclick="document.getElementById('newclient').style.display='none'">&times</a></p></h1>
<hr/>
<p>Setup a client account if you want to post jobs and hire talents.</p>
Company name<br><input type="text" name="company-name" style="padding: 1.5% 12%;width: 60%;margin-bottom: 10%;"><br>
<hr/>
<div class="low-foot">
<button type="submit" name="create-client">Create Client account</button>
</div>
</div>
</div>
<div id="enterpassedit" class="modal">
  <div class="enter-popup">
	<h1>Enter Password</h1><br>
    <input type="password" placeholder="Enter Password" id="password" name="password" required><a class="fa fa-eye fa-lg" onclick="showPassword()" id="toggle-password"></a><br>
	<button type="submit" class="bnt" name="make_edit">SUBMIT</button>
    <button type="button" class="bnt cancel" onclick="document.getElementById('enterpassedit').style.display='none'">Close</button>
	</div>
</div>
</form>
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">&times;</span>
    <div class="container">
      <h1>Delete Account</h1>
      <p>Are you sure you want to delete your account?</p>

      <div class="clearfix">
	  <button type="button" class="deletebtn" onclick="document.getElementById('enterpass').style.display = 'block'" style="padding: 14px 20px;margin-left: 20%;border: none;cursor: pointer;width: 70%;opacity: 0.9;">Delete</button>
        <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'" style="padding: 14px 20px;margin-left: 20%;border: none;cursor: pointer;width: 70%;opacity: 0.9;">Cancel</button>
      </div>
    </div>
  
</div>
<div id="enterpass" class="modal">
<form class="modal-content" method="POST" action="">
  <div class="enter-popup2">
	<a style="float: right;" onclick="document.getElementById('enterpass').style.display='none'">&times</a>
	<h1>Enter Password</h1><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
	<button type="submit" class="bnt" name="delete">Delete</button>
	</div>
</form>
</div>
</div>
<script>
function edit(){
	document.getElementById("id").disabled=false;
	document.getElementById("name").disabled=false;
	document.getElementById("email").disabled=false;
	document.getElementById("phone").disabled=false;
	document.getElementById("make_edit").style.display='block';
	
}
function editother(){
	document.getElementById("address").disabled=false;
	document.getElementById("phone").disabled=false;
	document.getElementById("gender").disabled=false;
	document.getElementById("make_otheredit").style.display='block';
}
function close_edit(id)
{
	document.getElementById(id).style.display='none';
}
function back(){ 
window.location = "account.php";
}
function exitdel(){ window.location.href = 'register.php';
session_destroy();
}
function newClient(){
	document.getElementById("newclient").style.display='block';
}
function changeInput(old, newType) {
	old.type = newType;
} 
  
function showPassword() {
	if(document.getElementById('password').type == "password"){
		changeInput(document.getElementById('password'), 'text');	
	}else{
		changeInput(document.getElementById('password'), 'password');
	}
}
</script>