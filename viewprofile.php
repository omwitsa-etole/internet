<?php 
include "header.php";

 require_once "database.php";
 $postusername = $_GET["uname"];
 $postname = $_GET["postname"];
 $idn = $_GET["idn"];
if(isset($_POST["showprofile"]))
{
	header('');
}

?>
 <style>
 .form-popup {
  display: block;
  position: fixed;
  border: collapse;
  z-index: 1;
  background-color: gray;
  border-radius: 22px;
  border: 3px solid #f1f1f1;
  justify-content: center;
  text-align: center;
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  left: 0;
  top: 0;
}
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #white;
}
.form-container {
  width: 60%;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 15px;
  border: none;
  background: #ddd;
  resize: none;
  min-height: 300px;
}
.form-container .cancel {
  background-color: red;
  padding: 19px;
}
.form-container button{
  background-color: green;
  padding: 19px;
  margin-top: ;
  max-width: 30%;
  margin-left: 15%;
}
.form-container img{
	border-radius: 50%;
	margin-left: 5%;
	width: 50%
	height: 20%;
</style> 
<body bgcolor="black">
<div class="form-popup" id="myForm">
<table border="1px" class="form-container">
<td>
<form method="POST" action="" >
<img src="image/avatar.jpg"><br><br>
<p style="font-family: calibri;font-size: 15px;margin-left: 20%">View <?php echo $postusername; ?> Profile?</p><br>
<a href="profile.php?idn=<?php echo $idn;?>&postnamep=<?php echo $postname?>&postusernamep=<?php echo $postusername?>"><button type="button">Continue</button></a>
<button type="button"  onclick="history.back()" class="cancel" >Back</button>
</form></td>
</table>
</div>
</body>