<?php
	session_start();
	$uname=$_SESSION["uname"];
	$uid=$_SESSION["uid"];
	$pass=$_SESSION["pass"];
	$notes=$uid."_notes";
	$noteid=$_SESSION["noteid"];
	mysql_connect("localhost","root","");
	@mysql_select_db("simplenote") or die( "Unable to select database");
	$result=mysql_query("select note_title,note from ".$notes." where NoteID=".$noteid.";");
	if(!$result)
		die("error edit.php line 11"); 
	else
	{
		$to = $_POST["email"];
        $subject = mysql_result($result,0,"note_title");
        $message =mysql_result($result,0,"note");
        $retval = mail ($to,$subject,$message,$header);
        if($retval==true)
        {
            header("Location: main.php");
         }else {
            header("Location: main.php");
         }
	}

?>