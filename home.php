<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    </head>
<body>
<div id="wrap">
    <section id="Header">
        <nav class="navbar navbar-expand-sm navbar-light  font-weight-normal pt-0" style="background-color: #FFFFFF;">
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
    <section id="MainContent">       
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1>IIEST Bulletin</h1>
                <button class="btn btn-primary" onclick="window.location.href='board_sel_form.php';">Start Searching <strong>EVENTS</strong> Rightway</button>         
                
            </div>
        </div>
    </section>
    
</div>
    <section>
        <div id="Footer" class="d-flex justify-content-center border-top fixed-bottom pt-2" style="background-color: #FFFFFF">
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