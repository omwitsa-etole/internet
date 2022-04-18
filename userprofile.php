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
.other-det {
	width: 70%;
	height: 300px;
	overflow: auto;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 10px;
	background: white;
	margin-top: 5%;
}
.add-proff {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.add-proff textarea{
	width: 90%;
	height: 35%;
	margin-left: 5%;
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
.add-proff a:hover{ text-decoration: underline; }
.add-skill {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.add-skill input[type=text]{
	width: 90%;
	margin-left: 2%;
	padding: 3%;
	position: relative;
}
.skill-opt {
	display: none;
	position: absolute;
	min-height: 50px;
	width: 300px;
	overflow-y: auto;
	background: white;
	border-radius: 5px;
	margin-left: 2%;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}
.skill-opt a{ width: 100%; }
.skill-opt a:hover{cursor:pointer;}
.req-testimonial {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
.certification {
	width: 55%;
	height: 70%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 8px;
	overflow: auto;
	background: white;
	margin-left: 30%;
	margin-top: 10%;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="width: 100%;height: 100%;margin-left: 25%;margin-top: 5%;">
<div class="profile-table">
<h1>Profile</h1>
<img src="avatar.jpg">
<button class="h-btn" onclick="window.location='jobsaccount.php?url=profile'">Profile Settings</button>
<p style="font-weight: bold;font-size: 19px;margin-top: -7%;margin-left: 10%;"><?php echo $_SESSION["name"]?></p>
<br>
<hr/>
<div class="l-profile">
<p>Video Introduction<a class="fa fa-plus"></a></p><hr/>
<p>Languages<a class="fa fa-plus"></a><a class="fa fa-pencil-square-o" aria-hidden="true"></a></p>
<p>English<br>Swahili<br></p>
<hr/>
<p>Education<a class="fa fa-plus"></a></p>
</div>
<div class="r-profile">
<h1>Profession<a class="fa fa-edit"></a><a onclick="document.getElementById('addprofile').style.display='block'" class="fa fa-plus" style="float: right;cursor: pointer;"></a></h1><br>
<hr/>
<h1>Skills<a class="fa fa-plus" onclick="document.getElementById('addskill').style.display='block'" style=""></a></h1><br>
<p>Your skills display here</p>
<hr/>
</div>
</div>
<div class="testimonials">
<h1>Testimonials<p style="float:right;margin-top: -0.5%;"><a onclick="document.getElementById('testimonial').style.display='block'" class="fa fa-plus" style="zoom: 100%;"></a></p></h1>
<h2>Endorsements from past clients</h2>
<hr/>
</div>
<div class="employement">
<h1>Employment history<p style="float:right;margin-top: -0.5%;"><a class="fa fa-plus" style="zoom: 100%;"></a></p></h1>
<hr/>
<p>Employement details</p>
</div>
<div class="other-det">
<h1>Other Experiences<p style="float:right;margin-top: -0.5%;"><a onclick="document.getElementById('certification').style.display='block'" class="fa fa-plus" style="zoom: 100%;"></a></p></h1>
<hr/>
</div>
</div>
<form method="POST">
<div id="addprofile" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="add-proff">
<h2>Overview<a style="float: right;" onclick="document.getElementById('addprofile').style.display='none'">&times</a></h2>
<hr/>
<h3>Use this space to show clients you have the skills and experience they're looking for.</h3>
<ul>
<li>Describe your strengths and skills</li>
<li>Highlight projects, accomplishments and education</li>
<li>Keep it short and make sure it's error-free</li>
</ul><br>
<textarea name="profession"></textarea>
<a onclick="document.getElementById('addprofile').style.display='none'" style="color: green;font-size: 25px;">Cancel</a>
<span style="float: right;margin-right: 2%;"><button class="btn-save" name="add-proffession" type="submit">SAVE</button></span>
</div>
</div>
</form>
<div id="addskill" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="add-skill">
<h1>Edit skills<a onclick="document.getElementById('addskill').style.display='none'" style="float: right;">&times</a></h1>
<hr/><br>
<h3>Skills</h3>
<p>Keeping your skills up to date helps you get the jobs you want.<p>
<form method="POST">
<input type="text" name="skill" id="skill-input" onkeyup="showselect()" >
<div id="opt" class="skill-opt">
<p><a onclick="change(this.innerHTML)">Ai</a></p>
<p><a onclick="change(this.innerHTML)">Machine learning</a></p>
<p><a onclick="change(this.innerHTML)">Java</a></p>
<p><a onclick="change(this.innerHTML)">Javascript</a></p>
<p><a onclick="change(this.innerHTML)">Php</a></p>
<p><a onclick="change(this.innerHTML)">Python</a></p>
<p><a onclick="change(this.innerHTML)">Css</a></p>
<p><a onclick="change(this.innerHTML)">Sql</a></p>
<p><a onclick="change(this.innerHTML)">Networking</a></p>
<p><a onclick="change(this.innerHTML)">C++</a></p>
<p><a onclick="change(this.innerHTML)">C</a></p>
<p><a onclick="change(this.innerHTML)">C#</a></p>
<p><a onclick="change(this.innerHTML)">C-Net</a></p>
<p><a onclick="change(this.innerHTML)">Django</a></p>
</div>
<br>
<span style="margin-top: 5%;"><hr/>
<a onclick="document.getElementById('addskill').style.display='none'" style="color: green;font-size: 25px;">Cancel</a>
<button class="btn-save" type="submit" name="add-skill" style="float: right;">SAVE</button></span>
</form>
</div>
</div>
<div id="testimonial" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="req-testimonial">
<h1>Request a client testimonial<a style="float:right;" onclick="document.getElementById('testimonial').style.display='none'">&times</a></h1>
<p>Add your client’s contact details</p>
</div>
</div>
<div id="certification" style="display: none;position: fixed;z-index: 1;top: 0;width: 100%;height: 100%;">
<div class="certification">
<h1>Add Certification<a style="float:right;" onclick="document.getElementById('certification').style.display='none'">&times</a></h1>
<hr/>
<select placeholder="Select Certification">
<option value=""></option>
<option></option>
</select>
<button class="btn-save" style="float: right;margin-top: 5%;">ADD</button>
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
</script>
