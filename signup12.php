<?php
if(!$_SESSION["id"]){
	echo '<script>window.location="signup.php?step=1"</script>';
}
?>
<?php
$sql = 'SELECT * FROM users WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
if($retval->num_rows > 0){
	while($row = $retval->fetch_assoc()){
		$dir= $row["profile"];
		$name = $row["name"];
		$title = $row["title"];
		$about = $row["about"];
		$rate = $row["rate"];
	}
}
?>
<style>
.dropdown {
  float: right;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;
  outline: none;
  margin: 0; 
  border-radius: 50%;
  width: 100px;
  height: 80px;
  margin-top: -15%;
  z-index: 1;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 2;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<div>
<center>
<div style="width: 35%;height: 55%;margin-top: 10%;">
<h1>Nice work, <?php echo$_SESSION["name"];?>!Your profile’s ready.</h1><br>
<p>Congratulations! With thousands to choose from, it’s time to start bidding on roles that are the perfect fit for your skills.</p>
<button onclick="window.location='userprofile.php'" style="padding: 2% 10%;border-radius: 15px;cursor: pointer;">View my Profile</button>
<button style="float: right;border-radius: 15px;padding: 2% 10%;cursor: pointer;background: green;color: white;">Browse Jobs</button>
</div>
</center>
</div>