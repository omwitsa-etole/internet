<?php
if(!$_SESSION["email"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$id = $_SESSION["id"];
$category = $sub_category = $error = '';
if(isset($_POST["addwork"])){
	if(empty(trim($_POST["category"]))){
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Select Category
			</div>';
	}else{ $category = trim($_POST["category"]); }
	if(empty(trim($_POST["subcategory"]))){
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Select sub category
			</div>';
	}else{ $sub_category = trim($_POST["subcategory"]); }
	if(empty($error)){
		$sql = 'INSERT INTO categories(id, category, sub_category) VALUES(?,?,?)';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_category, $param_sub_category);
			$param_id = $id;
			$param_category = $category;
			$param_sub_category = $sub_category;
			if(mysqli_stmt_execute($stmt)){
				echo '<script>window.location="signup.php?step=9"</script>';
			}else{
				echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Failed to add work category
				</div>';
			}
		}
	}
	
	
}

?>
<style>
.work {
	width: 60%;
	height: 60%;
	font-size: 18px;
	overflow: auto;
}
.work select{
	width: 65%;
	height: 15%;
	margin-top: 3%;
	margin-left: -25%;
}
</style>
<form method="POST">
<center>
<div class="work">
<h1>Tell us about the work you do. What is the main service you offer?</h1><br>
<p>Relevant experience can help your profile stand out. Choose the categories that best describe the type of work you do so we can show you to the right type of clients in search results.</p><br>
<select onchange="allowSub(this.value)" name="category">
<option value="">Select Category</option>
<option value="computer services">Computer Services</option>
<option value="accounting">Accounting</option>
</select><br>
<select id="sub" name="subcategory">
<option>Select sub Category</option>
<option value="Computer Services">Computer Services</option>
</select><br>
</div>
</center>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="addwork" class="next">Next, set your rate</button>
</div>
</form>
<script>
function allowSub(val){
	var x = document.getElementById("sub");
	if(val!=""){
		//x.disabled = false;
	}else{ //x.disabled = true; }
}
</script>