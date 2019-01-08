( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			console.log(to);
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	wp.customize( 'daisy-store[header_full_width]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' )
				$( '.cactus-header' ).addClass( 'fullwidth' );
			else
				$( '.cactus-header' ).removeClass( 'fullwidth' );
		} );
	} );
	
	
	wp.customize( 'daisy-store[display_topbar]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' ){
				$( '.cactus-top-bar' ).removeClass( 'hide' );
			}
			else{
				$( '.cactus-top-bar' ).addClass( 'hide' );
			}
		} );
	} );
	
	wp.customize( 'daisy-store[display_footer_widgets]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' ){
				$( '.footer-widget-area > div' ).removeClass( 'hide' );
			}
			else{
				$( '.footer-widget-area > div' ).addClass( 'hide' );
			}
		} );
	} );
	
	wp.customize( 'daisy-store[display_scroll_to_top]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' ){
				$( '.back-to-top' ).removeClass( 'hide' );
			}
			else{
				$( '.back-to-top' ).addClass( 'hide' );
			}
		} );
	} );
	
	wp.customize( 'daisy-store[fullwidth_custom]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' ){
				$( '.fullwidth_custom_selective' ).removeClass( 'cactus-container' ).addClass('dstore-container-fullwidth');
			}
			else{
				$( '.fullwidth_custom_selective' ).addClass( 'cactus-container' ).removeClass('dstore-container-fullwidth');
			}
		} );
	} );
	
	wp.customize( 'daisy-store[display_footer_icons]', function( value ) {
		value.bind( function( to ) {
			if( to == '1' ){
				$( '.footer-sns' ).removeClass( 'hide' );
			}
			else{
				$( '.footer-sns' ).addClass( 'hide' );
			}
		} );
	} );


	wp.customize( 'daisy-store[sticky_header]', function( value ) {
		value.bind( function( to ) {
			if(to=='1'){
				$('.cactus-fixed-header-wrap').removeClass('hide');
				}else{
					$('.cactus-fixed-header-wrap').addClass('hide');
					}
			} );
	} );
	
		
	$(document).on('click','.customize-partial-edit-shortcut-frontpage_menu_selective',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[frontpage_menu]' );
		});
		

	$(document).on('click','.customize-partial-edit-shortcut-section_service_selective',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[service]' );
		});
	$(document).on('click','.customize-partial-edit-shortcut-topbar_left_selective',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[topbar_left]' );
		});
	$(document).on('click','.customize-partial-edit-shortcut-topbar_icons_selective',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[topbar_icons]' );
		});
	$(document).on('click','.customize-partial-edit-shortcut-topbar_right_selective',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[topbar_right]' );
		});
	
	$(document).on('click','.customize-partial-edit-shortcut-footer-info-area',function(){
		wp.customize.preview.send( 'focus-control-for-setting', 'daisy-store[footer_icons]' );
		});
	
	wp.customize( 'daisy-store[footer_style]', function( value ) {
		value.bind( function( to ) {
			if( to == '2' ){
				$( '.footer-info-area.style2' ).removeClass('hide');
				$( '.footer-info-area.style1' ).addClass('hide');
			}else{
				$( '.footer-info-area.style2' ).addClass('hide');
				$( '.footer-info-area.style1' ).removeClass('hide');
			}
					
			} );
	} );


} )( jQuery );
