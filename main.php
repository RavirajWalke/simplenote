<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$pass=$_SESSION["pass"];
	$notes=$uid."_notes";
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("select * from ".$notes." order by creation desc;");
	if(!$result)
		die("error main.php line 11"); 
	else
	{
		$_SESSION["no_of_notes"]=mysql_numrows($result)+1;
		echo '
		<head>
			<link rel="stylesheet" href="style.css">
		</head>
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
				<form action="addnote.php" method="post">
					<textarea name="title" cols="55" rows="1" placeholder="Title..."></textarea>
					<textarea name="note" cols="60" rows="8" placeholder="Take a new note..."></textarea>
					<br>	
					<input type="submit" value="Add note"></input>
				</form>
			</td>
		</tr>
		<tr align="center">
			<td colspan="2">
			<br><br>
				-: Your Notes :-
			<br><br>
			</td>
		</tr>';
		if(mysql_numrows($result)==0)
		{
			echo '<tr align="center"><td colspan="2">No notes created yet</td></tr>
			</table>';
		}
		else
		{
			$i=0;
			while($i<mysql_numrows($result))
			{
				echo '
				<tr align="center">
					<td width="50%">
						<div style="background-color: yellow; box-shadow: 10px 10px 5px #888888;">
							<table width="100%" align="center">
								<tr align="center">
									<td width="80%">
										<b><h3>'.mysql_result($result,$i,"note_title").'</h3></b>
									</td>
									<td width="10%">
										<form action="edit.php" method="post">
											<input style="visibility:hidden;" type="radio" name="noteid" value="'.mysql_result($result,$i,"NoteID").'" checked/></input>
											<input style="background-color: yellow; color: black;" border="0" type="submit" value="Edit"></input>
										</form>
									</td>
									<td width="10%">
										<form action="share.php" method="post">
											<input style="visibility:hidden;" type="radio" name="noteid" value="'.mysql_result($result,$i,"NoteID").'" checked/></input>
											<input style="background-color: yellow; color: black;" border="0" type="submit" value="Share"></input>
										</form>
									</td>
								</tr>
								<tr align="center">
									<td colspan="3">
										<h3>'.mysql_result($result,$i,"note").'</h3>
									</td>
								</tr>
							</table>
						</div>
					</td>
					';
					$i++;
					if($i<mysql_numrows($result))
					{
						echo '
						<td>
						<div style="background-color: yellow; box-shadow: 10px 10px 5px #888888;">
							<table width="100%" align="center">
								<tr align="center">
									<td width="80%">
										<b><h3>'.mysql_result($result,$i,"note_title").'</h3></b>
									</td>
									<td width="10%">
										<form action="edit.php" method="post">
											<input style="visibility:hidden;" type="radio" name="noteid" value="'.mysql_result($result,$i,"NoteID").'" checked/></input>
											<input style="background-color: yellow; color: black;" type="submit" value="Edit"></input>
										</form>
									</td>
									<td width="10%">
										<form action="share.php" method="post">
											<input style="visibility:hidden;" type="radio" name="noteid" value="'.mysql_result($result,$i,"NoteID").'" checked/></input>
											<input style="background-color: yellow; color: black;" border="0" type="submit" value="Share"></input>
										</form>
									</td>
								</tr>
								<tr align="center">
									<td colspan="3">
										<h3>'.mysql_result($result,$i,"note").'</h3>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
						';
					}
					else
					{
						echo '</tr>';
					}
				$i++;
			}
			echo "</table>";
		}
		mysql_close();
	}
?>