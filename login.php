<?php
	session_start();  // session starts
?>

<html>
	<head>
		<title> Login Page   </title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="css/login.css">
    	<link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	</head>
	<body>
		<section id="Header">
        	<nav class="navbar navbar-expand-sm navbar-light  font-weight-normal pt-0" style="background-color: #FFFFFF;">
            	<a class="navbar-brand" href="home.php">IIEST<strong>Bulletin</strong></a>
          	</nav>
        </section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-sm-auto card">
					<div class="form-title text-center">
						<h1>Login</h1>
					</div>
					<div class="form-content">
						<form action="" method="post">
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
								<button type="submit" name="login" class="btn btn-primary">Login</button>
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



<?php

	if(isset($_SESSION['user']))//checks for existing session
	{
		header("Location:events.php");
	}
	else if(isset($_POST['login']))// it checks whether the user clicked login button or not 
	{
		$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		$sql="SELECT passwd FROM x_users WHERE uid = ".$user.";";
		$result=$conn->query($sql);
		if(!$result)
		{
			echo "Failed!!!";
			return;
		}
		
		if($result->num_rows>0)
		{
			$row=$result->fetch_assoc();
			if($row['passwd']==$pass)
			{
				$_SESSION['user']=$user;
				header("Location:events.php");
			}
			else
				echo "Password is incorrect!!! Try again.";
		}
		else
			echo "UserId does not exist!!!";
		
		mysqli_close($conn);
	}
?>