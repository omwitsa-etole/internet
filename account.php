<?php include "header.php";
require_once "database.php";
$password_err = $new_password = $confirm_password = $p_err = $old_password = '';
$errp = '';
	if(isset($_POST["delete"])) 
	 {
		 $sql = 'DELETE FROM users WHERE id='.$_SESSION["id"].'';
		 $execute = $link->query($sql);
		 if (!$execute) {
			 echo '<div class="success" onLoad="disablerefresh()"><div class="success-content">Something went wrong try again<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="exitdel()">exit</button>
			</div></div>' . $link->error;
				
			} else {
				$email = $_SESSION["email"];
				$subject = 'ACCOUNT DELETED ';
				$message = 'This is to inform you that your account at myJOBS was successfully deleted';
				$header = "MyJobs Network\r\n";
				mail($email,$subject,$message,$header);
				echo '<div class="success"><div class="success-content">Account deleted successfully<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="exitdel()">exit</button>
			</div></div>';}
			header("refresh: 1;url=register.php");

			$link->close();
	}
	
	if(isset($_POST["updatemode"]))
	{
	 $mode = trim($_POST["mode"]);
	 $sql0 = 'UPDATE users SET mode=? where id='.$_SESSION["id"].'';
	 if($stmt = mysqli_prepare($link, $sql0))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_mode);
	    $param_mode = $mode;
		if(mysqli_stmt_execute($stmt))
		{
			header("refresh: 1;url=account.php");
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
 
 
	}
	
	if(isset($_POST["edit"]))
	{
		$err = '';
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
										echo '<div class="success" id="suxess"><div class="success-content">Name Updated Succesfully
										<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
										</div></div>';
										$_SESSION["name"] = $name;
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
											echo '<div class="success" id="suxess"><div class="success-content">'.$err.'
											<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
											</div></div>';
										}else
										{
											$sql11 = 'UPDATE users SET email=?, activated=0 WHERE id='.$_SESSION["id"].'';
								
												if($stmt11 = mysqli_prepare($link, $sql11))
												{
													mysqli_stmt_bind_param($stmt11, "s", $param_email);
													$param_email = $email;
													if(mysqli_stmt_execute($stmt11))
													{
														echo '<div class="success" id="suxess"><div class="success-content">Email Updated Succesfully
														<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
														</div></div>';
														$_SESSION["email"] = $email;
													}
												}
												mysqli_stmt_close($stmt11);
										}
									}
								}
								mysqli_stmt_close($stmt1);
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
											echo '<div class="success" id="suxess"><div class="success-content">'.$err.'
											<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
											</div></div>';
										}else
										{
											$sql21 = 'UPDATE users SET phone=?, phone_activated=0 WHERE id='.$_SESSION["id"].'';
								
												if($stmt21 = mysqli_prepare($link, $sql21))
												{
													mysqli_stmt_bind_param($stmt21, "s", $param_phone);
													$param_phone= $phone;
													if(mysqli_stmt_execute($stmt21))
													{
														echo '<div class="success" id="suxess"><div class="success-content">Phone Updated Succesfully
														<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
														</div></div>';
														$_SESSION["Phone"] = $phone;
													}
												}
												mysqli_stmt_close($stmt21);
										}
									}
								}
								mysqli_stmt_close($stmt2);
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
											echo '<div class="success" id="suxess"><div class="success-content">'.$err.'
											<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
											</div></div>';
										}else
										{
												$sql31 = 'UPDATE users SET username=? WHERE id='.$_SESSION["id"].'';
								
												if($stmt31 = mysqli_prepare($link, $sql31))
												{
													mysqli_stmt_bind_param($stmt31, "s", $param_username);
													$param_username = $username;
													if(mysqli_stmt_execute($stmt31))
													{
														echo '<div class="success" id="suxess"><div class="success-content">Username Updated Succesfully
														<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
														</div></div>';
														$_SESSION["username"] = $username;
													}
												}
												mysqli_stmt_close($stmt31);
										}
									}
								}
								mysqli_stmt_close($stmt3);
							}
						}else
						{
							$err = 'Invalid Password';
							echo '<div class="success" id="suxess"><div class="success-content">'.$err.'
							<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
							</div></div>';
						}
					}
				}
				mysqli_stmt_close($stmt);
			}
		
		
	}
	
	if(isset($_POST["update"]))
	{
		if(empty(trim($_POST["old_password"]))){
        $password_err = "Please enter old_password.";     
		echo '<div class="success" id="suxess"><div class="success-content">'.$password_err.'
			<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
			</div></div>';
		} 
		else{
			$old_password = trim($_POST["old_password"]);
		}
		
		if(empty(trim($_POST["new_password"]))){
        $password_err = "Please enter a password.";     
		echo '<div class="success" id="suxess"><div class="success-content">'.$password_err.'
			<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
			</div></div>';
		} else if(strlen(trim($_POST["new_password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
			echo '<div class="success" id="suxess"><div class="success-content">'.$password_err.'
			<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
			</div></div>';
		} else{
			$new_password = trim($_POST["new_password"]);
		}
		if(empty(trim($_POST["confirm_password"]))){
			$p_err = "Please confirm password.";   
			echo '<div class="success" id="suxess"><div class="success-content">'.$p_err.'
			<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
			</div></div>';			
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($new_password != $confirm_password)){
				$p_err = "Password did not match.";
				echo '<div class="success" id="suxess"><div class="success-content">'.$p_err.'
				<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
				</div></div>';
			}
		}
		
		if(empty($p_err))
		{
			$sql = 'SELECT id,password FROM users WHERE id=?';
			
			if($stmt = mysqli_prepare($link, $sql))
			{
				mysqli_stmt_bind_param($stmt, 's', $param_id);
					
					$param_id = $_SESSION["id"];
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $id, $password);
					if(mysqli_stmt_fetch($stmt)){
						$hash = password_hash($password, PASSWORD_DEFAULT);
						if(password_verify($old_password, $hash))
						{
							$sql1 = 'UPDATE users SET password=? WHERE id=?';
			
							if($stmt1 = mysqli_prepare($link, $sql1))
							{
								mysqli_stmt_bind_param($stmt1, "ss", $param_password, $param_id);
								$param_password =$new_password;
								$param_id = $_SESSION["id"];
								if(mysqli_stmt_execute($stmt1))
								{
									echo '<div class="success" id="suxess"><div class="success-content">Password Updated Succesfully
									<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
									</div></div>';
								}else{ echo '<div class="success" id="suxess"><div class="success-content">Failed to change password Please try again
								<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
								</div></div>';}
							}
						}else
						{
							echo '<div class="success" id="suxess"><div class="success-content">Old Password Is incorrect Please try again
							<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="back()">exit</button>
							</div></div>';							
						}
					}
				
				}
			}
		}
	}

?>

<style>
#accountsmain {
	margin-top: 5%;
}

button:hover {
  opacity:1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Modal Close Button (x) */
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

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and delete button on extra small screens */
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
  margin-left: 20%;
  width: 40%; /* Could be more or less, depending on screen size */
  height: 50%;
}

/* Full-width input fields */
.enter-popup input[type=password] {
  width: 90%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.enter-popup input[type=password]:focus {
  background-color: #ddd;
  outline: none;
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

/* Add a red background color to the cancel button */
.enter-popup .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.enter-popup .bnt:hover, .open-button:hover {
  opacity: 1;
}

.success {
  display: block; 
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  
}
.success-content {
	background-color: #ddd;
  margin: 2% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  height: 20%;
  width: 50%; /* Could be more or less, depending on screen size */
}
.ainfo {
	margin-top: 5%;
}
.pinfo {
	border-collapse: collapse;
	height: 50%;
	width: 30%;
	color: black;
	border-radius: 5px;
}
.pinfo th{
	height: 5%;
}
.pinfo td{
	height: 7%;
	padding: 3%;
}
.pinfo td input{
	border: none;
	padding: 5px;
	background: white;
	color: black;
}
.oinfo {
	border-collapse: collapse;
	height: 50%;
	width: 30%;
	border-radius: 5px;
	color: black;
}
.oinfo th{
	height: 5%;
}
.oinfo td{
	height: 4%;
	padding: 3%;
	color: black;
}
.oinfo td input{
	border: none;
	padding: 5px;
	background: white;
	color: black;
}
#tablesettings {
	border-collapse: collapse;
}
#tablesettings td{ cursor: pointer;padding: 3%;}
#changepass table{
	position: fixed;
	border-collapse: collapse;
	top: 25%;
	background: #ddd;
	left: 40%;
}
.payment {
}
.payment table{
	position: absolute;
	width: 30%;
	height: 50%;
	border-collapse: collapse;
}
.payment table th{
	height: 10%;
}
.payment table td{
	padding: 5%;
}
</style>
<div id="accountsmain" style="position: absolute;width: 100%;height: 100%;margin-left: 25%;">
<div class="ainfo">
<div>
<form method="POST" action="" enctype="multipart/form-data">
<table border="1px" class="pinfo" id="pinfo">
<th>Personal Info<input type="button" id="submit" style="float: right;color: green;border-radius: 5px;display: none;"onclick="document.getElementById('enterpassedit').style.display = 'block'" value="SUBMIT" style="submit"></th>
<tr><td>
Name: <input id="name" type="text" name="name" value="<?php echo $_SESSION["name"];?>"  disabled>
<button id="name" onclick="document.getElementById(this.id).disabled=false;document.getElementById('submit').style.display='block'" style="border-radius: 5px;color: green;background: white;float: right;">Edit</button>
</td></tr>
<tr><td>
User: <input id="user" type="text" name="username" value="<?php echo$_SESSION["username"];?>"  disabled>
<button id="user" onclick="document.getElementById(this.id).disabled=false;document.getElementById('submit').style.display='block'" style="border-radius: 5px;color: green;background: white;float: right;">Edit</button>
</td></tr>
<tr><td>
Mail:<input type="text" id="email" name="email" value="<?php echo $_SESSION["email"];?>" disabled>
<button id="email" onclick="document.getElementById(this.id).disabled=false;document.getElementById('submit').style.display='block'" style="border-radius: 5px;color: green;background: white;float: right;">Edit</button>
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
<a href="verifyemail.php?email=<?php $_SESSION["email"];?>" target="_blank"><button type="button" style="border-radius: 5px;color: red;background: white;float: right;margin-top: 7%;">Not verified</button></a>
<?php } }?>
</td></tr>
</td></tr>
<tr><td>
Phone:<input type="text" id="phone" name="phone" value="<?php echo $_SESSION["phone"];?>" disabled>
<button id="phone" onclick="document.getElementById(this.id).disabled=false;document.getElementById('submit').style.display='block'" style="border-radius: 5px;color: green;background: white;float: right;">Edit</button><br>
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
<a href="#" target="_blank"><button type="button" style="border-radius: 5px;color: red;background: white;float: right;margin-top: 2%;" onclick="">Not verified</button></a>
<?php } }$link->close();?>
</td></tr>
</table>
<div id="enterpassedit" class="modal">
  <div class="enter-popup">
	<h1>Enter Password</h1><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
	<input type="submit" class="bnt" name="edit" value="SUBMIT">
    <button type="button" class="bnt cancel" onclick="document.getElementById('enterpassedit').style.display='none'">Close</button>
	</div>
</div>
</form>
</div><br>
<div>
<table border="1px" class="oinfo" id="oinfo">
<th>Other Details</th>
<tr><td>
D. O. B<input type="text" value="<?php echo $_SESSION["birthdate"];?>" disabled>
</td></tr>
<tr><td>
GENDER<input type="text" value="<?php echo $_SESSION["gender"];?>" disabled>
</td></tr>
<tr><td>
Address: 42613-00100
</td></tr>
</table>
</div>
</div><br>
<div>
<table id="tablesettings" border="1px" width="30%">
<tr><th><center>ACCOUNT SETTINGS</center></th></tr><form method="POST" action="" id="form1">
<tr>
<td>
Dark mode <span style="float: right;margin-left: -20%;" id="radios"><input type="text" id="val" name="mode" value="" style="display: none;">
<?php if($_SESSION["mode"] == 0){?>
light<input type="radio" name="mode" value="0" checked>
dark<input type="radio" name="mode" value="1">
<?php }else{ ?>
light<input type="radio" name="mode" value="0" >
dark<input type="radio" name="mode" value="1" checked>
<?php }?>
</span>
</td>
</tr><br>
<tr>
<td onclick="document.getElementById('changepass').style.display='block'" >
change Password
</td>
</tr>
<tr><td onclick="document.getElementById('id01').style.display='block'">
Delete Account
</td></tr>
<tr>
<td>
<input type="submit" value="save" name="updatemode" style="padding: 8px;position: auto;float: right;"></form>
</td>
</tr>
</table><br>
</div><br>
<div class="payment">
<table border="1px">
<tr><th>PAYMENTS HISTORY</th></tr>
<tr><td>
ACCOUNT BALANCE: 
</td></tr>
<tr><td>
PENDING PAYEMENTS: 
</td></tr>
<tr><td>
JOBS COMPLETED: 
</td></tr>
<tr><td>
PERFOMANCE RATING: 
</td></tr>
</table>
</div>


<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
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
  <div class="enter-popup">
	<h1>Enter Password</h1><br>
    <input type="password" placeholder="Enter Password" name="password" required><br>
	<button type="submit" class="bnt" name="delete">Delete</button>
    <button type="button" class="bnt cancel" onclick="document.getElementById('enterpass').style.display='none'">Close</button>
	</div>
</form>
</div>

<div id="changepass" style="display: none;">
<table border="1px" width="30%" height="40%">
<tr><th>Change Password<input type="button" value="x" onclick="document.getElementById('changepass').style.display='none'" style="float: right; color: red;"></th></tr>
<tr>
<td>
<form method="POST" action="" enctype="multipart/form-data">
<center>Enter Old password<br><input type="password" name="old_password"><br>
Enter New Password<br><input type="password" id="password" name="new_password"><br>
Confrim New Password<br><input type="password" name="confirm_password" ><br><br>
<input type="checkbox" onchange="showpass()" >show password<br>
<input type="submit" value="Update" name="update"></center>
</form>
</td>
</tr>
</table>
</div>
</div>
<?php include "footer.php";?>
<script>
function back(){ 
window.location = "account.php";
}
function edit(d)
{
	var x = document.getElementById(d);
	var y = document.getElementById("submit");
	x.disabled = false;
	y.style.display = "block";
}

function exitdel(){ window.location.href = 'register.php';
session_destroy();
}
function darkmode(mode)
{
	switch(mode){
		case "dark":
	document.getElementById("body").style.background = "black";
	document.getElementById("body").style.color = "white";
	document.getElementById("menu").style.background = "white";
	document.getElementById("menu2").style.background = "white";
	document.getElementById("menu3").style.background = "white";
	document.getElementById("val").value = "1";break;
	
	
	case "light":
	document.getElementById("body").style.background = "white";
	document.getElementById("body").style.color = "black";
	document.getElementById("menu").style.background = "black";
	document.getElementById("menu2").style.background = "black";
	document.getElementById("menu3").style.background = "black";
	document.getElementById("val").value = "0";break;
	}
}

function showpass(){ var x  = document.getElementById("password");
if(x.type == "password"){ x.type = "text"; }else { x.type="password"; }
}
</script>
