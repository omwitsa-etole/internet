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
#more {display: none;}
.profiletable {
	position: relative;
	z-index: -1;
	margin-top: 10%;
}
.profiletable table{
	border-collapse: collapse;
	width: 65%;
	height: 470px;
	margin-left: 10%;
	padding: 10px 15px;
    box-shadow: 0 1px #999;
}

.user table{
	border-collapse: collapse;
	width: 65%;
	height: 20%;
	margin-left: 20%;
	box-shadow: 0 2px #999;
}

.submit button{
	float: left;
	padding: 12px;
	bottom: 23%;
}
#opt2{
	display: block;
	visibility: visible;
}
.submit input{
	height: 40px;
	min-width: 120px;
}
.submit input:hover{
	background-color: green;
}
.success {
	display: block; 
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.success-content {
	background-color: #ddd;
  margin: 2% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  height: 20%;
  width: 50%; /* Could be more or less, depending on screen size */
}
.tablecont {
	overflow: hidden;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 4;
	text-color: #ddd;
}
#myBtn {
	padding: 9px;
}	
</style>

<div class="profiletable">
<center>
<table border="1px" >
<td>
<img height="20%" src="<?php echo 'profile/'.$_SESSION["background"].'';?>" style="margin: 0px 0px 0px 0px;position:relative;"/>
<div style="padding: 12px 16px;float: right;"><a href="javascript:void(0)" onclick="imgpost()">
<button style="position:relative;padding: 18px 23px;" onclick="imgpost()">change photo</button></a></div>
<hr/>
<a href="javascript:void(0)" onclick="imgpost()"><img src="<?php echo 'profile/'.$_SESSION["profile"].'';?>" height="110px" width="140px" style="position: relative;border-radius: 50%;margin: -60px 0px 0px 20px;"/></a><br><br>
<div style="position: auto;margin: 30px 0px 0px 20px;">
NAME: <?php echo $name;?><br><p>USERNAME: <?php echo '<a href="#'.$name.'">@'.$username.'</a>';?></p><br>Other details: STUDENT AT UNIVERSITY OF ELDORET<br>EXPERIENCE IN PROGRAMMING<br><br>connections: <br>
<div>
<button class="btn2">connect</button><button class="btn2">share</button><button class="btn2" onclick="">more</button>
</div>
</div>
</td> 
</table>
</center>
</div><br>
<div class="user">
<table border="1px">
<td>
<p>ABOUT<p><br><hr/>
<div class="tablecont">about education<span id="dots">...</span>
<span id="more">experience, contact</span></div>
<hr/><center><button onclick="myFunction()" id="myBtn">Read more</button></center>
</td>
</table><br><br>
</div>
<div >
<table border="1px" width="30%" height="80%" id="imgpost" style="position: fixed;margin-top: -20%;border: collapse;margin-left: 40%; display: none;background-color: white;bottom: 5px;z-index: 1;">
<td>
<form method="POST" action="" enctype="multipart/form-data">
<div style="position: absolute;" width="100%"><a style="float: right;" href="javascript:void(0)" onclick="closeimgpost()">&times;</a><br><br>
upload photo<br><input type="file" name="file" id="upload">
<hr/><br>
<div class="img-preview" id="imgpreview">
<img src="" alt="image preview" class="img-previewimg" id="imgpreviewimg">
<span id="defaulttext">IMAGE PREVIEW</span>
</div><br>
<div class="submit"><button onclick="quiz()">POST AS </button><br>
<div>
<input type="submit" name="profile" value="PROFILE">
<input type="submit" name="background" value="BACKGROUND">
</div>
</button></div><br>
</div>
</form>
</td>
</table>
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
