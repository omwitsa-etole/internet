<?php
session_start();
?>
<style>
.login {
	width: 45%;
	height: 65%;
	margin-left: 25%;
	margin-top: 5%;
	background: white;
	box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
	font-size: 23px;
	font-weight: bold;
	text-align: center;	
}
.login input{
	width: 90%;
	margin-left: 0.5%;
	padding: 3%;
}
.login button{
	width: 65%;
	margin-left: 5%;
	padding: 4%;
	border-radius: 15px;
	background: green;
	color: white;
	margin-top: 10%;
	font-size: 20px;
	font-weight: bold;
	cursor: pointer;
}
.login a{
	margin-left: -10%;
	z-index: 1;
	cursor: pointer;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script>
	  function changeInput(old, newType) {
		  old.type = newType;
	  } 
	  
	function showPassword() {
		if(document.getElementById('password').type == "password"){
			changeInput(document.getElementById('password'), 'text');	
		}else{
			changeInput(document.getElementById('password'), 'password');
		}
	}
</script>
<body>
<div style="color: green;font-size: 18px;font-weight: bold;font-family:Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif ;">
<h3>My Jobs<p style="float: right;margin-top: -0.1%;margin-right: 5%;"><a style="text-decoration: none;font-size: 18px;color: green;cursor: pointer;">Logout</a></p></h3>
</div>
<hr/>
<div class="login">
<p>Name: <?php echo $_SESSION["name"];?></p>
<p>Email: <?php echo $_SESSION["email"];?></p><br>
<input type="password"  id="password" placeholder="password"><a class="fa fa-eye fa-lg" onclick="showPassword()" id="toggle-password"></a><br>
<button>Submit</button>
</div>
</body>