<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="register.php?next=jobsaccount.php?url=profile"</script>';
}
$id = $_SESSION["id"];$error = '';
if(isset($_POST["add-link"])){
	$link_url = trim($_POST["link"]);
	$url = trim($_POST["url"]);
	if($link_url == "facebook"){
		$sql = 'UPDATE users set facebook=? WHERE id='.$id.'';
	}else if($link_url == "linkedin"){
		$sql = 'UPDATE users set linkedin=? WHERE id='.$id.'';
	}else if($link_url == "twitter"){
		$sql = 'UPDATE users set twitter=? WHERE id='.$id.'';
	}else{
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter valid link
			</div>';
	}
	if(empty($error)){
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_url);
			$param_url = $url;
			if(mysqli_stmt_execute($stmt)){
				echo '<div class="alert_succ">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Link added successfully
				</div>';
			}else{
				echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Enter valid link
				</div>';
			}
			mysqli_stmt_close($stmt);
		}
	}
}
?>
<style>
.myProfile{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	text-align: left;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.myProfile select{
	padding: 13px 20%;
	text-align: justify;
	font-size: 14px;
	width: 60%;
}
.preferences{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.experience {
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.categories {
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.linked{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.linked button{
	padding: 2% 15%;
	margin-left: 4%;
	margin-top: 3%;
	border-radius: 10px;
	background: white;
	text-align: center;
	font-size: 17px;
	text-align: justify;
	justift-content: center;
}
.link-acc {
	width: 55%;
	height: 50%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 10%;
	margin-top: 10%;
	font-size: 18px;
}
.link-acc input[type=text]{
	width: 60%;
	margin-left: 2%;
	padding: 3%;
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
</style>
<div>
<h1>Profile Settings</h1>
<div class="myProfile">
<h2>My Profile</h2>
<hr/>
<h4>Visibility</h4>
<select name="profile_privacy">
<option>Public</option>
<option>Private</option>
<option>Friends</option>
</select>
<h4>Project preference </h4>
<select name="preferences">
<option>Short and long term projects</option>
<option>Long term projects(3+ months)</option>
<option>Short term projects(less than 3 months)</option>
</select>
<button type="submit" class="btn_submit" style="float: right;margin-top: 10%;">Submit</button>
</div>
<div class="experience">
<h1>Experience Level</h1>
<hr/>
</div>
<div class="categories">
<h1>Categories<p style="float: right;margin-top: -0.1%;" ><a href="javascript:void(0)" onclick="document.getElementById('categories').style.display='block';" class="fa fa-plus" aria-hidden="true"></a></p></h1>
<hr/>
</div>
<div class="linked">
<h1>Linked accounts</h1>
<hr/><br>
<button class="fa fa-facebook" id="facebook" onclick="linkaccount(this.id)">Facebook</button><button class="fa fa-twitter" id="twitter" onclick="linkaccount(this.id)">Twitter</button><br>
<button class="fa-linkedin" id="linkedin" onclick="linkaccount(this.id)">Linkedin</button><button class="fa fa-git" id="github" onclick="linkaccount(this.id)">Github</button>
</div>
</div>
<div id="linkacc" style="display: none;width: 100%;height: 100%;position: fixed;z-index: 1;top: 0;">
<div class="link-acc">
<form method="POST">
<a style="float: right;cursor: pointer;" onclick="document.getElementById('linkacc').style.display='none'">&times</a>
<h1 id="link-head"></h1><hr/><br>
<input type="text" value="" name="link" id="link" style="display: none;">
Copy Url: <input type="text" name="url" onkeyup="checkInput(this.value)">
<p id="error" style="font-size: 16px;font-weight: bold;margin-left: 7%;"></p>
<span style="margin-top: 10%;"><hr/>
<a onclick="document.getElementById('linkacc').style.display='none'" style="color: green;font-size: 25px;">Cancel</a>
<button class="btn-save" type="submit" name="add-link" style="float: right;">SAVE</button></span>
</form>
</div>
</div>
<script>
function linkaccount(text){
	var x = document.getElementById('linkacc');
	var y = document.getElementById('link-head');
	var z = document.getElementById('link');
	x.style.display='block';
	y.innerHTML = text;
	z.value = text;
}
function showcategory(){
	document.getElementById('categories').style.display='block';
}
function closecategory(){
	document.getElementById('categories').style.display='none';
}
function checkInput(myURL){
	var pattern = /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
	var y = document.getElementById('error');
	if(myURL.match(pattern)){
		y.innerHTML = 'success';
	}else{
		y.innerHTML = 'Invalid url';	
	}
}
</script>