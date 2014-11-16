<?php
	include "../modules/constants.php";
	if (isset($_GET["login"])) {
		include LOGIN;
	} else if (isset($_GET["logout"])) {
		include LOGOUT;
	} else if (isset($_GET["register"])) {
		include REGISTER;
	} else {
		include SESSION;
	}
?>
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
		.list-striped {
			list-style-type: none;
			padding:10px 10px 0 10px;
			margin:0;
			font-family: 'Open Sans', sans-serif;
		}
		.list-striped li {
			padding:10px;
			margin:0 0 10px 0;
			border-radius: 2px;
		}
		.list-striped li:nth-child(even) {
			background:rgba(0,0,0,0.1);
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
					#logo_image {
						display:inline-block;
						height:48px;
						width:48px;
						background-image: url('./img/Guiser-Logo.png');
						/*background-size:contain;*/
						background-repeat: no-repeat;
						vertical-align: -45%;
						margin-left:25px;
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
					<div class="col-md-6" id="header_logo">
						GUISER<div id="logo_image"></div>
					</div>
					<div class="col-md-6" id="header_login">
						<?php
							if (isset($_SESSION['user_id'])) {
						?>
							Welcome, <?php echo $_SESSION['username']; ?>!
							<form class="form-inline pull-right" method="GET">
								<input type="submit" class="btn btn-default" name="logout" value="Log Out">
							</form>
						<?php
							} else {
						?>
						<form class="form-inline pull-right" method="GET">
							<input type="email" class="form-control" name="email" placeholder="Email">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<input type="submit" class="btn btn-default" name="login" value="Log In">
						</form>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</header>