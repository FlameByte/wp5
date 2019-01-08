(function( $ ) {
	
	// Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.wp-color-picker').wpColorPicker();
    });
	
	// Handle sidebar collapse in preview.
	$( '.daisy-store-template-preview' ).on(
		'click', '.collapse-sidebar', function () {
			event.preventDefault();
			var overlay = $( '.daisy-store-template-preview' );
			if ( overlay.hasClass( 'expanded' ) ) {
				overlay.removeClass( 'expanded' );
				overlay.addClass( 'collapsed' );
				return false;
			}

			if ( overlay.hasClass( 'collapsed' ) ) {
				overlay.removeClass( 'collapsed' );
				overlay.addClass( 'expanded' );
				return false;
			}
		}
	);

	// Handle responsive buttons.
	$( '.daisy-store-responsive-preview' ).on(
		'click', 'button', function () {
			$( '.daisy-store-template-preview' ).removeClass( 'preview-mobile preview-tablet preview-desktop' );
			var deviceClass = 'preview-' + $( this ).data( 'device' );
			$( '.daisy-store-responsive-preview button' ).each(
				function () {
					$( this ).attr( 'aria-pressed', 'false' );
					$( this ).removeClass( 'active' );
				}
			);

			$( '.daisy-store-responsive-preview' ).removeClass( $( this ).attr( 'class' ).split( ' ' ).pop() );
			$( '.daisy-store-template-preview' ).addClass( deviceClass );
			$( this ).addClass( 'active' );
		}
	);

	// Hide preview.
	$( '.close-full-overlay' ).on(
		'click', function () {
			$( '.daisy-store-template-preview .daisy-store-theme-info.active' ).removeClass( 'active' );
			$( '.daisy-store-template-preview' ).hide();
			$( '.daisy-store-template-frame' ).attr( 'src', '' );
			$('body.daisy-store-companion_page_daisy-store-template').css({'overflow-y':'auto'});
		}
	);
			
	// Open preview routine.
	$( '.daisy-store-preview-template' ).on(
		'click', function () {
			var templateSlug = $( this ).data( 'template-slug' );
			var previewUrl = $( this ).data( 'demo-url' );
			$( '.daisy-store-template-frame' ).attr( 'src', previewUrl );
			$( '.daisy-store-theme-info.' + templateSlug ).addClass( 'active' );
			setupImportButton();
			$( '.daisy-store-template-preview' ).fadeIn();
			$('body.daisy-store-companion_page_daisy-store-template').css({'overflow-y':'hidden'});
		}
	);
	
	$( '.daisy-store-next-prev .next-theme' ).on(
				'click', function () {
					var active = $( '.daisy-store-theme-info.active' ).removeClass( 'active' );
					if ( active.next() && active.next().length ) {
						active.next().addClass( 'active' );
					} else {
						active.siblings( ':first' ).addClass( 'active' );
					}
					changePreviewSource();
					setupImportButton();
				}
			);
			$( '.daisy-store-next-prev .previous-theme' ).on(
				'click', function () {
					var active = $( '.daisy-store-theme-info.active' ).removeClass( 'active' );
					if ( active.prev() && active.prev().length ) {
						active.prev().addClass( 'active' );
					} else {
						active.siblings( ':last' ).addClass( 'active' );
					}
					changePreviewSource();
					setupImportButton();
				}
			);

			// Change preview source.
			function changePreviewSource() {
				var previewUrl = $( '.daisy-store-theme-info.active' ).data( 'demo-url' );
				$( '.daisy-store-template-frame' ).attr( 'src', previewUrl );
			}
	
	function setupImportButton() {
		var installable = $( '.active .daisy-store-installable' );
		if ( installable.length > 0 ) {
			$( '.wp-full-overlay-header .daisy-store-import-template' ).text( daisy_store_companion_admin.i18n.t1 );
		} else {
			$( '.wp-full-overlay-header .daisy-store-import-template' ).text( daisy_store_companion_admin.i18n.t2 );
		}
		var activeTheme = $( '.daisy-store-theme-info.active' );
		var button = $( '.wp-full-overlay-header .daisy-store-import-template' );
		$( button ).attr( 'data-template-file', $( activeTheme ).data( 'template-file' ) );
		$( button ).attr( 'data-template-title', $( activeTheme ).data( 'template-title' ) );
		$( button ).attr( 'data-template-slug', $( activeTheme ).data( 'template-slug' ) );
		
		if($( activeTheme ).data( 'template-file' ) == '' ){
				$('.cc-buy-now').show();
				$('.daisy-store-import-template').hide();
			}else{
				$('.cc-buy-now').hide();
				$('.daisy-store-import-template').show();
				}
	}
	
	
	// Handle import click.
	$( '.wp-full-overlay-header' ).on(
		'click', '.daisy-store-import-template', function () {
			$( this ).addClass( 'daisy-store-import-queue updating-message daisy-store-updating' ).html( '' );
			$( '.daisy-store-template-preview .close-full-overlay, .daisy-store-next-prev' ).remove();
			var template_url = $( this ).data( 'template-file' );
			var template_name = $( this ).data( 'template-title' );
			var template_slug = $( this ).data( 'template-slug' );
			
			if ( $( '.active .daisy-store-installable' ).length || $( '.active .daisy-store-activate' ).length ) {

				checkAndInstallPlugins();
			} else {
				$.ajax(
					{
						url: daisy_store_companion_admin.ajaxurl,
						beforeSend: function ( xhr ) {
							$( '.daisy-store-import-queue' ).addClass( 'daisy-store-updating' ).html( '' );
							xhr.setRequestHeader( 'X-WP-Nonce', daisy_store_companion_admin.nonce );
						},
						// async: false,
						data: {
							template_url: template_url,
							template_name: template_name,
							template_slug: template_slug,
							action: 'daisy_store_import_elementor'
						},
						type: 'POST',
						success: function ( data ) {
							$( '.daisy-store-updating' ).replaceWith( '<span class="daisy-store-done-import"><i class="dashicons-yes dashicons"></i></span>' );
							var obj = $.parseJSON( data );
							
							location.href = obj.redirect_url;
						},
						error: function ( error ) {
							console.error( error );
						},
						complete: function() {
							$( '.daisy-store-updating' ).replaceWith( '<span class="daisy-store-done-import"><i class="dashicons-yes dashicons"></i></span>' );
						}
					}, 'json'
				);
			}
		}
	);

	function checkAndInstallPlugins() {
		var installable = $( '.active .daisy-store-installable' );
		var toActivate = $( '.active .daisy-store-activate' );
		if ( installable.length || toActivate.length ) {

			$( installable ).each(
				function () {
					var plugin = $( this );
					$( plugin ).removeClass( 'daisy-store-installable' ).addClass( 'daisy-store-installing' );
					$( plugin ).find( 'span.dashicons' ).replaceWith( '<span class="dashicons dashicons-update" style="-webkit-animation: rotation 2s infinite linear; animation: rotation 2s infinite linear; color: #ffb227 "></span>' );
					var slug = $( this ).find( '.daisy-store-install-plugin' ).attr( 'data-slug' );
					wp.updates.installPlugin(
						{
							slug: slug,
							success: function ( response ) {
								activatePlugin( response.activateUrl, plugin );
							}
						}
					);
				}
			);

			$( toActivate ).each(
				function () {
						var plugin = $( this );
						var activateUrl = $( plugin ).find( '.activate-now' ).attr( 'href' );
					if (typeof activateUrl !== 'undefined') {
						activatePlugin( activateUrl, plugin );
					}
				}
			);
		}
	}

	function activatePlugin( activationUrl, plugin ) {
		$.ajax(
			{
				type: 'GET',
				url: activationUrl,
				beforeSend: function() {
					$( plugin ).removeClass( 'daisy-store-activate' ).addClass( 'daisy-store-installing' );
					$( plugin ).find( 'span.dashicons' ).replaceWith( '<span class="dashicons dashicons-update" style="-webkit-animation: rotation 2s infinite linear; animation: rotation 2s infinite linear; color: #ffb227 "></span>' );
				},
				success: function () {
					$( plugin ).find( '.dashicons' ).replaceWith( '<span class="dashicons dashicons-yes" style="color: #34a85e"></span>' );
					$( plugin ).removeClass( 'daisy-store-installing' );
				},
				complete: function() {
					if ( $( '.active .daisy-store-installing' ).length === 0 ) {
						$( '.daisy-store-import-queue' ).trigger( 'click' );
					}
				}
			}
		);
	}
     
})( jQuery );