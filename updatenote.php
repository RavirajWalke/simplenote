<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$notes=$uid."_notes";
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("update ".$notes." set note_title='".$_POST["title"]."', note='".$_POST["note"]."' where NoteID=".$_SESSION["noteid"].";");
	if(!$result)
		die("error updatenote.php line 11"); 
	else
	{
		header("Location: main.php");
	}
?>