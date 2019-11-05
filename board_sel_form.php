<!DOCTYPE html>
<html>
    <head>
    	<title>Selection Board</title>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="css/board_sel_form.css">
    	<link href="https://fonts.googleapis.com/css?family=Alegreya|B612|Sail|Roboto&display=swap" rel="stylesheet">
    	<script src="https://kit.fontawesome.com/a8f317beae.js" crossorigin="anonymous"></script>

    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>	
        <style>
            details >summary.nochild
            {
            	list-style-type: none;
            }
            details > summary.nochild::-webkit-details-marker
            {
            	display: none;
            }
            ul{
                list-style-type: none;
            }
        </style>
            
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
                        <a id="logout" class="nav-link text-white btn btn-danger mr-2 btn-sm-lg" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        </nav>
	</section>
	<section id="mainBody">
		<div class="container-fluid">
			<div class="row mb-5">
				<div class="col-7 card mx-auto pb-3">
					<div class="row mx-auto">
						<h1>SELECT DESIRED  GROUP</h1>
					</div>
					<div class="row mx-auto">
		        	<form action="events.php" method="POST" >
						<?php
			                $conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
			                if (mysqli_connect_errno())
			                {
			                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
			                }
			                
			                $root=new Node();

			                populate_tree($conn,$root,0);

			                mysqli_close($conn);



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
			         <div class="row">
						<button type="submit" name="add" class="btn btn-primary">ADD</button>
					</div> 
			    </div>
			</div>
        	</form>
            <!-- <ul>
                <li>
                    <details>
                        <summary>CST DEPT</summary>
                        <ul>
                            <li>
                                <details>
                                    <summary>UG</summary>
                                    <ul>
                                        <li>
                                            <details>
                                                <summary class="nochild">
                                                    <input type="checkbox" name="5">1ST YEAR
                                                </summary>
                                            </details>
                                        </li>
                                        <li>
                                            <details>
                                                <summary class="nochild">
                                                    <input type="checkbox" name="6">2ND YEAR
                                                </summary>
                                            </details>
                                        </li>
                                        <li>
                                            <details>
                                                <summary class="nochild">
                                                    <input type="checkbox" name="7">3RD YEAR
                                                </summary>
                                            </details>
                                        </li>
                                        <li>
                                            <details>
                                                <summary class="nochild">
                                                    <input type="checkbox" name="8">4TH YEAR
                                                </summary>
                                            </details>
                                        </li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <details>
                                    <summary class="nochild">
                                        <input type="checkbox" name="4" >PG
                                    </summary>
                                </details>
                            </li>
                        </ul>
                    </details>
                </li>
                
                <li>
                    <details>
                        <summary class="nochild">
                            <input type="checkbox" name="2">QUIZ MANIAC BEINGS
                        </summary>
                    </details>
               </li>   
            </ul> -->

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>      
   