<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
if(isset($_POST["add-lang"])){
	echo '<script>window.location="signup.php?step=6"</script>';
}
$id = $_SESSION["id"];
$error = $success = '';
if(isset($_POST["add-languages"])){
	if(empty(trim($_POST["language"]))){
		$error = 'Select Language';
	}else{ $language = trim($_POST["language"]); }
	if(empty(trim($_POST["level"]))){
		$error = 'Select Level';
	}else{ $level = trim($_POST["level"]); }
	if(empty($error)){
		$sql = 'INSERT INTO languages(id, language, level) VALUES(?,?,?)';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_language, $param_level);
			$param_id = $id;
			$param_language = $language;
			$param_level = $level;
			if(mysqli_stmt_execute($stmt)){
				$success = 'Language added';
			}else{
				echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Failed to add language
			</div>';
			}
			mysqli_stmt_close($stmt);
		}
	}
}
?>
<style>
.add-language {
	width: 60%;
	height: 50%;
	overflow: auto;
	font-size: 18px;
}
.lang-head {
	width: 100%;
	height: 20%;
	background: #D3D3D3;
	
}
.lang-cont {
	width: 100%;
	height: 50%;
	overflow: auto;
}
.lang-head h5{
	display: inline-block;
	margin-top: 2%;
}
.lang-cont p{
	display: inline-block;
	margin-top: 2%;
}
.lang-cont input{
	width: 65%;
	height: 25%;
}
.datalist {
	max-height: 200px;
	overflow: auto;
}
</style>
<form method="POST">
<center>
<div>
<h1>Looking good. Next, tell us which languages you speak.</h1><br>
<p>Upwork is global, so clients are often interested to know what languages you speak. 
English is a must, but do you speak any other languages?</p><br>
<div class="add-language">
<div class="lang-head">
<h5 style="width: 45%;">Language</h5><h5 style="width: 45%;float: right;">Proficiency</h5>
</div>
<div class="lang-cont">
<input name="language" value="English" style="display: none;">
<p style="width: 45%;">English</p>
<p style="width: 45%;float: right;"><input list="level" name="level" placeholder="My level is">
<datalist id="level">
  <option value="Basic">I write clearly in this language</option>
  <option value="Conversational">I write and speak clearly in this language</option>
  <option value="Fluent">I write and speak this language to a high level</option>
  <option value="Native">I write and speak this language perfectly</option>
</datalist></p><br>
<span id="addlang" style="display: none;">
<hr/>
<p style="width: 45%;"><input list="language" name="language" placeholder="I know">
<datalist id="language">
  <option value="Afrikanaas">
  <option value="Danish">
  <option value="German">
  <option value="French">
  <option value="Arabic">
  <option value="Spanish">
  <option value="Swahili">
  <option value="Telugu">
  <option value="Korean">
  <option value="Kudish">
  <option value="Latin">
  <option value="Dutch">
  <option value="Russian">
  <option value="Romanian">
  <option value="Polish">
  <option value="Somali">
  <option value="Chinese">
  <option value="Japanese">
</datalist></p>
<p style="width: 45%;float: right;"><input list="level" name="level" placeholder="My level is">
<datalist id="level">
  <option value="Basic">I write clearly in this language</option>
  <option value="Conversational">I write and speak clearly in this language</option>
  <option value="Fluent">I write and speak this language to a high level</option>
  <option value="Native">I write and speak this language perfectly</option>
</datalist>
<a style="margin-left: 2%;cursor: pointer;" class="fa fa-trash" aria-hidden="true" onclick="document.getElementById('addlang').style.display='none'"></a>
</p>
</span>
</div>
<p><?php echo $success;?></p>
<hr/>
<a class="fa fa-plus" style="cursor: pointer;" onclick="document.getElementById('addlang').style.display='block'">Add language</a><br>
<button type="submit" name="add-languages" class="btn-save" style="float: right;">Save</button><br>
</div>
</div>
</center>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="add-lang" class="next">Now Share your skills</button>
</div>
</form>