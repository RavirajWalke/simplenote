<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$pass=$_SESSION["pass"];
	$notes=$uid."_notes";
	$noteid=$_POST["noteid"];
	$_SESSION["noteid"]=$noteid;
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("select * from ".$notes." where NoteID=".$noteid.";");
	if(!$result)
		die("error main.php line 11"); 
	else
	{
		echo '<link rel="stylesheet" href="style.css">
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
	<div style="background-color: yellow; box-shadow: 10px 10px 5px #888888;">
							<table width="50%" align="center">
								<tr align="center">
									<td>
										<b><h3>'.mysql_result($result,0,"note_title").'</h3></b>
									</td>
								</tr>
								<tr align="center">
									<td colspan="3">
										<h3>'.mysql_result($result,0,"note").'</h3>
									</td>
								</tr>
							</table>
			</div>
			<br><br>
<form action="send.php" method="post" >
	<table align="center">
		<tr>
			<td>
				<label>Email ID:</label>
			</td>
			<td>
				<input id="uid" name="email" type="text" required>
				<label style="color:red;"><sup>*</sup></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Share via Email" />	
			</td>
		</tr>
	</table>
</form>
	';
	}
	
?>