<?php
	$eid= $_GET['eid'];
	
	$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="DELETE FROM x_events WHERE eid =".$eid;

	if(mysqli_query($conn, $sql)) {
		$sql1 = "DELETE FROM x_eveb WHERE eid =".$eid;
		if(mysqli_query($conn, $sql1))
		{
    		echo '<h1 style="color: red; text-align: center;">Event deleted successfully !!!!<h1>';
    	}
    	else 
		{
    		echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
		}
	}
	else 
	{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	header("refresh:2;url=../admin_user.php");
	exit;
?>