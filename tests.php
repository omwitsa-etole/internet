<?php
	include "functions.php";
	$db = new MyDB;
	$n = <<<EOF
	SELECT * FROM users;
EOF;
	$check = $db->exec($n);
	if(!$check){
		$sql = <<<EOF
		CREATE TABLE users
		(id INT AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(100) NOT NULL,
		email VARCHAR(100) NOT NULL,
		password VARCHAR(100) NOT NULL
		
		);
EOF;
		$res = $db->exec($sql);
		if(!$res){
			echo 'error<br><br>';
		}
	}else{
		$db = new MyDB;
	}
	
	
	if(isset($_POST['register']))
	{
		register();
	}
	if(isset($_POST['login']))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		login_validate($username, $password);
	}
	
?>
<br>SIGNUP
<form method='POST'>
Username<input type="text" name="username"><br>
Email<input type="text" name="email"><br>
Password<input type="password" name="password"><br>
<input type="Submit" name="register">
</form>
LOGIN
<form method='POST'>
Username<input type="text" name="username"><br>
Password<input type="password" name="password"><br>
<input type="Submit" name="login">
</form>
