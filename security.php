<?php
	if(isset($_POST["update"]))
	{
		require_once "database.php";
		if(empty(trim($_POST["old_password"]))){
        $password_err = "Please enter old_password.";     
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  '.$password_err.'
			</div>';
		} 
		else{
			$old_password = trim($_POST["old_password"]);
		}
		
		if(empty(trim($_POST["new_password"]))){
        $password_err = "Please enter a password.";     
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  '.$password_err.'
			</div>';
		} else if(strlen(trim($_POST["new_password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
			echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  '.$password_err.'
				</div>';
		} else{
			$new_password = trim($_POST["new_password"]);
		}
		if(empty(trim($_POST["confirm_password"]))){
			$p_err = "Please confirm password.";   
			echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  '.$p_err.'
				</div>';			
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($new_password != $confirm_password)){
				$p_err = "Password did not match.";
				echo '<div class="alert_fail">
					  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
					  '.$p_err.'
					</div>';
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
									echo '<div class="alert_succ">
									  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
									  Password Updated Successfully
									</div>';
								}else{ echo '<div class="alert_fail">
									  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
									  Failed to Update password
									</div>';}
							}
						}else
						{
							echo '<div class="alert_fail">
								  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
								  Old password is incorrect
								</div>';							
						}
					}
				
				}
			}
		}
	}
?>
<style>
.auth_options {
	width: 50%;
	height: 40%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.change_pass {
	width: 50%;
	height: 70%;
}
.password_edit {
	width: 50%;
	height: 50%;
	border-radius: 10px;
	background: white;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

</style>
<div style="width: 100%;height: 100%;">
<h1>Security Settings</h1>
<div class="auth_options">
<h1>Authentication options</h1>
<hr/>
<h2>Password<p style="float: right;margin-top: -0.2%;"><i onclick="edit()" class="fa fa-edit"></i></p></h2>
<b>Password has been set</b>
</div>
<div class="change_pass" id="change_pass" style="display:none;position: fixed;top: 10%;left: 30%;height: 100%;width: 100%;">
<div class="password_edit">
<h2>Change Password<p style="float: right;margin-top: -0.2%;"><i onclick="document.getElementById('change_pass').style.display='none'" >&times</i></p></h2>
<form method="POST" action=""  enctype="multipart/form-data">
Enter Old password<br><input type="password" name="old_password" style="padding: 1.5% 12%;"><br>
Enter New Password<input type="checkbox" onchange="showpass()">show password<br>
<input type="password" id="password" name="new_password" style="padding: 1.5% 12%;"><br>
Confrim New Password<br><input type="password" name="confirm_password" style="padding: 1.5% 12%;"><br>
<button type="submit" class="btn_submit" name="update">Update</button>
<p><a onclick="document.getElementById('change_pass').style.display='none'">cancel</a></p>
</form>
</div>
</div>
</div>
<script>
function edit(){
	document.getElementById('change_pass').style.display='block';
}
</script>