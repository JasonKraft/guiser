<?php
	require_once("../modules/constants.php");
	require_once(API);

	$connection = connect();

	session_start();// Starting Session
	// Storing Session
	if (isset($_SESSION['user_id'])) {
		$user_check=$_SESSION['user_id'];
		// SQL Query To Fetch Complete Information Of User
		$ses_sql=mysqli_query($connection, "SELECT * from users where ID='$user_check'");
		$row = mysqli_fetch_array($ses_sql);
		$login_session = $row['username'];
		if(!isset($login_session)){
			$connection->close(); // Closing Connection
			// header('Location: ' . INDEX); // Redirecting To Home Page
		}
	}
?>