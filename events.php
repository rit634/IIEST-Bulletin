<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>events</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/event.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a8f317beae.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
  <body>
<div id="wrap">
    <section id="Header">
        <nav class="navbar navbar-expand-sm navbar-light  font-weight-normal pt-0" style="background-color: #FFFFFF">
            <a class="navbar-brand" href="home.php">IIEST<strong>Bulletin</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse mr-0 justify-content-end" id="navbarToggler">
            <ul class="navbar-nav mt-1">
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a id="profile" class="nav-link" href="events.php"><i class="fa fa-user-circle-o fa-2x text-primary" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a id="login" class="nav-link text-white btn btn-danger mr-2 btn-sm-lg" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a id="login" class="nav-link text-primary btn btn-outline-primary mr-2 btn-sm-lg" href="login.php">LogIn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary" href="sform.php">SignUp</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        </nav>
    </section>
   <?php 	
    	if(isset($_SESSION['user']))
    	{
    		$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
            if(mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $uid = $_SESSION['user'];
            $sql="select * from x_pref where uid =".$uid.";";
            $result = mysqli_query($conn,$sql);
            $ebid = array();
            if(mysqli_num_rows($result) > 0)
            {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $ebid [$i] = $row["ebid"];
                    $i ++;
                }
            }
        }
        else
        {
        	$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
        	$ebid = array();
        	$i = 0;
        	unset($_POST['add']);
        	foreach($_POST as $x => $x_value)
        	{
        		$ebid[$i] = $x;
        		$i ++;
        	}

        }
            
            $j = 0;
            $eid = array();
            for($i=0; $i < count($ebid); $i ++)
            {
                $sql="select * from x_eveb where ebid =" . $ebid[$i].";"; 
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $eid[$j] = $row["eid"];
                        $j ++;
                    }
                }
            }
            $eid=array_values(array_unique($eid,SORT_NUMERIC));
            
            
            // for($i=0; $i < count($eid); $i ++)
            // {
            //     echo "<h1>".$eid[$i]."</h1>";
            // }
            
        
    ?> 
   	<section id="mainBody">
    		<div class="container-fluid event-board mb-3">
				 <div class="row">
				 	<!-- <div class="col-4 d-flex flex-column">
				 		<p class="text-center pt-1">Filters</p>
				 		<button class="btn btn-primary btn-sm">Apply</button>
				 	</div> -->
				 	<div class="col-8 mx-auto event-card-title mt-2">
						<h1 class="text-center pt-1 text-primary">Events</h1>
				 	</div>
				 </div>
    		<?php 
                for($i = 0; $i < count($eid); $i ++)
                {
                    $sql="select * from x_events where eid =" . $eid[$i].";"; 
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
            ?>
                <div class="row">
                    <div class="col-8 text-center mx-auto event-card mt-3"> 
                        <div class="d-flex justify-content-between">
                            <h4><?php echo $row["ename"] ?></h4>
                            <p> <?php echo $row["edate"]; ?></p>
                        </div>
                        <p><?php echo $row["edesc"] ?></p>
                    </div>
                </div>
            <?php }  ?>
            </div>
    <?php mysqli_close($conn); ?> 
    </section>
 </div>
   <section>
        <div id="Footer" class="d-flex justify-content-center border-top pt-2" style="background-color: #FFFFFF">
            <p>© 2019 IIEST<strong>Bulletin</strong></p>
            <a href="login.php" class="text-primary pl-2">Login</a>
            <a href="sform.php" class="text-danger pl-2">SignUp</a>
        </div>            
    </section>
    <script>
        var h = $('#Footer').height();
        var wrappingHeight=$(window).height()-h;
        $('#wrap').css("min-height",wrappingHeight);
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>