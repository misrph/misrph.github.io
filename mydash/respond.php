<?php 
session_start();

	include("../files/logincon.php");
	include("../files/functions.php");

	$user_data = check_login($con);
	$branch_code = $user_data['branch_code'];

	include("../files/requestsconn.php");
	$id = $_GET['id'];
    $request_respond = "SELECT * FROM requests WHERE id='$id'";
	$respond = mysqli_query($conn, $request_respond);


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$vendor = $_POST['vendor_id'];
		$response = $_POST['response'];
		$quantity_response = $_POST['quantity_response'];
		$reason = $_POST['reason'];

            $updatequery = "UPDATE  requests SET response='$response', vendor_id='$vendor', quantity_response='$quantity_response', reason='$reason' WHERE id='$id'";

			mysqli_query($conn, $updatequery);

			header("Location: index.php");

			die;
	}

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
                if (mysqli_num_rows($respond) > 0) {
                   
                   while($row = $respond->fetch_assoc()) {
                       	        $requester_store = $row["requester"];
                       			$article_id = $row["article_id"];
                       			$article_name = $row["article_name"];
                       			$quantity = $row["quantity"];
                       			$balance = $row["balance"];
                       			$requester= $row["requester_id"];
                       			$notes = $row["notes"];
                       			$time = $row["time"];
                   echo "<table class='responsetable'>
                   <tr><td>BRANCH</td><td>$requester_store</td></tr>
                   <tr><td>REQUESTED BY</td><td>$requester</td></tr>
                   <tr><td>ARTICLE CODE</td><td>$article_id</td></tr>
                   <tr><td>ARTICLE NAME</td><td>$article_name</td></tr>
                   <tr><td>QUANTITY</td><td>$quantity</td></tr>
                   <tr><td>YOUR BALANCE</td><td>$balance</td></tr>
                   <tr><td>ADDITIONAL NOTES</td><td>$notes</td></tr>
                   <tr><td>TIME OF REQUEST</td><td>$time</td></tr>
                   </table>";
                   }
                   }
                   else {
                   echo "";
                   }
                  ?> 
                  <br>

                <form id="respond" method='POST' name="respond">
                                   <table><tr>
                                   	<td><input type="radio" name="response" value="YES" id="yesCheck" onclick="javascript:yesnoCheck();" /> </td> 
                                   	<td>YES</td>
                                   <td> <input type="radio" name="response" id="noCheck" value="NO" onclick="javascript:yesnoCheck();" /></td> 
                                   <td>NO</td>
                                   </tr></table>
                                   <input class="respond" type="text" name="vendor_id" placeholder="YOUR EMPLOYMENT CODE *"required/></span>
                                   <input class="respond" type="number" name="quantity_response" placeholder="QUANTITY ISSUED *"required/></span>
                                   <div id="ifYes" style="visibility:hidden">
                                   <input class="respond" type="text" name="reason" id='yes' placeholder="IF NO EXPLAIN WHY *" required /></span>
                                   </div>
                                   <br><br>
                                   <input class="respond" id="button" type="submit" value="Submit">
                        </form>
		</div>
	</div>
</body>