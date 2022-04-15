<?php 
session_start();
	if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
		header("location: register.php");
		die();
	}
require_once "database.php";
$post = '';
$name = $_SESSION["name"];
$username = $_SESSION["username"];
$id = $_SESSION["id"];

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$post = trim($_POST["post"]);
	
	$sql = 'INSERT INTO posts (id, username, name, post) values(?, ?, ?, ?)';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_name, $param_post);
		$param_id = $id;
		$param_username = $username;
		$param_name = $name;
		$param_post = $post;
		if(mysqli_stmt_execute($stmt)){
			header("refresh:1;url=index.php");
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
	mysqli_close($link);
}
?>