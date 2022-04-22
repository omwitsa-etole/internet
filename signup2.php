<?php
if(!$_SESSION["username"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$_SESSION["loggedin"] = true;
$username = $_SESSION["username"];
$sql0 = 'SELECT id FROM users WHERE username = ?';
if($stmt0 = mysqli_prepare($link, $sql0)){
	mysqli_stmt_bind_param($stmt0, "s", $param_username);
		$param_username = $username;
		if(mysqli_stmt_execute($stmt0)){
			mysqli_stmt_store_result($stmt0);
				
				if(mysqli_stmt_num_rows($stmt0) == 1)
				{
					mysqli_stmt_bind_result($stmt0, $id);
					if(mysqli_stmt_fetch($stmt0))
					{	
						$_SESSION["id"] = $id;
					}
				}else {
					echo '<script>window.location="signup.php?step=1"</script>';
				}
		}
	mysqli_stmt_close($stmt0);
}
if(isset($_POST["add-title"])){
	$title = trim($_POST["title"]);
	$sql = 'UPDATE users SET title=? WHERE id='.$_SESSION["id"].'';
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $param_title);
		$param_title = $title;
		if(mysqli_stmt_execute($stmt)){
			echo '<script>window.location="signup.php?step=3"</script>';
		}else{
			'<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed please try again
			</div>';
		}
		mysqli_stmt_close($stmt);
	}
	
}

?>
<style>
.add-title{
	width: 55%;
	height: 60%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 5%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
}
.add-title input{
	border-radius: 5px;
	width: 80%;
	height: 20%;
}

</style>
<form method="POST">
<center>
<div class="add-title">
<h1>Now, add a title to tell the world what you do.</h1><br>
<p>It’s the very first thing clients see, so make it count. 
Stand out by describing your expertise in your own words.</p><br>
<input type="text" name="title" placeholder="Example:FullstackDeveloper|Web & Mobile">
</div>
</center>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go(-1)">Back</button>
<button type="submit" name="add-title" class="next">Next, Add Experience</button>
</div>
</form>