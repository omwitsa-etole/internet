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
.newpost {
	width: 60%;
	height: 65%;
	margin: 5% auto;
	box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
	background: white;
	font-size: 17px;
	overflow: auto;
	text-align: justify;
	border-radius: 10px;
}
.newpostl  {
	float: left;
	width: 50%;
}
.newpostr {
	float: right;
	width: 50%;
}
.newpostr textarea{
	height: 250px;
	width: 80%;
	resize: none;
}
</style>
<link rel="stylesheet" href="style.css">
<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div class="posttable" style="width: 100%;height:100%;position: auto;margin-top: 5%;">
<center>
  <table border="1px" width="55%" height="15%" style="border-collapse: collapse;margin-left: 5%;margin-top: 2.5%;">
  <td>
  <a href="userprofile.php"><img src="<?php echo $dir;?>" height="70px" width="10%" style="border-radius: 50%;"></a><a href="upload.php"><input type="button" class="post-btn" value="POST"></a><br>
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
Name:<?php echo ''.$postname.'';?><a href="profile.php?idn=<?php echo $idn;?>&postnamep=<?php echo $postname?>&postusernamep=<?php echo $postusername?>"><?php echo '@'.$postusername.'';?></a><br>
Date: <?php echo $time_elapsed = timeAgo($time);?>
  <a href="javasccript:void(0)" id="dropbtn" onclick="showmenu('menu<?php echo $identifier?>')" style="float: right;margin-top: -2%;">...</a>
	<div class="context-menu" id="context-menu">
	<div class="menu" id="menu<?php echo $identifier?>">
	<a href="javasccript:void(0)" onclick="shareopt('sub<?php echo $no?>')">Share</a>
		<div class="dropdownb" id="sub<?php echo $no?>" >
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
<a id="likes<?php echo $no;?>" class="fa fa-thumbs-up" onclick="likedislike(this.id)"><?php echo $row["likes"];?></a>
<a id="dislike<?php echo $no;?>" class="fa fa-thumbs-down" onclick="likedislike(this.id)"><?php echo $row["dislikes"];?></a>
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
Name:<?php echo ''.$postname.'';?><a href="profile.php?idn=<?php echo $idn;?>&postnamep=<?php echo $postname?>&postusernamep=<?php echo $postusername?>"><?php echo '@'.$postusername.'';?></a><br>
Date: <?php echo $time_elapsed = timeAgo($time);?>
  <a href="javasccript:void(0)" id="dropbtn" onclick="showmenu('menu<?php echo $identifier?>')" style="float: right;margin-top: -2%;">...</a>
	<div class="context-menu" id="context-menu">
	<div class="menu" id="menu<?php echo $identifier;?>">
	<a href="javasccript:void(0)" onclick="shareopt('sub<?php echo $no;?>')">Share</a>
		<div class="dropdownb" id="sub<?php echo $no;?>" >
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
<a id="like" class="fa fa-thumbs-up" onclick="likedislike(this.id)"><?php echo $row["likes"];?></a>
<a id="dislike" class="fa fa-thumbs-down" onclick="likedislike(this.id)"><?php echo $row["dislikes"];?></a>
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
<div id="newpost" style="position: fixed;display: none;z-index: 1;width: 100%;height: 100%;top: 0;">
<div class="newpost">
<a href="javascript:void(0)" style="float: right;zoom: 200%;cursor: pointer;color: red;" onclick="document.getElementById('newpost').style.display='none'">&times;</a>
<div class="newpostl">
<form method="post" action="" enctype="multipart/form-data">
<h1>upload photo<br><input type="file" name="file" id="upload" value=""></h1><br>
<div class="img-preview" id="imgpreview">
<img src="" alt="image preview" class="img-previewimg" style="margin-top: 30%;" id="imgpreviewimg">
<span id="defaulttext">IMAGE PREVIEW</span>
</div>
</div>
<div class="newpostr"><br>
<br>DESCRIBE YOUR POST<br><br><textarea name="post-text" ></textarea><br>
<div style="float: left;"><input type="reset" value="CANCEL" onclick="document.getElementById('newpost').style.display='none'" style="padding: 14px 25px;"></div>
<div style="float: right;margin-right: 15%;"><input type="submit" value="POST" name="post-image" style=" padding: 14px 25px;"></div>
</form>
</div>
</div>
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
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("mysearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("postdatatable");
  tr = table.getElementById("thetable");

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

function likedislike(id){
	document.getElementById(id).innerHTML++;
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

