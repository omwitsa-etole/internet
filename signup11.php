<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
if(isset($_POST["save-data"])){
	echo '<script>window.location="signup.php?step=completed"</script>';
}
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
			echo '<div class="alert_succ">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Education added
			</div>';
		}else{
			echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add education
			</div>';
		}
		mysqli_stmt_close($stmt);
	}
}
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
				echo '<div class="alert_succ">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Skill added success
				</div>';
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
?>
<style>
.preview {
	width: 75%;
	height: 45%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	overflow: auto;
}
.preview button{
	padding: 1% 5%;
	background: green;
	color: white;
	border-radius: 9px;
	cursor: pointer;
}
.preview button:hover{
	background: #006400;
}
.details {
	width: 65%;
	height: 55%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	overflow: auto;
}
.details img{
	border-radius: 50%;
	width: 22%;
	height: 32%;
}
.skills {
	width: 65%;
	height: 30%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	overflow: auto;
}
.skills p{
	display: inline-block;
	margin-left: 1.5%;
	font-weight: bold;
}
.work {
	width: 65%;
	height: 40%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	overflow: auto;
}
.work p{
	font-weight: bold;
}
.education {
	width: 65%;
	height: 50%;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}
.education p{
	font-weight: bold;
	font-size: 17px;
}
.skills-edit{
	width: 65%;
	height: 60%;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	border-radius: 10px;
	margin-top: 5%;
	background: white;
}
.work-edit{
	width: 65%;
	height: 95%;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	border-radius: 10px;
	background: white;
	margin-top: 2%;
}
.education-edit{
	width: 65%;
	height: 95%;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	border-radius: 10px;
	background: white;
}
.education-edit select{
	padding: 2% 20%;
}
.education-edit textarea{
	resize: none;
	width: 95%;
	height: 25%;
}
.skills-edit input{
	width: 90%;
	margin-left: 5%;
	padding: 2%;
	position: relative;
}
.work-edit select{
	padding: 2% 20%;
}
.work-edit textarea{
	resize: none;
	width: 95%;
	height: 25%;
}
</style>
<?php
$sql = 'SELECT * FROM users WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$dir= $row["profile"];
		$name = $row["name"];
		$title = $row["title"];
		$about = $row["about"];
		$rate = $row["rate"];
	}
}
?>
<div style="width: 100%;height: 100%;margin-left: 15%;">
<div class="preview">
<form method="POST">
<h1>Preview Profile</h1><br>
<h3>Looking Good <?php echo $name;?></h3><br>
<p>Make any edits you want, then submit your profile. You can make more changes after it’s live.</p><br>
<button type="submit" name="save-data">Submit Profile</button>
</div><br><br>
<div class="details">
<img src="<?php echo $dir;?>">
<p style="margin-left: 25%;margin-top: -10%;font-weight: bold;"><?php echo $_SESSION["name"];?><br><?php echo $_SESSION["email"];?></p><br>
<div>
<h3><?php echo $title; ?></h3>
<p><?php echo $about; ?></p><br>
<h3><?php echo $rate; ?></h3>
<p>Hourly rate</p> 
</div>
</div><br>
<div class="skills">
<h2>Skills</h2><a class="fa fa-plus" onclick="makeEdit('skills')" style="float: right;zoom: 150%;cursor: pointer;"></a><br><hr/><br>
<?php
$sql = 'SELECT * FROM skills WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$skill= $row["skill"];
?>
<p><?php echo $skill;?></p>
<?php
	}
}
?>
</div><br>
<div class="work">
<h2>Work experience</h2><a class="fa fa-plus" onclick="makeEdit('work')" style="float: right;zoom: 150%;cursor: pointer;"></a><br><hr/><br>
<?php
$sql = 'SELECT * FROM work_experience WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$title= $row["work_title"];
		$company = $row["company"];
?>
<p><?php echo $title?>|<?php echo$company;?>
<?php
	}
}
?>
</div><br>
<div class="education">
<h2>Education history</h2><a class="fa fa-plus" onclick="makeEdit('education')" style="float: right;zoom: 150%;cursor: pointer;"></a><br><hr/><br>
<?php
$sql = 'SELECT * FROM education WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$degree= $row["degree"];
		$field = $row["field"];
?>
<p><?php echo $degree?>|<?php echo $field?></p><br>
<?php
	}
}
?>
</div><br>
<button type="submit" name="save-data" style="margin-left: 45%;padding: 1% 5%;border-radius: 9px;cursor: pointer;background: green;color: white;">Submit Profile</button>
<div id="skills" style="display: none;width: 100%;height: 100%;position: fixed;z-index: 1;top: 0;">
<div class="skills-edit">
<h1>Add skill<a style="float: right;zoom: 100%;cursor: pointer;" onclick="closeEdit('skills')">&times</a></h1><br><hr/>
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
<button type="submit" class="btn-save" name="add-skill" style="float: right;margin-top: 2%;">Save</button>
</div>
</div>
<div id="work" style="display: none;width: 100%;height: 100%;position: fixed;z-index: 1;top: 0;">
<div class="work-edit">
<h1>Add work experience<a style="float: right;zoom: 100%;cursor: pointer;" onclick="closeEdit('work')">&times</a></h1><br><hr/>
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
<div id="education" style="display: none;width: 100%;height: 100%;position: fixed;z-index: 1;top: 0;">
<div class="education-edit">
<h1>Add education<a style="float: right;zoom: 100%;cursor: pointer;color: red;" onclick="closeEdit('education')">&times</a></h1><br><hr/>
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
</form>
</div>
<script>
function makeEdit(id){
	var x = document.getElementById(id);
	x.style.display = 'block';
}
function closeEdit(id){
	var x = document.getElementById(id);
	x.style.display = 'none';
}
</script>