<?php
    session_start();
    if(isset($_SESSION['user']))
    {
        $conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
        if(mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $uid = $_SESSION['user'];
        $sql="select type from x_users where uid =".$uid.";";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row["type"] != "admin")
        {
            header("Location:events.php");   
        }
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
    else{
        header("Location:events.php");
    }

?>

<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/admin_user.css">
        <link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a8f317beae.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


        <script>
            function deleteEvent(eid) {
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                 var elem= document.getElementById("" + eid);
                 elem.parentNode.removeChild(elem);
                }
              };
              xhttp.open("GET", "resources/delete_events.php?eid="+eid, true);
              xhttp.send();
            }
        </script>
        
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
                        <a id="profile" class="nav-link" href="user.php"><i class="fa fa-user-circle-o fa-2x text-primary" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a id="logout" class="nav-link text-white btn btn-danger mr-2 btn-sm-lg" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        </nav>
    </section>
    <?php

        
        // $j = 0;
        // $eid = array();
        // for($i=0; $i < count($ebid); $i ++)
        // {
        //     $sql="select * from x_eveb where ebid =" . $ebid[$i].";"; 
        //     $result = mysqli_query($conn,$sql);
        //     if(mysqli_num_rows($result) > 0)
        //     {
        //         while ($row = mysqli_fetch_assoc($result)) {
        //             $eid[$j] = $row["eid"];
        //             $j ++;
        //         }
        //     }
        // }
        // $eid=array_values(array_unique($eid,SORT_NUMERIC));
    ?>

    <section id="mainBody">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-9 card mx-auto">
                    <div class="row mx-auto">
                        <h1 class="text-primary">Add Event</h1>
                    </div>
                    <form action="resources/add_events.php" method="post">
                        
                        <div class="row my-3">
                            <div class="col-3">
                                <label>Event Name:</label>
                            </div>
                                <div class="col-9">
                                <input class="input-field input-text" type="text" name="ename" required /> 
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3">
                                <label>Event desc:</label>
                            </div>
                            <div class="col-9">
                                <textarea class="input-text" name="edesc"></textarea>  
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3">
                                <label>Event date:</label>
                            </div>
                            <div class="col-9">
                                <input class="input-field" type="date" name="edate" required />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3">
                                <label>Event time:</label>
                            </div>
                            <div class="col-9">
                                <input class="input-field" type="time" name="etime" required />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-3">
                                <label>Choose Event board:</label>
                            </div>
                            <div class="col-9">
                            <?php
                                
                                
                                $root=new Node();

                                populate_tree($conn,$root,0);

                                function populate_tree(&$conn,&$root,$id)
                                {
                                    $sql="SELECT ebid FROM x_eventb WHERE pebid = $id;";

                                    $result=$conn->query($sql);
                                    if(!$result)
                                    {
                                        echo "Failed!!!";
                                        return;
                                    }

                                    $a=array();
                                    
                                    while($row=$result->fetch_assoc())
                                    {
                                        $a[]=$row['ebid'];
                                    }
                                    $cnt=count($a);
                                    
                                    $child_array[]=array($cnt);
                                    
                                    $root->setNode($id,$cnt,$child_array);

                                    //echo $id.'<br>';

                                    $sql="SELECT ebname FROM x_eventb WHERE ebid = $id;";
                                    $result=$conn->query($sql);
                                    $eventbname=strtoupper($result->fetch_assoc()['ebname']);

                                    if($cnt>0)
                                    {
                                        if($id != 0)
                                            echo '<summary>'.$eventbname.'</summary>';
                                        echo '<ul>';
                                    }
                                    else
                                    {
                                ?>
                                
                                        <summary class="nochild">
                                            <input type="checkbox" name="<?php echo $id; ?>">
                                            <?php echo $eventbname; ?>  
                                        </summary>
                                    

                                <?php
                                    }

                                    for ($i=0; $i < $cnt; $i++)
                                    {
                                        echo '<li><details>';
                                        $child_array[$i]=new Node();
                                        populate_tree($conn,$child_array[$i],$a[$i]);
                                        echo '</details></li>';
                                    }
                                    if($cnt>0)
                                        echo '</ul>';
                                }

                                class Node
                                {
                                    public $myid;
                                    public $n;
                                    public $children;

                                    function setNode($x,$i,$a)
                                    {
                                        $myid=$x;
                                        $n=$i;
                                        $children=$a;
                                    }
                                }
                            ?>
                            </div>
                        </div>
                        <div class="row mx-auto my-auto ">
                            <button type="submit" name="add" class="btn btn-primary"> Add Event </button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-9 card mx-auto pb-3">
                    <div class="row mx-auto">
                        <h1 class="text-danger">Delete Event</h1>
                    </div>
                <?php 

                    $sql="select * from x_events;";
                    $result = mysqli_query($conn,$sql);
                    // for($i = 0; $i < count($eid); $i ++)
                    // {
                        //$sql="select * from x_events where eid =" . $eid[$i].";"; 
                        
                        
                if(mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {

                        
                    
                ?>
                    <div class="row">
                        <div class="col-9 text-center mx-auto event-card mt-3 d-flex justify-content-between pt-2" id="<?php echo $row["eid"] ?>">
                            <h4><?php echo $row["ename"] ?></h4>
                            <span class="cur ml-5" onclick="deleteEvent(<?php echo $row["eid"] ?>)"><i class="fas fa-trash text-danger"></i></span>
                        </div>
                    </div>
                <?php } } ?>
                <?php mysqli_close($conn); ?> 
                </div>
            </div>
        </div>
    </section>

</div>
    <section>
        <div id="Footer" class="d-flex justify-content-center border-top pt-2 mt-3" style="background-color: #FFFFFF">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>