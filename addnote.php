<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$notes=$uid."_notes";
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("insert into ".$notes." values(".++$_SESSION["no_of_notes"].",'".$uid."','".$_POST["title"]."','".$_POST["note"]."','".date("Y-m-d")."');");
	if(!$result)
		die("error addnote.php line 11"); 
	else
	{
		header("Location: main.php");
	}
?>