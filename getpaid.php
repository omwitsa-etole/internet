<style>
.balance {
	width: 55%;
	height: 40%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
}
.balance button{
	float: right;
	border-radius: 12px;
	background: white;
	padding: 2% 13%;
	color: green;
	font-size: 15px;
}
.payement_details {
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
}
.payement_details button{
	float: right;
	border-radius: 11px;
	background: white;
	padding: 2% 11%;
	color: green;
	font-size: 15px;
	margin-top: -4%;
	
}
.add_pay {
	width: 50%;
	height: 90%;
	z-index: 2;
	overflow: auto;
	box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
	border-radius: 12px;
	background: white;
	font-weight: bold;
}
.add_pay select{
	padding: 2.5% 9%;
}
.method {
	width: 95%;
	height: 60%;
	border-radius: 5px;
	display: none;
}
.phone_method {
	height: 100%;
	overflow: auto;
}
.phone_method input[type=text]{
	padding: 4% 15%;
	width: 70%;
}
.phone_method select{ width: 70%; }
</style>
<div>
<h1>Get Paid</h1>
<div class="balance">
<h2>Balance</h2>
<hr/>
<p>Your balance is : </p>
<button>Get Paid </button>
</div>
<div class="payement_details">
<h1>Payement Details</h1>
<hr/>
<h3>Last Payement</h3>
<p>You have not made any withdrawals yet</p>
<button >View Payements</button><br>
<hr/>
<h3>Payement schedule</h3>
<button>Edit Schedule</button><br>
<hr/>
<h3>Payement methods</h3>
<button onclick="document.getElementById('addpay').style.display='block'">Add method</button>
<p></p>
</div>
<div class="addpay_method" id="addpay" style="display:none;position: fixed;top: 15%;left: 30%;height: 100%;width: 100%;">
<div class="add_pay">
<p style="float: right;"><a onclick="document.getElementById('addpay').style.display='none'">&times</a></p>
Select method <select onchange="checkmethod(this.value)">
<option value="method-card">CARD</option>
<option value="method-phone">M-PESA</option>
</select>
<hr/>
<div id="method-card" class="method">
<h2>Enter Card details<h2>
<form action="" method="POST" name="form1">
<div>
	 <div class="col-50">
	<h3>Payment</h3>
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
<button type="submit" value="Add Method" name="card_method" onsubmit="validateCard()" class="btn_submit" >Add method</button>
</form>
</div>
<div id="method-phone" class="method">
<h2>Set up payements for your mpesa</h2>
<div>
<form method="post" class="phone_method">
First name<br>
<input type="text" name="fname"><br>
Last name<br>
<input type="text" name="lname"><br>
Id type<br>
<select onchange="myfunction(this.value)">
<option value="national_id">National Id</option>
<option value="passport">Passport</option>
<option value="Visa">Visa</option>
</select>
<h2><p id="type-id">Id number</p></h2><br>
<input type="text" name="id_number" ><br>
<h2>Mobile number (used to receive payments on your M-PESA account)<h2>
<input type="text" placeholder="254-7xxxxxxxx" name="pay_phone"><br>
<h2>Country</h2>
<input type="text" value="Kenya" disabled><br>
<p>Mpesa is only allowed in kenya</p>
<input type="checkbox" onchange="unblock()">
<p>I attest that I am the owner and have full authorization to this M-PESA account.</p>
<button type="submit" id="sub_meth" name="phone_method" class="btn_submit" disabled>Add Method</button>
<p style="color: green;font-size: 18px;margin-left: 45%;margin-top: -10%;"><a onclick="document.getElementById('method-phone').style.display='none'">Cancel</a></p>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
function unblock(){
	var x = document.getElementById('sub_meth');
	if(x.disabled == true){
		x.disabled = false;
	}else{ x.disabled = true; }
}
function checkmethod(id){
	if(id == "method-card"){
		document.getElementById(id).style.display = 'block';
		document.getElementById('method-phone').style.display = 'none';
	}else if(id == "method-phone"){
		document.getElementById(id).style.display = 'block';
		document.getElementById('method-card').style.display = 'none';
	}else {
		document.getElementById('method-card').style.display = 'none';
		document.getElementById('method-phone').style.display = 'none';
	}
	
	
}
function myfunction(val){
		document.getElementById("type-id").innerText = val;
}
</script>