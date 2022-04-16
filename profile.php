<?php
session_start();
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
		header("location: register.php");
		die();
	}
require_once "database.php";
$idn = $_GET["idn"];
$postusername = $_GET['postusernamep'];
$postname = $_GET['postnamep'];
 $sql2 = 'SELECT email, phone, gender, profile, background FROM users where id ='.$idn.'';
		
		if($stmt2 = mysqli_prepare($link, $sql2))
		{
			
			if(mysqli_stmt_execute($stmt2))
			{
				mysqli_stmt_store_result($stmt2);
				
				if(mysqli_stmt_num_rows($stmt2) == 1)
				{
					mysqli_stmt_bind_result($stmt2, $email, $phone, $gender, $profile, $background);
					if(mysqli_stmt_fetch($stmt2))
					{
						
					//session_start();
					$_SESSION["email2"] = $email;
					$_SESSION["phone2"] = $phone;
					$_SESSION["gender2"] = $gender;
					$_SESSION["profile2"] = $profile;
					$_SESSION["background2"] = $background;
					}	
				}
				
			}
	mysqli_stmt_close($stmt2);
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
.profiletable table{
	border-collapse: collapse;
	width: 750px;
	height: 470px;
	margin-left: 0%;
	padding: 10px 15px;
    box-shadow: 0 1px #999;
}
.activity table{
	border-collapse: collapse;
	position: auto;
	width: 780px;
	height: 350px;
	padding: 10px 15px;
	margin: 0px 0px 0px -36px;
	box-shadow: 0 2px #999;
}
.experience table{
	border-collapse: collapse;
	position: auto;
	width: 780px;
	height: 450px;
	padding: 10px 15px;
	margin: 0px 0px 0px -36px;
	box-shadow: 0 2px #999;
}
.education table{
	border-collapse: collapse;
	position: auto;
	width: 780px;
	height: 450px;
	margin: 0px 0px 0px -36px;
	box-shadow: 0 2px #999;
}
.skills table{
	border-collapse: collapse;
	position: auto;
	width: 780px;
	height: 450px;
	margin: 0px 0px 0px -36px;
	box-shadow: 0 2px #999;
}
.form-popup {
  display: none;
  position: fixed;
  border: collapse;
  float: right;
  right: 1%;  
  bottom: 5px;
  z-index: 1;
  background-color: gray;
  border-radius: 22px;
  border: 3px solid #f1f1f1;
  justify-content: center;
  text-align: center;
}
.form-container {
  max-width: 200px;
  max-height: ;
  padding: 10px;
  background-color: #white;
}
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
.form-container .cancel {
  background-color: red;
}
</style>
<head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>PROJECT</title>
</head>
<style>
.profile{
	float: left;
	position: fixed;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	width: 200px;
	margin: auto;
	text-align: center;
	margin-top: 5%;
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
<body id="body" style="overflow: auto;">
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
<div class="dropdown">
<img class="dropbtn" id="dropbtn" src="<?php echo 'profile/'.$_SESSION["profile"].'';?>" onclick="showoption()">
<div>
<div id="mydropdown" class="dropdown-content">
<a href='userprofile.php'>PROFILE</a>
<a href="message.php?msgn=Select message in the table to preview&non=1">INBOX<p style="width: 27%;text-align: center;float: right;margin-top: -2%;border-radius: 50%;background-color: green;"><?php echo$counter;?></p></a>
<a href="javascript:void(0)" onclick="logout()">LOG OUT</a>
</div>
</div>
</div>
<div class="menulinks">
<a href="index.php" >HOME</a>
<a href="jobs.php?title=">MyJOBS</a>
<a href="account.php">ACCOUNT</a>
</div>
<div id="myInput">
<form method="GET" action="search.php">
<input type="text" name="search" placeholder="Search for posts.." value="<?php if(isset($_GET["search"])){ echo $_GET["search"];}?>">
</form>
</div>
</div>
<div class="profile">
  <div style="position: auto;margin: 0px 0px 0px 0px; background-color: gray;">
  <img src="<?php echo 'profile/'.$_SESSION["profile2"].'';?>" alt="Profile photo" height="80px" width="100px" ><br>
  </div>
  <h1><p style="font-size: 70%;"><?php echo $postname;?></P></h1><p><?php echo '<a url="#'.$postname.'">@'.$postusername.'</a>';?></p><br><hr/>
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
<input type="submit" value="Connect" name="connect" style="width: 200px; height: 60px;"></form>
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
<input type="button" value="FRIENDS" style="width: 200px; height: 60px;" disabled>
<?php
	}else{
?>
<input type="button" value="REQUEST PENDING" style="width: 200px; height: 60px;" disabled>	
<?php
	}
			}
	}
}
  ?>
  <br><hr/>
  <a><button style="width: 200px; height: 60px;">About Me</button></a><br>
  <button style="width: 200px; height: 60px;" onclick="history.go(-2)">BACK</button>
</div>
<div id="profilemain">
<div class="profiletable">
<center>
<table border="1px" >
<td>
<img height="195px" src="<?php echo 'profile/'.$_SESSION["background2"].'';?>" style="margin: 0px 0px 0px 0px;position:relative;"/>
<hr/>
<img src="<?php echo 'profile/'.$_SESSION["profile2"].'';?>" height="110px" width="140px" style="position: relative;border-radius: 50%;margin: -60px 0px 0px 20px;"/><br><br>
<div style="position: auto;margin: 0px 0px 0px 20px;">
NAME:<?php echo $postname;?><br>username <?php echo '@'.$postusername.'<br>';?><br>Other details:<br><br><br>connections: <br><br>
<div>
<button onclick="composemsg()" style="padding: 15px;float: right;">message</button>
<form method="POST" action="" enctype="multipart/form-data"></form>
</div>
</div>
</td> 
</table>
</center>
</div><br>

<div class="activity">
<center>
<table border="1px" id="activitytable">
<td>
<div class="activitycont" style="position: relative; margin: 0px 0px 0px 10px;">
POSTED JOBS
</div>
<div style="margin-bottom: 0px; position: relative; margin: 350px 0px 0px 0px;">
<div id="showbtn" style="display: block;"><hr/><a href="javascript:void(0)" onclick="showMore()"><center>SEE ALL ACTIVITY</center></a></div>
</div>
</td>
</table>
</center>
</div><br>
<div class="experience">
<center>
<table border="1px" id="exptable">
<td>
<div class="expcont" style="position: relative;top: -200px;">
EXPERIENCE
</div>

</td>
</table>
</center>
</div><br>
<div class="education">
<center>
<table border="1px" id="eductable">
<td>
<div class="expcont" style="position: relative;top: -200px;">
EDUCATION
</div>

</td>
</table>
</center>
</div><br>
<div class="skills">
<center>
<table border="1px" id="skillstable">
<td>
<div class="expcont" style="position: relative;top: -200px;">
SKILLS
</div>

</td>
</table>
</center>
</div>
<div class="form-popup" id="myForm">
<form method="POST" action="" class="form-container">
<h1>Message to <input type="text" value="<?php echo ''.$postusername.'';?>" name="tousername"></h1>
<input type="text" value="<?php echo ''.$_SESSION["username"].'';?>" name="fromusername" style="display: none;">
<textarea placeholder="Type message." name="message" required></textarea>
<button type="submit" name="sendmessage" class="msgbtn">Send</button>
<button type="button" class="msgbtn-cancel" onclick="closemsg()">Cancel</button>
</form>
</div>

</div>
<?php include "footer.php";?>
<script>
function composemsg() {
  document.getElementById("myForm").style.display = "block";
}
function closemsg() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<?include "footer.php":?>