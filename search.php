
<?php
include "header.php";
if(isset($_GET["search"]))
{
	$identifier = 0;
	require_once "database.php";
	$keywords = trim($_GET["search"]);
	$query = "SELECT * FROM posts where ";
	$display_words = "";
	$keywords = explode(' ', $keywords);
	foreach($keywords as $word){
	 $query .="CONCAT(username, name, post) LIKE '%".$word."%' or ";
	 $display_words .= $word." ";
	}
	$query = substr($query, 0, strlen($query) - 3);
	
	$query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) > 0)
	{
		echo '<p style="margin-top: -2%;margin-left: 72%;font-size: 100%;"><a href="index.php"><<-home</a></p>';
		while ($row = mysqli_fetch_assoc($query_run))
		{
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
		if($row["filename"] == "")
		{
?>
<div style="margin-top: 5%;">
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
?>
<br>

<?php
	}else{
		echo '<p style="margin-left: 45%;margin-top: -2%;">No results  <a href="index.php">home</a></p><br>';
	}
	
}
include 'footer.php';
?>
</div>