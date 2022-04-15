<?php include "header.php";

if(isset($_POST["postjob"]))
{
	$err = '';
	$title = trim($_POST["title"]);
	
	$major = trim($_POST["major_group"]);
	
	$minor = trim($_POST["minor_group"]);
	
	$sub = trim($_POST["sub_group"]);
	$description = trim($_POST["description"]);
	$amount = trim($_POST["amount"]);
	$id = $_SESSION["id"];
	$username = $_SESSION["username"];
	$name = $_SESSION["name"];
	$filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
    $folder = "jobdocs/".$filename;
	if(empty(trim($_POST["title"])) || empty(trim($_POST["major_group"])) || empty(trim($_POST["minor_group"])) || empty(trim($_POST["sub_group"])))
	{
	echo'<script> alert("please fill out manadatory fields");</script>';	
	}
	else{
		$sql = 'INSERT INTO jobs (id, username, name, title, major, minor, sub, files, description, amount) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "ssssssssss", $param_id, $param_username, $param_name, $param_title, $param_major, $param_minor, $param_sub, $param_files, $param_description, $param_amount);
			$param_id = $id;
			$param_username = $username;
			$param_name = $name;
			$param_title = $title;
			$param_major = $major;
			$param_minor = $minor;
			$param_sub = $sub;
			$param_files = $filename;
			$param_description = $description;
			$param_amount = $amount;
			
			if(mysqli_stmt_execute($stmt))
			{
				move_uploaded_file($tempname, $folder);
				echo '<div class="success" id="succ"><div class="success-content">JOB UPLOADED SUCCESSFULLY
<button style="margin-top: 10%;float: right;padding: 8px 17px;background-color: red;" onclick="exitsucc()">exit</button></div></div>';
			}
		}
	}
}
?>

<style>
.success {
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.success-content {
	background-color: #ddd;
	color: black;
  margin: 2% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  height: 15%;
  width: 50%; /* Could be more or less, depending on screen size */
}
.post-job {
	position: absolute;
	margin-top: -2%;
	background: white;
	left: 20%;
	color: black;
	
}

.group {
margin-top: ;}
.group select{
	padding: 10px;
	max-width: 30%;
	min-width: 30%;
}
#textarea{
 width: 90%;
  padding: 15px;
  margin-left: 5%;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
#a:hover { background: red;}
#b:hover { background: green;}
.major {
	padding: 0% 0% 2% 0%;
	width: 45%;
	font-size: 16px;
}
.minor {
	padding: 0% 0% 2% 0%;
	width: 45%;
	font-size: 16px;
}
.sub {
	padding: 0% 0% 2% 0%;
	width: 45%;
	font-size: 16px;
	margin-left: 2.5%;
}
.datalist-items{
	width: 30%;
}
</style>

<div class="post-job">
<form method="POST" action="" enctype="multipart/form-data">
<table border="1px" width="100%" height="50%" style="border-collapse: collapse;">
<tr>
<th style="color: black;">POST A JOB
<input type="button" onclick="history.back()" value="x" style="color: red;border: none;float: right;">
</th></tr>
<tr>
<td>
<p style="font-size: 25px;"><input type="text" placeholder="JOB TITLE" name="title" style="background-repeat: no-repeat;background-position: 10px 12px;padding: 10px 30%;border: none;font-size: 18px;width: 40%;"></p>
</td>
</tr>
<tr>
<td>
<p style="font-size: 18px;color: black;">
Major group* <input list="major" class="major" name="major_group">
<datalist id="major">
<option value="Proffesionals">Proffessionals and Govt Officials</option>
<option value="Service">Service, Craft and related trade works</option>
<option value="Transport">Transport</option>
<option value="Plant">Plant and machine operators and fishery workers</option>
<option value="Agriculture">Agriculture</option>
<option value="Mining">Mining and Construction</option>
</datalist></p>
<p style="font-size: 18px;color: black;">
Minor group*<input list="minor" class="minor" name="minor_group"><div class="h">
<datalist id="minor" class="opt">
<option value="Legislators">Legislator and Senior officials</option>
<option value="Health">Health Proffesionals</option>
<option value="Life">Life science Proffesionals</option>
<option value="Teaching">Teaching Proffesionals</option>
<option value="Legal">Legal Proffesionals</option>
<option value="Finance">Finance Proffesionals</option>
<option value="">Architects, Planners, Surveyors and Designers</option>
<option value="Sports">Sports and Fitness Workers</option>
<option value="Personal">Personal service workers</option>
<option value="Trade">Wholesale and retail trade </option>
<option value="Hotel">Hotel and Restaurant managers</option>
<option value="Clerks">General Office Clerks</option>
<option value="Street">Street Vendors and Related Workers</option>
<option value="Sales">Sales Persons</option>
<option value="Cleaning">Vehicle, window, laundry and other hand cleaning workers</option>
<option value="Arts">Creative and Perfoming Artists</option>
<option value="Blacksmith">Blacksmith, toolmakers and related trade works</option>
<option value="Handicraft">Handicraft workers</option>
<option value="Printing">Printing Trades workers</option>
<option value="Electrical">Electrical and electronic equipement, telecommunication installers and repairs </option>
<option value="">Food processing and related trades work</option>
<option value="Garments">Garment and related trades work</option>
<option Value="Drivers">Locomotive engine drivers, Motor vehicles and related workers</option>
<option value="Ships">Ship controllers and technicians</option>
<option value="Airports">Airport workers and related workers</option>
<option value="Agriculture">Animal Producers</option>
<option value="Agriculture">Agricultural Labourers</option>
<option value="Agriculture">Market gardeners and Crop growers</option>
<option value="Agriculture">Forestry and related workers</option>
<option value="Agriculture">Mixed crop and Animal producers</option>
<option value="Agriculture">Subsistence livestock farmers</option>
<option value="Agriculture">Subsistence mixed crop and livestock farmers</option>
<option value="Agriculture">Fishery workers, hunters and trappers and gatherers</option>
<option value="Mining labourers">Mining labourers</option>
<option value="Building construction labourers">Building construction labourers</option>
<option value="Manufacturing labourers">Manufacturing labourers</option>
<option value="Mobile Plant Operators">Mobile Plant Operators</option>
<option value="Assemblers">Assemblers</option>
<option value="Machine">Stationery, plant and machine operators</option>
<option value="Food">Food and related products machine operators</option>
<option>Textile, flur and feather machine operators</option>
<option>Rubber, plastic and paper products machine operators</option>
<option>Wood processing and paper making plant operators</option>
<option>Metal processing and finising plant operators</option>
<option>Mining and Mineral processing plant operators</option>
</datalist></div>
</p>
<p style="font-size: 18px;color: black;">
Sub group*<input list="sub" class="sub" name="sub_group">
<datalist id="sub">
<option value="">--select---</option>
<option value="Legislators">Legislators</option>
<option value="Government Officials">Government Officials</option>
<option value="Senior Officials and Special Interest Organisations">Senior Officials and Special Interest Organisations</option>
<option value="Athlete, Boxer, Footballer, Sports">Athlete, Boxer, Footballer, Sports</option>
<option value="Coach Soccer, Coach Athlete">Coach Soccer, Coach Athlete</option>
<option value="Fitness and recreation instructors and programme leaders">Fitness and recreation instructors and programme leaders</option></select>
<option value="Manufacturing Supervisors">Manufacturing Supervisors</option>
<option value="Hand packers">Hand packers</option>
<option value="Manufacturing labourers">Manufacturing labourers </option>
<option value="Companions and valets">Companions and valets</option>
<option value="Pet Groomers and Animal caretakers">Pet Groomers and Animal caretakers</option>
<option value="Driving Instructors">Driving Instructors</option>
<option value="Personal Workers Not classified">Personal Workers Not elsewhere classified</option>
<option value="Restauranteur">Restauranteur</option>
<option value="Hoteliers">Hoteliers</option>
<option value="Seretary">Seretary</option>
<option value="Payroll clerks">Payroll clerks</option>
<option value="Cahier, ticket clerks, Money changer">Cahier, ticket clerks, Money changer</option>
<option value="Bank tellers and Related Clerks">Bank tellers and Related Clerks</option>
<option value="General Office clerks">General Office clerks</option>
<option value="Data Entry Clerks">Data Entry Clerks</option>
<option value="Debt collectors and related workers">Debt collectors and related workers</option>
<option value="Accounting and Book Keeping Clerks">Accounting and Book Keeping Clerks</option>
<option value="Other Client information workers Not classified">Client information workers Not elsewhere classified</option>
<option value="Street/newspapers and periodicalls">Street/newspapers and periodicalls</option>
<option value="Garbage and Recycling Collectors">Garbage and Recycling Collectors</option>
<option value="Street non-food Products Vendor">Street non-food Products Vendor</option>
<option value="Stall and Market-place salesperson">Stall and Market-place salesperson</option>
<option value="Street Food Sales Person">Street Food Sales Person</option>
<option value="Shopkeepers">Shopkeepers</option>
<option value="Shop Supervisors">Shop Supervisors</option>
<option value="Shop Sales assistants">Shop Sales assistants</option>
<option value="Sales demonstrators">Sales demonstrators</option>
<option value="Door to door Salesperson">Door to door Salesperson</option>
<option value="Service Station attendants">Service Station attendants</option>
<option value="Contact center salesperson">Contact center salesperson</option>
<option value="Street food Vendor">Street food Vendor</option>
<option value="Other Sales workers Not classified">Sales workers not elsewhere classified</option>
<option value="Vehicle Cleaners">Vehicle Cleaners</option>
<option value="Window Cleaners">Window Cleaners</option>
<option value="Other Cleaning workers">Other Cleaning workers</option>
<option value="Visual artists">Visual artists</option>
<option value="Musicians, Singers and Composers">Musicians, Singers and Composers</option>
<option value="Dancers and Choreographers">Dancers and Choreographers</option>
<option value="Actors">Actors</option>
<option value="Photographers">Photographers</option>
<option value="Film, Stage and related Directors and Producers">Film, Stage and related Directors and Producers</option>
<option value="Announcementation, Radio, Television and other media">Announcementation, Radio, Television and other media</option>
<option value="Fashion, other models">Fashion, other models</option>
<option value="Interior designers and decorators">Interior designers and decorators</option>
<option value="Gallery, Museum and Library Technicians">Gallery, Museum and Library Technicians</option>
<option value="Other Creative and Perfomane artists Not classified">Creative and Perfomane artists Not elsewhere classified</option>
<option value="Hand and Pedal Vehicle Drivers">Hand and Pedal Vehicle Drivers</option>
<option value="Drivers of Animal drawn vehicles or machinery">Drivers of Animal drawn vehicles or machinery</option>
<option value="Construction Labourers">Construction Labourers</option>
<option value="Freight handlers">Freight handlers</option>
<option value="Civil engineering labourers">Civil engineering labourers</option>
<option value="Mining Labourers">Mining Labourers</option>
<option value="Quarrying Labourers">Quarrying Labourers</option>
<option value="Crop Farm labourers">Crop Farm labourers</option>
<option value="Livestock farm Labourers">Livestock farm Labourers</option>
<option value="Mixed crop and Livestock farm Labourers">Mixed crop and Livestock farm Labourers</option>
<option value="Garden and Horticultural Labourers">Garden and Horticultural Labourers</option>
<option value="Forestry Labourers">Forestry Labourers</option>
<option value="Fishery and Aquaculture Labourers">Fishery and Aquaculture Labourers</option>
<option value="Tree and shrub crop growers">Tree and shrub crop growers</option>
<option value="Livestock and Dairy Producers">Livestock and Dairy Producers</option>
<option value="Poultry Producers">Poultry Producers</option>
<option value="Mixed crop and Animal producers">Mixed crop and Animal producers</option>
<option value="Forest Ranger">Forest Ranger</option>
<option value="Deep sea Fishery workers">Deep sea Fishery workers</option>
<option value="Aquaculture workers, hunters, trappers and gatherers">Aquaculture workers, hunters, trappers and gatherers</option>
<option value="Inland and Coastal waters Fishery workers">Inland and Coastal waters Fishery workers</option>
<option value="Subsistence Livestock Farmers">Subsistence Livestock Farmers</option>
<option value="Subsistence mixed, crop and Livestock Farmers">Subsistence mixed, crop and Livestock Farmers</option>
<option value="Mixed Crop growers">Mixed Crop growers</option>
<option value="Gardeners; Horticultural and Garden workers">Gardeners; Horticultural and Garden workers</option>
<option value="Other Animal Producers Not classified">Animal Producers not elsewhere classified</option>
<option value="Lifting Truck operators">Lifting Truck operators</option>
<option value="Mechanical Machinery assemblers">Mechanical Machinery assemblers</option>
<option value="Crane, hoist and related plant operators">Crane, hoist and related plant operators</option>
<option value="Mobile farm and forestry plant operators">Mobile farm and forestry plant operators</option>
<option value="Earthmoving and related plant operators">Earthmoving and related plant operators</option>
<option value="Laundry Machine operators">Laundry Machine operators</option>
<option value="Sewing Machine Operators">Sewing Machine Operators</option>
<option value="Fur and leather preparing machine operators">Fur and leather preparing machine operators </option>
<option value="Weaving and Knitting Machine Operators">Weaving and Knitting Machine Operators</option>
<option value="Shoemaking and related Machine operators">Shoemaking and related Machine operators</option>
<option value="Other Textile, Flur and Leather products machine Not classified">Textile, Flur and Leather products machine operators not elsewhere mentioned</option>
<option value="Metal Proceesing Plant Operators">Metal Proceesing Plant Operators</option>
<option value="Metal refinig, Metal cleaning equipement operator">Metal refinig, Metal cleaning equipement operator</option>
<option value="Metal Galvanising, metal Spraying machine Operator">Metal Galvanising, metal Spraying machine Operator </option>
<option value="Ship deck pilots">Ship deck pilots</option>
<option value="Ship captain, master ship">Ship captain, master ship</option>
<option value="Ship navigating officer, marine pilot">Ship navigating officer, marine pilot</option>
<option value="Ship engineers">Ship engineers</option>
<option value="Train drivers">Train drivers</option>
<option value="Marine supretendant, marine Engineer">Marine supretendant, marine Engineer</option>
<option value="Ship deck officers, crew and related associate proffessionals">Ship deck officers, crew and related associate proffessionals</option>
<option value="Railway break, Signal and Switch operators">Railway break, Signal and Switch operators</option>
<option value="Motorcycle Drivers">Motorcycle Drivers</option>
<option value="Car, Taxi and Van drivers">Car, Taxi and Van drivers</option>
<option value="Bus and Trum drivers">Bus and Trum drivers</option>
<option value="Heavy trucks and lorries Drivers">Heavy trucks and lorries Drivers</option>
<option value="Aircraft Pilot">Aircraft Pilot</option>
<option value="Aircraft Crew and related proffesionals">Aircraft Crew and related proffesionals</option>
<option value="Air traffic controllers">Air traffic controllers</option>
<option value="Air craft Engineers, Radar and Sonar Technicians">Air craft Engineers, Radar and Sonar Technicians </option>
<option value="Pedal Vehicle Driver">Pedal Vehicle Driver</option>
<option value="Freight handler, Turnboy, Dockers, Bale press Operator">Freight handler, Turnboy, Dockers, Bale press Operator</option>
<option value="Psychologists">Psychologists</option>
<option value="Authors and related writers">Authors and related writers</option>
<option value="Religious Proffessionals">Religious Proffessionals e.g chaplain, pastor...</option>
<option value="Journalists, archivists and curators">Journalists, archivists and curators</option>
<option value="Sports coaches, Instructors and officials">Sports coaches, Instructors and officials</option>
<option value="Social Work and counselling proffesionals">Social Work and counselling proffesionals</option>
<option value="Food and related products machine operators">Food and related products machine operators </option>
<option value="Food and related plant operators">Food and related plant operators </option>
</datalist>
<br>
</p>


</div>
</td>
</tr>
<div style="position: relative;margin-top: 10%;"><hr/></div>
<tr>
<td>
<p style="font-size: 20px;margin-top: 2%;margin-bottom: 2%;color: black;">Upload Supporting document(s) for the job <input type="file" name="file" multiple></p>
</td>
</tr>
<hr/>
<tr>
<td>
<p style="font-size: 25px;color: black;">Describe the job 
<textarea id="textarea" placeholder="job_description" name="description"></textarea></p>
</td>
</tr>
<tr>
<td>
<center><p style="font-size: 23px;color: black;">Payements</p></center>
<p style="color: black;">Amount in Kshs:* </p><input type="number" placeholder="amount" name="amount" style="padding: 9px;margin-left: 25%;margin-top: -10%;">
<p style="float: right;margin-top: -7.5%;color: black;">Through: <select style="padding: 7px;">
<option>M-PESA</option>
<option>AIRTEL MONEY</option>
<option>T-KASH</option>
</select></p>
</td>
</tr>
<hr/><br>
<tr>
<td>
<input type="reset" id="a" value="RESET" style="float: left;padding: 12px;">
<input type="submit" id="b" value="SUBMIT" name="postjob" style="float: right;padding: 12px;">
</td>
</tr>
</table>
</form>
</div>
<script>

function exitsucc(){ document.getElementById("succ").style.display = "none"; }

</script>