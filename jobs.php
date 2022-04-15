<?php include "header.php";

if(isset($_POST["take"]))
{
	$job_id = trim($_POST["job_id"]);
	$title = trim($_POST["title"]);
	
	$username = $_SESSION["username"];
	$sql0 = 'UPDATE jobs SET taken=1 WHERE no=?';
		
		if($stmt0 = mysqli_prepare($link, $sql0))
		{
			mysqli_stmt_bind_param($stmt0, "s", $param_job);
			
			$param_job = $job_id;
			if(mysqli_stmt_execute($stmt0))
			{
				$sql1 = 'INSERT INTO jobs_taken (job_id, id, title) VALUES(?, ?, ?)';
				
				if($stmt = mysqli_prepare($link, $sql1))
				{
					mysqli_stmt_bind_param($stmt, "sss", $param_job_id, $param_id, $param_title);
					$param_job_id = $job_id;
					$param_id = $id;
					$param_title = $title;
					
					if(mysqli_stmt_execute($stmt))
					{
						
					}else{ echo 'failed';}
					mysqli_stmt_close($stmt);
				}
			}
			mysqli_stmt_close($stmt0);
		}
}

if(isset($_POST["remove"]))
{
	$job_id = trim($_POST["job_id"]);
	$sql0 = 'UPDATE jobs SET taken=0 WHERE no=?';
		
	if($stmt0 = mysqli_prepare($link, $sql0))
	{
		mysqli_stmt_bind_param($stmt0, "s", $param_job);
		
		$param_job = $job_id;
		if(mysqli_stmt_execute($stmt0))
		{
		$sql = 'DELETE FROM jobs_taken WHERE job_id='.$job_id.'';
		 $execute = $link->query($sql);
		 if (!$execute) {
			 echo 'failed';
			} else {
				header("url=jobs.php?title=");
			}
		}
	}
	
}

?>
<style>
#myInput2 {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 55%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
  margin-left: 20%;
  margin-top: 5%;
}

#myTable {
position: absolute;
display: block;
height: 60%;
overflow: auto;
margin-left: 20%;
border-collapse: collapse; 
width: 55%; 
border: 1px solid #ddd; 
font-size: 18px;
  
}

#myTable th, #myTable td {
  text-align: left; 
  padding: 17px; 
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}
#jobs tr:hover{
	background-color: #f1f1f1;
}
#jobs td{
	text-align: left;
	width: 10%;
	cursor: pointer;
	height: 10%;
}
#jobs tr{
	 border-bottom: 1px solid #ddd;
	 	min-width: 50px;
}
#jobs{
	position: fixed;
	display: block;
	height: 50%;
	overflow: auto;
	margin-top: 2%;
	border-collapse: collapse;
	right: 0;
}
#jobsdata{
	padding: 1% 130px;
	text-align: left;
	border-radius: 8px;
	margin-top: 3%;
	margin-bottom: 3%;
}
#jobtable-main {
		padding: 1%;
}
#showjob table{
	position: fixed;
	border-collapse: collapse;
	top: 25%;
	background: #ddd;
	left: 40%;
}
</style>
<div>
<input type="text" id="myInput2" onkeyup="myFunction()" placeholder="Search for job titles..">
<table id="myTable">
  <tr class="header">
    <th style="width:35%;color: black;">Title</th>
    <th style="width:25%;color: black;">Major Group</th>
	<th style="width:5%;color: black;">Amount</th>
	<th style="width:5%;color: black;"></th>
  </tr>
  <?php 
   require_once "database.php";
 $sql = 'SELECT * FROM jobs ORDER BY jobs.time DESC ';
	$taken = 0;
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		if($row["taken"] == $taken){
  ?>
  <tr>
  <form method="POST" action="" enctype="multipart/form-data">
    <td><?php echo $row["title"];?><input type="text" name="job_id" value="<?php echo $row["no"];?>" style="display: none;"></td>
    <td><?php echo $row["major"];?> <input type="text" name="title" value="<?php echo $row["title"];?>" style="display: none;"></td>
	<td><?php echo $row["amount"];?></td>
	<td><button type="submit" name="take" style="width: 70px;">Take</button></td>
	</form>
  </tr>
  <?php
		}else{
?>
<?php
		}
	}
}
  ?>
  
</table>
</div>
<button style="position: fixed;right: 1%;top: 12%;padding: 1.5% 6%;" onclick="openleftnav()">MORE</button><br>
  <div>
  <table border="1px" width="25%" id="jobs">
  <tr><th>Your Jobs</th></tr>
  <?php 
   require_once "database.php";
   $id = $_SESSION["id"];
 $sql00 = 'SELECT * FROM jobs_taken';

$retval00 = $link->query($sql00);
if($retval00->num_rows > 0){
	while($rowj = $retval00->fetch_assoc()){
		$job_no = $rowj["job_id"];
  ?>
  <tr>
 <td onclick="window.location='jobs.php?index=<?php echo$job_no;?>&title=<?php echo $rowj["title"];?>'">
  <?php echo $rowj["title"];?>
  <input type="text" name='job_id' id="job_id" value="<?php echo $job_no?>" style="display: none;">
  <input type="text" name='job_title' id="job_title" value="<?php echo $rowj["title"]?>" style="display: none;">
  <form method="POST" action="" >
  <div id="remove">
   <input type="text" name="job_id" id="job_id" value="<?php echo $job_no?>" style="display: none;">
  <input type="submit" value="remove" name="remove" style="float: right;background: red;">
  </div>
  </form>
  </td>
  </tr>
  <?php 
	}
}else {
  ?>
   <tr>
  <td>
  YOU DO NOT HAVE ANY JOBS
  </td>
  </tr>
<?php }?>
   
  </table>
  </div>
<table border="1px" width="200px" style="background: gray;position: fixed;bottom: 2%;border-collapse: collapse;">
  <td>
  <center>
  <div style="position: auto;">
  Having trouble?<hr/><br>
  </div>
  <p><a href="mailto:omwitsabradone@gmail.com">CONTACT US</a></P><br><br>
  </center>
  </td>
  </table>
<div id="myleftnav" class="leftnav">
<center>
  <a href="javascript:void(0)" class="closebtn" style="right: 10%;"onclick="closeleftnav()">&times;</a>
  <a href="index.php" >
  <table border="1px" style="border-collapse: collapse; width: 190px; height: 250px;margin: 0px 0px 0px -20px;">
  <td>
  <p style="margin: -70px 0px 0px 0px;"> online at the moment<hr/></p>
  post<br>online<br>users<br>here<br>
  </td>
  </table>
  </a><hr/><br>
  <table border="1px" style="border-collapse: collapse; width: 190px; height: 290px;">
  <td>
  <p style="margin: -120px 0px 0px 0px;">LATEST TRENDING<hr><p>
  </td>
  </table>
  </center>
</div>

<?php 
   require_once "database.php";
 if($_GET["title"] != "")
 {
	 $job_no = $_GET["index"];
 $sql00 = 'SELECT * FROM jobs WHERE no='.$job_no.'';

$retval00 = $link->query($sql00);
if($retval00->num_rows > 0){
	while($row = $retval00->fetch_assoc()){
		
  ?>
 <div id="showjob" style="display: ;">
<table border="1px" width="40%" height="50%">
<tr style="margin-top: -5%;"><th>JOB DETAILS<input type="button" value="x" onclick="document.getElementById('showjob').style.display='none'" style="float: right; color: red;"></th></tr>
<tr>
<td>
<div style="text-align: center;width: 100%;background: white;height: 80%;"><p style="position: relative;font-size: 16px;"><?php echo$row["title"];?></p></div>
</td>
</tr>
<tr>
<td width="60%" height="70%">
<p style="position: relative;margin-top: -15%;">
MAJOR GROUP: <?php echo $row["major"];?><br>
MINOR GROUP: <?php echo $row["minor"];?><br>
SUB GROUP: <?php echo $row["sub"];?><br>
AMOUNT: <?php echo $row["amount"];?><br><br>
DESCRIPTION: <span><?php echo $row["description"];?></span><br>
<?php 
if($row["files"] != ""){
?>
download supporting documents <a href="/class/jobdocs/<?php echo$row["files"]?>" target="_blank"> file(s)</a>
<?php
}
?>
</p>
</td>
</tr>
</table>
</div>
<?php 
	}
}
}
?>

<?php include "footer.php";?>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // search with loop and hide those who don't match the search 
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
function showJob()
{

	document.getElementById("showjob").style.display="block";
	var a  = document.getElementById("job_id").value;
	var b = document.getElementById("job_d");
	var c  = document.getElementById("job_title").value;
	var d = document.getElementById("title_d");
	//document.getElementsByName("job_id").value = a;
	b.value = a;
	d.value = c;
	
}
</script>

