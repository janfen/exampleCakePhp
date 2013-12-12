<?php

 if (isset($_POST['Msg'])) {
/*
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("chat", $con);

$ddd=$_POST['text'];
	$query = "INSERT INTO message (message) VALUES ('$ddd')";
	
} */
try {
	$username ='root';
	$password = 'example';
    $conn = new PDO('mysql:host=localhost;dbname=ChatSystem', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
function addMessage( $login, $message ) { 

	global $conn;
   	if ( $login == '' ) { return; }
	if ( $message == '' ) { return; } 
	$dateCreate=date('d/m/Y h:i:s a', time());
	$st = $conn->prepare('INSERT INTO HistoryChat(frmUser,toUser, Msg, Time) VALUES (?,?,?,?)');
	$data = array($login,'janfen',$message, $dateCreate );
	//echo $dateCreate;
	$st->execute($data);
}
function updateMessage( $id, $message ) { 

	global $conn;
	if ( $message == '' ) { return; } 
	$sql = "UPDATE `HistoryChat` SET `Msg`='".$message."' WHERE `id`='".$id ."'";
	$count = $conn->exec($sql);

	$conn = null;        // Disconnect
}
if (isset($_POST['ID'])) {
	updateMessage( $_POST['ID'], $_POST['Msg'] );
}
else
{
	addMessage( $_POST['frmUser'], $_POST['Msg'] );
}
}
?>