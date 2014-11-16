<?php
	require_once("../modules/constants.php");
	require_once(HEADER);
	$post;
	if(!isset($_GET['pid'])) {
		header('location: ' . PAGE_NOT_FOUND);
	} else {
		$pid = scrub($_GET['pid']);
		$post = json_decode(getPost($pid), TRUE);
		if (count($post) == 1) {
			header('location: ' . PAGE_NOT_FOUND);
		}
	}
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 panel">
				<div class="title-bar">
					<?php
						echo $post[0]['title'];
					?>
				</div>
				<div class="text-content">
					<?php
						echo $post[0]['content'];
					?>
				</div>
				<div class="post-info">
					<span class="author">
						<?php
							echo json_decode(getUser($post[0]['UID']), TRUE)['username'];
						?>
					</span>
					<span class="date-posted">
						<?php
							echo $post[0]['date'];
						?>
					</span>
					<span class="up-votes">
						Upvotes: 
						<?php
							echo $post[0]['upvotes'];
						?>
					</span>
				</div>
			</div>
		</div>
		<?php
			foreach($post['CIDs'] as $cid) {
				// echo getComment($cid);
				$comment = json_decode(getComment($cid), TRUE);
		?>
		<div class="row">
			<div class="col-xs-12 panel">
				<div class="text-content">
		<?php
				echo $comment[0]['content'];
		?>
				</div>
				<div class="post-info">
					<span class="author">
						<?php
							echo json_decode(getUser($comment[0]['UID']), TRUE)['username'];
						?>
					</span>
					<span class="date-posted">
						<?php
							echo $comment[0]['date'];
						?>
					</span>
					<span class="up-votes">
						Upvotes: 
						<?php
							echo $comment[0]['upvotes'];
						?>
					</span>
				</div>
			</div>
		</div>
		<?php
			}

			if(isset($_SESSION['user_id'])) {
		?>
		<div class="row">
			<div class="col-xs-12 panel">
				<form method="GET">
					<textarea name="comment-body" class="form-control"></textarea>
					<input type="submit" class="btn btn-lg btn-primary" name="createcomment" value="Add Comment">
				</form>
			</div>
		</div>
		<?php
			}
		?>
	</div>
</div>
<?php
	require_once(FOOTER);
?>