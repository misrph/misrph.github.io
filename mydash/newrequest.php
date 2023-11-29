<?php 
session_start();

	include("../files/logincon.php");
	include("../files/functions.php");

	$user_data = check_login($con);
	$branch_code = $user_data['branch_code'];

	include("../files/requestsconn.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$vendor = $_POST['vendor'];
		$article_id = $_POST['article_id'];
		$article_name = $_POST['article_name'];
		$quantity = $_POST['quantity'];
		$balance = $_POST['balance'];
		$requester_code = $_POST['requester_code'];
		$notes = $_POST['notes'];



                $insquery = "insert into requests (vendor, requester, article_id, article_name, quantity, balance, requester_id, notes) values ('$vendor', '$branch_code', '$article_id', '$article_name', '$quantity', '$balance', '$requester_code', '$notes')";

			mysqli_query($conn, $insquery);

			header("Location: myrequests.php");
			die;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>STO DASHBOARD</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<link rel="shortcut icon" href="" />
	<script src="../assets/js/username.js"></script>
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
			<button class="createrequest active">
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
			<form id="insert" method='POST'>
                                   <input class="newrequestform" type="list" name="vendor" placeholder="VENDOR * EX: S001" required/></span>
                                   <input class="newrequestform" type="text" name="article_id" placeholder="ARTICLE CODE *" required/></span>
                                   <input class="newrequestform" type="text" name="article_name" placeholder="ARTICLE NAME"/></span>
                                   <input class="newrequestform" type="number" name="quantity" placeholder="QUANTITY REQUIRED *"required/></span>
                                   <input class="newrequestform" type="number" name="balance" placeholder="VENDOR'S BALANCE"/></span>
                                   <input class="newrequestform" type="text" name="requester_code" placeholder="YOUR EMPLOYMENT CODE IN COMPANY *"required/></span>
                                   <input class="newrequestform" type="text" name="notes" placeholder="ANY ADDITIONAL NOTES"/></span>
                                   <br><br>
                                   <input class="newrequestform" id="button" type="submit" value="Submit">
            </form>
		</div>
	</div>
</body>