<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$error = '';
$id = $_SESSION["id"];
if(isset($_POST["check-profile"])){
	if(empty(trim($_POST["country"]))){
		$error = 'error';
		echo '<div class="alert_fail">
		  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
		  Select country
		</div>';
	}else{
		$country = trim($_POST["country"]);
	}if(empty(trim($_POST["city"]))){
		$error = 'error';
		echo '<div class="alert_fail">
		  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
		  Enter city
		</div>';
	}else{
		$city = trim($_POST["city"]);
	}if(empty(trim($_POST["phone"]))){
		$error = 'error';
		echo '<div class="alert_fail">
		  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
		  Enter Phone
		</div>';
	}else{
		$phone = trim($_POST["phone"]);
	}
	if(empty($error)){
		$sql = 'UPDATE users SET phone=?, country=?, city=? WHERE id='.$id.'';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $param_phone, $param_country, $param_city);
			$param_phone = $phone;
			$param_country = $country;
			$param_city = $city;
			if(mysqli_stmt_execute($stmt)){
				echo '<script>window.location="signup.php?step=final"</script>';		
			}else{
				echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Failed try again
				</div>';
			}
			mysqli_stmt_close($stmt);
		}
	}	
	
}
if(isset($_POST["save-profile"])){
	$target_dir = "profile/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$tempname = $_FILES["fileToUpload"]["tmp_name"]; 
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		$sql = 'UPDATE users SET profile=? WHERE id='.$id.'';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_profile);
			$param_profile = $target_file;
			if(mysqli_stmt_execute($stmt)){
				if (move_uploaded_file($tempname, $target_file)){
					echo '<div class="alert_succ">
					  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
					  Profile set
					</div>';
				}else{
					echo '<div class="alert_fail">
					  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
					  Failed to set profile
					</div>';
				}	
			}
			mysqli_stmt_close($stmt);
		}
		 $uploadOk = 1;
	}else{
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Image file not valid
			</div>';
		$uploadOk = 0;
	}
	
}
//<button onclick="document.getElementById('upload').click()" type="button">Select profile image</button><br>
?>
<style>
.set-profile {
	width: 75%;
	height: 70%;
	font-size: 18px;
	overflow: auto;
	margin-left: 15%;
	position: relative;
}
.set {
  display: table-cell; 
  width: 100%;
  height: 100%;
  position: relative;
  overflow: auto; 
  
}
.l {
	float: left;
	left: 0;
	width: 250px;
	height: 300px;
	box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
}
.r {
	width: 350px;
	height: 300px;
	right: 0;
	float: right;

}
.l img{
	border-radius: 50%;
	width: 50%;
	height: 35%;
}
.in1 {
	width: 55%;
}
.in2 {
	width: 30%;
}
.add-photo {
	width: 65%;
	height: 100%;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	background: white;
	margin-left: 15%;
	margin-top: 2%;
	overflow: auto;
}
.add-photo img{
	border-radius: 50%;
	width: 30%;
	height: 35%;
}
.add-photo button{
	width: 35%;
	height: 10%;
	background: white;
	color: green;
	border-radius: 9px;
}
.add-photo button:hover{
	background: #90ee90;
}
.add-photo a:hover{ text-decoration: underline; }

#defaulttext {
	display: flex;
	align-items: center;
	justify-content: center;
	font-weight: bold;
	color: #cccccc;
}
.img-preview {
	display: none;
	width: 30%;
	height: 35%;
	text-align: center;
}
</style>
<form method="POST" enctype="multipart/form-data">
<div class="set-profile">
<h1>A few last details - then you can check and publish your profile.</h1><br>
<p>A professional photo helps you build trust with your clients. To keep things safe and simple, they’ll pay you through us - which is why we need your personal information.</p><br>
<?php
$sql = 'SELECT * FROM users WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$dir= $row["profile"];
	}
}
?>
<div class="set l" id="img">
<?php if($dir == ""){?>
<img src="" alt="image preview" class="img-preview" id="imgpreview"><br>
<span id="defaulttext"><img src="avatar.jpg"></span>
<br>
<?php
}else{
?>
<img src="<?php echo $dir;?>" style="border-radius: 50%;width: 40%;height: 40%;"><br><br>
<?php }?>
<button type="button" onclick="document.getElementById('addphoto').style.display='block'">Upload Photo</button>
</div>
<div class="set r">
Coutry: <br><input class="in1" list="country" name="country" placeholder="Select country">
<datalist id="country">
  <option value="Kenya">
  <option value="Uganda">
  <option value="Tanzania">
  <option value="Ethiopia">
  <option value="Uganda">
  <option value="South Sudan">
</datalist><br>
City<br><input class="in2" name="city" type=""><p style="float: right;margin-top: -7%;">Zip/Postal Code<br><input name="postal" type=""></p><br>
Phone<br><input class="in1" name="phone" type="">
</div>
</div>
<div id="addphoto" style="display: none;position: fixed;z-index: 1;top: 0;overflow: auto;width: 100%;height: 100%;">
<div class="add-photo">
<h1>Add Profile photo<a style="float:right;cursor: pointer;color: red;" onclick="document.getElementById('addphoto').style.display='none'">&times</a></h1><br>
<center>
<div id="img2">
<img src="" alt="image preview" class="img-preview" id="imgpreview2">
<span id="defaulttext2">IMAGE PREVIEW</span>
</div>
</center><br>
<input type="file" name="fileToUpload" id="upload" style="display: none;">
<button onclick="document.getElementById('upload').click()" type="button">Select profile image</button><br>
<p>Your photo should: </p><br>
<ul>
<li>Be a close-up of your face</li>
<li>Show your face clearly - no sunglasses!</li>
<li>Be clear and crisp</li>
<li>Have a neutral background</li>
</ul><br>
<div style="display: inline-block;width: 100%;height: 10%;">
<a style="cursor: pointer;color: green;font-size: 17px;text-decoration: none;" onclick="document.getElementById('addphoto').style.display='none'">cancel</a>
<button type="submit" name="save-profile" style="float: right;padding: 3% 15%;font-size: 18px;margin-top: -1%;cursor: pointer;background: green;border-radius: 9px;color: white;">Save</button>
</div>
</div>
</div>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="check-profile" class="next">Check your Profile</button>
</div>
</form>
<script>
const upload = document.getElementById("upload");
	const upload2 = document.getElementById("upload2");
	const previewbox = document.getElementById("img");
	const previewimage = document.getElementById("imgpreview");
	const previewdefault = document.getElementById("defaulttext");
	const previewbox2 = document.getElementById("img2");
	const previewimage2 = document.getElementById("imgpreview2");
	const previewdefault2 = document.getElementById("defaulttext2");
	
	upload.addEventListener("change", function() {
		const file = this.files[0];
		
		if(file){
			const reader = new FileReader();
			
			previewdefault.style.display = "none";
			previewimage.style.display = "block";
			previewdefault2.style.display = "none";
			previewimage2.style.display = "block";
			
			reader.addEventListener("load", function () {
				previewimage.setAttribute("src", this.result);
				previewimage2.setAttribute("src", this.result);
			});
			reader.readAsDataURL(file);
		}else{
			previewdefault.style.display = null;
			previewimage.style.display = null;
			previewimage.setAttribute("src", "");
			previewdefault2.style.display = null;
			previewimage2.style.display = null;
			previewimage2.setAttribute("src", "");
		}
	});
</script>