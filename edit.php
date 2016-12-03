<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$pass=$_SESSION["pass"];
	$notes=$uid."_notes";
	$_SESSION["noteid"]=$_POST["noteid"];
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("select note_title,note from ".$notes." where NoteID=".$_POST["noteid"].";");
	if(!$result)
		die("error edit.php line 11"); 
	else
	{
		echo '
		<link rel="stylesheet" href="style.css">
		<h1 align="center">SimpleNote</h1>
	<hr align="center" width="60%">
	<table width="50%" align="center">
		<tr align="center">
			<td>
				<a href="us.html">About</a>
			</td>
			<td>
				<a href="main.php">'.$uname.'</a>
			</td>
			<td>
				<a href="logout.php">Log Out</a>
			</td>
		</tr>
	</table>
	<hr align="center" width="60%">
	<table width="50%" align="center" cellpadding="10">
		<tr align="center">
			<td colspan="2">
				<form action="updatenote.php" method="post">
					<textarea name="title" cols="55" rows="1">'.mysql_result($result,0,"note_title").'</textarea>
					<textarea name="note" cols="60" rows="8">'.mysql_result($result,0,"note").'</textarea>
					<br>	
					<input type="submit" value="Save note"></input>
				</form>
			</td>
		</tr>';
	}

?>