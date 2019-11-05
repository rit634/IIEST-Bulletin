<?php
	session_start();
    if(isset($_SESSION['user']))
    {
        $conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $flag = 0;
        $uid = $_SESSION['user'];
        $sql="select type from x_users where uid =".$uid.";";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row["type"] == "admin")
        {
            $flag =1;   
        }
    }
    else
    {
        header("Location:login.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/admin_user.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a8f317beae.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
  <body>
    <section id="Header">
        <nav class="navbar navbar-expand-sm navbar-light  font-weight-normal pt-0" style="background-color: rgba(208, 245, 245, 0.747)">
            <a class="navbar-brand" href="home.php">IIEST<strong>Bulletin</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse mr-0 justify-content-end" id="navbarToggler">
            <ul class="navbar-nav mt-1">
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a id="profile" class="nav-link" href="user.php"><i class="fa fa-user-circle-o fa-2x text-primary" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a id="login" class="nav-link text-white btn btn-danger mr-2 btn-sm-lg" href="logout.php">Logout</a>
                    </li>
            <?php endif; 
                if($flag == 1)
                {
            ?>
                    <li class="nav-item">
                        <a id="admin" class="nav-link text-white btn btn-primary mr-2 btn-sm-lg" href="admin_user.php">admin</a>
                    </li>
            <?php
                }
            ?>                    
            </ul>
        </div>
        </nav>
    </section>
   
    <section id="mainBody">
    		<div class="container-fluid event-board">
				 <div class="row mt-5">
				 	<div class="col-8 border mx-auto card pb-3">
						<div class="row mx-auto">
                            <h1 class="text-primary">Your Detail</h1>
                        </div>
                        <?php
                        
                            $sql="SELECT * FROM x_users WHERE uid = ".$_SESSION['user'].";";
                            $result=$conn->query($sql);
                            
                            if(!$result)
                            {
                                echo "Failed!!!";
                                return;
                            }
                            
                            if($result->num_rows>0)
                            {
                                $row=$result->fetch_assoc();

                        ?>
                        <div class='row'>
                            <div class='col-9 text-center mx-auto event-card mt-3 pt-2'>
                                <div class='d-flex justify-content-between'>
                                    <strong>Enrollment Id: </strong>
                                    <span><?php echo $row['uid']; ?></span>
                                </div>
                            </div>
                        </div>  
                        <div class='row'>
                            <div class='col-9 text-center mx-auto event-card mt-3 pt-2'>
                                <div class='d-flex justify-content-between'>
                                    <strong>Name: </strong>
                                    <span><?php echo $row['name']; ?></span>
                                </div>
                            </div>
                        </div>   

                        <div class='row'>
                            <div class='col-9 text-center mx-auto event-card mt-3 pt-2'>
                                <div class='d-flex justify-content-between'>
                                    <strong>Email: </strong>
                                    <span><?php echo $row['email']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-10 text-center mx-auto mt-3 pt-2'>
                                <div class='d-flex justify-content-between'>
                                   <a  class="nav-link text-white btn btn-primary" href="#">Change password</a>
                                   <a  class="text-white btn btn-primary" href="rem_pref.php">Change Preferences</a> 
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
                
                <?php
                        
                    }
                    else
                        echo "UserId does not exist!!!";
                    
                    mysqli_close($conn);
                ?>
        </div>
    </section>
 
    <section>
        <div id="Footer" class="d-flex justify-content-center fixed-bottom border-top pt-2">
            <p>© 2019 IIEST<strong>Bulletin</strong></p>
            <a href="login.php" class="text-dark pl-2">Login</a>
            <a href="sform.php" class="text-dark pl-2">SignUp</a>
        </div>            
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>