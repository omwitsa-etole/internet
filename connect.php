<?php include "header.php";?>
<style>
#myInput4 {
  background-image: url('/css/searchicon.jpg'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 60%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 170px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 15px; /* Add some space below the input */
  margin-left: 30px;
  margin-top: 10%;
}
#connecttable{
	position: fixed;
	cursor: pointer;
	border-collapse: collapse;	
  display: block; 
  left: 19%;
  top: 5%;
  width: 40%;
  height: 95%;
  overflow: auto; /* Enable scroll if needed */
  background-color: #ddd; /* Fallback color */
  background-color: rgba(0,0,0,0.4);
}
#connectgruptable{
	position: fixed;
	border-collapse: collapse;	
  display: block; 
  right: 0;
  top: 5%;
  width: 40%;
  height: 95%;
  overflow: auto; /* Enable scroll if needed */
  background-color: #ddd; /* Fallback color */
  background-color: rgba(0,0,0,0.4);
}
#details p{
	display: block;
	margin: 5px 0px 0px 20%;
	font-size: 18px;
	color: black;
}
.profilebox {
	background: white; 
	padding: 7.5% 70px;
	border-radius: 8px;
	margin-top: 3%;
	margin-bottom: 3%;
}
</style>
<div class="connect" >
<table id="connecttable">
  <tr>
    <th style=""><input type="text" id="myInput4" onkeyup="searchFunction()" placeholder="Search for names.."></th>
  </tr>
  <?php 
	require_once("database.php");
	
	$sql = 'SELECT * FROM users';
	$users = $link->query($sql);
	
	while($row = $users->fetch_assoc())
	{
?>
	<tr>
	<td onclick="window.location='viewprofile.php?idn=<?php echo $row["id"];?>&postname=<?php echo $row["name"];?>&uname=<?php echo $row["username"];?>'">
	<div class="profilebox">
	<img src="<?php echo 'profile/'.$row["profile"].'';?>" alt="profile" style="border-radius: 50%;width: 30%;height: 80px;margin-left: -15%;margin-top:;">
	<div id="details" style="margin-top: -20%;">
	<p><?php echo ''.$row["name"].'';?></p>
	<p><?php echo '@'.$row["username"].'';?></p>
	<p>Proffession</p>
	</div>
	</div>
	</td>
	</tr><br>
<?php
	}
?>
<br>
</table>
</div>

</table>
</div>
<script>
function showUsers(){ 
document.getElementById("connecttable").style.display = "block";
}
function searchFunction() {
  
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("connecttable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
function searchFunctiongrup() {
  
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("connectgruptable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
