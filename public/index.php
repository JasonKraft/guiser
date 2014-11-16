<?php
	include "../modules/constants.php";
	include HEADER;
?>
<div id="content">
	<div class="jumbotron" id="call_to_action">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h1>Welcome to Guiser: a collaborative open-source idea environment.</h1>
					<p>Guiser is designed to be a safe place for anyone to share their creative ideas and recieve feedback and tips for cool projects.</p>
				</div>
				<div class="col-md-4">
					<form role="form" method="GET">
						<input type="email" class="form-control" name="email" placeholder="Email">
						<input type="text" class="form-control" name="username" placeholder="Username">
						<input type="password" class="form-control" name="password" placeholder="Password">
						<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign Up">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6" id="top_posts">
				<h3>Top Posts</h3>
				<ul class="list-striped">
					<li>Test</li>
					<li>Test2</li>
					<li>Test</li>
					<li>Test2</li>
				</ul>
			</div>
			<div class="col-md-6" id="recent_posts">
				<h3>Recent Posts</h3>
				<ul class="list-striped">
					<li>Test</li>
					<li>Test2</li>
					<li>Test</li>
					<li>Test2</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
	include FOOTER;
?>