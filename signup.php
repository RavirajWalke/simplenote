<?php
	session_start();
	if(isset( $_POST["submit"]))
	{
		mysql_connect("localhost","root","");
		@mysql_select_db("simplenote") or die( "Unable to select database");
		$result=mysql_query("insert into users values('".$_POST["userid"]."','".$_POST["username"]."','".$_POST["password"]."');");
		if(!$result)
			die("UserID already exists"); 
		else
		{
			$result=mysql_query("create table ".$_POST["userid"]."_notes(NoteID int primary key,UserID varchar(20),note_title varchar(20),note text,creation date,foreign key(UserID) references users(UserID));");
			if(!result)
			{
				die("Unable to create Data space");
			}
			else
			{
				$_SESSION["uid"]=$_POST["userid"];
				$_SESSION["uname"]=$_POST["username"];
				$_SESSION["pass"]=$_POST["password"];
				header("Location: main.php");
			}
		}
		mysql_close();
	}
?>