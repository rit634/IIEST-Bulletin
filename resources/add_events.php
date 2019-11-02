	
<?php
	$eid= $_POST['eid'];
	$ename=$_POST['ename'];
	$edesc=$_POST['edesc'];
	$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="INSERT INTO x_events(eid,ename,edesc) VALUES (".$eid. ",'$ename' ,'$edesc');";
	if (mysqli_query($conn, $sql)) {
    	echo '<h1 style="color: blue; text-align: center;">Event added successfully !!!!<h1>';
	}
	else 
	{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	header("refresh:2;url=../admin_user.php");
	exit;
?>