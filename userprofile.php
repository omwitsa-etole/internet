<?php include "header.php";

if(isset($_POST["profile"]))
{
	$filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
    $folder = "imagepost/".$filename;
          
  
        // Get all the submitted data from the form
        $sql = 'UPDATE users SET profile=? WHERE id='.$_SESSION["id"].'';
  
        // Execute query
        if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_filename);
			$param_filename = $filename;
		if(mysqli_stmt_execute($stmt))
		{
        // Now let's move the uploaded image into the folder: image
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

if(isset($_POST["background"]))
{
	$filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
    $folder = "imagepost/".$filename;
          
  
        // Get all the submitted data from the form
        $sql = 'UPDATE users SET background=? WHERE id='.$_SESSION["id"].'';
  
        // Execute query
        if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_filename);
			$param_filename = $filename;
		if(mysqli_stmt_execute($stmt))
		{
        // Now let's move the uploaded image into the folder: image
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

?>
<style>
.profile-table {
	width: 70%;
	height: 900px;
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
}
.r-profile {
	width: 60%;
	float: right;
	box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
	height: 70%;
}
.l-profile i{
	margin-left: 1%;
	zoom: 150%;
	float: right;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="width: 100%;height: 100%;margin-left: 25%;margin-top: 5%;">
<div class="profile-table">
<h1>Profile</h1>
<img src="avatar.jpg">
<button class="h-btn" onclick="window.location='jobsaccount.php?url=profile'">Profile Settings</button>
<br>
<hr/>
<div class="l-profile">
<p>Languages<i class="fa fa-plus"></i><i class="fa fa-pencil-square-o" aria-hidden="true"></i></p>
<p>English<br>Swahili<br></p>
<hr/>
</div>
<div class="r-profile">
</div>
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
	
function quiz()
{ document.getElementById('opt2').style.visibility='visible';
e.preventDefault();document.location.reload(false);}
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}
function exitdel(){ window.location.href = 'userprofile.php';
}
</script>
