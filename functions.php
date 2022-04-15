<?php 
class MyDB extends SQLite3{
	function __construct()
	{
		$this->open('database.dat');
	}
}

function register(){
	$db = new MyDB;
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	validate($username);
	$sql = <<<EOF
	INSERT INTO users (username, email, password) VALUES($username, $email, $password);
EOF;
	$res = $db->exec($sql);
	if(!$res)
	{
		echo 'failed to create account';
	}else{
		echo 'Account created successfully';
	}
}
function login_validate($username, $password){
	$db = new MyDB;
	$n = <<<EOF
	SELECT username FROM users where username=$username;
EOF;
	$ret0 = $db->exec($n);
	if(!$ret0)
	{
		echo 'user not found';
		
	}else{	
		$pass = <<<EOF
	SELECT password as pass from users where username = $username;
EOF;
		$ret = $db->exec($pass);
		if($ret){
			if($pass != $password)
			{
				echo '<br>User not found<br>';
			}else{
				echo 'successfull authentication';
			}
		}
	}
	
}
function validate($username){
	$db = new MyDB;
	$sql = <<<EOF
	SELECT username from users where username = $username;
EOF;
	$ret = $db->exec($sql);
	if(!$ret)
	{
		return;		
	}else{
		echo 'user already exists';
	}
}
?>