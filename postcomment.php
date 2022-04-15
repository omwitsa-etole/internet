<?
session_start();
 $id = $_SESSION["id"] ;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$comment = trim($_POST["comment"]);
	
	$sql = 'INSERT INTO comments (id, comment) values(?, ?)';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_comment);
		$param_id = $id;
		$param_comment = $comment;
		if(mysqli_stmt_execute($stmt)){
			header('refresh:1;url=post.php?idn='.$id.'&postn='.$_SESSION["postn"].'');
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
	
	mysqli_close($link);
}
?>