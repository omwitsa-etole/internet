<?php include "header.php";?>
<style>
#tablemessage {
	position: auto;
	margin-left: 22%;
}
	
#myInput3 {
  background-position: 10px 12px; 
  background-repeat: no-repeat; 
  width: 55%; 
  font-size: 16px;
  padding: 12px 20px 12px 40px; 
  border: 1px solid #ddd; 
  margin-bottom: 12px; 
}

#myTable {
  border-collapse: collapse; 
  width: 55%; 
  border: 1px solid #ddd; 
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left; 
  padding: 12px; 
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header {
  background-color: #f1f1f1;
}
#myTable tr:hover { background-color: #d1d1d1;}
#btn-btn {
	width: 40%;
	padding: 10px;
	
}
#msg p{
	margin-left: -60%;
	overflow: hidden;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 2;
	text-color: black;
	
}
#msgread p{
	margin-left: -60%;
	overflow: hidden;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 2;
	text-color: #ddd;
	
}
.container {
 position: fixed;
 margin-left: -10%;
 max-width: 30%;
  border: 2px solid #dedede;
  background-color: white;
  border-radius: 5px;
  padding: 10px;
  width: 95%;
  height: 95%;
  top: 15%;
  display: inline-block;
}
.messages {
	position: auto;
  max-height: 100%;
  overflow: auto;
}
.messages textarea{
	position: fixed;
	bottom: 1%;
	width: 28%;
	right: 2%;
	min-height: 8%;
  padding: 15px;
  border: line;
  resize: none;
}
#msg-menu {
	position: fixed;
	margin-top: -3%;
	float: left;
	background: black;
	width: 20px;
	height: 5px;
}
#mmenu { width: 70px;display:none; margin-top: -10%; position: absolute;}
#mmenu a{
	margin-top: -20%;
	color: black;
	font-size: 14px;
	display: block;
	border: 1px;
	text-align: center;
	height: 40px;
	background-color: white;
}
#mmenu a:hover{ color: red; background: gray;}
</style>
<div id="tablemessage">
<input type="text" id="myInput3" onkeyup="myFunction()" placeholder="Search for names..">

<table id="myTable">
  <tr class="header">
    <th style="width:40%;">Username</th>
    <th style="width:30%;">Message</th>
  </tr>
 <?php 
 require_once "database.php"; 
$counter = 0;
$msg = $idm = '';
$sql0 = 'SELECT * FROM messages where id='.$_SESSION["id"].' ORDER BY time DESC ';
$result = $link->query($sql0);

while($rows=$result->fetch_assoc())
{
	$counter++;
	$no = $rows["no"];
	$time = $rows["time"];
	if($rows["is_read"] == 0)
	{
?> 
  <tr style="background-color: #ddd;"><p style="color: black;">
    <td><?php echo ''.$counter.'.  ';?><?php echo '<a href="message.php?non='.$no.'&msgn='.$rows["message"].'"><input type="submit" id="btn-btn" name="showmessage" value="'.$rows["fromusername"].'"></a>';?></td>
    <td><?php echo '<div id="msg"><p>'.$rows["message"].'</p></div>';?>
	<p><?php
	echo $time_elapsed = timeAgo($time);
	?></p>
	</td></p>
  </tr>
<?php 
	}else{
?>
  <tr style="background-color: ;"><p style="color: black;">
	<td><?php echo ''.$counter.'.  ';?><?php echo '<a href="?non='.$no.'&msgn='.$rows["message"].'"><input type="submit" id="btn-btn" name="showmessage" value="'.$rows["fromusername"].'"></a>';?></td>
    <td><?php echo '<div id="msgread"><p>'.$rows["message"].'</p></div>';?>
	<p style="float: right; bottom: 2px;"><?php
	echo $time_elapsed = timeAgo($time);
	?></p>
	</td></p>
  </tr>
<?php
	}
}
?>
</table>
<div >
<table border="1px" height="70%" width="30%" style="border-collapse: collapse;float: right;margin-top: -25%;">
<td>

<div class="container">
<center><h1 style="margin-top:5%;padding: 15px;background-color: gray;">INBOX
<div onclick="document.getElementById('mmenu').style.display='block'">
<div id="msg-menu"></div>
<div id="msg-menu"></div>
<div id="msg-menu"></div>
</div></h1></center>
<div id="mmenu">
<a href="javascript:void(0)">inbox</a>
<a href="javascript:void(0)">sent</a>
<a href="javascript:void(0)">draft</a>
</div>
<div class="messages">
<?php 
 require_once "database.php"; 
	$msg = $_GET["msgn"];
	 $no = $_GET["non"];
	 $is_read = 1;
	 
	 $sql0 = 'UPDATE messages SET is_read=? where no='.$no.'';
	 if($stmt = mysqli_prepare($link, $sql0))
	{
		mysqli_stmt_bind_param($stmt, "s", $param_is_read);
	    $param_is_read = $is_read;
		if(mysqli_stmt_execute($stmt))
		{
		}else{ echo 'SOMETHING WENT WRONG';}
		mysqli_stmt_close($stmt);
	}else{ echo 'WRONG';}
 
?> 
<div style="float: left;display: block; margin-top: 2%; position: auto;padding: 12px 40px;max-width: 60%;background-color: #f1f1f1;border-radius: 12px;"><?php echo $msg;?></div>
<br>
<span style="float: right;display: block; position: auto;margin-top: 2%;padding: 12px 40px;max-width: 60%;background-color: gray;border-radius: 12px;"><?php echo $msg;?></span>
<?php 

?>
<br>
<form method="POST">
<textarea placeholder="reply" name="messagerep"></textarea>
</form>
</div>
</div>
</td>
</table>
</div>
</div>
<?php include "footer.php";?>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
</script>
