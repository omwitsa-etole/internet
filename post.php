<?php 
include "header.php";
	 require_once "database.php";
	 $no = $_GET['non'];
	$post =  $_GET['postn'];
	$postname = $_GET["postname"];
	$postusername = $_GET["uname"];
	$idn = $_GET['idn'];
	$likes = $_GET["liken"];
	$dislikes = $_GET["disliken"];
	
if(isset($_POST["postcomment"]))
{
	$comment = trim($_POST["comment"]);
	
	$sql2 = 'INSERT INTO comments (no, id, username, comment) values(?, ?, ?, ?)';
	if($stmt3 = mysqli_prepare($link, $sql2))
	{
		mysqli_stmt_bind_param($stmt3, "ssss", $param_no, $param_id, $param_username, $param_comment);
		$param_no = $no;
		$param_id = $id;
		$param_username = $_SESSION["username"];
		$param_comment = $comment;
		if(mysqli_stmt_execute($stmt3)){
			header('url=post.php?idn='.$id.'&postn='.$post.'&uname='.$postusername.'');
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt3);
	}
	else{ echo 'SOMETHING WENT WRONG';}
}

if(isset($_POST["like"]))
{
	$likes=trim($_POST["likes"]);
	$sql= 'UPDATE posts SET likes=? WHERE no='.$no.'';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_likes);
	    $param_likes = $likes;
		if(mysqli_stmt_execute($stmt))
		{
			$likes = $likes++;
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
}
if(isset($_POST["dislike"]))
{
	$dislikes=trim($_POST["dislikes"]);
	$sql= 'UPDATE posts SET dislikes=? WHERE no='.$no.'';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_dislikes);
	    $param_dislikes = $dislikes;
		if(mysqli_stmt_execute($stmt))
		{
			$dislikes = $dislikes++;
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
}

?>
<style>
.post table{
	position: auto;
	margin: 6% 0px 0px 240px;
	display: block;
	border-collapse: collapse;
	height: 600px;
	background-color: white;
}
.postcontainer {
  position: absolute;
  border: 2px solid #dedede;
  background-color: white;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  margin-top: 0px;
  margin-right: 400px;
  height: 540px;
  width: 45%;
  display: inline-block;
}
.inputpost {
	max-height: 100%;
    max-width: 60%;
	color: black;
}
.container {
 position: absolute;
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  margin-top: 0px;
  margin-left: 48%;
  height: 540px;
  width: 49%;
  display: inline-block;
}
.comments {
  height: 100%;
  overflow: auto;
}
.time-right {
  float: right;
  margin-top: -3px;
  color: blue;
}
.msg-popup {
  display: none;
  border: collapse; 
  bottom: 5px;
  z-index: 1;
  background-color: gray;
  border-radius: 22px;
  border: 3px solid #f1f1f1;
  justify-content: center;
  text-align: center;
}
.msg-popup textarea {
  width: 90%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
.msgbtn {
	position: relative;
	float: right;
	padding: 10px 14px;
	border-radius: 5px;
	margin-top: -18%;
}
.msgbtn-cancel {
	position: relative;
	float: left;
	padding: 10px 14px;
	background: red;
	border-radius: 5px;
	margin-top: -18%;
}
.lowerbtn {
	position: absolute;
	background: #555;
	width: 51%;
	border-radius: 8px;
	margin-top: 58%;
	float: right;
	margin-left: 48%;
}
.lowerbtn button{
	padding: 5%;
	margin-left: 7%;
	margin-top: 2%;
	cursor: pointer;
	border: none;
}
.lowerbtn button:hover{
	border-radius: 50%;
}

.comm i{
	display: block;
	color: black;
}
.comm { margin-left: 15%; margin-top: -5%;}
.btno { margin-left: 35%;margin-top: -14%;}

</style>

<div class="post">
<table id="post" width="70%" >
<tr border="1px">
<td>
<div style="position: absolute;width: 70%;">
<input type="button" onclick="history.back()" value="x" style="position: relative;color: red;border: none;">
<div class="row-datashow" style="float: left;max-width: 40%;">

</div>
<div style="max-width: 44%;">
<div class="container">
<div class="comments">
<?php 
 require_once "database.php"; 
$counter = 0;
$no = $_GET['non'];
$sql = 'SELECT * FROM comments where no = '.$no.' ORDER BY time DESC ';
$result = $link->query($sql);

while($rows=$result->fetch_assoc())
{
	$counter++;
	$idp = $rows["id"];
	$sql1 = 'SELECT * FROM users where id = '.$idp.'';
	$result1 = $link->query($sql1);
	while($row=$result1->fetch_assoc())
		
{
?>
<div>
<img src="profile/<?php echo $row["profile"];?>" alt="Avatar" style="border-radius: 50%; width: 10%;height:7%;"><p class="comm"><?php echo '<i>'.$row['name'].'</i>';?>
<?php echo '<i>  @'.$rows['username'].'</i>';?></p>
<p style="color: black"><?php echo $rows['comment'];?></p>
<span class="time-right"><?php
	$time = $rows["time"];
	echo $time_elapsed = timeAgo($time);
  ?></span>
</div><br><hr/>
<?php
}
}

echo '<a href="javascript:void(0)" onclick="openForm()">ADD COMMENT<br><br><br><br></a>';
?>
<div class="msg-popup" id="myForm"><form method='POST'>
<textarea placeholder="Type comment." name="comment" required></textarea>
<button type="submit" name="postcomment" class="msgbtn">Send</button>
<button type="button" class="msgbtn-cancel" onclick="closeForm()">Cancel</button>
</form>
</div>
</div>
</div>

<div class="postcontainer">
<div class="inputpost">
<a href="viewprofile.php?idn=<?php echo $idn;?>&postname=<?php echo $postname?>&uname=<?php echo $postusername?>"><?php echo '@'.$_GET["uname"].'';?></a><br>
<?php echo $post;
if($_GET["imagen"] == ""){
?><br>
<?php
}else{
?>
<img src="<?php echo 'imagepost/'.$_GET["imagen"].'';?>" width="100%" height="30%"><br>
<?php
}
?>
</div>
</div>
</div>
<span style="position: absolute;margin-top: 63%;">Likes: <?php echo $likes;?> Dislikes: <?php echo $dislikes;?> Comments: <?php echo $counter;?></span>
<div class="lowerbtn">
<form method="POST" action="" enctype="multipart/form-data">
<button type="submit" name="like" id="like"  onclick="myFunction(this)" class="fa fa-thumbs-up"></button>
<button type="submit" name="dislike" id="dislike" onclick="myFunction2(this)" class="fa fa-thumbs-down"></button>
<input type="text" name="likes" value="<?php echo $likes+1;?>" style="display:none;">
<input type="text" name="dislikes" value="<?php echo $dislikes+1;?>" style="display:none;">
<button type="button" class="fa fa-sms"  onclick="openForm()"></button>
<button type="button" class="fa fa-share"></button>
</form>
</div>
</td>
</tr>
</table>

</div> 
<script>

function openForm() {
  document.getElementById("myForm").style.display = "block";
  e.preventDefault();
}
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
function myFunction() {
	var x = document.getElementById("like");
	if(x.style.color == "black"){
	x.style.color = "red";document.getElementById("dislike").style.color = "black";}else { x.style.color = "black";}
}
function myFunction2() {
	var x = document.getElementById("dislike");
	if(x.style.color == "black"){
	x.style.color = "red";document.getElementById("like").style.color = "black";}else { x.style.color = "black";}
}
</script>
