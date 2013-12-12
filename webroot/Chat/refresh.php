<?php
/* $con = mysqli_connect("localhost","root","example");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("chat", $con);

$result = mysql_query("SELECT * FROM HistoryChat ORDER BY ID DESC");


while($row = mysql_fetch_array($result))
  {
  echo '<p>'.'<span>'.$row['sender'].'</span>'. '&nbsp;&nbsp;' . $row['message'].'</p>';
  }

mysql_close($con); */

try {
	$username ='root';
	$password = 'example';
    $conn = new PDO('mysql:host=localhost;dbname=ChatSystem', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$statement = $conn->query('SELECT ID, frmUser, toUser, Msg, Time FROM HistoryChat');
	$statement->execute();
	$statement->setFetchMode(PDO::FETCH_OBJ);
	while($row = $statement->fetch()){
		$prm= 'onclick=updateMessage('.$row->ID.');';
		echo '<p>'.'<span>'.$row->frmUser.'</span>'. '&nbsp;&nbsp;' . $row->Msg.' <span><input name="'.$row->ID.'" type="hidden" value="'.$row->Msg.'"/> <input type="button" value="Delete" onclick="deleteMessage('.$row->ID.');"/></span><span><input type="button" value="Update" ';
		echo "onclick=\"updateMessage(".$row->ID.",'".$row->frmUser."','".$row->Msg."');\"";
		echo '></span></p>';
	}
	$conn=null;
?>
