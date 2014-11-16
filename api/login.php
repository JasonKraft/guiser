<?php
include "../modules/constants.php";
include API;

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
	$error = "Email or Password is invalid";
	} else {
		// Define $username and $password
		$email=$_POST['email'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = connect();
		// To protect MySQL injection for Security purpose
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);

		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query("SELECT * FROM users where password='$password' AND useremail='$useremail'", $connection);

		if (($rows = mysqli_num_rows($query)) == 1) {
			$_SESSION['login_user']=$email; // Initializing Session
			header("location: index.php"); // Redirecting To Other Page
		} else {
			$error = "Email or Password is invalid";
		}
	}
}	