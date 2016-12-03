<?php
session_start();
$formuid=$_POST["userid"];
$formpass=$_POST["password"];
mysql_connect("localhost","root","");
@mysql_select_db("simplenote") or die("Unable to select database");
$result=mysql_query("select * from users where UserID='".$formuid."';");
if(mysql_numrows($result)==0)
	die("User does not exists");
$pass = mysql_result($result,0,"Password");
if($formpass===$pass)
{
	$_SESSION["uid"]=$formuid;
	$_SESSION["uname"]=mysql_result($result,0,"UserName");
	$_SESSION["pass"]=$pass;
	header("Location: main.php");
}
else
{
	header("Location: welcome.html");
}
mysql_close();
?>