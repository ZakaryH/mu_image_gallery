<?php
include("mysql_connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<title>Blog</title>

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
	visibility: hidden;
	
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
#pagination {
	text-align: right;
	width:300px;
	float: right;
}
.displayUser{
	padding: 4px;
	font-weight: bold;
	text-align: right;
	font-family: georgia;	
}

.author{
	text-align: right;
	font-style: italic;
}
.comment{
	font-style:italic;
	font-size: 11px;
}
</style>



</head>

<body>

<div id="container">
<div id="banner"> 
 Blog
</div>



<div id="content">
<a href="index.php">All Posts</a>
