<?php
include "../modules/constants.php";
include API;

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
// if (isset($_POST['submit'])) {
	if (empty($_GET['email']) || empty($_GET['username']) || empty($_GET['password']) || empty($_GET['confirmpassword'])) {
	$error = "Please fill in all required form fields!";
	// echo $error;
	} else {
		$connection = connect();
		// Define $username and $password
		$email = $_GET['email'];
		$username = $_GET['username'];
		$password = $_GET['password'];
		$confirmpassword = $_GET['confirmpassword'];
		$email = stripslashes($email);
		$username = stripslashes($username);
		$password = stripslashes($password);
		$confirmpassword = stripslashes($confirmpassword);
		$email = mysqli_real_escape_string($connection, $email);
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);
		$confirmpassword = mysqli_real_escape_string($connection, $confirmpassword);
		$connection->close();
		if ($password !== $confirmpassword) {
			$error = "Confirmation password does not match password!";
		} else {
			$createuserstatus = createUser($username, $password, $email);
			if ($createuserstatus[0] === 0) {
				$_SESSION['user_id'] = $createuserstatus[1];
				$_SESSION['username'] = $username;
				header("location: " . INDEX);
			} else if ($createuserstatus[0] === 1) {
				$error = "That username already exists.";
			} else {
				$error = "There already exists an account with that email address.";
			}
			// // Establishing Connection with Server by passing server_name, user_id and password as a parameter
			// $connection = connect();
			// // To protect MySQL injection for Security purpose
			// $email = stripslashes($email);
			// $password = stripslashes($password);
			// $email = mysqli_real_escape_string($connection, $email);
			// $password = mysqli_real_escape_string($connection, $password);

			// // SQL query to fetch information of registerd users and finds user match.
			// $query = mysqli_query($connection,"SELECT * FROM users where password='$password' AND useremail='$email'");

			// if (($rows = mysqli_num_rows($query)) == 1) {
			// 	$result = mysqli_fetch_array($query);
			// 	$_SESSION['user_id'] = $result["ID"]; // Initializing Session
			// 	$_SESSION['username'] = $result["username"];
			// 	header("location: " . INDEX); // Redirecting To Other Page
			// } else {
			// 	$error = "Email or Password is invalid";
			// 	// echo $error;
			// }
		}
	}
// }
?>
