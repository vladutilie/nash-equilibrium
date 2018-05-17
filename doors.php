<!DOCTYPE html>
<html lang="en">
	<head>
		<title>IAAGT Homework</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<?php require_once( 'functions.php' ); ?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>N doors problem | <sup>go to <a href="index.php">Nash Equilibria problem</a></sup></h1>
					<i class="glyphicon glyphicon-info-sign"></i> <a class="btn btn-link" data-toggle="collapse" data-target="#requirements">Show requirements <i class="glyphicon glyphicon-chevron-down"></i></a>
					<div id="requirements" class="collapse">
						<p>
							2. Consider N doors. There is a gift behind one of the doors. You have to choose one door in the first step. The door is not opened for you. N-2 doors without the gift are opened. There are left two doors: the one you indicated in the first step and another one.
						</p>
						<p>
							In second step you are asked to choose between the following two strategies (the door you mention in the second step will be finally opened and if it has the gift behind then you are a winner):
							<ul>
								<li><strong>Strategy 1:</strong> Keep the same door you have chosen in the first place.</li>
								<li><strong>Strategy 2:</strong> Change initial choice door with the other one left unopened.</li>
							</ul>
						</p>
						<p>
							Write an algorithm in which the computer evaluates in a K times repetition of the situation, what is the probability to win by the Strategy 1 and what is the probability to win by the Strategy 2.
						</p>
						<p>
							Report results for different N.<br />
							For a fixed N, try K=10, K=100, K=1000, K=10000 and see how the reported probabilities evolve (for the given N).
						</p>
					</div>
				</div>
				<div class="col-sm-12">
					<div id="main-content">
						<h3>Set the parameters of the problem:</h3>
						<form class="form-inline">
							<div class="form-group">
								<input type="number" class="form-control" id="doors_N" placeholder="N (doors number)">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" id="loops" placeholder="K (loops)">
							</div>
							<button type="submit" id="calculate_p" class="btn btn-primary">Calculate!</button>
						</form>
					</div>
					<div id="results"></div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>