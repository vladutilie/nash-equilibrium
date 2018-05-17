<?php

function generate_matrix_form( $P1_strategies_no, $P2_strategies_no ) {
	session_start();
	$_SESSION['P1_strategies'] = $P1_strategies_no; // Number of strategies for player 1 | + 1 row name
	$_SESSION['P2_strategies'] = $P2_strategies_no; // Number of strategies for player 2 | + 1 col name

	// Prompt the user for payoffs and form the table
	$header = '<tr><th>P1 \ P2</th>';
	$lines = '';
	for ( $row = 0; $row < $P1_strategies_no; $row++ ) {
		for ( $col = 0; $col <= $P2_strategies_no; $col++ ) {
			if ( 0 == $row ) {
				if ( $col == $P2_strategies_no ) {
					$header .= '</tr>';
				} else {
					$header .= '<th>S' . ($col + 1) . '</th>';
				}
			}
			if ( 0 == $col ) {
				$lines .= '<tr><td> S' . ($row + 1) . '</td>';
			} else {
				$lines .= '<td><input class="form-control input-sm col-xs-2" type="text" name="payoff[]" size="2" title="(P1, P2)" placeholder="(P1, P2)" /></td>';
				if ( $col == $P2_strategies_no ) {
					$lines .= '</tr>';
				}
			}
		}
	}
	return '<table class="table table-striped table-bordered table-hover table-condensed">' . $header . $lines . '</table>
	<div class="col-sm-12">
		<p><button id="calculate" class="btn btn-success" type="submit">Calculate</button>
		<button id="randomize" class="btn btn-warning" type="submit">Randomize!</button>
		<a href="index.php" class="btn btn-link">Remake form</a>
	</div>';
}

function calculate( $payoffs ) {
	$P1_strategies = $_SESSION['P1_strategies']; // number of rows
	$P2_strategies = $_SESSION['P2_strategies']; // number of cols

	$pos = array();
	for ( $row = 0; $row < $P1_strategies; $row++ ) {
		for ( $col = 0; $col < $P2_strategies; $col++ ) {
			$pos[ $row ][ $col ] = 0;
		}
	}

	$pos_row = $pos_col = array();
	// [0] Max of the column
	for ( $col = 0; $col < $P2_strategies; $col++ ) {
		$max_col = array( -11, array( 0, 0 ) ); // [value_to_compare-1, [array of coords]]
		for ( $row = 0; $row < $P1_strategies; $row++ ) {
			if ( $payoffs[ $row ][ $col ][0] > $max_col[0] ) {
				$max_col[0] = $payoffs[ $row ][ $col ][0];
				$max_col[1] = array( $row, $col );
			}
		}
		array_push( $pos_col, $max_col[1] );
	}
	
	// [1] Max of the row
	for ( $row = 0; $row < $P1_strategies; $row++ ) {
		$max_row = array( -11, array( -1, -1 ) ); // [value_to_compare-1, [array of coords]]
		for ( $col = 0; $col < $P2_strategies; $col++ ) {
			if ( $payoffs[ $row ][ $col ][1] > $max_row[0] ) {
				$max_row[0] = $payoffs[ $row ][ $col ][1];
				$max_row[1] = array( $row, $col );
			}
		}
		array_push( $pos_row, $max_row[1] );
	}

	foreach ( $pos_col as $p ) {
		$pos[ $p[0] ][ $p[1] ]++;
	}
	
	$str = '';
	foreach ( $pos_row as $p ) {
		$var = ++$pos[ $p[0] ][ $p[1] ];
		if ( 2 == $var ) {
			for ( $row = 0; $row < $P1_strategies; $row++ ) {
				for ( $col = 0; $col < $P2_strategies; $col++ ) {
					if ( $payoffs[ $p[0] ][ $p[1] ] == $payoffs[ $row ][ $col ] )
						$str .= '[' . $row . '][' . $col . '], ';
				}
			}
			//$str .= '[' . $p[0] . '][' . $p[1] . '],';
		}
	}

	if ( ! empty( $str ) ) {
		return '<div class="col-sm-12"><div class="alert alert-info"><strong>NE found</strong> at positions ' . $str . '<br/>
		<small><strong>Note:</strong> Coordinates are represented as <em>[row][column]</em> starting from 0.</small></div></div>';
	} else {
		return '<div class="col-sm-12"><div class="alert alert-info"><strong>No NE</strong> found.</div></div>';
	}
}

// Functions for the 2nd problem
function init_doors( &$doors, $n ) {
	for ( $i = 0; $i < $n; $i++ ) {
		$doors[ $i ] = array( 0, 0 ); // [ 0 - closed, 0 - no gift ]
	}
	$rand_door = rand( 0, $n - 1 ); // choose a random door
	$doors[ $rand_door ][1] = 1; // put the gift behind a random door :)
}

function strategy_1( $doors, $n, &$S1_pass ) {
	$rand = rand( 0, $n - 1 );
	if ( 1 == $doors[ $rand ][1] ) {
		$S1_pass++;
	}
}

function strategy_2( $doors, $n, &$S2_pass ) {
	$rand = rand( 0, $n - 1 );
	if ( 1 == $doors[ $rand ][1] ) {
		$S2_pass++;
	} else {
		$rand = rand( 0, $n - 1 );
		while ( 1 == $doors[ $rand ][0] ) { // while the chosen door is OPENED
			$rand = rand( 0, $n - 1);	// choose another one, hoping the next one is CLOSED
		}
		if ( 1 == $doors[ $rand ][1] ) {
			$S2_pass++;
		}
	}
}

function probability( $S, $k, $pass ) {
	if ( 'S1' == $S ) {
		$fail = $k - $pass;
		$S1_P_pass = ( $pass / $k ) * 100;
		$S1_P_fail = ( $fail / $k ) * 100;
		return array( $S1_P_pass, $S1_P_fail );
	} else if ( 'S2' == $S ) {
		$fail = $k - $pass;
		$S2_P_pass = ( $pass / $k ) * 100;
		$S2_P_fail = ( $fail / $k ) * 100;
		return array( $S2_P_pass, $S2_P_fail );
	} else return 'N/A';
}