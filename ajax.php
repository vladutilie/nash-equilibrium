<?php
require_once( 'functions.php' );

$form_data = $_POST;
$allowed_actions = array( 'generate_matrix_form', 'calculate', 'calculate_p', /*another actions*/ );

if ( empty( $form_data['action'] ) || ! in_array( $form_data['action'], $allowed_actions ) ) {
	die( '0' );
}

if ( 'generate_matrix_form' == $form_data['action'] ) {
	$P1_strategies_no = (int) $form_data['P1_strategies'];
	$P2_strategies_no = (int) $form_data['P2_strategies'];
	$response['HTML'] = generate_matrix_form( $P1_strategies_no, $P2_strategies_no );
} else if ( 'calculate' == $form_data['action'] ) {

	$payoff = explode( ',', $form_data['payoffs'] );
	$count = count( $payoff );

	session_start();
	$P2_strategies = $_SESSION['P2_strategies'];

	$build = $final = array();
	$j = 0;
	for ( $i = 0; $i < $count; $i += 2 ) {
		if ( $j < $P2_strategies ) {
			array_push( $build, array( $payoff[ $i ], $payoff[ $i + 1 ] ) );
			$j++;
		} else {
			$j = 1;
			array_push( $final, $build );
			$build = array();
			array_push( $build, array( $payoff[ $i ], $payoff[ $i + 1 ] ) );
		}
		if ( $i + 2 == $count ) array_push( $final, $build );		
	}
	$response['HTML'] = calculate( $final );
} else if ( 'calculate_p' == $form_data['action'] ) {
	$n = (int) $form_data['N'];	// number of doors
	$k = (int) $form_data['K'];	// number of loops
	if ( $n <=  0 || $k <= 0 ) {
		$response['HTML'] = 'N or K cannot be <= 0';
	} else {	
		$S1_pass = $S2_pass = 0;
		for ( $j = 0; $j < $k; $j++ ) {
			init_doors( $doors, $n );
			strategy_1( $doors, $n, $S1_pass );
			strategy_2( $doors, $n, $S2_pass );
		}
		$P_S1 = probability( 'S1', $k, $S1_pass );
		$P_S2 = probability( 'S2', $k, $S2_pass );

		$response['HTML'] = '<table class="table table-striped table-bordered table-hover table-condensed">
			<tr>
				<th>Probability</th>
				<th>1<sup>st</sup> strategy</th>
				<th>2<sup>nd</sup> strategy</th>
			</tr>
			<tr>
				<td>Pass</td>
				<td>' . $P_S1[0] . '%</td>
				<td>' . $P_S2[0] . '%</td>
			</tr>
			<tr>
				<td>Fail</td>
				<td>' . $P_S1[1] . '%</td>
				<td>' . $P_S2[1] . '%</td>
			</tr>
		</table>';
	}
} else { $response = 0; }

echo json_encode( $response );