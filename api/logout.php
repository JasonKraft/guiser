<?php
require_once("../modules/constants.php");

session_start();
if(session_destroy()) {
	header("Location: " . INDEX); 
}
?>