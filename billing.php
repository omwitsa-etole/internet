<?php
$id =$_SESSION["id"];$error = $cardname = $cardnumber = $expyear = '';
if(isset($_POST["add-billing"])){
	if(empty(trim($_POST["cardname"]))){
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter card name
			</div>';
	}else{ $cardname = trim($_POST["cardname"]);}
	if(empty(trim($_POST["cardnumber"]))){
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter card number
			</div>';
	}else{ $cardnumber = trim($_POST["cardnumber"]);}
	if(empty(trim($_POST["expyear"]))){
		$error = 'error';
		echo '<div class="alert_fail">
			  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
			  Enter card expiry date
			</div>';
	}else{ $expiry = trim($_POST["expyear"]);}
	if(empty($error)){
		$sql = 'INSERT INTO accounts(id, cardname, cardnumber, expyear) VALUES(?,?,?,?)';
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_cardname, $param_cardnumber, $param_expyear);
			$param_id = $id;
			$param_cardname = $cardname;
			$param_cardnumber = $cardnumber;
			$param_expyear = $expyear;
			if(mysqli_stmt_execute($stmt)){
				echo '<div class="alert_succ">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Card added successfully
				</div>';
			}else{
				echo '<div class="alert_fail">
				  <span class="closebtn" onclick="close_alert(this.parentElement)">&times;</span>
				  Failed to add card
				</div>';
			}
			mysqli_Stmt_close($stmt);
		}
	}
	
}
?>
<style>
.billing {
	width: 55%;
	height: 60%;
	overflow: auto;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
}
.billing h2{
	margin-bottom: 4%;
}
.billing button{
	float: right;
	border-radius: 12px;
	background: white;
	padding: 2% 13%;
	color: green;
	font-size: 15px;
}
.bill-card {
	width: 65%;
	height: 30%;
	overflow: auto;
	text-align: justify;
	background: white;
	border-radius: 15px;
	margin-left: 5%;
	font-size: 18px;
	
}
</style>
<div>
<h1>Billing and payements</h1>
<div class="billing">
<h2>Billing methods<button onclick="addMethod()">Add a new billing method</button></h2>
<hr/>
Available cards: 
<?php
require_once "database.php";
$sql = 'SELECT * FROM accounts WHERE id='.$_SESSION["id"].'';
$retval = $link->query($sql);
	if($retval->num_rows > 0){
		while($row = $retval->fetch_assoc()){
			$cardname = $row["cardname"];
			$cardnumber = $row["cardnumber"];
			$exp = $row["expyear"];
?>
<div class="bill-card"><p>Name: <?php echo $cardname;?></p><p>Card number: <?php echo $cardnumber;?></p><a class="fa fa-trash" style="float: right;margin-top: -15%;zoom: 150%;"></a></div><br>
<?php
		}
	}
		
?>
</div>
</div>
<div id="new_method" style="display: none;position: fixed;top: 10%;left: 35%;height: 100%;">
<div style="width: 100%;height: 90%;z-index: 2;overflow: auto;">
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST" name="form1">

             <div class="col-50">
            <h3>Payment<p style="float: right;cursor: pointer;"><a onclick="document.getElementById('new_method').style.display='none'">&times</a></p></h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Expiry</label>
                <input type="month" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>

        </div>

        <input type="submit" value="Add Method" name="add-billing" onsubmit="validateCard()" class="btn">
      </form>
    </div>
  </div>

</div>

</div>
<script>
function addMethod(){
	var x = document.getElementById("new_method");
	if(x.style.display == "none"){
		x.style.display = "block";
	}
}
function validateCard()
{
  var x = document.getElementById("ccnum").value;
  var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
  if(x.match(cardno))
  {
    return true;
  }
  else
  {
    alert("Not a valid Visa credit card number!");
    return false;
   }
}
</script>