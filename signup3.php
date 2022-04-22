<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$sucess = '';
$id = $_SESSION["id"];
if(isset($_POST["add-workexp"])){
	$work_title = trim($_POST["work-title"]);
	$company = trim($_POST["company"]);
	$location = trim($_POST["location"]);
	$country = trim($_POST["country"]);
	$description = trim($_POST["description"]);
	$sql = 'INSERT INTO work_experience(id, work_title, company, location, country, description) VALUES(?,?,?,?,?,?)';
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "ssssss", $param_id, $param_work_title, $param_company, $param_location, $param_country, $param_description);
		$param_id = $id;
		$param_work_title = $work_title;
		$param_company = $company;
		$param_location = $location;
		$param_country = $country;
		$param_description = $description;
		if(!mysqli_stmt_execute($stmt)){
			echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add work experience
			</div>';
		}else{
			$sucess = 'added';
		}
		mysqli_stmt_close($stmt);
	}
}
if(isset($_POST["add-exp"])){
	echo '<script>window.location="signup.php?step=4"</script>';
}

?>
<style>
.add-experience {
	width: 55%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 25%;
	margin-top: 2%;
}
.add-experience select{
	padding: 2% 20%;
}
.add-experience textarea{
	resize: none;
	width: 95%;
	height: 25%;
}

</style>
<form method="POST">
<center>
<div>
<h1>If you have relevant work experience, add it here.</h1><br>
<p>Freelancers who add their experience are twice as likely to win work. 
But if you’re just starting out, you can still create a great profile.<br> 
Just head on to the next page.</p>
<div class="addexp" onclick="document.getElementById('experience').style.display='block'">
<a onclick="document.getElementById('experience').style.display='block'">Add experience</a>
<p><?php echo $sucess; ?></p>
</div>
</div>
</center>
<div id="experience" style="display: none;position: fixed;z-index: 1;top: 0;overflow: auto;width: 100%;height: 100%;">
<div class="add-experience">
<h1>Add workexperience<a style="float:right;cursor: pointer;color: red;" onclick="document.getElementById('experience').style.display='none'">&times</a></h1>
<hr/>
Title: <br><input class="emp-1" type="text" name="work-title" placeholder="Ex:Software Engineer"><br>
Company: <br><input class="emp-1" type="text" name="company" placeholder="Ex:Microsoft"><br>
Location: <br><input class="emp-2" name="location" type="text">
<select name="country">
<option value="">country</option>
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="South Sudan">South Sudan</option>
</select><br>
Period: <br>
<select>
<option>From</option>
<option ></option>
<option></option>
</select>
<select>
<option>To</option>
<option></option>
<option></option>
</select><br>
<input type="checkbox"> I currently work here<br>
Description(optional)<br>
<textarea name="description"></textarea><br>
<span style="margin-top: 5%;"><hr/>
<a onclick="document.getElementById('experience').style.display='none'" style="cursor: pointer;color: green;font-size: 25px;">Cancel</a>
<button class="btn-save" type="submit" name="add-workexp" style="float: right;">SAVE</button></span>
</div>
</div>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="add-exp" class="next">Next, Add Education</button>
</div>
</form>