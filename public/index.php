<?php
	require_once("../modules/constants.php");
	require_once(HEADER);
?>
<div id="content">
	<?php
		if (!isset($_SESSION['user_id'])) {
	?>
	<div class="jumbotron" id="call_to_action">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h1>Welcome to Guiser: a collaborative open-source idea environment.</h1>
					<p>Guiser is designed to be a safe place for anyone to share their creative ideas and recieve feedback and tips for cool projects.</p>
				</div>
				<div class="col-md-4">
					<form method="GET">
						<input type="email" class="form-control" name="email" placeholder="Email">
						<input type="text" class="form-control" name="username" placeholder="Username">
						<input type="password" class="form-control" name="password" placeholder="Password">
						<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
						<input type="submit" class="btn btn-lg btn-primary btn-block" name="register" value="Sign Up">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
	?>
	<div class="container">
		<?php
			if (isset($_SESSION['user_id'])) {
		?>
		<div class="row">
			<div class="col-md-8 panel" id="newpostform">
				<h3>Create a New Post</h3>
				<form method="GET">
					<input type="text" class="form-control" name="title" placeholder="Project Title">
					<select name="category" class="form-control">
						<!-- <option value="0" selected="selected"></option> -->
						<?php
							$allcategories = json_decode(getCategories(), TRUE);
							foreach($allcategories as $val) {
								echo "<option value='" . $val['CID'] . "'>" . $val['name'] . "</option>";
							}
						?>
					</select>
					<textarea name="content" class="form-control" placeholder="Description"></textarea>
					<input type="submit" class="btn btn-lg btn-primary" name="createpost">
				</form>
			</div>
			<div class="col-md-4 panel" id="activityfeed">
				<h3>Recent Activity</h3>
				<ul class="list-striped">
				<?php
					$recentactivity = json_decode(getRecentActivity($_SESSION['user_id'], 10, 0), TRUE);
					if (count($recentactivity) > 0) {
						foreach($recentactivity as $value) {
							echo "<li>" . $value['type'] . "</li>";
						}
					} else {
						echo "<li>No recent activity.</li>";
					}
				?>
				</ul>
			</div>
		</div>
		<?php
			}
		?>
		<div class="row">
			<div class="col-md-6 panel" id="top_posts">
				<h3>Top Posts</h3>
				<ul class="list-striped">
					<?php
						$topposts = json_decode(sortByUpvotes(0, 10, 0, 0), TRUE);
						if (count($topposts) > 0) {
							foreach($topposts as $value) {
								echo "<li>" . $value['title'] . "</li>";
							}
						} else {
							echo "<li>No posts found.</li>";
						}
					?>
				</ul>
			</div>
			<div class="col-md-6 panel" id="recent_posts">
				<h3>Recent Posts</h3>
				<ul class="list-striped">
					<?php
						$recentposts = json_decode(sortByDate(10, 0), TRUE);
						if (count($recentposts) > 0) {
							foreach($recentposts as $value) {
								echo "<li>" . $value['title'] . "</li>";
							}
						} else {
							echo "<li>No posts found.</li>";
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
	require_once(FOOTER);
?>