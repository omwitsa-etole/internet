<?php 
include "header.php";
 require_once "database.php";
 $postusername = $_GET['postusernamep'];
 $postname = $_GET['postnamep'];
 $idn = $_GET["idn"];
    
if(isset($_POST["showprofile"]))
{	session_destroy();
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
						
						session_start();
					$_SESSION["email2"] = $email;
					$_SESSION["phone2"] = $phone;
					$_SESSION["gender2"] = $gender;
					$_SESSION["profile2"] = $profile;
					$_SESSION["background2"] = $background;
					header("url=profile.php");
					}	
				}
				
			}
	mysqli_stmt_close($stmt2);
}
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
<div style="font-size: 15px;margin-left: 20%">View <?php echo $postusername; ?> Profile?</div><br>
<button type="submit" name="sendmessage" name="showprofile">Continue</button>
<button type="button" class="cancel" >Back</button>
</form></td>
</table>
</div>
</body>