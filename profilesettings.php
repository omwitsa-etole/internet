<style>
.myProfile{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	text-align: left;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.myProfile select{
	padding: 13px 20%;
	text-align: justify;
	font-size: 14px;
	width: 60%;
}
.preferences{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.experience {
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.categories {
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
.linked{
	width: 55%;
	height: 60%;
	border-radius: 10px;
	box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}
</style>
<div>
<h1>Profile Settings</h1>
<div class="myProfile">
<h2>My Profile</h2>
<hr/>
<h4>Visibility</h4>
<select name="profile_privacy">
<option>Public</option>
<option>Private</option>
<option>Friends</option>
</select>
<h4>Project preference </h4>
<select name="preferences">
<option>Short and long term projects</option>
<option>Long term projects(3+ months)</option>
<option>Short term projects(less than 3 months)</option>
</select>
<button type="submit" class="btn_submit" style="float: right;margin-top: 10%;">Submit</button>
</div>
<div class="experience">
<h1>Experience Level</h1>
<hr/>
</div>
<div class="categories">
<h1>Categories<p style="float: right;margin-top: -0.1%;" ><a href="javascript:void(0)" onclick="document.getElementById('categories').style.display='block';" class="fa fa-plus" aria-hidden="true"></a></p></h1>
<hr/>
</div>
<div class="linked">
<h1>Linked accounts</h1>
</hr>
</div>
</div>

<script>
function showcategory(){
	document.getElementById('categories').style.display='block';
}
function closecategory(){
	document.getElementById('categories').style.display='none';
}
</script>