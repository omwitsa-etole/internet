<style>
.notifications{
	width: 55%;
	height: 200%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; 
}
.notifications input{
	margin-top: 1%;
}
.notifications  button{
	float: right;
	color: white;
	background: green;
	padding: 2% 9%;
	border-radius: 12px;
	margin-top: -5%;
}
</style>
<div style="width: 100%;height: 100%;">
<h1>Notification Settings</h1>
<div class="notifications">
<h1>Email Updates</h1>
<hr/>
<p>Send email notification to <?php echo $_SESSION["email"] ?> when...</p><br>

<input type="checkbox">A job is posted or modified<br>
<input type="checkbox">A proposal is received<br>
<input type="checkbox">An interview is accepted or offer terms are modified<br>
<input type="checkbox">An interview or offer is declined or withdrawn<br>
<input type="checkbox">An offer is accepted<br>
<input type="checkbox">A job posting will expire soon<br>
<input type="checkbox">A job posting expired<br>
<input type="checkbox">No interviews have been initiated<br>
<button type="submit" name="options1" >Update</button><br>
<hr/>
<h2>Freelancer and Agency Proposals</h2>
<input type="checkbox">An interview is initiated<br>
<input type="checkbox">An offer or interview invitation is received<br>
<input type="checkbox">An offer or interview invitation is withdraw<br>
<input type="checkbox">A Proposal is rejected<br>
<input type="checkbox">A job I applied to has been cancelled or closed<br>
<input type="checkbox">A proposal is withdrawn<br>
<button type="submit" name="options1" >Update</button><br>
<hr/>
<h2>Communications from Upwork</h2>
<input type="checkbox">Send me genuinely useful emails every now and then to help me get the most out of Upwork<br>
</div>
</div>