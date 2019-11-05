<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$ename=$_POST['ename'];
	$edesc=$_POST['edesc'];
	$edate=$_POST['edate'];
	$etime=$_POST['etime'];

	// $ename="Batch Party";
	// $edesc="Welcome to a batch party!!";
	// $edate='10/30/2019 10:00 AM';

	echo $edate."<br>".$etime;

	$yr=strtok($edate,'/:');
	$month=strtok('/');
	$date=strtok('/');

	$hr=strtok($etime,':');
	$min=strtok(':');
	$m=strtok(':');

	$conn = mysqli_connect("localhost","btech2017","btech2017","btech2017");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="INSERT INTO x_events(ename,edesc,edate) VALUES ('$ename' ,'$edesc','$yr-$month-$date $hr:$min');";
	if (mysqli_query($conn, $sql)) {
    	echo '<h1 style="color: blue; text-align: center;">Event added successfully !!!!<h1>';
	}
	else 
	{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	//ARRAY FOR EVENTBOARDS TO WHICH THE EVENT IS RELATED
	//$ea = array(5,6);

	$sql="SELECT eid FROM x_events ORDER BY eid DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql);
	$row=$result->fetch_assoc();
	$newid=$row['eid'];

	echo $newid;

	$ea = array();
    unset($_POST['add']);
    unset($_POST['ename']);
    unset($_POST['edesc']);
    unset($_POST['edate']);
    unset($_POST['etime']);
    foreach($_POST as $x => $x_value){
    	$ea[] = $x;
    	$sql="INSERT INTO x_eveb VALUES ({$newid},{$x});";
		mysqli_query($conn, $sql);
    }
    // for($i=0; $i < count($ea); $i ++)
    // {
    //     echo "<h1>".$ea[$i]."</h1>";
    // }
	sendemails($conn,$ea,$ename);

	mysqli_close($conn);

	//header("refresh:2;url=../admin_user.php");
	exit;

	function sendemails(&$conn,&$ebarr,$ename)
	{
		$param='';
		for($i=0;$i<count($ebarr)-1;$i++)
			$param.=" ebid = $ebarr[$i] OR ";
		$param.=" ebid = $ebarr[$i]";

		$sql="SELECT DISTINCT email FROM x_users INNER JOIN x_pref ON x_users.uid=x_pref.uid WHERE".$param.";";

		$result=$conn->query($sql);

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'eventlerteam@gmail.com';                     // SMTP username
		    $mail->Password   = 'Eventler@g1';                               // SMTP password
		    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		    $mail->Port       = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('eventlerteam@gmail.com', 'Eventler Team');
		    while($row=$result->fetch_assoc())
		        $mail->addAddress($row['email']);

		    // $mail->addReplyTo('info@example.com', 'Information');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    // Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Alert for a new upcoming event!!!';
		    $mail->Body    = "<h4>{$ename} is coming up...</h4>Tighten your seatbelts for a new event aligning to your interests has come up.<br><a href=".'cs.iiests.ac.in/~adityavc/eventler/login.php'.">Login</a> to your portal to see further details about the happening.";

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
?>