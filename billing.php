<style>
.billing {
	width: 55%;
	height: 60%;
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

#new_method {}
</style>
<div>
<h1>Billing and payements</h1>
<div class="billing">
<h2>Billing methods<button onclick="addMethod()">Add a new billing method</button></h2>
<hr/>
<?php
require_once "database.php";
$sql = 'SELECT * FROM accounts WHERE id='.$_SESSION["id"].'';

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

        <input type="submit" value="Add Method" onsubmit="validateCard()" class="btn">
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