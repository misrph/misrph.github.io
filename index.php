<?php
session_start();

  include("files/logincon.php");
  include("files/functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $branch_code = $_POST['branch_code'];
    $password = $_POST['password'];

    if(!empty($branch_code) && !empty($password) && !is_numeric($branch_code))
    {

      //read from database
      $query = "select * from users where branch_code = '$branch_code' limit 1";
      $result = mysqli_query($con, $query);

      if($result)
      {
        if($result && mysqli_num_rows($result) > 0)
        {

          $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['password'] === $password)
          {

            $_SESSION['branch_name'] = $user_data['branch_name'];
            header("Location: mydash/index.php");
            die;
          }
        }
      }
      
      echo "wrong username or password!";
    }else
    {
      echo "wrong username or password!";
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/general.css" rel="stylesheet">
    <title>DASHBOARD LOGIN</title>
</head>
<body style="background-image: url('../assets/photos/bg-01.jpg');background-size: cover;">
	<div class="form_outbox">
	 <div class="form_inbox">
	  <form method="post">
        <div class="login_form">
	        <img class="loginlogo" src="assets/photos/logo.jpg">
            <input id="branch_code" name="branch_code" class="login" type="text" placeholder="Enter Your Branch Code" required>
        </div>

        <div class="login_form">                                              
            <input id="password" type="password" class="login" name="password" placeholder="********" required>
        </div>
              
        <div class="login_form">
            <div class="btn_uy">
                <input class="loginsubmit" id="button" type="submit" class="submit" value="Login">
            </div>
        </div>
      </form>
     </div>
    </div>
</body>