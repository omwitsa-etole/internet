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
.col-container {
  position: absolute;
  display: table; 
  width: 70%; 
  min-height: 400px;
  margin-left: 25%;
  margin-top: 10%;
  background: white;
  box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
}
.col {
  display: table-cell; 
  width: 100%;
  position: relative;
  overflow: auto; 
  
}
.left {
  left: 0;
  width: 50%;
  min-height: 200px;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
}

.right {
  right: 0;
  width: 50%;
  min-height: 200px;
  overflow: auto;
  box-shadow: rgba(0, 0, 0, 0.06) 0px 2px 4px 0px inset;
}
.centered {
	position: absolute
	top: 0;
}
.lowerbtn {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
}
.upper {
  position: absolute;
  top: 0;
  width: 100%;
  text-align: center;
}
.lowerbtn button{
	margin-left: 2%;
	padding: 3% 7%;
}
@media only screen and (max-width: 600px) {
  .col {
    display: block;
    width: 100%;
  }
  .col-container {
	  margin-top: 15%;
  }
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
  min-height: 100px;
}
.comm{
	margin-top: -10%;
	margin-left: 12%;
}
</style>
<div>
<div class="col-container">
<a onclick="history.go(-1)" style="color: red;float: right;zoom: 200%;">&times</a>
<div class="col left">
  <div class="centered">
  <?php echo $post;
	if($_GET["imagen"] == ""){
	?><br>
	<?php
	}else{
	?>
    <img src="<?php echo 'imagepost/'.$_GET["imagen"].'';?>" width="90%" height="70%">
	<?php }?>
  </div>
<div class="lowerbtn">
<form method="POST" action="" enctype="multipart/form-data">
<?php echo $likes;?><button type="submit" name="like" id="like"  onclick="myFunction(this)" class="fa fa-thumbs-up"></button>
<?php echo $dislikes;?><button type="submit" name="dislike" id="dislike" onclick="myFunction2(this)" class="fa fa-thumbs-down"></button>
<input type="text" name="likes" value="<?php echo $likes+1;?>" style="display:none;">
<input type="text" name="dislikes" value="<?php echo $dislikes+1;?>" style="display:none;">
<button type="button" class="fa fa-envelope"  onclick="openForm()"></button>
</form>
</div>
</div>
<div class="col right">
<div class="upper">
<a href="javascript:void(0)" onclick="openForm()">ADD COMMENT<br></a>
  <div class="msg-popup" id="myForm"><form method='POST'>
<textarea placeholder="Type comment." name="comment" required></textarea>
<button type="submit" name="postcomment" class="msgbtn">Send</button>
<button type="button" class="msgbtn-cancel" onclick="closeForm()">Cancel</button>
</form>
</div>
</div>
<div class="centered">
Comments:<hr/>
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
	while($row=$result1->fetch_assoc()){
		$prof_uri = 'profile.php?idn='.$row["id"].'&postnamep='.$row["name"].'&postusernamep='.$row["username"].'';
?>
<div>
<img src="<?php echo $row["profile"];?>" alt="Avatar" style="border-radius: 50%; width: 10%;height:5%;"><p class="comm"><?php echo '<i>'.$row['name'].'</i>';?>
<a href='<?php echo $prof_uri;?>'><?php echo '<i>  @'.$rows['username'].'</i>';?></a></p>
<p style="margin-left: 2%;margin-top: 5%;"><?php echo $rows['comment'];?></p>
<span style="float: right;"><?php
	$time = $rows["time"];
	echo $time_elapsed = timeAgo($time);
  ?></span>
</div><br><hr/>
<?php
}
}

?>
</div>

</div>
</div>
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
