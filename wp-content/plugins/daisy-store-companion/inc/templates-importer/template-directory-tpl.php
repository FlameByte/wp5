<?php


$preview_url = add_query_arg( 'daisy_store_templates', '', home_url() );

$html = '';

if ( is_array( $templates_array ) ) {
	$html .= '<div class="daisy-store-template-dir wrap">';
	$html .= '<h1 class="wp-heading-inline">' . __( 'Daisy Store Template Directory', 'daisy-store-companion' ) . '</h1>';
	$html .= '<div class="daisy-store-template-browser">';

	foreach ( $templates_array as $template => $properties ) {
		$html .= '<div class="daisy-store-template">';
		$html .= '<div class="more-details daisy-store-preview-template" data-demo-url="' . esc_url( $properties['demo_url'] ) . '" data-template-slug="' . esc_attr( $template ) . '" ><span>' . __( 'More Details', 'daisy-store-companion' ) . '</span></div>';
		$html .= '<div class="daisy-store-template-screenshot">';
		$html .= '<img src="' . esc_url( $properties['screenshot'] ) . '" alt="' . esc_html( $properties['title'] ) . '" >';
		$html .= '</div>'; // .daisy-store-template-screenshot
		$html .= '<h2 class="template-name template-header">' . esc_html( $properties['title'] ) . (isset($properties['pro'])? apply_filters('daisy_store_after_template_title','<span class="pro-template">Pro</span>'):'').'</h2>';
		$html .= '<div class="daisy-store-template-actions">';

		if ( ! empty( $properties['demo_url'] ) ) {
			$html .= '<a class="button daisy-store-preview-template" data-demo-url="' . esc_url( $properties['demo_url'] ) . '" data-template-slug="' . esc_attr( $template ) . '" >' . __( 'Preview', 'daisy-store-companion' ) . '</a>';
		}
		$html .= '</div>'; // .daisy-store-template-actions
		$html .= '</div>'; // .daisy-store-template
	}
	$html .= '</div>'; // .daisy-store-template-browser
	$html .= '</div>'; // .daisy-store-template-dir
	$html .= '<div class="wp-clearfix clearfix"></div>';
}// End if().

echo $html;
?>

<div class="daisy-store-template-preview theme-install-overlay wp-full-overlay expanded" style="display: none;">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span class="screen-reader-text"><?php _e( 'Close', 'daisy-store-companion' );?></span></button>
			<div class="daisy-store-next-prev">
				<button class="previous-theme"><span class="screen-reader-text"><?php _e( 'Previous', 'daisy-store-companion' );?></span></button>
				<button class="next-theme"><span class="screen-reader-text"><?php _e( 'Next', 'daisy-store-companion' );?></span></button>
			</div>
            
			<span class="daisy-store-import-template button button-primary"><?php _e( 'Import', 'daisy-store-companion' );?></span>
           
            
            
		</div>
		<div class="wp-full-overlay-sidebar-content">
			<?php
			foreach ( $templates_array as $template => $properties ) {
			?>
				<div class="install-theme-info daisy-store-theme-info <?php echo esc_attr( $template ); ?>"
					 data-demo-url="<?php echo esc_url( $properties['demo_url'] ); ?>"
					 data-template-file="<?php echo esc_url( $properties['import_file'] ); ?>"
					 data-template-title="<?php echo esc_attr( $properties['title'] ); ?>" 
                     data-template-slug="<?php echo esc_attr( $template ); ?>">
					<h3 class="theme-name"><?php echo esc_attr( $properties['title'] ); ?></h3>
					<img class="theme-screenshot" src="<?php echo esc_url( $properties['screenshot'] ); ?>" alt="<?php echo esc_attr( $properties['title'] ); ?>">
					<div class="theme-details">
						<?php
							global $allowedposttags;
						 	echo wp_kses( $properties['description'] ,$allowedposttags );
						 ?>
					</div>
					<?php
					if ( ! empty( $properties['required_plugins'] ) && is_array( $properties['required_plugins'] ) ) {
					?>
					<div class="daisy-store-required-plugins">
						<p><?php _e( 'Required Plugins', 'daisy-store-companion' );?></p>
						<?php
						foreach ( $properties['required_plugins'] as $plugin_slug => $details ) {
							$file_name = isset($details['file'])?$details['file']:'';
							
							if ( daisystoreTemplater::check_plugin_state( $plugin_slug,$file_name ) === 'install' ) {
								echo '<div class="daisy-store-installable plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-no-alt"></span>';
								echo $details['title'];
								echo daisystoreTemplater::get_button_html( $plugin_slug,$file_name );
								echo '</div>';
							} elseif ( daisystoreTemplater::check_plugin_state( $plugin_slug,$file_name ) === 'activate' ) {
								echo '<div class="daisy-store-activate plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-admin-plugins" style="color: #ffb227;"></span>';
								echo $details['title'];
								echo daisystoreTemplater::get_button_html( $plugin_slug,$file_name );
								echo '</div>';
							} else {
								echo '<div class="daisy-store-installed plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-yes" style="color: #34a85e"></span>';
								echo $details['title'];
								echo '</div>';
							}
						}
						?>
					</div>
					<?php
					}
					?>
				</div><!-- /.install-theme-info -->
			<?php } ?>
		</div>

		<div class="wp-full-overlay-footer">
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="Collapse Sidebar">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php _e( 'Collapse', 'daisy-store-companion' ); ?></span>
			</button>
			<div class="devices-wrapper">
				<div class="devices daisy-store-responsive-preview">
					<button type="button" class="preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="screen-reader-text"><?php _e( 'Enter desktop preview mode', 'daisy-store-companion' ); ?></span>
					</button>
					<button type="button" class="preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="screen-reader-text"><?php _e( 'Enter tablet preview mode', 'daisy-store-companion' ); ?></span>
					</button>
					<button type="button" class="preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="screen-reader-text"><?php _e( 'Enter mobile preview mode', 'daisy-store-companion' ); ?></span>
					</button>
				</div>
			</div>

		</div>
	</div>
	<div class="wp-full-overlay-main daisy-store-main-preview">
		<iframe src="" title="Preview" class="daisy-store-template-frame"></iframe>
	</div>
</div>
