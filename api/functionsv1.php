<?php

define ('IP', '127.0.0.1');
define ('PORT', "");
define ('USERNAME', 'root');
define ('PASSWORD', "");
define ('DATABASE', 'guiser');

define ('CREATE_POST', 0);
define ('CREATE_COMMENT', 1);
define ('UPVOTE_POST', 2);
define ('UPVOTE_COMMENT', 3);
define ('RESCIND_UPVOTE_POST', 4);
define ('RESCIND_UPVOTE_COMMENT', 5);

define ('DAY', 0);
define ('WEEK', 1);
define ('MONTH', 2);

function connect(){
	$connection;

	if (PORT != ""){
		$connection = new mysqli(IP . ":" . PORT, USERNAME, PASSWORD, DATABASE);
	} else {
		$connection = new mysqli(IP, USERNAME, PASSWORD, DATABASE);
	}

	if (mysqli_connect_errno()){
		exit();
	}

	return $connection;
}

function update($connection, $table, $query_string) {
	if (!mysqli_query($connection, "UPDATE " . $table . " " . $query_string)) {
		die("Error: " . mysqli_error($connection) . "\n");
	}
}
function insert($connection, $table, $query_string) {
	if (!mysqli_query($connection, "INSERT INTO " . $table . " " . $query_string)) {
		die("Error: " . mysqli_error($connection) . "\n");
	}
}
function delete($connection, $table, $query_string) {
	if (!mysqli_query($connection, "DELETE FROM " . $table . " " . $query_string)) {
		die("Error: " . mysqli_error($connection) . "\n");
	}
}

//Function may or may not be complete, don't know what to do with settings
function createUser($username, $password, $email) {

	$connection = connect();

	$query = mysqli_query($connection,"SELECT ID FROM users WHERE username='$username' OR useremail='$email'");
	if(mysqli_num_rows($query)>0){
        echo "input already exists";
        return FALSE;
    }else{
    	$sql = "INSERT INTO users (username, password, useremail) VALUES('$username', '$password', '$email')";
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}
    }

    $connection->close();
    return TRUE;
}

//Gets a post given a PID and represents it in json
function getPost($PID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM posts WHERE PID = '$PID'");

	$jsonsettings = array();
	$cid = array();
	if ($row = mysqli_fetch_array($query)){
		array_push($jsonsettings, $row);
	}

	$query = mysqli_query($connection, "SELECT * FROM comments WHERE PID = '$PID'");

	while ($row = mysqli_fetch_array($query)){
		array_push($cid, $row["CID"]);
	}
	$jsonsettings["CIDs"] = $cid;

	$connection->close();

	if (count($jsonsettings) > 0){
		return json_encode($jsonsettings);
	} else {
		echo "Error:  Unable to find post!";
	}
}

//find all posts made my this user ID, return array of post ID's
function findPost($UID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT PID FROM posts WHERE UID = '$UID'");

	$PIDs = array();
	while($row = mysqli_fetch_array($query)){
		array_push($PIDs, $row["PID"]);
	}

	$connection->close();

	if (count($PIDs)){
		return json_encode($PIDs);
	} else {
		echo "Error: Post not Found!";
	}
}

//returns all the data for one comment
function getComment($PCID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM comments WHERE PCID = '$PCID'");

	$postInfo = array();
	if($row = mysqli_fetch_array($query)){
		array_push($postInfo, $row);
	}

	$connection->close();

	if (count($postInfo) > 0) {
		return json_encode($postInfo);
	}else{
		echo "Error:  No comments on post!";
	}
}

//returns the UID for someone with a given username
function findUser($username){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");

	$connection->close();

	return json_encode(mysqli_fetch_array($query));
}

//creates a post with passed information
function createPost($UID, $CID, $title, $content){

	

	$connection = connect();

	$sql = "INSERT INTO posts (UID, CID, title, content) VALUES($UID, $CID, '$title', '$content')";
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}
	if (mysqli_query($connection, $sql)) {
		$last_id = mysqli_insert_id($connection);
	} else {
		echo "Error!";
	}

	$sql = "INSERT INTO activity (UID, type, ID) VALUES($UID, " . CREATE_POST . ", $last_id)";
	    if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}
    $connection->close();

    return TRUE;
}

//returns any 25 comments after passed offset
function getComments($PID, $limit, $offset){

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM comments WHERE PID = '$PID' ORDER BY date LIMIT $limit, $offset");

	$PCIDs = array();
	while($row = mysqli_fetch_array($query)) {
		array_push($PCIDs, $row);
	}
	$connection->close();

	if (count($PCIDs) > 0){
		return json_encode($PCIDs);
	} else {
		echo "Error:  No comments on post!";
	}
}

//removes a post with a passed PID
function erasePost($PID){

	

	$connection = connect();

	//$sql = mysqli_query($connection, "DELETE FROM posts WHERE PID = $PID");
	$sql = "DELETE FROM posts WHERE PID = $PID";
	//find some way to return data if it successfully deleted or not?
	if(!mysqli_query($connection, $sql)){
    	die('Error: '. mysqli_error($connection));
    }

	$connection->close();

	return TRUE;
}

//returns an array containing all posts made by user
function getPostsByUser($UID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM posts WHERE UID = '$UID'");
	$posts = array();

	while($row = mysqli_fetch_array($query)){
		array_push($posts, $row);
	}

	$connection->close();

	if (count($posts) > 0){
		return json_encode($posts);
	} else {
		echo "No posts by user";
	}
}

function getCommentsByUser($UID){

	

	$connection = connect();

	$query = mysqli_query($onnection, "SELECT * FROM comments WHERE UID = '$UID'");
	$comments = array();

	while($row = mysqli_fetch_array($query)){
		array_push($comments, $row);
	}

	$connection->close();

	if (count($comments) > 0) {
		return json_encode($comments);
	} else {
		echo "No comments by user";
	}
}

function getCategories($CID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM categories WHERE CID = '$CID' ");

	$categories = array();
	while($row = mysqli_fetch_array($query)){
		array_push($categories, $row);
	}

	$connection->close();

	if (count($categories) > 0){

		return json_encode($categories);
	} else {
		echo "No Categories present!";
	}
}

function getPostByCategory($CID, $limit, $offset){
	
	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM posts WHERE CID = '$CID' ORDER BY CID LIMIT $limit, $offset");

	$full;
	while($row = mysqli_fetch_array($query)){
		array_push($full, $row);
	}

	$connection->close();
	if(count($full) > 0){
		return json_encode($full);
	}
	else{
		echo "No Posts in this Category";
	}

}

//make a comment
function createComment($UID, $PID, $content){

	

	$connection = connect();

	$sql = "INSERT INTO comments (UID, PID, content) VALUES($UID, $PID, '$content')";
    	if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}

    if (mysql_query($connection, $sql)) {
		$last_id = mysql_insert_id($connection);
	} else {
		echo "Error!";
	}

	$sql = "INSERT INTO activity (UID, type, ID) VALUES($UID, ".CREATE_COMMENT.", $last_id)";
	    if(!mysqli_query($connection, $sql)){
    		die('Error: '. mysqli_error($connection));
    	}
    $connection->close();

    return TRUE;
}

function toggleUpvotePost($UID, $PID){

	

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM activity WHERE UID = $UID AND ID = $PID AND type = ".UPVOTE_POST."");

	if (!$query){
		die('Error: '. mysqli_error($connection));
	}
	if (mysqli_num_rows($query) > 0){
		$query = mysqli($connection, "UPDATE post SET upvotes = upvotes - 1 WHERE PID = $PID");


	} else {
		$query = mysqli_query($connection, "UPDATE post SET upvotes = upvotes + 1 WHERE PID = $PID");
		if (!query){
			die('Error: '. mysqli_error($connection));
		}
		$query = mysqli_query($connection, "INSERT INTO activity (UID, type, ID) VALUES ($UID, ".UPVOTE_POST.", $PID");
		if (!mysqli_query($connection, $query)){
			die('Error: '. mysqli_error($connection));
			}

	}
	$connection -> close();

}

function toggleUpvoteComment($UID, $PCID){

	$connection = connect();

	$query = mysqli_query($connection, "SELECT * FROM activity WHERE UID = $UID and ID = $PCID AND type = ".UPVOTE_COMMENT." ");
	if (!query){
		die('Error: '. mysqli_error($connection));
	}

	if (mysqli_num_rows($query) > 0) {
		echo "You already upvoted this!";
		$connection->close()
		return FALSE;
	} else {
		$query = mysqli_query($connection, "UPDATE comment SET upvotes = upvotes + 1 WHERE PCID = $PCID");
		if (!query){
			die('Error: '. mysqli_error($connection));
		}
		$query = "INSERT INTO activity (UID, type, ID) VALUES ($UID, ".UPVOTE_COMMENT.", $PCID)";
		if (!mysqli_query($connection, $query)){
			die('Error: '. mysqli_error($connection));
		}

		$connection->close();
	}

} 

/*function sortByUpvotes($CID, $limit, $offset, $type){

	$connection = connect();
	if ($type == 0){
		$query = mysqli_query($connection, "SELECT * FROM post WHERE CID = $CID ORDER BY upvotes LIMIT $limit, $offset)";
	} else if ($type == 1){

	}
}*/

function eraseComment($PCID){

	$connection = connect();

	$sql = "DELETE FROM comment WHERE PCID = $PCID";
	//find some way to return data if it successfully deleted or not?
	if(!mysqli_query($connection, $sql)){
    	die('Error: '. mysqli_error($connection));
    }

	$connection->close();

}

function editComment($UID, $PCID, $content){

	$connection = connect();
	$query = mysqli_query($connection, "UPDATE comment SET content = '$content' WHERE PCID = $PCID");
	if (!$query){
		die('Error: '. mysqli_error($connection));
	}
	$query = "INSERT INTO activity (UID, type, ID) VALUES ($UID, ".CREATE_COMMENT.", $PCID)";
	if (!mysqli_query($connection, $query)){
		die('Error: '. mysqli_error($connection));
	}
	$connection -> close();
}

function getRecentActivity($UID, $limit, $offset){

	$connection = connect();
	$query = mysqli_query($connection, "SELECT * FROM activity WHERE UID = $UID ORDER BY date LIMIT $limit, $offset");

	$activities = array();

	while($row = mysqli_fetch_array($query)){
		array_push($activities, $row);
	}

	$connection->close();

	if (count($activities) > 0){
		json_encode($activities);
	} else {
		echo "Error: Unable to get Recent Activities";
	}
}