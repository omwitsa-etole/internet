<div id="postdatatable" style="margin-top: ;">
<?php
require_once "database.php";
 $sql = 'SELECT * FROM posts ORDER BY posts.id DESC ';

$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$post = $row["post"];
		$postname = $row["name"];
		$postusername = $row["username"];
		$postimage = $row["filename"];
		$time = $row["time"];
		$likes = $row["likes"];
		$dislikes = $row["dislikes"];
		$id = $row["id"];
		$no = $row["no"];
 ?>
 <link rel="stylesheet" src="style.css">
 <div  style="margin-left: 18%;">
  <table id="thetable" border="1px" width="78%">
  <td>
  <div class="topnav">
  <div style="float: left;"><?php echo ''.$postname.'';?><a href="viewprofile.php?idn=<?php echo $id;?>&postnamep=<?php echo $postname?>&postusernamep=<?php echo $postusername?>"><?php echo '@'.$postusername.'';?></a></div>
  <div id="min-menu"><a href="javasccript:void(0)" onclick="postmenu()">...</a></div><br>
  </div>
  posted on: <?php echo ''.$time.'';?>
  <hr/>
  <div class="row-data" id="postdata"><?php echo ''.$post.'<br><br><div class="postimage"><img class="imagen" src=imagepost/'.$postimage.' id="postimage"></div>';?><br>
  </div>
  <br><a href="post.php?non=<?php echo $no;?>&idn=<?php echo $id;?>&postn=<?php echo $post;?>&imagen=<?php echo $postimage;?>&uname=<?php echo $postusername?>&liken=<?php echo $likes;?>&disliken=<?php echo $dislikes;?>">
  <input type="button" value="showmore" name="showpost" onclick="posttable()"></a>
  <p style="color: black;float: right;position: relative;bottom: 30px;">likes <?php echo ''.$likes.'';?></p><hr/>
  <div class="bottom-nav"><span style="margin: 0px 0px 0px 30px;"><div class="popup">
  <form method="POST" action="" enctype="multipart/form-data">
  <button type="submit" id="like" name="like" style="background: gray;padding: 11px 16px;border-radius: 13px;" onclick="myFunction(this)" class="fa fa-thumbs-up"></button>
  <button type="submit" id="dislike" name="dislike" style="background: gray;padding: 11px 16px;border-radius: 13px;" onclick="myFunction2(this)" class="fa fa-thumbs-down"></button>
  </div>
  </form>
  <a href="post.php?non=<?php echo $no;?>&idn=<?php echo $id;?>&postn=<?php echo $post;?>&imagen=<?php echo $postimage;?>&uname=<?php echo $postusername?>&liken=<?php echo $likes;?>&disliken=<?php echo $dislikes;?>">
  <button class="btn2">COMMENT</button></a> <button class="btn2" onclick="shareopt()">SHARE</button>
  </span><br>
  
	</td>
  </table>
  </div>
</div>
 
<br>
<?php
}
}
mysqli_close($link);
?>
</div>

  
 