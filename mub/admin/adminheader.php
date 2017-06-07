<?php
include("../includes/mysql_connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<title>Phil's Blog</title>

<style type="text/css">
body {

	font-family: verdana, arial;
	font-size: 13px;
	color: #333;
	text-align:center;
	background-image: url('img/bg.jpg');
	background-repeat: repeat-x;
	background-color:#b6bfce;
}
#container {
	width: 600px;
	background-color: #fff; /**/
	
	text-align:left;
	padding: 10px;
	margin-left: auto;
	margin-right: auto;
	border: 1px solid #999;
}
#banner {
	
	height: 100px;
	background-color: #ccc; /**/
	color: #fff;
	/* background-image: url('img/banner.jpg');*/
	font-size: 48px;
	font-weight:bold;
	text-align:center;
	font-family: georgia;
	padding: 20px 0px 0px 0px;;
}

#content {
	/* padding: 10px; */
}

#nav {
	padding: 4px;
	font-weight: bold;
	
	background-image: url('img/navtile.gif');
	background-repeat: repeat-x;
	background-color:#cacdd8;

	
}
#nav a{
	
	font-weight: bold;
	color: #545e82;
	text-decoration: none;

}
#nav a:hover{
	
	color: #fff;
	text-decoration: underline;

}
/* Form style here */

#tblform {
	width: 500px;
	border: 1px solid #666;
}
.tdtext {
	text-align: right;
	font-weight: bold;
	width: 140px
}
.tdinput {
	text-align: left;
	
	width: 360px
}
.frminput {
	width: 340px;
	border: 1px solid #999;
}
#frmmessage {
	height: 120px;
}
#emoticons {
	border: 1px solid #ccc;
	padding: 3px;
}
#emoticons img{
	padding: 1px;
}
div.entryheader {
	 border: 1px solid #999;/* */
	padding: 5px;
	background-color: #eee;

	width: 585px;
	margin-bottom: 4px;
}
div.date {
	/*border: 1px solid #999;
	padding: 5px;
	background-color: #eaeaea;
	
	padding: 2px;
	*/
	
	/*display:inline;
	float:left;
	*/
	font-style: italic;
}
div.title {
	/*border: 1px solid #999;*/
	padding: 5px;
	/*background-color: #ffeaea;*/
	padding: 2px;
	font-weight:bold;
	width: 300px;
	/*
	display:inline;
	float:right;
	*/
}
div.message {
	/*border: 1px solid #999;*/
	padding: 2px;
	/* background-color: #eaeaff; */
	display: block;
	margin-top:10px;
}
h2 {
	color:  #545e82;
	font-family: georgia;

}
.blogentry{
	font-weight:normal;
	font-style:normal;
	text-align:left;
	border: 1px solid #ccc;
	padding: 7px;
	margin-bottom: 7px;
}
.blogtitle{
	font-weight:bold;
	font-style:normal;
	text-align:left;
	border: 0x solid #ccc;
}
.blogmessage{
	font-weight:normal;
	font-style:normal;
	text-align:left;
	/*  italic small-caps 900 12px arial */
	font: normal 13px arial,verdana ;
	border: 0x solid #ccc;
}
.blogtimedate{
	
	text-align:right;
	/*  italic small-caps 900 12px arial */
	font: italic bold 12px  arial,verdana;
	color: #999;
	border: 0x solid #ccc;
}
#emoticons {
	width: 200px;
	height: 135px;
	border:0px solid #666;
	float:right;
	margin-right:100px;
	margin-top:68px;
}
/* Forms style */
#editform p {
	
	width: 300px;
}
#editform label  {
	
	width: 65px;
	font-weight: bold;
	position:relative;
	top:10px;
}
#editform input,textarea  {
	
	width: 180px;
	margin-left: 100px;
}
#editform textarea  {
	
	height:140px;
}
</style>

<script type="text/javascript">
function emoticon(text) {
	var txtarea = document.myform.entry;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}
function go()
{
	// box = document.navform.entryselect; // gets the form element by the name attribute
	box = document.getElementById('entryselect'); // gets form element by the id.
	destination = box.options[box.selectedIndex].value;
	if (destination) location.href = destination;
}

</script>

</head>

<body>

<div id="container">
<div id="banner"> 
 Blog Admin
</div>



<div id="nav">
<a href="../index.php">BLOG</a> | &nbsp;&nbsp;&nbsp;&nbsp;

<a href="insert.php">Input</a> | 

</div>
<div id="content">

