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
function createUser($username, $password, $email) {

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);
	$defaultSettings = NULL;

	$query = mysqli_query($connection,"SELECT ID FROM users WHERE username='$username' OR useremail='$email'");
	if(mysqli_num_rows($query)>0){
        echo "input already exists";
        return FALSE;
    }else{
    	$sql = 'INSERT INTO users (username, password, useremail, settings) VALUES($username, $password, $email', '$defaultsettings');
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}
    }

    $connection->close();
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

	$connection->close();

	return json_encode($jsonsettings);
}

//find all posts made my this user ID, return array of post ID's
function findPost($UID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT * FROM posts WHERE UID = '$UID'");

	$PIDs = array();
	while($row = mysqli_fetch_array($query)){
		array_push($PIDs, $row["PID"]);
	}

	$connection->close();

	return $PIDs;
}

//returns all the data for one comment
function getComment($PCID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT * FROM comments WHERE PCID = '$PCID'");

	$postInfo = array();
	if($row = mysqli_fetch_array($query)){
		$postInfo["UID"] = $row["UID"];
		$postInfo["PID"] = $row["PID"];
		$postInfo["title"] = $row["title"];
		$postInfo["content"] = $row["content"];
		$postInfo["date"] = $row["date"];
		$postInfo["upvotes"] = $row["upvotes"];
	}

	$connection->close();

	return json_encode($postInfo);
}

//returns the UID for someone with a given username
function findUser($username){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT ID FROM users WHERE username = '$username'");

	$connection->close();

	return $query;
}

//creates a post with passed information
function createPost($UID, $CID, $title, $content, $date, $upvotes){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$sql = 'INSERT INTO posts (UID, CID, title, content, date, upvotes) VALUES($UID, $CID, $title, $content, $date, $upvotes');
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}

    $connection->close();

    return true;
}

//returns to top/first PCIDs for a post with a passed PID
function getComments($PID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT PCID FROM comments WHERE PID = '$PID' ORDER BY date");

	$count = 0;
	$PCIDs = array();
	while($row = mysqli_fetch_array($query) && count < 25){
		array_push($PCIDs, $row["PCID"]);
		$count++;
	}

	$connection->close();

	return $PCIDs;
}
//returns any 25 comments after passed offset
function getComments($PID, $offset){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT PCID FROM comments WHERE PID = '$PID' ORDER BY date");

	$count = 0;
	$PCIDs = array();
	while($row = mysqli_fetch_array($query) && count < $offset + 25) {
		if ($count > $offset && < $offset + 25) {
			array_push($PCIDs, $row["PCID"]);
		}
		$count++;
	}
	$connection->close();

	return $PCIDs;
}

//removes a post with a passed PID
function erasePost($PID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$sql = mysqli_query($connection, "DELETE FROM posts WHERE PID = $PID";
	//find some way to return data if it successfully deleted or not?
	if(!mysqli_query($connection, $sql)){
    	die('Error: '. mysqli_error($connection));
    }

	$connection->close();

	return TRUE;
}

//returns an array containing all posts made by user
function getPostsByUser($UID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($connection, "SELECT PID FROM posts WHERE UID = '$UID'");
	$posts = array();

	while($row = mysqli_fetch_array($query)){
		array_push($posts, $row["PID"]);
	}

	$connection->close();

	return $posts;
}

function getCommentsByUser($UID){

	$connection = connect(IP, PORT, USERNAME, PASSWORD, DATABASE);

	$query = mysqli_query($onnection, "SELECT PCID from comments WHERE UID = '$UID'");
	$comments = array();

	while($row = mysqli_fetch_array($query)){
		array_push($posts, $row["PCID"]);
	}

	$connection->close();

	return $comments;
}