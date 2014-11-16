<?php
include "../modules/constants.php";

session_start();
if(session_destroy()) {
	header("Location: " . INDEX); 
}
?>