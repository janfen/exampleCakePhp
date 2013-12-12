<?php 
session_start();

/* if(isset($_POST['submit']))
{
try {
	$username ='root';
	$password = 'example';
    $conn = new PDO('mysql:host=localhost;dbname=ChatSystem', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
// Add message into system 
	/* $message=$_POST['message'];
	$sender=$_POST['sender'];
	if ( $sender != '' && $message != '') { 
		$st = $conn->prepare('INSERT INTO HistoryChat(frmUser,toUser, Msg, Time) VALUES (?,?,?,?)');
		$data = array($sender,'janfen',$message, $dateCreate );
		//echo $dateCreate;
		$st->execute($data);
	} */
/* } */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Chat</title>
<script language="javascript" src="jquery-1.2.6.min.js"></script>
<script language="javascript" src="jquery.timers-1.0.0.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	flagUpdateChat =false;
	indexMessage = -1;
   var j = jQuery.noConflict();
	j(document).ready(function()
	{
		j(".refresh").everyTime(1000,function(i){
			j.ajax({
			  url: "refresh.php",
			  cache: false,
			  success: function(html){
				j(".refresh").html(html);
				var elem = document.getElementById('content');
				elem.scrollTop = elem.scrollHeight;
			  }
			})
		});
		
	});
	j(document).ready(function() {
			j('#post_button').click(function() {
				//$text = $('#post_text').val();
				//console.log(document.getElementsByName("message")[0].value);
				if(flagUpdateChat){
				//console.log("vao day nao cac tinh yeu oi");
					 j.ajax({
						type: "POST",
						cache: false,
						url: "save.php",
						data: "Msg="+ document.getElementsByName("message")[0].value +"&ID=" + indexMessage,
						success: function(data) {
							//alert('data has been stored to database');
							flagUpdateChat=false;
							indexMessage=-1;
							document.getElementsByName("message")[0].value="";
							document.getElementsByName("sender")[0].value="";
						}
					}); 
				}
				else{
					j.ajax({
						type: "POST",
						cache: false,
						url: "save.php",
						data: "Msg="+ document.getElementsByName("message")[0].value + "&frmUser=" +document.getElementsByName("sender")[0].value,
						success: function(data) {
							//alert('data has been stored to database');
							flagUpdateChat=false;
							indexMessage=-1;
							document.getElementsByName("message")[0].value="";
							document.getElementsByName("sender")[0].value="";
						}
					}); 
				}
			});
		});
   j('.refresh').css({color:"green"});
});
function deleteMessage(idMessage){
	
	var j = jQuery.noConflict();
	j.ajax({
		type: "POST",
		cache: false,
		url: "delete.php",
		data: "idMessage="+ idMessage,
		success: function(data) {
			//alert('data has been stored to database');
			if(indexMessage==idMessage){
				flagUpdateChat=false;
				indexMessage=-1;
				document.getElementsByName("message")[0].value="";
				document.getElementsByName("sender")[0].value="";
			}
			j.ajax({
			  url: "refresh.php",
			  cache: false,
			  success: function(html){
				j(".refresh").html(html);
			  }
			});
		}
	});
}

function updateMessage(idMessage, frmUser, Msg){
	flagUpdateChat=true;
	indexMessage=idMessage;
	document.getElementsByName("message")[0].value =Msg;
	document.getElementsByName("sender")[0].value =frmUser;
}
</script>
<style type="text/css">
.refresh {
    border: 1px solid #3366FF;
	border-left: 4px solid #3366FF;
    color: green;
    font-family: tahoma;
    font-size: 12px;
    height: 225px;
    overflow: auto;
    width: 400px;
	padding:10px;
	background-color:#FFFFFF;
}
#post_button{
	border: 1px solid #3366FF;
	background-color:#3366FF;
	width: 100px;
	color:#FFFFFF;
	font-weight: bold;
	margin-left: -105px; padding-top: 4px; padding-bottom: 4px;
	cursor:pointer;
}
#textb{
	border: 1px solid #3366FF;
	border-left: 4px solid #3366FF;
	width: 320px;
	margin-top: 10px; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; width: 415px;
}
#texta{
	border: 1px solid #3366FF;
	border-left: 4px solid #3366FF;
	width: 410px;
	margin-bottom: 10px;
	padding:5px;
}
p{
border-top: 1px solid #EEEEEE;
margin-top: 0px; margin-bottom: 5px; padding-top: 5px;
}
span{
	font-weight: bold;
	color: #3B5998;
}
</style>
</head>
<body>
<form method="POST" name="" action="">
<input name="sender" type="text" id="texta" value="<?php echo $sender ?>"/>
<div class="refresh" id ="content">
<?php
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

</div>
<input name="message" type="text" id="textb"/>
<input name="submit" type="button" value="Chat" id="post_button" />
</form>
</body>
</html>
