<?php
require_once("../modules/constants.php");
require_once(API);

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
// if (isset($_POST['submit'])) {
	if (empty($_GET['email']) || empty($_GET['password'])) {
	$error = "Email or Password is invalid";
	// echo $error;
	} else {
		// Define $username and $password
		$email=$_GET['email'];
		$password=$_GET['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = connect();
		// To protect MySQL injection for Security purpose
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($connection,"SELECT * FROM users where password='$password' AND useremail='$email'");

		if (($rows = mysqli_num_rows($query)) == 1) {
			$result = mysqli_fetch_array($query);
			$_SESSION['user_id'] = $result["ID"]; // Initializing Session
			$_SESSION['username'] = $result["username"];
			header("location: " . INDEX); // Redirecting To Other Page
		} else {
			$error = "Email or Password is invalid";
			// echo $error;
		}
	}
// }
?>
