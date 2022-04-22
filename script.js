window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
window.scroll(function() {
	if(window.scrollTop() > 100)
		sessionStorage.scrollPos = window.scrollTop();
});
var init = setTimeout(function (){
	if(sessionStorage.scrollPos > 100){
		$("html").animate ({ scrollTop: sessionStorage.scrollPos }, 2000);
}
},1000);
window.onload = init;

window.onscroll = function(){scrollFunction()};
function scrollFunction() {
	if(document.documentElement.scrollTop > 150 || document.body.scrollTop > 150){
	document.getElementById("backtop").style.display = "block";}
	else { document.getElementById("backtop").style.display = "none";}
}
function backtop(){ window.scrollTop() = 0;}
function logout()
{
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
	window.location = 'logout.php';
}

function openNav() {
  document.getElementById("mySidenav").style.width = "220px"; 
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}
function newpost(){ document.getElementById("newpost").style.display = "block";
document.getElementById("body").style.background = "rgba(0,0,0,0.4);";
}
function closepost() { document.getElementById("post").style.display = "none";document.getElementById("newpost").style.display = "none";
  document.getElementById("body").style.background = "white";document.getElementById("nextpost").style.display = "none";
}
function closenextpost() { document.getElementById("nextpost").style.display = "none";}
function openNav() {
  document.getElementById("mySidenav").style.width = "150px";
}

function searchform()
{
	var x = document.getElementById("searchform");
	if(x.style.display == "none")
	{
		x.style.display = "block";
	}else{x.style.display = "none";}
}

function showMessage()
{
	if(document.getElementById("msging").style.height == "0px"){
	document.getElementById("msging").style.height = "400px";document.getElementById("msg-cont").style.display = "block";}
	else{document.getElementById("msging").style.height = "0px";document.getElementById("msg-cont").style.display = "none";}
}
function postmenu()
{
	var x = document.getElementById("postmenu");
	if(x.style.display == "none")
	{
		x.style.display = "block";
	}else{ x.style.display = "none";}
}
function showMore(){ document.getElementById("activitytable").style.height = "600px";document.getElementById("showbtn").style.display = "none";
document.getElementById("exptable").style.height = "700px";}
function imgpost() { document.getElementById("imgpost").style.display = "block";}
function closeimgpost() { document.getElementById("imgpost").style.display = "none";}
function openleftnav() { document.getElementById("myleftnav").style.width = "30%";document.getElementById("drop-down").style.marginright = "220px";}
function closeleftnav() { document.getElementById("myleftnav").style.width = "0"; document.getElementById("drop-down").style.marginright = "0";}
function nextpage() { document.getElementById("nextpost").style.display = "block";}

function copytext(id)
{
	var copyText = document.getElementById(id);
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */
	
	navigator.clipboard.writeText(copyText.value);
	 alert("post copied: ");
}

function showmenu(id)
{ 
	var menu = document.getElementById(id);    
	if (menu.style.display == "none"){ 
		menu.style.display = 'block'; 
	}else{   
		menu.style.display = 'none'; 
	} 
}
function shareopt(id)
{ if(document.getElementById(id).style.display == "none")
	{ document.getElementById(id).style.display = "block";}else{ document.getElementById(id).style.display = "none";}
}