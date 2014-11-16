<?php

define ('IP', '127.0.0.1');
define ('PORT', "");
define ('USERNAME', 'root');
define ('PASSWORD', "");
define ('DATABASE', 'guiser');

function connect($ip, $port, $username, $password, $db){
	if ($port != ""){
		$ip = $ip . ":" . $port;
	}

	$connection = new mysqli($ip, $username, $password, $db);

	if (mysqli_connect_errno()){
		echo "You done fucked up mate";
		exit();
	}

	return $connection;
}


function createUser($username, $password, $email, $settings) {

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection,"SELECT ID FROM users WHERE username='$username' OR useremail='$email'");
	if(mysqli_num_rows($query)>0){
        echo "input already exists";
        return FALSE;
    }else{
    	$sql = 'INSERT INTO users (username, password, useremail, settings) VALUES($username, $password, $email, $settings');
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($con));
    	}
    }
    return TRUE;
}