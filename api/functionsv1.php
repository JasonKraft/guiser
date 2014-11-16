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

//Function may or may not be complete, don't know what to do with settings
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

//Gets a post given a PID and represents it in json
function getPost($PID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT * FROM posts WHERE PID = '$PID'");

	$jsonsettings = array();
	$cid = array();
	if ($row = mysqli_fetch_array($query)){
		$jsonsettings["title"] = $row["title"];
		$jsonsettings["content"] = $row["content"];
		$jsonsettings["upvotes"] = $row["upvotes"];
		$jsonsettings["date"] = $row["date"];
	}

	$query = mysqli_query($connection, "SELECT CID FROM comments WHERE PID = '$PID'");

	while ($row = mysqli_fetch_array($query)){
		array_push($cid, $row["CID"]);
	}
	$jsonsettings["CIDs"] = $cid;


	return json_encode($jsonsettings);
}