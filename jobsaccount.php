<?php
session_start();
 if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
		header('location: register.php?next=' . urlencode($_SERVER['REQUEST_URI']));
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
	
?>
<head>
<meta charset="utf-8">
<meta name="description" content="Online channel for searching and creating jobs, sharing posts and connecting with others">
<meta name="keywords" content="JOBS, IMAGES, POSTS, CONNECT">
<meta name="author" content="jobs search website by  Computer Science">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
	overflow-x: hidden;
}
.side_links{
	
}
.side_links p{
	font-size: 19px;
	font-weight: bold;
	display: block;
}
.side_links a{
	margin-left: 5%;
	text-decoration: none;
	color: black;
	width: 15%;
	display: block;
	margin-top: 1.5%;
	font-family: Arial, Helvetica, sans-serif;
}
.side_links a:hover{
	text-decoration: underline;
}
.add_category {
	display: none;
	position: fixed;
	top: 3%;
	Z-index: 2;
	width: 100%;
	height: 100%;
	background: #555;
	position: fixed;
}
.categ {
	width: 50%;
	height: 100%;
	overflow-y: auto;
	background: white;
	border-radius: 12px;
	box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
	margin: auto;
}
.btn_submit {
	padding: 10px 15%;
	background: green;
	color: white;
	border-radius: 10px;
	margin-bottom: 7%;
}
a:hover{
	cursor: pointer;
	text-decoration: underline;
}
.row {
  display: -ms-flexbox; 
  display: flex;
  -ms-flex-wrap: wrap; 
  flex-wrap: wrap;
  margin: 0 -16px;
}


.col-50 {
  -ms-flex: 50%; 
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%;
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}


@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
}
.alert_fail {
  padding: 20px;
  background-color: #f44336; 
  color: white;
  width: 65%;
  margin-top: 1%;
  margin-bottom: 15px;
}

.alert_succ {
  padding: 20px;
  background-color: green; 
  color: white;
  width: 65%;
  margin-top: 1%;
  margin-bottom: 15px;
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
.lower-categ {
	float: right;
	margin-bottom: 10%;
	margin-top: 0;
	margin-right: 10%;
}
.lower-categ button{
	padding: 20% 50%;
	background: green;
	color: white;
	border-radius: 12px;
	
}
</style>
<script src="script.js"></script>
<script>
function showoption() {
  var x = document.getElementById("mydropdown"); 
  if(x.style.display == "none"){ x.style.display = "block"; }else{ x.style.display = "none"; }
}
function close_alert(x){
	x.style.display='none';
}
</script>
</head>
<body bgcolor="#f1f2f4">
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
      <a href="Jobsaccount.php">Account</a>
    </div>
</div>
<div id="myInput">
<form method="GET" action="search.php">
<input type="text" name="search" placeholder="Search for posts.." value="<?php if(isset($_GET["search"])){ echo $_GET["search"];}?>">
</form>
</div>

</div>
<div style="margin-top: 5%;">
<div>
<div class="side_links">
<p>Billing</p>
<a href="?url=billingpayement">Billing and Payements</a>
<p>User Settings</p>
<a href="?url=membership">Membership & Connects</a>
<a href="?url=contact">Contact info</a>
<a href="?url=profile">My Profile</a>
<a href="?url=getpaid">Get Paid</a>
<a href="?url=connections">Connected Services</a>
<a href="?url=security">Password & Security</a>
<a href="?url=notifications">Notification Settings</a>
</div>
<div style="width: 100%;height: 100%;position: absolute;top: 15%;left: 25%;">
<?php
require_once "database.php";
if(isset($_GET["url"])){
$url = trim($_GET["url"]);	
if($url == "billingpayement"){
	include "billing.php";
}else if($url == "membership"){
	include "membershipconnects.php";
}else if($url == "contact"){
	include "contact.php";
}else if($url == "profile"){
	include "profilesettings.php";
}else if($url == "getpaid"){
	include "getpaid.php";
}else if($url == "connections"){
	include "connections.php";
}else if($url == "security"){
	include "security.php";
}else if($url == "notifications"){
	include "notifications.php";
}
	
}
?>

</div>
</div>
</div>
<div class="add_category" id="categories">
<div class="categ">
<h1>Categories<p style="float: right;margin-top: -0.1%;"><a href="javascript:void(0)" onclick="document.getElementById('categories').style.display='none';" aria-hidden="true">&times</a></p><h1>
<hr/>
<h3>What are the main services you offer to clients?</h3>
<p>Select up to 10 categories.</p><br>
<hr/>
<div class="acc-cons">
<h3>Accounting & Consulting<p id="pointer" style="float: right;transform: rotate(90deg);"><a onclick="expandable(this.parentElement)">></a></p></h3>
<div class="cons_details" id="cons_details">
<input type="checkbox">Accounting & Bookkeeping<br>
<input type="checkbox">Financial Planning<br>
<input type="checkbox">Human Resources<br>
<input type="checkbox">Management Consulting & Analysis<br>
<input type="checkbox">Other - Accounting & Consulting<br>
</div>
</div>
<hr/>
<div class="adm-sup">
<h3>Admin Support<p id="pointer" style="float: right;transform: rotate(90deg);"><a onclick="expandable2(this.parentElement)">></a></p></h3>
<div class="adm-det">
<input type="checkbox">Data Entry & Transcription Services<br>

<input type="checkbox">Market Research & Product Reviews<br>

<input type="checkbox">Project Management<br>

<input type="checkbox">Virtual Assistance<br>
</div>
</div>
<hr/>
<div class="it-net">
<h3>IT & Networking</h3>

<input type="checkbox">Database Management & Administration<br>

<input type="checkbox">DevOps & Solutions Architecture<br>

<input type="checkbox">ERP/CRM Software<br>

<input type="checkbox">Information Security & Compliance<br>

<input type="checkbox">Network & System Administration<br>
</div>
<hr/>
<div class="legal">
<h3>Legal</h3>
<input type="checkbox">Corporate & Contract Law<br>
<input type="checkbox">Finance & Tax Law<br>
<input type="checkbox">International & Immigration Law<br>
<input type="checkbox">Public Law<br>
</div>
<div class="sal-mak">
<h3>Sales & Marketing</h3>
<input type="checkbox">Display Advertising<br>
<input type="checkbox">Email & Marketing Automation<br>
<input type="checkbox">Lead Generation & Telemarketing<br>
<input type="checkbox">Marketing & Brand Strategy<br>
<input type="checkbox">SEO & SEM Services<br>
</div>
<hr/>
<div class="web-soft">
<h3>Web, Mobile & Software Dev</h3>
<input type="checkbox">Desktop Application Development<br>
<input type="checkbox">Ecommerce Development<br>
<input type="checkbox">Game Design & Development<br>
<input type="checkbox">Mobile Development<br>
<input type="checkbox">Other - Software Development<br>
<input type="checkbox">Product Management<br>
<input type="checkbox">QA & Testing<br>
<input type="checkbox">Scripts & Utilities<br>
<input type="checkbox">Web & Mobile Design<br>
<input type="checkbox">Web Development<br>
</div>
<hr/>
<div class="writ">
<h3>Writing</h3>
<input type="checkbox">Content & Copywriting<br>
<input type="checkbox">Creative Writing Services<br>
<input type="checkbox">Editing & Proofreading Services<br>
<input type="checkbox">Grant & Proposal Writing<br>
<input type="checkbox">Other - Writing<br>
<input type="checkbox">Resumes & Cover Letters<br>
<input type="checkbox">Technical Writing<br>
</div>
<div class="lower-categ">
<button type="submit">Submit</button>
</div>
</div>
</div>
<?php include "footer.php"?>
<script>
function showpass(){ var x  = document.getElementById("password");
if(x.type == "password"){ x.type = "text"; }else { x.type="password"; }
}

</script>







