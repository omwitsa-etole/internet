<?php include "header.php";
$success = '';
if(isset($_POST["profile"]))
{
	$filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
    $folder = "profile/".$filename;
        $sql = 'UPDATE users SET profile=? WHERE id='.$_SESSION["id"].'';
  
        if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_filename);
			$param_filename = $filename;
		if(mysqli_stmt_execute($stmt))
		{
        if (move_uploaded_file($tempname, $folder))  {
            
			 echo '<div class="success"><div class="success-content">profile updated successfully
			 <button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="exitdel()">exit</button></div></div>';
			header("refresh: 1;url=userprofile.php");
			
        }else{
            echo "Failed to upload image";
      }
		}
		mysqli_stmt_close($stmt);
		}
}

if(isset($_POST["add-skill"])){	
	if(empty(trim($_POST["skill"]))){
		$error = 'Select skill';
	}else{
		$skill = trim($_POST["skill"]);
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
if(isset($_POST["add-proffession"])){
	$about = trim($_POST["proffession"]);
	$sql = 'UPDATE users SET about=? WHERE id='.$id.'';
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $param_about);
		$param_about = $about;
		if(mysqli_stmt_execute($stmt)){
			echo '<div class="alert_succ">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Added Successfully
			</div>';
		}else{
			echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add proffession
			</div>';
		}
		mysqli_stmt_close($stmt);
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
			echo '<div class="alert_succ">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  work experience added
			</div>';
		}
		mysqli_stmt_close($stmt);
	}
}
if(isset($_POST["add-languages"])){
	if(empty(trim($_POST["language"]))){
		$error = 'Select Language';
	}else{ $language = trim($_POST["language"]); }
	if(empty(trim($_POST["level"]))){
		$error = 'Select Level';
	}else{ $level = trim($_POST["level"]); }
	if(empty($error)){
		$sql = 'INSERT INTO languages(id, language, level) VALUES(?,?,?)';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_language, $param_level);
			$param_id = $id;
			$param_language = $language;
			$param_level = $level;
			if(mysqli_stmt_execute($stmt)){
				echo '<div class="alert_succ">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Language added
				</div>';
			}else{
				echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add language
			</div>';
			}
			mysqli_stmt_close($stmt);
		}
	}
}
?>
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
<style>
.profile-table {
	width: 70%;
	height: 700px;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 10px;
	background: white;
	margin-top: 5%;
	
}
.profile-table img{
	border-radius: 50%;
	width: 10%;
	height: 10%;
}
.h-btn {
	float: right;
	padding: 1.2% 5%;
	background: green;
	color: white;
	border-radius: 9px;
	font-size: 16px;
	cursor: pointer;
}
.h-btn:hover {background: 	#32CD32;}
.l-profile {
	width: 40%;
	box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
	height: 70%;
	font-size: 19px; font-weight: bold;
	float: left;
	overflow: auto;
}
.r-profile {
	width: 60%;
	float: right;
	box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
	height: 70%;
}
.l-profile a{
	margin-left: 1%;
	zoom: 100%;
	float: right;
	cursor: pointer;
}
.r-profile a{
	margin-left:3%;
	zoom: 70%;
	cursor: pointer;
}
.r-profile p{
	display: inline-block;
	margin-left: 2.5%;
	font-weight: bold;
	width: 15%;
	height: 5%;
	border-radius: 8px;
	text-align: center;
	background: #ddd;
	font-size: 17px;
}
.testimonials {
	width: 70%;
	height: 400px;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 10px;
	background: white;
	margin-top: 5%;
}
.employement {
	width: 70%;
	height: 400px;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 10px;
	background: white;
	margin-top: 5%;
}
.employement p{
	font-weight: bold;
	font-size: 18px;
}
.other-det {
	width: 70%;
	height: 300px;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 10px;
	background: white;
	margin-top: 5%;
}
.add-proff {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.add-proff textarea{
	width: 90%;
	height: 35%;
	margin-left: 5%;
}
.btn-save {
	padding: 12px 20px;
	border-radius: 6px;
	background: green;
	color: white;
}
.btn-save:hover {
	background: 	#32CD32;
}
.add-proff a:hover{ text-decoration: underline; }
.add-skill {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.add-skill input[type=text]{
	width: 90%;
	margin-left: 2%;
	padding: 3%;
	position: relative;
}
.skill-opt {
	display: none;
	position: absolute;
	min-height: 50px;
	width: 300px;
	overflow-y: auto;
	background: white;
	border-radius: 5px;
	margin-left: 2%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.skill-opt a{ width: 100%; }
.skill-opt a:hover{cursor:pointer;}
.req-testimonial {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.add-employement {
	width: 55%;
	height: 100%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 5%;
}
.certification {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.certification select{
	padding: 2% 20%;
	margin-left: 2%;
}
.emp-1 {
	padding: 2%;
	width: 90%;
}
.emp-2 {
	padding: 2% 8%;
	margin-right: 2%;
}
.add-employement select{
	padding: 2% 18%;
}
.add-employement textarea{
	resize: none;
	width: 95%;
	height: 150px;
}
.alert_fail {
  padding: 20px;
  background-color: #f44336; 
  color: white;
  width: 55%;
  position: fixed;
  top: 5%;
  left: 25%;
  z-index: 2;
}

.alert_succ {
  padding: 20px;
  background-color: #FFA500; 
  color: white;
  width: 55%;
  position: fixed;
  top: 5%;
  left: 25%;
  z-index: 2;
  
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
.add-language {
	width: 60%;
	height: 65%;
	overflow: auto;
	font-size: 18px;
	background: white;
	margin-left: 25%;
	margin-top: 10%;
	text-align: center;
}
.lang-head {
	width: 100%;
	height: 20%;
	background: #D3D3D3;
	
}
.lang-cont {
	width: 100%;
	height: 50%;
	overflow: auto;
}
.lang-head h5{
	display: inline-block;
	margin-top: 2%;
}
.lang-cont p{
	display: inline-block;
	margin-top: 2%;
}
.lang-cont input{
	width: 65%;
	height: 25%;
}
.datalist {
	max-height: 200px;
	overflow: auto;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="width: 100%;height: 100%;margin-left: 25%;margin-top: 5%;">
<div class="profile-table">
<h1>Profile</h1>
<img src="<?php echo$dir;?>">
<button class="h-btn" onclick="window.location='jobsaccount.php?url=profile'">Profile Settings</button>
<p style="font-weight: bold;font-size: 19px;margin-top: -7%;margin-left: 10%;"><?php echo $_SESSION["name"]?><br>@<?php echo $_SESSION["username"]?></p>
<br>
<hr/>
<div class="l-profile">
<p>Video Introduction<a class="fa fa-plus" style="cursor: pointer;"></a></p><hr/>
<p>Languages<a class="fa fa-plus" onclick="document.getElementById('language').style.display='block'"></a><a class="fa fa-pencil-square-o" aria-hidden="true" style="cursor: pointer;"></a></p>
<?php
$sql = 'SELECT * FROM languages WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$language= $row["language"];
		$level = $row["level"];
?>
<p><?php echo $language;?><a style="float: right;cursor: pointer;" title="delete <?php echo $language;?> language" class="fa fa-trash"></a></p>
<span style="margin-left: 7%;font-weight: light;"><?php echo $level;?></span>
<?php
	}
}
?>
<hr/>
<p>Education<a class="fa fa-plus" style="cursor: pointer;"></a></p>
<?php
$sql = 'SELECT * FROM education WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$degree= $row["degree"];
		$field = $row["field"];
		$description = $row["description"];
?>
<p><?php echo $degree;?>|<?php echo $field;?></p>
<span style="margin-left: 7%;font-weight: light;"><?php echo $description;?></span>
<?php
	}
}
?><br>
</div>
<div class="r-profile">
<h1>Profession<a class="fa fa-edit"></a><a onclick="document.getElementById('addprofile').style.display='block'" class="fa fa-plus" style="float: right;cursor: pointer;"></a></h1>
<span style="font-weight: bold;font-size: 19px;"><?php echo $title;?></span><br>
<?php echo $about;?>
<hr/>
<h1>Skills<a class="fa fa-plus" onclick="document.getElementById('addskill').style.display='block'" style="cursor: pointer;"></a></h1>
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
<hr/>
</div>
</div>
<div class="testimonials">
<h1>Testimonials<p style="float:right;margin-top: -0.5%;"><a onclick="document.getElementById('testimonial').style.display='block'" class="fa fa-plus" style="zoom: 100%;cursor: pointer;"></a></p></h1>
<h2>Endorsements from past clients</h2>
<hr/>
</div>
<div class="employement">
<h1>Employment history<p style="float:right;margin-top: -0.5%;"><a class="fa fa-plus" onclick="document.getElementById('employement').style.display='block'" style="zoom: 100%;cursor: pointer;"></a></p></h1>
<hr/>
<?php
$sql = 'SELECT * FROM work_experience WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$title= $row["work_title"];
		$company = $row["company"];
		$description = $row["description"];
?>
<p><?php echo $title;?>|<?php echo $company;?></p>
<span style="margin-left: 7%;font-weight: light;"><?php echo $description;?></span>
<?php
	}
}
?>
</div>
<div class="other-det">
<h1>Other Experiences<p style="float:right;margin-top: -0.5%;"><a onclick="document.getElementById('certification').style.display='block'" class="fa fa-plus" style="zoom: 100%;cursor: pointer;"></a></p></h1>
<hr/>
</div>
</div>
<form method="POST">
<div id="addprofile" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="add-proff">
<h2>Overview<a style="float: right;cursor: pointer;" onclick="document.getElementById('addprofile').style.display='none'">&times</a></h2>
<hr/>
<h3>Use this space to show clients you have the skills and experience they're looking for.</h3>
<ul>
<li>Describe your strengths and skills</li>
<li>Highlight projects, accomplishments and education</li>
<li>Keep it short and make sure it's error-free</li>
</ul><br>
<textarea name="proffession"></textarea>
<a onclick="document.getElementById('addprofile').style.display='none'" style="color: green;font-size: 25px;cursor: pointer;">Cancel</a>
<span style="float: right;margin-right: 2%;"><button class="btn-save" name="add-proffession" type="submit">SAVE</button></span>
</div>
</div>
</form>
<div id="addskill" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="add-skill">
<h1>Edit skills<a onclick="document.getElementById('addskill').style.display='none'" style="float: right;cursor: pointer;">&times</a></h1>
<hr/><br>
<h3>Skills</h3>
<p>Keeping your skills up to date helps you get the jobs you want.<p>
<form method="POST">
<input type="text" name="skill" id="skill-input" onkeyup="showselect()" >
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
<br>
<span style="margin-top: 5%;"><hr/>
<a onclick="document.getElementById('addskill').style.display='none'" style="color: green;font-size: 25px;">Cancel</a>
<button class="btn-save" type="submit" name="add-skill" style="float: right;">SAVE</button></span>
</form>
</div>
</div>
<div id="testimonial" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="req-testimonial">
<h1>Request a client testimonial<a style="float:right;cursor: pointer;" onclick="document.getElementById('testimonial').style.display='none'">&times</a></h1>
<p>Add your client’s contact details</p>
</div>
</div>
<div id="employement" style="display: none;position: fixed;z-index: 1;top: 0;overflow: auto;width: 100%;height: 100%;">
<div class="add-employement">
<form method="POST">
<h1>Add employement Details<a style="float:right;cursor: pointer;" onclick="document.getElementById('employement').style.display='none'">&times</a></h1>
<hr/>
Company: <br><input class="emp-1" name="company" type="text" placeholder="company"><br>
Location: <br><input class="emp-2" name="location" type="text"><select name="country">
<option>country</option>
<option value="Kenya">Kenya</option>
<option value="Uganda">Uganda</option>
<option value="Tanzania">Tanzania</option>
<option value="Ethopia">Ethopia</option>
<option value="South Sudan">South Sudan</option>
</select><br>
Title: <br>
<input type="text" name="work-title" class="emp-1"><br>
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
<input type="checkbox">I currently work here<br>
Description(optional)<br>
<textarea name="description"></textarea><br>
<span style="margin-top: 5%;"><hr/>
<a onclick="document.getElementById('employement').style.display='none'" style="color: green;font-size: 25px;cursor: pointer;">Cancel</a>
<button class="btn-save" type="submit" name="add-workexp" style="float: right;">SAVE</button></span>
</form>
</div>
</div>
<div id="certification" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="certification">
<h1>Add Certification<a style="float:right;" onclick="document.getElementById('certification').style.display='none'">&times</a></h1>
<hr/>
<select>
<option value="">Select Certification</option>
<option></option>
</select>
<button class="btn-save" style="float: right;margin-top: 5%;">ADD</button>
</div>
</div>
<div id="language" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="add-language">
<form method="POST">
<h1>Add language<a onclick="document.getElementById('language').style.display='none'" style="cursor: pointer;float: right;zoom: 100%;color: red;">&times</a></h1><br><hr/>
<div class="lang-head">
<h5 style="width: 45%;">Language</h5><h5 style="width: 45%;float: right;">Proficiency</h5>
</div>
<div class="lang-cont">
<input name="language" value="English" style="display: none;">
<p style="width: 45%;">English</p>
<p style="width: 45%;float: right;"><input list="level" name="level" placeholder="My level is">
<datalist id="level">
  <option value="Basic">I write clearly in this language</option>
  <option value="Conversational">I write and speak clearly in this language</option>
  <option value="Fluent">I write and speak this language to a high level</option>
  <option value="Native">I write and speak this language perfectly</option>
</datalist></p>
<span id="addlang" style="display: none;">
<hr/>
<p style="width: 45%;"><input list="lang" name="language" placeholder="i know">
<datalist id="lang">
		<option value="Afrikanaas">
		<option value="Danish">
		<option value="German">
		<option value="French">
		<option value="Arabic">
		<option value="Spanish">
		<option value="Swahili">
		<option value="Telugu">
		<option value="Korean">
		<option value="Kudish">
		<option value="Latin">
		<option value="Dutch">
		<option value="Russian">
		<option value="Romanian">
		<option value="Polish">
		<option value="Somali">
		<option value="Chinese">
		<option value="Japanese">
</datalist></p>
<p style="width: 45%;float: right;"><input list="level" name="level" placeholder="My level is">
<datalist id="level">
  <option value="Basic">I write clearly in this language</option>
  <option value="Conversational">I write and speak clearly in this language</option>
  <option value="Fluent">I write and speak this language to a high level</option>
  <option value="Native">I write and speak this language perfectly</option>
</datalist>
<a style="margin-left: 2%;cursor: pointer;" class="fa fa-trash" aria-hidden="true" onclick="document.getElementById('addlang').style.display='none'"></a>
</p>
</span>
</div>
<p><?php echo $success;?></p>
<hr/>
<a class="fa fa-plus" style="cursor: pointer;" onclick="document.getElementById('addlang').style.display='block'">Add language</a><br>
<button type="submit" name="add-languages" class="btn-save" style="float: right;">Save</button><br>
</form>
</div>
</div>
<script>
	const upload = document.getElementById("upload");
	const upload2 = document.getElementById("upload2");
	const previewbox = document.getElementById("imgpreview");
	const previewimage = document.getElementById("imgpreviewimg");
	const previewdefault = document.getElementById("defaulttext");
	
	upload.addEventListener("change", function() {
		const file = this.files[0];
		
		if(file){
			const reader = new FileReader();
			
			previewdefault.style.display = "none";
			previewimage.style.display = "block";
			
			reader.addEventListener("load", function () {
				previewimage.setAttribute("src", this.result);
			});
			reader.readAsDataURL(file);
		}else{
			previewdefault.style.display = null;
			previewimage.style.display = null;
			previewimage.setAttribute("src", "");
		}
	});
	
function change(txt){
	document.getElementById("skill-input").value = txt;
	document.getElementById("opt").style.display = 'none';
}
function showselect(){
	var x = document.getElementById("opt");
	input = document.getElementById("skill-input");
	var filter = input.value.toUpperCase();
	var table = document.getElementById("opt");
	var tr = table.getElementsByTagName("p");
	x.style.display = 'block';
	for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("a")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
		
      }
    }
  }
}
function close_alert(x){
	x.style.display = 'none';
}
</script>
