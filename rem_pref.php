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
        $sql="delete from x_pref where uid =".$uid.";";
        $result = mysqli_query($conn,$sql);

        mysqli_close($conn);
        
        header("Location:board_sel_form.php");
    }
    else
        header("Location:board_sel_form.php");
?>