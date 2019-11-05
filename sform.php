<?php
	session_start();  // session starts
?>

<html>
	<head>
		<title> Login Page   </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="css/sform.css">
    	<link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto card">
					<div class="form-title text-center">
						<h1>Sign Up</h1>
					</div>
					<div class="form-content">
						<form action="" method="post">
							<div class="row form-group">
								<div class="col-sm-4 px-3">
									<label>Name : </label>
								</div>
								<div class="col-sm-8">
									 <input type="text" name="name" required>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-4 px-3">
									<label>UserId : </label>
								</div>
								<div class="col-sm-8">
									 <input type="text" name="user" required>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-sm-4 px-3">
									<label>Password :</label>
								</div>
								<div class="col-sm-8">
									 <input type="password" name="pass"  required>
								</div>
							</div>
							<div class="row form-group-btn d-flex justify-content-end">
								<button type="submit" name="sup" class="btn btn-primary">Sign Up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>

<!-- <html>
	<head>

		<title>SignUp Page</title>

	</head>

	<body>

		<form action="" method="post">

			<table width="200" border="0">
				<tr>
					<td>Name</td>
					<td> <input type="text" name="name" > </td>
				</tr>
				<tr>
					<td>UserId</td>
					<td> <input type="text" name="user" > </td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td> <input type="submit" name="sup" value="SUBMIT"></td>
					<td></td>
				</tr>
			</table>
		</form>

	</body>
</html> -->



<?php

	if(isset($_SESSION['user']))//checks for existing session
	{
		header("Location:events.php");
	}
	else if(isset($_POST['sup']))// it checks whether the user clicked signup button or not 
	{
		$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			return;
		}
		
		$user = $_POST['user'];
		$name = $_POST['name'];
		$pass = $_POST['pass'];
		
		$sql="SELECT passwd FROM x_dummy WHERE sid = ".$user.";";
		$result=$conn->query($sql);

		if(!$result)
		{
			echo "Failed!!!";
			return;
		}
		
		if($result->num_rows==0)
		{
			$sql="INSERT INTO x_dummy VALUES(".$user.",'".$name."','".$pass."');";
			$conn->query($sql);
			$_SESSION['user']=$user;
			header("Location:events.php");
		}
		else
			echo 'User already exists!!! Please login.<button onclick="window.location.href = "login.php";" >Login</button>';
		
		mysqli_close($conn);
	}
?>