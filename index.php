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
					<h1>Nash Equilibria problem | <sup>go to <a href="doors.php">N doors problem</a></sup></h1>
					<i class="glyphicon glyphicon-eye-open"></i> <a href="https://github.com/vladutilie/nash-equilibrium" target="_blank">View github project</a><br />
					<i class="glyphicon glyphicon-info-sign"></i> <a class="btn btn-link" data-toggle="collapse" data-target="#requirements">Show requirements <i class="glyphicon glyphicon-chevron-down"></i></a>
					<div id="requirements" class="collapse">
						<p>
							1. Create an algorithm to determine the pure Nash Equilibria (pure NE) of a normal-form game with 2 players (any possible finite number of strategies for each player).
						</p>
						<p>
							The algorithm should give the right answer to the following questions:
							<ul>
								<li>Existence (or not) of pure NE in the game;</li>
								<li>Find all the pure NE in the game;</li>
							</ul>
						</p>
						<p>
							The professor should be able to test the algorithm on any finite normal-form game he defines in terms of 2 players, strategies and payoffs. Moreover, there should also be the possibility to check the algorithm on games with the payoffs chosen by randomization with the help of the computer.
						</p>
						<p>
							Besides the correctness of the algorithm, in the evaluation will also be considered issues related to duration (which are considered to be a reflection of time efficiency issues).
						</p>
					</div>
				</div>
				<div class="col-sm-12">
					<div id="main-content">
						<h3>Set the number of strategies for each player:</h3>
						<form class="form-inline">
							<div class="form-group">
								<input type="number" class="form-control" id="P1_strategies_no" placeholder="Player 1">
							</div>
							<div class="form-group">
								<input type="number" class="form-control" id="P2_strategies_no" placeholder="Player 2">
							</div>
							<button type="submit" id="set-strategies" class="btn btn-primary">Set!</button>
						</form>
					</div>
					<div id="results"></div>
				</div>
			</div>
		</div>
		<?php
		/*
$sum = 0;
for ( $i = 1; $i <= 20; $i++ ) {
	$num[ $i ] = rand( 1, 100 );
	$sum += $num[ $i ];
}

$avg = $sum / 20;
$diff = array();
for ( $i = 1; $i <= 20; $i++ ) {
	$diff[ $i ] = abs( $avg - $num[ $i ] );
	echo 'Player ' . $i . ': ' . $num[ $i ]. ' <strong>' . $diff[ $i ] . '</strong><br />';
}
echo '<br />Avg: ' . $sum / 20 . '<br />';
echo 'Min diff: ' . min( $diff );*/
		?>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>