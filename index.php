<?php include "header.php"; 
require_once "database.php";
$post = $postname = $postusername = '';
 $msg = "";
 
 
 
 if(isset($_POST["sendmessage"]))
 {
	 $tousername = trim($_POST["tousername"]);
	 $fromusername = trim($_POST["fromusername"]);
	 $message = trim($_POST["message"]);
	 $idn = trim($_POST["toid"]);
	 
	$sql = 'INSERT INTO messages (id, fromusername, tousername, message) values(?, ?, ?, ?)';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_fromusername, $param_tousername, $param_message);
		$param_id = $idn;
		$param_fromusername = $fromusername;
		$param_tousername = $tousername;
		$param_message = $message;
		if(mysqli_stmt_execute($stmt)){
			echo '
			<div class="alert" id="success">
			<span class="closebtn" onclick="closealert()">&times;</span>
			Message Sent
			</div>
			';
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
 } 
 
if(isset($_POST["post-image"]))
{
	$filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
    $folder = "imagepost/".$filename;
	$post = trim($_POST["post-text"]);
	$likes = "0";
          
  
        // Get all the submitted data from the form
        $sql = 'INSERT INTO posts (id, username, name, filename, post, likes) VALUES (?, ?, ?, ?, ?, ?)';
  
        // Execute query
        if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $param_id, $param_username, $param_name, $param_filename, $param_post, $param_likes);
			$param_id = $_SESSION["id"];
			$param_username = $_SESSION["username"]; 
			$param_name = $_SESSION["name"];
			$param_filename = $filename;
			$param_post = $post;
			$param_likes = $likes;
		if(mysqli_stmt_execute($stmt))
		{
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
			
        }else{
            $msg = "Failed to upload image";
      }
		}
		mysqli_stmt_close($stmt);
		}
}

if(isset($_POST["like"]))
{
	$idn = trim($_POST["id"]);
	$newlikes=trim($_POST["newlikes"]);
	$sql= 'UPDATE posts SET likes=? WHERE id='.$idn.'';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_newlikes);
	    $param_newlikes = $newlikes;
		if(mysqli_stmt_execute($stmt))
		{
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
}
if(isset($_POST["dislike"]))
{
	$idn = trim($_POST["id"]);
	$newdislikes=trim($_POST["newdislikes"]);
	$sql= 'UPDATE posts SET dislikes=? WHERE id='.$idn.'';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_newdislikes);
	    $param_newdislikes = $newdislikes;
		if(mysqli_stmt_execute($stmt))
		{
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
}

if(isset($_POST["posttext"]))
{
	require_once "database.php";
$name = $_SESSION["name"];
$username = $_SESSION["username"];
$id = $_SESSION["id"];

	$post = trim($_POST["post"]);
	
	$sql = 'INSERT INTO posts (id, username, name, post) values(?, ?, ?, ?)';
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_username, $param_name, $param_post);
		$param_id = $id;
		$param_username = $username;
		$param_name = $name;
		$param_post = $post;
		if(mysqli_stmt_execute($stmt)){
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
	
}

if(isset($_POST["accept"]))
{
	$no = trim($_POST["number"]);
	$sql = 'UPDATE friends SET is_confirmed=1 where no='.$no.'';
	
	if($stmt = mysqli_prepare($link, $sql))
	{
		if(mysqli_stmt_execute($stmt)){
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}
	else{ echo 'SOMETHING WENT WRONG';}
}

if(isset($_POST["reject"]))
{
	$no = trim($_POST["number"]);
	$sql = 'DELETE FROM friends WHERE no='.$no.'';
	$execute = $link->query($sql);
}

?>
<style>

</style>
<link rel="stylesheet" href="style.css">
<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div class="posttable" style="width: 100%;height:100%;position: auto;margin-top: 5%;">
<center>
  <table border="1px" width="55%" height="15%" style="border-collapse: collapse;">
  <td>
  <a href="userprofile.php"><img src="<?php echo 'profile/'.$_SESSION["profile"].'';?>" height="70px" width="10%" style="border-radius: 50%;"></a><a href="upload.php"><input type="button" class="post-btn" value="POST"></a><br>
  <div class="post-item">
  <center><button class="btn" onclick="textpost()">TEXT</button>  <button class="btn" onclick="newpost()">PHOTO</button>  <button class="btn" onclick="newpost()">VIDEO</button></center>
  </td>
  </table>
</center>
</div><br>
</div>
<br>
<div style="width: 100%;height: 100%;">
<?php
require_once "database.php";
 $sql = 'SELECT * FROM posts ORDER BY posts.time DESC ';
$identifier = 0;
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$identifier++;
		$post = $row["post"];
		$postname = $row["name"];
		$postusername = $row["username"];
		$postimage = $row["filename"];
		$time = $row["time"];
		$likes = $row["likes"];
		$dislikes = $row["dislikes"];
		$idn = $row["id"];
		$no = $row["no"];
		$dir_url = 'post.php?non='.$no.'&idn='.$idn.'&postn='.$post.'&imagen='.$postimage.'&uname='.$postusername.'&postname='.$postname.'&liken='.$likes.'&disliken='.$dislikes.'';
		if($row["filename"] == "")
		{
 ?>
<div class="post_container">
<div>
Name:<?php echo ''.$postname.'';?><a href="viewprofile.php?idn=<?php echo $idn;?>&postname=<?php echo $postname?>&uname=<?php echo $postusername?>"><?php echo '@'.$postusername.'';?></a><br>
Date: <?php echo $time_elapsed = timeAgo($time);?>
  <a href="javasccript:void(0)" id="dropbtn" onclick="showmenu(<?php echo $identifier?>)" style="float: right;margin-top: -2%;">...</a>
	<div class="context-menu" id="context-menu">
	<div class="menu" id="<?php echo $identifier?>">
	<a href="javasccript:void(0)" onclick="shareopt(<?php echo $no?>)">Share</a>
		<div class="dropdownb" id="<?php echo $no?>" >
		<a href="#" class="fa fa-facebook" style="color: blue;">Facebook</a>
		<a href="#" class="fa fa-instagram" style="padding: 6px;color: red; ">Instagram</a>
		<a href="#" class="fa fa-twitter" style="padding: 6px;color: blue;">Twitter</a>
		<a href="#" class="fa fa-whatsapp" style="padding: 6px;color: green; ">Whatsapp</a>
		<a href="#" class="fa fa-telegram" style="padding: 6px;color: ; ">Telegram</a>
		<a href="#" class="fa-mail-forward" style="padding: 6px;color: ; ">Gmail</a>
		<a href="#" class="fa fa-youtube" style="padding: 6px;color: red; ">YouTube</a>
		</div>
	<a href='<?php echo $dir_url;?>' target="_blank">Open in new tab</a>
	<a href="javasscript:void(0)" onclick="copytext(<?php echo $dir_url?>)"><i>Copy post Url</i></a>
	</div>
	</div>
</div>
<div class="post_container_table" onclick="window.location='<?php echo $dir_url;?>'">
<?php echo ''.$post.'<br>';?>
</div>
<div class="post_container_bottom">
<div class="bottom_nav">
<form method="POST" id="form" name="like-dislike">
<input type="text" name="id" value="<?php echo $idn;?>" style="display: none;">
<input type="text" name="newlikes" value="<?php echo $row["likes"]+1;?>" style="display: none;">
<input type="text" name="newdislikes" value="<?php echo $row["dislikes"]+1;?>" style="display: none;">
<?php echo $row["likes"];?><a id="like" class="fa fa-thumbs-up" onclick="document.getElementById('form').submit();"></a>
<?php echo $row["dislikes"];?><a id="dislike" class="fa fa-thumbs-down" onclick="document.getElementById('form').submit();"></a>
<a class="fa fa-share" onclick="shareopt(<?php echo $no?>)"></a>
</form>
</div>
</div>
</div>
<br>
<?php
}
else
{

?>
 <div class="post_container">
<div>
Name:<?php echo ''.$postname.'';?><a href="viewprofile.php?idn=<?php echo $idn;?>&postname=<?php echo $postname?>&uname=<?php echo $postusername?>"><?php echo '@'.$postusername.'';?></a><br>
Date: <?php echo $time_elapsed = timeAgo($time);?>
  <a href="javasccript:void(0)" id="dropbtn" onclick="showmenu(<?php echo $identifier?>)" style="float: right;margin-top: -2%;">...</a>
	<div class="context-menu" id="context-menu">
	<div class="menu" id="<?php echo $identifier?>">
	<a href="javasccript:void(0)" onclick="shareopt(<?php echo $no?>)">Share</a>
		<div class="dropdownb" id="<?php echo $no?>" >
		<a href="#" class="fa fa-facebook" style="color: blue;">Facebook</a>
		<a href="#" class="fa fa-instagram" style="padding: 6px;color: red; ">Instagram</a>
		<a href="#" class="fa fa-twitter" style="padding: 6px;color: blue;">Twitter</a>
		<a href="#" class="fa fa-whatsapp" style="padding: 6px;color: green; ">Whatsapp</a>
		<a href="#" class="fa fa-telegram" style="padding: 6px;color: ; ">Telegram</a>
		<a href="#" class="fa-mail-forward" style="padding: 6px;color: ; ">Gmail</a>
		<a href="#" class="fa fa-youtube" style="padding: 6px;color: red; ">YouTube</a>
		</div>
	<a href='<?php echo $dir_url;?>' target="_blank">Open in new tab</a>
	<a href="javasscript:void(0)" onclick="copytext(<?php echo $dir_url?>)"><i>Copy post Url</i></a>
	</div>
	</div>
</div>
<div class="post_container_table" onclick="window.location='<?php echo $dir_url;?>'">
<?php echo ''.$post.'<br>';?>
<div class="postimage"><img class="imagen" src="imagepost/<?php echo $postimage;?>" id="postimage"></div>
</div>
<div class="post_container_bottom">
<div class="bottom_nav">
<form method="POST" id="form" name="like-dislike">
<input type="text" name="id" value="<?php echo $idn;?>" style="display: none;">
<input type="text" name="newlikes" value="<?php echo $row["likes"]+1;?>" style="display: none;">
<input type="text" name="newdislikes" value="<?php echo $row["dislikes"]+1;?>" style="display: none;">
<?php echo $row["likes"];?><a id="like" class="fa fa-thumbs-up" onclick="document.getElementById('form').submit();"></a>
<?php echo $row["dislikes"];?><a id="dislike" class="fa fa-thumbs-down" onclick="document.getElementById('form').submit();"></a>
<a class="fa fa-share"></a>
</form>
</div>
</div>
</div>
<br>
<?php		
}
}
}
?>  
</div>
<div>
<div class="form-popup" id="textpost">
<td>
  <form action="" method="POST" class="form-container" enctype="multipart/form-data">
    <textarea placeholder="Type post." name="post" required></textarea>
	<button type="submit" class="btn" name="posttext" style="float: right;">Post</button>
    <button type="button" class="btn cancel" onclick="closeForm()" style="float: left;">Cancel</button>
	</form></div>
</div>
<div>
<table border="1px" width="55%" id="newpost" style="position: fixed;border: collapse;margin-left: 28%; display: none;background-color: white;bottom: 5px;z-index: 1;">
<tr>
<td width="53%" style="">
<div style="position: absolute;margin-top: -5%;">
<a href="javascript:void(0)" style="float: right;" onclick="document.getElementById('newpost').style.display='none'">&times;</a>
<form method="post" action="" enctype="multipart/form-data">
<h1>upload photo<br><input type="file" name="file" id="upload" value=""></h1>
</div><br>
<div class="img-preview" id="imgpreview">
<img src="" alt="image preview" class="img-previewimg" style="margin-top: 30%;" id="imgpreviewimg">
<span id="defaulttext">IMAGE PREVIEW</span>
</div><br>
</td>
<td style="float: left;margin-left: ;">
<div id="nextpost"><br>
<br>DESCRIBE YOUR POST<br><br><div><textarea cols="42" rows="17" name="post-text" ></textarea></div><br>
<div style="float: left;"><input type="reset" value="CANCEL" onclick="document.getElementById('newpost').style.display='none'" style="padding: 14px 25px;"></div>
<div style="float: right;"><input type="submit" value="POST" name="post-image" style=" padding: 14px 25px;"></div>
</form>
</div>
</td>
</table>

</div>

<div style="position: fixed;top: 17%;right: -22.5%;width: 43%;height: 450px;overflow: auto;">
<table border="1px" height="400px" width="50%" style="border-collapse: collapse;position: absolute;overflow: auto;">
<tr><th>REQUESTS</th></tr>
<?php 
 require_once "database.php"; 
$counter = 0;
$check = 'SELECT * FROM friends where id_friend='.$_SESSION["id"].'';
$rel = $link->query($check);
$count = mysqli_num_rows($rel);
if($count == 0){
?>
<td>Friend Requests will show here</td>
<?php
}else {
$confirmed = 0;
$sql0 = 'SELECT * FROM friends where id_friend='.$_SESSION["id"].' ';
$result = $link->query($sql0);
while($rows=$result->fetch_assoc())
{
if($rows["is_confirmed"] == $confirmed){
?>
<tr>
<td>
<div id="requests">
<img src="image/avatar.jpg" alt="profile" style="border-radius: 50%;width: 30%;height: 80px;margin-left:;margin-top:;">
<div id="requestsdata">
<p><?php echo $rows["name"]?></a></p>
<p><?php echo $rows["username"]?></p>
<span id="req-btn">
<form method="POST" action=""><input type="text" name="number" value="<?php echo $rows["no"];?>" style="display: none;">
<button type="submit" name="reject" style="background: red;">Reject</button>
<button type="submit" name="accept" style="background: green;">Accept</button></form></span>
</div>
</div>
</td>	
</tr>
<?php
}
}
}
?>
</table>
</div>
<?php include "footer.php";?>
<script>
	const upload = document.getElementById("upload");
	const upload2 = document.getElementById("upload2");
	const previewbox = document.getElementById("imgpreview");
	const previewimage = document.getElementById("imgpreviewimg");
	const previewdefault = document.getElementById("defaulttext");
	
	upload.addEventListener("change", function() {
		const file = this.files[0];
		
		if(file){
			const reader = new FileReader();
			
			previewdefault.style.display = "none";
			previewimage.style.display = "block";
			
			reader.addEventListener("load", function () {
				previewimage.setAttribute("src", this.result);
			});
			reader.readAsDataURL(file);
		}else{
			previewdefault.style.display = null;
			previewimage.style.display = null;
			previewimage.setAttribute("src", "");
		}
	});
function mysearchFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("mysearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("postdatatable");
  tr = table.getElementById("thetable");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementById("postdata")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function myFunction(x) {
	if(x.style.background == "gray"){
	x.style.background = "red";document.getElementById("dislike").style.background = "gray";}
}
function myFunction2(x) {
	if(x.style.background == "gray"){
	x.style.background = "red";document.getElementById("like").style.background = "gray";}
}	
function likeFunction() {
  var popup = document.getElementById("myPopup");
  if(popup.style.display == "none"){popup.style.display = "block";}
  else{ popup.style.display = "none";}
}
function textpost() {
  document.getElementById("textpost").style.display = "block";document.getElementById("myForm").style.display = "none";
  
}
function openForm() {
  document.getElementById("myForm").style.display = "block";document.getElementById("body").style.background = "#111";
}
function closeForm() {
  document.getElementById("textpost").style.display = "none";
}
function copytext(id)
{
var copyTextarea = id;
copyTextarea.select(); 
document.execCommand("copy");
}

function showmenu(id)
{ 
	var menu = document.getElementById(id);    
	if (menu.style.display == "none"){ 
		menu.style.display = 'block'; 
	}else{   
		menu.style.display = 'none'; 
	} 
}
function shareopt(id)
{ if(document.getElementById(id).style.display == "none")
	{ document.getElementById(id).style.display = "block";}else{ document.getElementById(id).style.display = "none";}
}
function myFunction3()
{
  var x = document.getElementById("msgDropdown");
  if(x.style.display == "none"){x.style.display = "block";}
  else { x.style.display = "none";}
}
function posttable(){ 	document.getElementById("body").style.background = "#111";}
function closemsg() { document.getElementById("alert").style.display="none"; }

</script>
