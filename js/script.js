jQuery( document ).ready(function( $ ) {
	$( document ).on( 'click', '#randomize', function( e ) {
		e.preventDefault();
		$( 'input[name^="payoff"]' ).each( function() {
			var P1 = Math.floor( Math.random() * 21 - 10 ),
				P2 = Math.floor( Math.random() * 21 - 10 );
			$(this).val( '(' + P1 + ', ' + P2 + ')' );
		});
		if ( 'disabled' == $( '#calculate' ).attr('disabled') ) {
			//$( '#calculate' ).removeAttr( 'disabled' );
		}
		return false;
	});

	$( '#set-strategies' ).on( 'click', function( e ) {
		e.preventDefault();
		var myData = new FormData();
		myData.append( 'action', 'generate_matrix_form' );
		myData.append( 'P1_strategies', $( '#P1_strategies_no' ).val() );
		myData.append( 'P2_strategies', $( '#P2_strategies_no' ).val() );
		$.post({
			url: 'ajax.php',
			data: myData,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function( response, textStatus, jqXHR ) {
				$( '#main-content' ).empty().html( response.HTML );
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				//console.log( errorThrown );
			}
		});
		return false;
	});

	$( document ).on( 'click', '#calculate', function( e ) {
		e.preventDefault();
		//$( this ).attr( 'disabled','disabled' );
		var form = new FormData(),
			payoffs = new Array(),
			payoff = new Array();
		$( 'input[name^="payoff"]' ).each( function() {
			payoff = $( this ).val().trim().replace( '(', '' ).replace( ')', '' ).replace( ' ', '' ).split( ',' );
			payoffs.push( payoff );
		});
		form.append( 'action', 'calculate' );
		form.append( 'payoffs', payoffs );	
		$.post({
			url: 'ajax.php',
			data: form,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function( response, textStatus, jqXHR ) {
				$( '#results' ).prepend( response.HTML );
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				//console.log( errorThrown );
			}
		});
		return false;
	});

	$( document ).on( 'click', '#calculate_p', function( e ) {
		e.preventDefault();
		var form = new FormData()
		form.append( 'action', 'calculate_p' );
		form.append( 'N', $( '#doors_N' ).val() );	
		form.append( 'K', $( '#loops' ).val() );	
		$.post({
			url: 'ajax.php',
			data: form,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function( response, textStatus, jqXHR ) {
				$( '#results' ).empty().html( response.HTML );
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				//console.log( errorThrown );
			}
		});
		// of it is ok then do this $( '.description' ).fadeIn(100).fadeOut(2000);
		return false;
	});
});
