<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
		header('location: register.php?next=' . urlencode($_SERVER['REQUEST_URI']));
		die();
	}
require_once "database.php";
$idn = $_GET["idn"];
$postusername = $_GET['postusernamep'];
$postname = $_GET['postnamep'];
	$sql = 'SELECT * FROM users WHERE id='.$idn.'';
	$retval = $link->query($sql);
	if($retval->num_rows > 0){
		while($row = $retval->fetch_assoc()){
			$dir= $row["profile"];
			$title = $row["title"];
			$about = $row["about"];
			$rate = $row["rate"];
			$phone = $row["phone"];
			$gender = $row["gender"];
			$background = $row["background"];
			$pname = $row["name"];
			$pusername = $row["username"];
			$pemail = $row["email"];
		}
	}

 if(isset($_POST["sendmessage"]))
 {
	 $tousername = trim($_POST["tousername"]);
	 $fromusername = trim($_POST["fromusername"]);
	 $message = trim($_POST["message"]);
	 
	$sql = 'INSERT INTO messages (id, fromusername, tousername, message) values(?, ?, ?, ?)';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_fromusername, $param_tousername, $param_message);
		$param_id = $idn;
		$param_fromusername = $fromusername;
		$param_tousername = $tousername;
		$param_message = $message;
		if(mysqli_stmt_execute($stmt)){
			echo '
			<div class="alert" id="success">
			<span class="closebtn" onclick="closealert()">&times;</span>
			Message Sent
			</div>
			';
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
 }


?>
 <?php
  if(isset($_POST["connect"]))
{
	require_once "database.php";
	$idn = $_GET["idn"];
	$postname = $_GET["postnamep"];
	$postusername = $_GET["postusernamep"];
	$sql = 'SELECT id FROM friends where id = ?';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, 's', $param_id);
			
			$param_id = $_SESSION["id"];
			
			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
			
					$sql0 = 'INSERT INTO friends (id, id_friend, username, name) VALUES(?, ?, ?, ?)';
	
					if($stmtf = mysqli_prepare($link, $sql0))
					{
						mysqli_stmt_bind_param($stmtf, "ssss", $param_id, $param_id_friend, $param_username, $param_name);
						$param_id = $_SESSION["id"];
						$param_id_friend = $idn;
						$param_username = $_SESSION["username"];
						$param_name = $_SESSION["name"];
						
						if(mysqli_stmt_execute($stmtf))
						{
						}else { echo 'error';}
						mysqli_stmt_close($stmtf);
					}
				
				
			}mysqli_stmt_close($stmt);
		}
					
	mysqli_close($link);			
}?>
<?php 
 require_once "database.php"; 

$sql0 = 'SELECT * FROM users where id='.$_SESSION["id"].'';
$result = $link->query($sql0);

while($rows=$result->fetch_assoc())
{
		$mode = 0;
		
		if($rows["mode"] == $mode){
?>
<style>
#body{
	background: white;
	color: black;
}
#menu ,#menu2 , #menu3{
  width: 60px;
  height: 10px;
  background-color: black;
  margin: 6px 0;
}
</style>
<?php	
}else {
?>
<style>
#body{
	background: black;
	color: white;
}
#menu ,#menu2 , #menu3{
  width: 60px;
  height: 10px;
  background-color: white;
  margin: 6px 0;
}
</style>
<?php		       
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
.alert {
  padding: 20px;
  margin: auto;
  background-color: green;
  color: white;
 position: absolute;
 top: 5px;
 text-align: center;
 margin: 0px 0px 0px 500px;
}

.formpopup {
  background: white;
  width: 60%;
  height: 50%;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  margin-left: 25%;
  margin-top: 10%;
}

.formpopup textarea {
  width: 100%;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
.formpopup .cancel {
  background-color: red;
}
</style>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>PROJECT</title>
<style>
.profile{
	float: left;
	position: fixed;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	width: 19%;
	text-align: center;
	top: 10%;
}
.title {
  color: grey;
  font-size: 90%;
}
.msgbtn {
	float: right;
	padding: 10px 14px;
	border-radius: 5px;
}
.msgbtn-cancel {
	float: left;
	padding: 10px 14px;
	background: red;
	border-radius: 5px;
}
.alert {
  padding: 20px;
  margin: auto;
  background-color: green;
  color: white;
 position: absolute;
 top: 5px;
 text-align: center;
 margin: 0px 0px 0px 500px;
}
</style>
<script src="script.js"></script>
<link rel="stylesheet" href="style.css">
<body id="body" style="overflow-x: hidden;">
<?php 
require_once "database.php"; 
$counter = 0;
$msg = $idm = '';
$sql000 = 'SELECT * FROM messages where id='.$_SESSION["id"].' ORDER BY time DESC';
$result000 = $link->query($sql000);

while($rows=$result000->fetch_assoc())
{
		
		$msg = $rows["message"];
		$no = $rows["no"];
		if($rows["is_read"] == 0){ $counter++;}
}
?>
<div class="menunav">
<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<a href="index.php" >HOME</a>
<a href="jobs.php?title=">MyJOBS</a>
<a href="account.php">ACCOUNT</a>
<div class="dropup">
<button class="dropbtn" id="dropbtn" onclick="showoption()">More</button>
<div>
<div id="mydropdown" class="dropup-content">
<a href='userprofile.php'>PROFILE</a>
<a href="message.php?msgn=Select message in the table to preview&non=1">INBOX<p style="width: 27%;text-align: center;float: right;margin-top: -2%;border-radius: 50%;background-color: green;"><?php echo$counter;?></p></a>
<a href="logout.php">LOG OUT</a>
</div>
</div>
</div>
</div>
<span onclick="openNav()">
<div id="menu-mobile" class="fa fa-bars"></div>
</span>
<div class="dropdown">
	<a href="index.php"><button>Home</button></a>
    <button class="dropbtn">MyJobs
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="upload.php">New Job</a>
      <a href="jobs.php?title=">View Jobs</a>
      <a href="jobsaccount.php">Account</a>
    </div>
</div>
<div id="myInput">
<form method="GET" action="search.php">
<input type="text" name="search" placeholder="Search for posts.." value="<?php if(isset($_GET["search"])){ echo $_GET["search"];}?>">
</form>
</div>
</div>
<div class="profile">
  <div style="position: auto;background-color: gray;">
  <img src="<?php echo $dir;?>" alt="Profile photo" height="90px" width="60%" ><br>
  </div>
  <h1><p style="font-size: 70%;text-align: justify;justify-content: center;width: 90%;"><?php echo $postname;?></P></h1><p><?php echo '<a url="#'.$postname.'">@'.$postusername.'</a>';?></p><br><hr/>
  <p class="title">PROFFESSION</p>
<?php
$idn = $_GET["idn"];
$counter = $counter2 = 0;
$confirmed = 1;
$sql0 = 'SELECT * FROM friends where id='. $idn.' ';
$result = $link->query($sql0);
while($rows=$result->fetch_assoc())
{
if($rows["is_confirmed"] == $confirmed){
	$counter++;
}
}
$sql10 = 'SELECT * FROM friends where id_friend='. $idn.' ';
$result2 = $link->query($sql10); 
while($row=$result2->fetch_assoc())
{
if($row["is_confirmed"] == $confirmed){
	$counter2++;
}
}

?> 
  connections:<?php echo $counter + $counter2;?> <br><br>
 
<?php 
	 require_once "database.php"; 
	$counter = 0;
	$idn = $_GET["idn"];
	$check = 'SELECT * FROM friends where id_friend='.$idn.'';
	$rel = $link->query($check);
	$count = mysqli_num_rows($rel);
	if($count == 0){
?>
<form method="POST" action="" enctype="multipart/form-data">
<input type="submit" value="Connect" name="connect" style="width: 90%; height: 60px;"></form>
<?php	
	}else {
		$confirmed = 1;
		$sql0 = 'SELECT * FROM friends where id_friend='.$idn.'';
		$result = $link->query($sql0);
		while($rows=$result->fetch_assoc())
		{
			$sql0 = 'SELECT * FROM friends where id_friend='. $idn.' ';
			$result2 = $link->query($sql0); 
			while($row=$result2->fetch_assoc())
			{
		if($rows["is_confirmed"] || $row["is_confirmed"] == $confirmed){
?>
<input type="button" value="FRIENDS" style="width: 90%; height: 60px;" disabled>
<?php
	}else{
?>
<input type="button" value="REQUEST PENDING" style="width: 90%; height: 60px;" disabled>	
<?php
	}
			}
	}
}
?>
  <br><hr/>
  <a><button style="width: 90%; height: 60px;">About Me</button></a><br>
  <button style="width: 90%; height: 60px;" onclick="history.go(-2)">BACK</button>
</div>
<div style="margin-left: 20%;margin-top: 10%;">
<div class="profile-table">
<h1>Profile</h1>
<img src="<?php echo$dir;?>">
<button class="h-btn" onclick="document.getElementById('message').style.display='block'">Message</button>
<p style="font-weight: bold;font-size: 19px;margin-top: -7%;margin-left: 10%;"><?php echo $pname;?><br><a >@<?php echo $pusername;?></a></p>
<br>
<hr/>
<div class="l-profile">
<p>Video Introduction</p><hr/>
<p>Languages</p>
<?php
$sql = 'SELECT * FROM languages WHERE id='.$idn.'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$language= $row["language"];
		$level = $row["level"];
?>
<p><?php echo $language;?></p>
<span style="margin-left: 7%;font-weight: light;"><?php echo $level;?></span>
<?php
	}
}
?>
<hr/>
<p>Education</p>
<?php
$sql = 'SELECT * FROM education WHERE id='.$idn.'';
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
<h1>Profession</h1>
<span style="font-weight: bold;font-size: 19px;"><?php echo $title;?></span><br>
<?php echo $about;?>
<hr/>
<h1>Skills</h1>
<?php
$sql = 'SELECT * FROM skills WHERE id='.$idn.'';
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
<h1>Testimonials</h1>
<h2>Endorsements from past clients</h2>
<hr/>
</div>
<div class="employement">
<h1>Employment history</h1>
<hr/>
<?php
$sql = 'SELECT * FROM work_experience WHERE id='.$idn.'';
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
<h1>Other Experiences</h1>
<hr/>
</div>
</div>
<div id="message" style="display: none;position: fixed;z-index: 2;top: 0;width: 100%;height: 100%;">
<div class="formpopup">
<a onclick="document.getElementById('message').style.display='none'" style="float: right;zoom: 100%;color: red;cursor: pointer;">&times</a>
<form method="POST">
<h3>Message to <input type="text" value="<?php echo ''.$postusername.'';?>" name="tousername"></h3>
<input type="text" value="<?php echo ''.$_SESSION["username"].'';?>" name="fromusername" style="display: none;">
<textarea placeholder="Type message." name="message" required></textarea>
<button type="submit" name="sendmessage" style="cursor: pointer;" class="msgbtn">Send</button>
<button type="button" class="msgbtn-cancel" onclick="document.getElementById('message').style.display='none'">Cancel</button>
</form>
</div>
</div>
</body>
<script>

</script>