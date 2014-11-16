<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		div {
			font-size:30px;
			background: rgb(0,0,0);
			color: #fff;
			border: 5px solid #F00;
		}
		.brown {
			background: brown;
		}
		#bluebutton {
			background: blue;
			border: none;
			border-radius:5px;
		}
		#green-border {
			border:5px solid green;
		}
		span.brown {
			color:yellow;
		}
	</style>
</head>
<body>
	<div>Hello, World!</div>
	<div class="brown">this element has a brown background and a red border</div>
	<div class="brown" id="green-border">this element has a brown background with a green border</div>
	<span class="brown">this is a span element with a brown background</span>
	<div id="bluebutton">this is a blue button</div>
</body>
</html>
