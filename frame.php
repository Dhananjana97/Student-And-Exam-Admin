<?php 
require_once 'student.php';
if(!isset($_COOKIE['pass']))header('Location index.php');
session_start();
$user = $_SESSION['user'];
if(isset($_GET['logout'])&&$_GET['logout']=='true'){logout();}

$links = $user->links;
function logout(){
	unset($_GET['logout']);
	setcookie('pass', 'logout', time() - (86400 * 30), "/");
	unset($_SESSION['user']);
	header('Location: index.php');
}


?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}
.user{
	position:absolute;
	top:0;
	right:0;
	margin-right:15px;
	margin-top: 8px;
	font-family: Georgia;
}
/*------------------------------Side nav bar--------------*/
.sidenav{
	margin-left: 4px;
}
ul[class = "dashboard"]{
	position:relative;
	top:0px;
	margin-right:50px;
	margin-top:5px;
	width:320px;
	list-style-type: none;
    overflow: hidden;
	padding:0;
	background-color: #d1d1d1;
	opacity:0.6;
    z-index: 1;

}
li[name = "main"] {
    float: top;
}

li[name = "main"] a {
    display: block;
    color: #000;
    text-align: left;
    padding: 14px 30px;
    text-decoration: none;
}

li[name = "main"] a:active { 
    background-color: #0000ff;
}

/* Change the link color to #111 (black) on hover */
li[name = "main"] a:hover {
        background-color: #fff;
}

/*------------------------------fixed horizontal nav bar--------------*/
ul[class="nav"] {
    width: 100%;
	top: 280px;
    z-index: 1;
    background-color: #818181;
	opacity:0.6;
    overflow: hidden;
	margin: 0;
    padding:0;
	border-right: 2px solid #aaa;
	list-style-type: none;
}

.horinav li{
		float:left;
}
.horinav li a{
    text-decoration: none;
    font-size: 25px;
	padding: 14px 25px;
    color: white;
    display: block;
	text-align: center;
}

.horinav a:hover {
	background-color: #111;
}


@media screen and (max-height: 450px) {
    .horinav {padding-top: 15px;}
    .horinav a {font-size: 18px;}
}


.horinav{
	margin: 4px 0px;
}

main{
	position:absolute;
	top:0px;
	background-color: #fff;
	opacity:0.8;
	margin-top: 315px;
    margin-left: 325px; /* Same as the width of the sidenav */
    font-size: 18px; /* Increased text to enable scrolling */
    padding: 30px 50px;
	min-height:100%;
	width:76%;
	 line-height:1.5;
}
.header{
	position:relative;
	text-align:center;
	margin: 5px 0px;
	left:0px;
	top:0px;
}
.main_title{
	position:absolute;
	top:70%;
	left:80%;
	color: #0000cc;
	transform: translate(-50%, -50%);
}

</style>
</head>
<body  style="background-image: url(images/background.jpg);    background-repeat: no-repeat;    background-attachment: fixed;background-size:cover; background-width:100%; background-height:100%">
<div class="header">
<div class="user">
<?php if(isset($_COOKIE['user'])&&isset($_COOKIE['pass'])){
	echo 'loggedin: '.strtoupper($_COOKIE['user']).' &nbsp;<a href="?logout=true"><strong>logout</strong></a>';
}?>
</div>
<img src = "dbanner.jpg" height = "240px" style="width:100%;">
<div class = "main_title"><h1> Student and Exam Administration</h1></div>
</div>


<div class="horinav">
<ul class = "nav">
	<li><a href="index.php">Home</a</li>
	<li><a href="services.php">Services</a></li>
	<li><a href="gallery.php">Gallery</a></li>
	<li><a href="aboutus.php">About</a></li>
	<li><a href="contactus.php">Contact</a></li>
</ul>
</div>

<div class "sidenav">
<?php
	if(isset($links)){
		echo '<ul class = "dashboard">';
		foreach($links as $title => $link ){
			echo '<li name = "main"><a style ="font-size: 20px" href="'.$link.'">'.$title.'</a></li>';
		}
		echo '</ul>';
	}
				
?>
</div>
<main>
</main>
</body>
</html> 