<?php
	if (empty($_GET['title']) || empty($_GET['category']) || empty($_GET['content'])) {
		$error='Please fill out all required sections for this form!';
	} else {
		$UID = $_SESSION['user_id'];
		$title = scrub($_GET['title']);
		$category = scrub($_GET['category']);
		$content = scrub($_GET['content']);

		createPost($UID, $category, $title, $content);
		header('location: ' . INDEX);
	}
?>