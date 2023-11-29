<?php

session_start();

if(isset($_SESSION['branch_name']))
{
	unset($_SESSION['branch_name']);

}

header("Location: index.php");
die;