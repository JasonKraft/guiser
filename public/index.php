<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Guiser // A Collaborative Open-Source Idea Environment</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Gentium+Basic:400,700,400italic,700italic|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<style>
		html, body {
			height:100%;
		}
		body {
			background:#B9D6ED;
			font-family: 'Gentium Basic', serif;
		}
		h1,h2,h3 {
			font-family: 'Open Sans', sans-serif;
			font-weight: 700;
		}
		form {
			font-family: 'Open Sans', sans-serif;
			font-weight: 400;
		}
		#wrapper {
			min-height:100%;
			margin-bottom:-75px;
		}
			#wrapper:after {
				content:'';
				display: block;
			}
			footer, #wrapper:after {
				height: 75px; /* .push must be the same height as .footer */
			}
			header, footer {
				background:rgba(0,0,0,0.8);
				color:#fff;
				padding:20px;
				font-family: 'Open Sans', sans-serif;
			}
			header {

			}
				#header_logo {
					font-size:24px;
				}
			#call_to_action {
				background:url('./img/geyser.jpg');
				background-position: center 25%;
				background-size:cover;
				color:#fff;
			}
			#call_to_action .container {
				background:rgba(0,0,0,0.5);
			}
			#call_to_action input {
				margin:20px 0 0 0;
			}
	</style>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-6" id="header_logo">GUISER</div>
					<div class="col-md-6" id="header_login">
						<form action="login.php" class="form-inline pull-right">
							<input type="email" class="form-control" name="email" placeholder="Email">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<input type="submit" class="btn btn-default" value="Log In">
						</form>

					</div>
				</div>
			</div>
		</header>
		<div id="content">
			<div class="jumbotron" id="call_to_action">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1>Welcome to Guiser: a collaborative open-source idea environment.</h1>
							<p>Guiser is designed to be a safe place for anyone to share their creative ideas and recieve feedback and tips for cool projects.</p>
						</div>
						<div class="col-md-4">
							<form role="form" action="register.php">
								<input type="email" class="form-control" name="email" placeholder="Email">
								<input type="text" class="form-control" name="username" placeholder="Username">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<input type="submit" class="btn btn-default">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<p>An open-source project by MJK.</p>
		</div>
	</footer>
</body>
</html>
