<?php
$connection =	mysqli_connect('localhost' , 'root' ,'' ,'db_user');




if(isset($_POST['Email'])){

	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$Email = $_POST['Email'];
	$id = $_POST['id'];

	//  query to update data

	$result  = mysqli_query($connection , "UPDATE user SET Firstname='$Firstname' , Lastname='$Lastname' , Email = '$Email' WHERE id='$id'");
	if($result){
		echo 'data updated';
	}

}
?>
