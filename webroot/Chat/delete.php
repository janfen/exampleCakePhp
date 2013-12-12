<?php

if (isset($_POST['idMessage'])) {
	try {
		$username ='root';
		$password = 'example';
		$conn = new PDO('mysql:host=localhost;dbname=ChatSystem', $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "DELETE FROM `HistoryChat` WHERE `ID` ='" . $_POST['idMessage'] ."'";
		
		$count = $conn->exec($sql);
		$conn = null;   
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
}
?>