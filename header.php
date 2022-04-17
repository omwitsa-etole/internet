<!DOCTYPE html>
<?php 
session_start();
 if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
		header("location: register.php");
		die();
	}
	 require_once "database.php";
	$name = $_SESSION["name"];
	$username = $_SESSION["username"];
	$id = $_SESSION["id"];
	
	$sql = 'SELECT email, phone, username, birthdate, gender, profile, background, mode FROM users where id ='.$id.'';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
			
			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1)
				{
					mysqli_stmt_bind_result($stmt, $email, $phone, $username,  $birthdate, $gender, $profile, $background, $mode);
					if(mysqli_stmt_fetch($stmt))
					{
					$_SESSION["username"] = $username;
					$_SESSION["email"] = $email;
					$_SESSION["phone"] = $phone;
					$_SESSION["birthdate"] = $birthdate;
					$_SESSION["gender"] = $gender;
					$_SESSION["profile"] = $profile;
					$_SESSION["background"] = $background;
					$_SESSION["mode"] = $mode;
					}
				}
			}
			mysqli_stmt_close($stmt);
		}
		
		function timeAgo($time){
		$time_ago = strtotime($time);
		$cur_time = time();
		$time_elapsed = $cur_time - $time_ago;
		$seconds = $time_elapsed;
		$minutes = round($time_elapsed / 60);
		$hours = round($time_elapsed / 3600);
		$days = round($time_elapsed / 86400);
		$weeks = round($time_elapsed / 604800);
		$months = round($time_elapsed / 2600640);
		$years = round($time_elapsed / 31207680);
		
		if($seconds <= 59){ 
		return 'just now';}
		else if($minutes <= 60){ if($minutes == 1){return 'one minute ago';} else{ return ''.$minutes.' minutes ago';}}
		else if($hours <= 24){ if($hours == 1){return 'an hour ago';} else{ return ''.$hours.' hours ago';}}
		else if($days <= 7){ if($days == 1){return 'yesterday';} else{ return ''.$days.' days ago';}}
		else if($weeks <= 4.3){ if($weeks == 1){return 'a week ago';} else{ return ''.$weeks.' weeks ago';}}
		else if($months <= 12){ if($months == 1){return 'one month ago';} else{ return ''.$months.' months ago';}}
		else{ if($years == 1){return 'one year ago';} else{ return ''.$years.' years ago';}}
	}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Online channel for searching and creating jobs, sharing posts and connecting with others">
<meta name="keywords" content="JOBS, IMAGES, POSTS, CONNECT">
<meta name="author" content="jobs search website by  Computer Science">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>PROJECT</title>
<?php 	
if($_SESSION["mode"] == 0){
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
.profileh {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  min-width: 20%;
  max-width: 25%;
  margin-top: 2.5%;
  position: fixed;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

.profileh button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.profileh a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

.profileh button:hover, a:hover {
  opacity: 0.7;
}
#backtop input{
	display: block;
	transform: rotate(90deg);
	position: fixed;
	bottom: 3%;
	right: 3%;
	border-radius: 50%;
	width: 5%;
	height: 10%;
}
#backtop input title{ color: red;}
#backtop input:hover { background-color: #555;}
.menunav{
	height: 10%;
	width: 100%;
	background: green;
	margin-bottom: 50px;
	border-radius: 8px;
	position: auto;
	z-index: 1;
	top: 0;
	
}
.myj {
	position: absolute;
	margin-left: 30%;
}
.myj a{
	display: block;
	background: white;
	height: 40px;
	text-decoration: none;
}
.myj a:hover{
	background: #ddd;
}
.mainjj:hover .myj{
	display: block;
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

.profileh {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  min-width: 20%;
  max-width: 25%;
  margin-top: 2.5%;
  position: fixed;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

.profileh button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.profileh a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

.profileh button:hover, a:hover {
  opacity: 0.7;
}

#backtop input{
	display: block;
	transform: rotate(90deg);
	position: fixed;
	bottom: 3%;
	right: 3%;
	border-radius: 50%;
	width: 5%;
	height: 10%;
}
#backtop input title{ color: red;}
#backtop input:hover { background-color: #555;}

</style>
<?php		       
}

?>
</head>
<script src="script.js"></script>
<script>
function showoption() {
  var x = document.getElementById("mydropdown"); 
  if(x.style.display == "none"){ x.style.display = "block"; }else{ x.style.display = "none"; }
}
</script>
<body id="body" oncontextmenu="">
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
<a href="javascript:void(0)" onclick="logout()">LOG OUT</a>
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
<div class="profileh">
  <a href="userprofile.php"><img src="avatar.jpg" alt="<?php echo $name;?>" style="width:100%;"></a>
  <h1><?php echo $name;?></h1>
  <p><?php echo '<a url="#'.$name.'">@'.$username.'</a>';?></p>
  <p class="title">Proffession</p>
  <?php
	$counter = 0;
	$counter2 = 0;
	$confirmed = 1;
	$sql0 = 'SELECT * FROM friends where id='.$_SESSION["id"].' ';
	$result = $link->query($sql0);
	while($rows=$result->fetch_assoc())
	{
	if($rows["is_confirmed"] == $confirmed){
		$counter++;
	}
	} 
	$sql10 = 'SELECT * FROM friends where id_friend='. $_SESSION["id"].' ';
	$result2 = $link->query($sql10); 
	while($row=$result2->fetch_assoc())
	{
	if($row["is_confirmed"] == $confirmed){
		$counter2++;
	}
	}
	 ?> 
  <p>Connections: <?php echo $counter + $counter2;?> </p>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a>
  <p><a href="connect.php"><button>Connect</button></a></p>
</div>
  
</div>
<div id="backtop">
<input type="button" value="<<" onclick="backtop()" title="Back top">
</div>

