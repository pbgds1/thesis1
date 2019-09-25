<?php
$db =	new PDO('mysql:host=localhost;dbname=db_user', 'root', '');
$page = isset($_GET['p'])?$_GET['p']:'';

if($page == "add") {
	$fn = $_POST['Firstname'];
	$ln = $_POST['Lastname'];
	$em = $_POST['Email'];
	$query = $db->prepare("INSERT INTO user VALUES('',?,?,?)");
	$query->bindParam(1,$fn);
	$query->bindParam(2,$ln);
	$query->bindParam(3,$em);
	if($query->execute()){
		echo "Success add data";
	}
	else {
		echo "Fail add data";
	}
}

}
?>
