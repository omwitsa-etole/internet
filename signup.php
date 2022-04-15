<?php 
require_once "database.php";

$success = $email = $password = $confirmpassword = $firstname = $lastname = $name = $gender = $phone = $date = '';
$email_err = $password_err = $p_err =  $phone_err =  $username_err = $fname_err = $gender_err = $date_err = $name_err ='';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty(trim($_POST["firstname"]))){
		$fname_err = "enter firstname";
	}else{ $firstname = trim($_POST["firstname"]);}
	
	if(empty(trim($_POST["lastname"]))){
		$fname_err = "enter lastname";
	}else{ $lastname = trim($_POST["lastname"]);}
	
	if(empty($fname_err)){ $name = ''.$firstname .'	'. $lastname.'';}else{ $name_err = "name error";}
	if(empty(trim($_POST["email"]))){
		$email_err = "enter email";
	}else{ $email = trim($_POST["email"]);}
	
	if(empty(trim($_POST["phone"]))){
		$phone_err = "enter phone";
	}else if(strlen(trim($_POST["phone"])) < 10){ $phone_err = "enter a valid phone"; }
	else if(strlen(trim($_POST["phone"])) > 10){ $phone_err = "enter a valid phone"; }
	else{ $phone = trim($_POST["phone"]); }
	
	if(empty(trim($_POST["date"]))){
		$date_err = "enter birth date";
	}else{ $date = trim($_POST["date"]);}
	
	if(empty(trim($_POST["gender"]))){
		$gender_err = "select gender";
	}else{ $gender = trim($_POST["gender"]);}
	
	if(empty(trim($_POST["username"]))){
		$username_err = "enter username";
	}else{ $username = trim($_POST["username"]);}
	
	if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } else if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	if(empty(trim($_POST["confirmpassword"]))){
        $p_err = "Please confirm password.";     
    } else{
        $confirmpassword = trim($_POST["confirmpassword"]);
        if(empty($password_err) && ($password != $confirmpassword)){
            $p_err = "Password did not match.";
        }
    }
	
	$all_err = $email_err || $p_err || $phone_err || $date_err || $gender_err || $username_err || $name_err;
if(empty($all_err))
{ 
	$sql = "SELECT email, phone, username FROM users WHERE email = ?";
	
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_email);
			$param_email = $email;
			
			if(mysqli_stmt_execute($stmt))
			{
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1)
				{
					mysqli_stmt_bind_result($stmt, $email, $phone, $username);
					if(mysqli_stmt_fetch($stmt))
					{
						if($email == trim($_POST["email"]) || $phone == trim($_POST["phone"]) || $username == trim($_POST["username"])){
							$email_err = "User alredy exists try again";
						}
					}
				}else{
				$sql2 = 'INSERT INTO users (email, name, password, phone, username, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?, ?)';
				
				if($stmt2 = mysqli_prepare($link, $sql2))
				{
					mysqli_stmt_bind_param($stmt2, "sssssss", $param_email, $param_name, $param_password, $param_phone, $param_username, $param_date, $param_gender);
					
					$param_email = $email;
					$param_name = $name;
					$param_password = $password;
					$param_phone = $phone;
					$param_username = $username;
					$param_date = $date;
					$param_gender = $gender;
					
					if(mysqli_stmt_execute($stmt2)){
						$success = "Account Created Successfully <br>Go back to login";
					} else{
						$success = "Something went wrong. Please try again later.";
					}
				}
				mysqli_stmt_close($stmt2);
				}
			}
			mysqli_stmt_close($stmt);
	}
	mysqli_close($link);

}	
}
?>
<head>
<title>Sign up</title>
<META charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
</head>
<body>
<table border="1px" width="100%" height="100%" style="border-collapse: collapse;">
<td>
<center>
<form id="regForm" method="POST" action="" onsubmit="finalpage()">

<h1>Register:</h1>

<div class="tab">Name:
  <p><input type="text" placeholder="First name..." oninput="this.className = ''" name="firstname" required></p>
  <p><input type="text" placeholder="Last name..." oninput="this.className = ''" name="lastname" required></p>
</div>

<div class="tab">Contact Info:
  <p><input type="email" placeholder="E-mail..." oninput="this.className = ''" name="email" required></p>
  <p><input type="text" placeholder="Phone..." oninput="this.className = ''" name="phone" required></p>
</div>

<div class="tab">Personal Details:
  Date of Birth:<p><input type="text" placeholder="dd/mm/yyyy" oninput="this.className = ''" name="date" required></p>
  Gender: <input type="radio" name="gender" value="male">MALE <input type="radio" name="gender" value="female">FEMALE
</div>

<div class="tab">Login Info:
  <p><input type="text" placeholder="Username..." oninput="this.className = ''" name="username" required></p>
  <p><input type="password" id="password" placeholder="Password..." oninput="this.className = ''" name="password" required></p>
  <p><input type="password" placeholder="confirm Password..." oninput="this.className = ''" name="confirmpassword" required></p>
  <div style="float: right; margin: 0px 0px 0px -150px; font-size: 15px;"><input type="checkbox" onchange="showpass()" >show password</div><br><br>
</div>
<div class="tab">
<div class="alert alert-dismissible" role="alert">
  <div class="alert alert-{{ message.tags }}"><?php echo $success; ?></div>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<div style="overflow:auto;">
  <div >
    <button type="button" id="prevBtn" onclick="nextPrev(-1)" style="float:left;padding: 12px 22px; background-color: blue;">Previous</button>
 </div>
 <div >
    <button type="button" id="nextBtn" onclick="nextPrev(1)" style="float:right;padding: 12px 22px; background-color: blue;">Next</button>
 </div>
 
</div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <p style="font-family: arial;font-size: 16px;">Already have an account? <a href="register.php">log in</a></p>
</div>

</form>
</center>
</table>
</td>
</body>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length-1)) {
    document.getElementById("nextBtn").type = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
function showpass(){
	var x = document.getElementById("password");
	if(x.type == "password"){ x.type = "text";}else{x.type = "password";}
}

</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>