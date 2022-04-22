<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$error = '';
$id = $_SESSION["id"];
if(isset($_POST["addbio"])){
	$about = trim($_POST["about-user"]);
	$sql = 'UPDATE users SET about=? WHERE id='.$id.'';
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $param_about);
		$param_about = $about;
		if(mysqli_stmt_execute($stmt)){
			echo '<script>window.location="signup.php?step=8"</script>';
		}else{
			echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add about you
			</div>';
		}
		mysqli_stmt_close($stmt);
	}
	
}

?>
<style>
.bio {
	width: 65%;
	height: 70%;
	font-size: 18px;
	overflow: auto;
}
.bio textarea{
	width: 70%;
	height: 45%;
}

</style>
<form method="POST">
<center>
<div class="bio">
<h1>Great! Now write a bio to tell the world about yourself.</h1><br>
<p>Help people get to know you at a glance. What work are you best at? Tell them clearly, using paragraphs or bullet points. You can always edit later - just make sure you proofread now!</p><br>
<textarea onkeyup="makeCount()" maxlength="2000" name="about-user" placeholder="Describe your top skills, experiences, and interests. This is one of the first things clients will see on your profile.">
</textarea><br>
<p style="float: right;margin-right: 20%;">Atleast <span id="rem">100</span> characters</p>
</div>
</center>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="addbio" class="next">Choose Area of Work</button>
</div>
</form>
<script>
function makeCount(){
	var x = document.getElementById("rem");
	x--;
}
</script>