<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
if(isset($_POST["addskills"])){
	echo '<script>window.location="signup.php?step=7"</script>';
}
$error = $success = '';
$id = $_SESSION["id"];
if(isset($_POST["add-skill"])){	
	if(empty(trim($_POST["skills"]))){
		$error = 'Select skill';
	}else{
		$skill = trim($_POST["skills"]);
	}
	if(empty($error)){
		$sql = 'INSERT INTO skills(id, skill) VALUES(?,?)';
		if($stmt = mysqli_prepare($link,$sql)){
			mysqli_stmt_bind_param($stmt, "ss", $param_id, $param_skill);
			$param_id = $id;
			$param_skill = $skill;
			if(mysqli_stmt_execute($stmt)){
				$success = 'Skill added';
			}else{
				echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add skill
			</div>';
			}
			mysqli_stmt_close($stmt);
		}
	}
}

?>
<style>
.skills {
	width: 65%;
	height: 50%;
	font-size: 18px;
}
.skills input{
	width: 90%;
	margin-left: 5%;
	padding: 2%;
	position: relative;
}

</style>
<form method="POST">
<center>
<div class="skills">
<h1>Nearly there! What work are you here to do?</h1><br>
<p>Your skills show clients what you can offer, and help us choose which jobs to recommend to you. Add or remove the ones we’ve suggested, or start typing to pick more. It’s up to you.</p><br>
<h4>Your Skills</h4><br>
<input type="text" placeholder="type your skill to serach" name="skills" id="skill-input" onkeyup="showselect()">
<div id="opt" class="skill-opt">
<p><a onclick="change(this.innerHTML)">Ai</a></p>
<p><a onclick="change(this.innerHTML)">Machine learning</a></p>
<p><a onclick="change(this.innerHTML)">Java</a></p>
<p><a onclick="change(this.innerHTML)">Javascript</a></p>
<p><a onclick="change(this.innerHTML)">Php</a></p>
<p><a onclick="change(this.innerHTML)">Python</a></p>
<p><a onclick="change(this.innerHTML)">Css</a></p>
<p><a onclick="change(this.innerHTML)">Sql</a></p>
<p><a onclick="change(this.innerHTML)">Networking</a></p>
<p><a onclick="change(this.innerHTML)">C++</a></p>
<p><a onclick="change(this.innerHTML)">C</a></p>
<p><a onclick="change(this.innerHTML)">C#</a></p>
<p><a onclick="change(this.innerHTML)">C-Net</a></p>
<p><a onclick="change(this.innerHTML)">Django</a></p>
</div>
<p><?php echo $success;?></p>
<button type="submit" class="btn-save" name="add-skill" style="float: right;margin-top: 2%;">Save</button>
</div>
</center>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="addskills" class="next">Now write your Bio</button>
</div>
</form>
