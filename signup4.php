<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
if(isset($_POST["add-educ"])){
	echo '<script>window.location="signup.php?step=5"</script>';
}
$success = '';
$id = $_SESSION["id"];
if(isset($_POST["add-education"])){
	$degree = trim($_POST["degree"]);
	$field = trim($_POST["field"]);
	$description = trim($_POST["description"]);
	$sql = 'INSERT INTO education(id, degree, field, description) VALUES(?,?,?,?)';
	if($stmt=mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_degree, $param_field, $param_description);
		$param_id = $id;
		$param_degree = $degree;
		$param_field = $field;
		$param_description = $description;
		if(mysqli_stmt_execute($stmt)){
			$success = "education added";
		}else{
			echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add education
			</div>';
		}
		mysqli_stmt_close($stmt);
	}
}

?>
<style>
.add-education {
	width: 55%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 25%;
	margin-top: 2%;
}
.add-education select{
	padding: 2% 20%;
}
.add-education textarea{
	resize: none;
	width: 95%;
	height: 25%;
}
</style>
<form method="POST">
<center>
<div>
<h1>Clients like to know what you know - <br>add your education here.</h1><br>
<p>You don’t have to have a degree. Adding any relevant education helps make your profile more visible.</p><br>
<div class="addexp" onclick="document.getElementById('education').style.display='block'">
<a onclick="document.getElementById('education').style.display='block'">Add education</a>
<p><?php echo $success;?></p>
</div>
</div>
</center>
<div id="education" style="display: none;position: fixed;z-index: 1;top: 0;overflow: auto;width: 100%;height: 100%;">
<div class="add-education">
<h1>Add education<a style="float:right;cursor: pointer;color: red;" onclick="document.getElementById('education').style.display='none'">&times</a></h1>
<hr/>
Degree: <br><input class="emp-1" name="degree" type="text" placeholder="Ex:Bachelor's"><br>
Field of study: <br><input class="emp-1" name="field" type="text" placeholder="Ex:Business"><br>
Period: <br>
<select>
<option>From</option>
<option></option>
<option></option>
</select>
<select>
<option>To</option>
<option></option>
<option></option>
</select><br>
Description(optional)<br>
<textarea name="description"></textarea><br>
<span style="margin-top: 5%;"><hr/>
<a onclick="document.getElementById('education').style.display='none'" style="cursor: pointer;color: green;font-size: 25px;">Cancel</a>
<button class="btn-save" type="submit" name="add-education" style="float: right;">SAVE</button></span>
</div>
</div>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="add-educ" class="next">Next,Languages</button>
</div>
</form>