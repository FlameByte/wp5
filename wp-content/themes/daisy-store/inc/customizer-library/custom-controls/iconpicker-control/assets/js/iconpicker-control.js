( function( $ ) {

	$( function() {
		$( '.icp' ).iconpicker({icons:daisy_store_iconpicker.icons}).on( 'iconpickerUpdated', function() {
			$( this ).trigger( 'change' );
		} );
	} );

} )( jQuery );