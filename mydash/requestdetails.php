<?php 
session_start();

	include("../files/logincon.php");
	include("../files/functions.php");

	$user_data = check_login($con);
	$branch_code = $user_data['branch_code'];

	include("../files/requestsconn.php");
	$id = $_GET['id'];
   $request_details = "SELECT * FROM requests WHERE id='$id'";
	$details = mysqli_query($conn, $request_details);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>REQUEST N: <?php echo "$id"; ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<link rel="shortcut icon" href="" />
	<script src="../assets/js/username.js"></script>
	<script src="../assets/js/yesno.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="../assets/css/general.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="index.php"><img src="../assets/photos/logo.jpg" style="width: 100%; height: 100%;"></a>
		</div>
		<div class="user">
			<button class="usermenu" onclick="myFunction()">
				<?php echo $user_data['branch_name']; ?> - <?php echo $user_data['branch_code'];?> 
			</button>
			<div id="dropdown" class="usermenu_content">
				<a href="#">My Profile</a>
				<a href="../logout.php">Log Out</a>
			</div>
		</div>
		<div class="middle">
			<button class="createrequest">
				<a href="newrequest.php">CREATE NEW REQUEST</a> 
			</button>
		</div>
	</div>
	<div class="body">
		<div class="navbar">
			<a href="index.php"><img class="navlogo" src="../assets/photos/home.png" >   HOME</a>
			<a href="myrequests.php"><img class="navlogo" src="../assets/photos/myrequests.png" >   MY REQUESTS</a>
			<a href="history.php"><img class="navlogo" src="../assets/photos/history.png" >   HISTORY</a>
			<a href="analysis.php"><img class="navlogo" src="../assets/photos/analysis.png" >   ANALYSIS</a>
		</div>
		<div class="result">
                  <?php
                       if (mysqli_num_rows($details) > 0) {
                       		while($row = $details->fetch_assoc()) {
                       	      $requester_store = $row["requester"];
                       	      $vendor = $row["vendor"];
                       			$article_id = $row["article_id"];
                       			$article_name = $row["article_name"];
                       			$quantity = $row["quantity"];
                       			$balance = $row["balance"];
                       			$requester= $row["requester_id"];
                       			$notes = $row["notes"];
                       			$time = $row["time"];
                       			$response = $row["response"];
                       			$vendor_id = $row["vendor_id"];
                       			$quantity_response = $row["quantity_response"];
                       			$reason = $row["reason"];
                       			if (!empty($row["response"])) {
                       			$time_response = $row["time_response"];
                       		    } else {
                       		    	$time_response = "NOT YET";
                       		    }
                       			if ($row["balance"] > 0) {
                       			$balance = $row["balance"];
                       		    } else {
                       		    	$balance = "NOT MENTIONED";
                       		    }
                       			echo "<table class='responsetable'>
                       			<tr><td>TIME & DATE OF REQUEST : </td> <td>$time</td> </tr>
                       			<tr><td>REQUESTER STORE : </td> <td>$requester_store</td></tr>
                       			<tr><td>EMPLOYEE CODE : </td> <td>$requester</td></tr>
                       			<tr><td>ARTICLE : </td> <td>$article_id</td></tr>
                       			<tr><td>ARTICLE NAME : </td> <td>$article_name</td></tr>
                       			<tr><td>quantity : </td> <td>$quantity</td></tr>
                       			<tr><td>BALANCE : </td> <td>$balance</td></tr> 
                       			<tr><td>ADDITIONAL NOTES : </td> <td>$notes</td> </tr>
                       			<tr><td>TIME OF RESPONSE : </td> <td>$time_response</td> </tr>
                       			<tr><td>VENDOR STORE : </td> <td>$vendor</td></tr>
                       			<tr><td>EMPLOYEE CODE : </td> <td>$vendor_id</td></tr>
                       			<tr><td>RESPONSE : </td> <td>$response</td> </tr>
                       			<tr><td>QUANTITY TO ISSUE : </td> <td>$quantity_response</td> </tr>
                       			<tr><td>REASON FOR REJECTION : </td> <td>$reason</td></tr>";
                       		}
                       		echo "</table>";
                       	}
                       	else {
                       	echo " 0 results";
                       }
                       ?>
		</div>
	</div>
</body>