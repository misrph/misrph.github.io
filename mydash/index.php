<?php 
session_start();

	include("../files/logincon.php");
	include("../files/functions.php");

	$user_data = check_login($con);
	$branch_code = $user_data['branch_code'];

	include("../files/requestsconn.php");
	$sql1 = "SELECT * FROM requests WHERE vendor='$branch_code' AND response IS NULL ORDER BY time DESC";
	$my_responds = mysqli_query($conn, $sql1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>STO DASHBOARD</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta http-equiv="refresh" content="10" />
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
			<button class="createrequest">
				<a href="newrequest.php">CREATE NEW REQUEST</a> 
			</button>
		</div>
	</div>
	<div class="body">
		<div class="navbar">
			<a href="#" class="active"><img class="navlogo" src="../assets/photos/home.png" >   HOME</a>
			<a href="myrequests.php"><img class="navlogo" src="../assets/photos/myrequests.png" >   MY REQUESTS</a>
			<a href="history.php"><img class="navlogo" src="../assets/photos/history.png" >   HISTORY</a>
			<a href="analysis.php"><img class="navlogo" src="../assets/photos/analysis.png" >   ANALYSIS</a>
		</div>
		<div class="result">
			<?php

                       if (mysqli_num_rows($my_responds) > 0) {
                       		echo "<table id='myrequeststable' class='reqtab'><tr><th>REQUESTER</th><th>ARTICLE</th><th>ARTICLE NAME</th><th>QUANTITY</th><th>BALANCE</th><th>EMPLOYEE ID</th><th>NOTES</th><th>TIME</th><th>STATUS</th></tr>";
                       		// output data of each row
                       		while($row = $my_responds->fetch_assoc()) { 
                       			$requester_code = $row["requester"];
                       			$article_id = $row["article_id"];
                       			$article_name = $row["article_name"];
                       			$quantity = $row["quantity"];
                       			$balance = $row["balance"];
                       			$employee_id = $row["requester_id"];
                       			$notes = $row["notes"];
                       			$time = $row["time"];
                       			$time2 = date('Y-m-d H:i:s', strtotime($time. ' + 1 HOURS'));
                       			$time3 = date('Y-m-d H:i:s', strtotime($time. ' + 2 HOURS'));
                       			date_default_timezone_set('Africa/Cairo');
                       			$current = date('Y-m-d H:i:s');
                       			$id = $row["id"];
                       			
                       		    if ($requester_code == "CC01") {
                       		    	echo "<tr style='background-color: darkred; color: white;'>
                       			<td><a style='color: white;' href='respond.php?id=$id' >$requester_code</a></td> 
                       			<td><a style='color: white;' href='respond.php?id=$id' >$article_id</a></td> 
                       			<td><a style='color: white;' href='respond.php?id=$id' >$article_name</a></td> 
                       			<td><a style='color: white;' href='respond.php?id=$id' >$quantity</a></td> 
                       			<td><a style='color: white;' href='respond.php?id=$id' >$balance</a></td>
                       			<td><a style='color: white;' href='respond.php?id=$id' >$employee_id</a></td>
                       			<td><a style='color: white;' href='respond.php?id=$id' >$notes</a></td>
                       			<td><a style='color: white;' href='respond.php?id=$id' >$time</a></td>";
                       		    	}
                       		    else {
                       			echo "<tr style='background-color: white; color: black'>
                       			<td><a style='color: black;' href='respond.php?id=$id' >$requester_code</a></td> 
                       			<td><a style='color: black;' href='respond.php?id=$id' >$article_id</a></td> 
                       			<td><a style='color: black;' href='respond.php?id=$id' >$article_name</a></td> 
                       			<td><a style='color: black;' href='respond.php?id=$id' >$quantity</a></td> 
                       			<td><a style='color: black;' href='respond.php?id=$id' >$balance</a></td>
                       			<td><a style='color: black;' href='respond.php?id=$id' >$employee_id</a></td>
                       			<td><a style='color: black;' href='respond.php?id=$id' >$notes</a></td>
                       			<td><a style='color: black;' href='respond.php?id=$id' >$time</a></td>";
                       			}
                       			if ($current > $time3) {
                       		    	echo "<td><img title='TWO HOURS PASSED' src='../assets/photos/warning2.png' style='width: 30px; height: 30px;'></td>";
                       		         }
                       		    elseif ($current > $time2 && $current < $time3) {
                       		    	echo "<td><img title='ONE HOURS PASSED' src='../assets/photos/warning1.png' style='width: 30px; height: 30px;'></td>";
                       		    }
                       		    else  {
                       			     echo "<td><img title='PLEASE RESPOND' src='../assets/photos/valid.png' style='width: 30px; height: 30px;'></td>";
                       			     } 
                       			echo "</tr>";
                       		
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