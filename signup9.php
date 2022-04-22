<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
$id = $_SESSION["id"];
if(isset($_POST["set-rate"])){
	if(empty(trim($_POST["rate"]))){
		echo '<div class="alert_fail">
		  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
		  Enter your hourly rate
		</div>';
	}else{
		$rate = trim($_POST["rate"]);
	}
	$sql = 'UPDATE users SET rate=? WHERE id='.$id.'';
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $param_rate);
		$param_rate = $rate;
		if(mysqli_stmt_execute($stmt)){
			echo '<script>window.location="signup.php?step=10"</script>';
		}else{
			echo '<div class="alert_fail">
		  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
		  Enter your hourly rate
		</div>';
		}
		mysqli_stmt_close($stmt);
	}
	
}

?>
<style>
.set-rate{
	width: 75%;
	height: 70%;
	font-size: 18px;
	overflow: auto;
	margin-left: 15%;
}
.set-rate input{
	padding: 1.5% 2.5%;
	float: right;
	margin-top: -2%;
}
</style>
<form method="POST">
<div class="set-rate">
<h1>Now, let’s set your hourly rate.</h1><br>
<p>Clients will see this rate on your profile and in search results once you publish your profile. You can adjust your rate every time you submit a proposal.</p><br>
<h4>Hourly Rate</h4>
<p>Total amount the client will see(/hr)</p>
<input placeholder="0.0" id="amt" name="rate" onkeyup="calc(this.value)"><br>
<hr/><br>
<h4>MyJobs service fee</h4><br>
<p>The Upwork Service Fee is 20% when you begin a contract with a new client. Once you bill over $500 with your client, the fee will be 10%.(/hr)</P>
<input placeholder="0.0" style="border: none;" id="charged" disabled><br><hr/><br>
<h4>You'll receive</h4>
<p>The estimated amount you'll receive after service fees(/hr)</p>
<input placeholder="0.0" id="final"><br><hr/><br>
</div>
<div class="next-back">
<hr/>
<button class="back" onclick="history.go()">Back</button>
<button type="submit" name="set-rate" class="next">Location and Profile</button>
</div>
</form>
<script>
var n = document.getElementById("charged");
var o = document.getElementById("final");
var y = 0.0;
var z = 0.0;
function calc(m){
	if(m<=500){
		y = m/10;
		z = m-y;
	}else{
		y = m/20;
		z = m-y;
	}
	n.value=y;
    o.value=z;
}

</script>