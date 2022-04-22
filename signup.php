<?php session_start();
require_once "database.php";
?>
<head>
<title>Sign up</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="Jobs, online, posts, comments, hire, freelance, freelancer, images, share, jobprofile">
<meta name="google-signin-client_id" content="75332547705-428c5vr23v4dmlrvd1un82pa099r3q0c.apps.googleusercontent.com">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
.box-1 {
	width: 50%;
	height: 75%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 5%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
	position: fixed;
	z-index: 1;
	left: 25%;
}
.box h1{ margin-top: 3%; }
.check-button{
	width: 33%;
	height: 50%;
	display: inline-block;
	background: white;
	border-radius: 13px;
	margin-top: 5%;
	position: relative;
}
.check-button p{
	position: absolute;
	right: 0;
	top: 0;
}
.box-1 i{
	zoom: 250%;
} 
.sub-btn{
	padding: 2.5% 9%;
	border-radius: 12px;
	background: green;
	color: white;
	margin-top: 3%;
}
.client-form {
    width: 65%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 2%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
}
.client-form input{
	padding: 2% 7%;
	margin-top: 1.5%;
	text-align: left;
	
}
.freelance-form {
    width: 65%;
	height: 90%;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	margin-top: 2%;
	font-size: 17px;
	border-radius: 15px;
	background: white;
}
.freelance-form input{
	padding: 2% 7%;
	margin-top: 1.5%;
	text-align: left;
	
}
.freelance-form h2{ text-align: center;text-shadow: 2px 2px 4px #000000;margin-top: 2%;}
.client-form h2{ text-align: center;text-shadow: 2px 2px 4px rgb(20, 35, 100);margin-top: 2%;}
.btn-opt-apple {
	margin-top: 2%;
	background: white;
	color: black;
	text-align: center;
	padding: 2% 12%;
	border-radius: 15px;
	text-align: justify;
}
.btn-opt-google{
	margin-top: 2%;
	background: #00BFFF;
	color: white;
	text-align: center;
	padding: 2% 12%;
	border-radius: 15px;
	margin-left: 4%;
	text-align: justify;
}
.submit-reg {
	padding: 2% 40%;
	background: green;
	color: white;
	border-radius: 15px;
	margin-top: 3%;
	cursor: pointer;
	margin-bottom: 1%;
}
.client-form a:hover{ text-decoration: underline; }
h2 {
  overflow: hidden;
  text-align: center;
}

h2:before,
h2:after {
  background-color: #000;
  content: "";
  display: inline-block;
  height: 1px;
  position: relative;
  vertical-align: middle;
  width: 50%;
}

h2:before {
  right: 0.5em;
  margin-left: -50%;
}

h2:after {
  left: 0.5em;
  margin-right: -50%;
}
.popuptext {
  display: none;
  position: absolute;
  margin-left: 25%;
  width: 30%;
  text-align: justify;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  position: absolute;
  z-index: 1;
   -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}
.alert_fail {
  padding: 20px;
  background-color: #f44336; 
  color: white;
  width: 65%;
  position: fixed;
  top: 1%;
  left: 15%;
  z-index: 2;
}

.alert_succ {
  padding: 20px;
  background-color: green; 
  color: white;
  width: 65%;
  position: fixed;
  top: 1%;
  left: 15%;
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
.next-back{
	position: fixed;
	bottom: 4%;
	width: 100%;
	height: 15%;
	background: white;
}
.back {
	padding: 1% 5%;
	background: #D3D3D3;
	margin-left: 5%;
	color: black;
	border-radius: 7px;
}
.next {
	padding: 1% 10%;
	background: #228B22;
	float: right;
	margin-right: 5%;
	color: white;
	border-radius: 7px;
}
.addexp {
	width: 40%;
	height: 40%;
	border-radius: 10px;
	font-size: 17px;
	background: white;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	cursor: pointer;
}
.addexp a{ cursor: pointer;margin-top: 5%;font-size: 20px;text-decoration: none; }
.addexp a:hover{ text-decoration: underline; }
.btn-save {
	padding: 12px 20px;
	border-radius: 6px;
	background: green;
	color: white;
}
.emp-1 {
	padding: 2%;
	width: 90%;
	margin-left: 1%;
}
.emp-2 {
	padding: 2% 9%;
	margin-right: 2%;
}
.skill-opt {
	display: none;
	position: absolute;
	min-height: 50px;
	width: 250px;
	z-index: 1;
	overflow-y: auto;
	background: white;
	border-radius: 5px;
	margin-left: 5%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.skill-opt a{ width: 100%; }
.skill-opt a:hover{cursor:pointer;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="overflow-x: hidden;">
<div style="color: green;font-size: 18px;font-weight: bold;font-family:Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif ;">
<h3>My Jobs</h3>
</div>
<hr/>
<?php
if(isset($_GET["step"])){
	$step = trim($_GET["step"]);
	if($step == "1"){
		include "signup1.php";
	}else if($step == "2"){
		include "signup2.php";
	}else if($step == "3"){
		include "signup3.php";
	}else if($step == "4"){
		include "signup4.php";
	}else if($step == "5"){
		include "signup5.php";
	}else if($step == "6"){
		include "signup6.php";
	}else if($step == "7"){
		include "signup7.php";
	}else if($step == "8"){
		include "signup8.php";
	}else if($step == "9"){
		include "signup9.php";
	}else if($step == "10"){
		include "signup10.php";
	}else if($step == "final"){
		include "signup11.php";
	}else if($step == "completed"){
		include "signup12.php";
	}else { include "signup1.php"; }
}
?>
</body>
<script>
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.style.display = 'block';
}
function changecheck(id){
	document.getElementById(id).checked = true;
	document.getElementById("join-option").innerHTML = id;
}
function generateform(text){
	if(text == "client"){
		document.getElementById("clientform").style.display = 'block';
		document.getElementById("box").style.display = 'none';
	}else if(text == "freelancer"){
		document.getElementById("freelanceform").style.display = 'block';
		document.getElementById("box").style.display = 'none';
	}else{
		document.getElementById("box").style.display = 'block';
		document.getElementById("clientform").style.display = 'none';
		document.getElementById("freelanceform").style.display = 'none';
	}
}
function exit(){
	var x = document.getElementById("clientform");
	var y = document.getElementById("freelanceform");
	x.style.display = 'none';
	y.style.display = 'none';				
	document.getElementById("box").style.display = 'block';
}
function uncheck(){
	var x = document.getElementById("submit");
	if(x.disabled == true){ x.disabled = false;}else{ x.disabled = true;}
}
function close_alert(x){
	x.style.display='none';
}
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
<script src="https://apis.google.com/js/platform.js" async defer></script>