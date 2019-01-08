<?php
/*
	Plugin Name: Daisy Store Companion
	Description: Daisy Store theme options.
	Author: VelaThemes
	Author URI: https://mageewp.com/
	Version: 1.0.1
	Text Domain: daisy-store-companion
	Domain Path: /languages
	License: GPL v2 or later
*/

defined('ABSPATH') or die("No script kiddies please!");

require_once 'inc/widget-recent-posts.php';
require_once 'inc/Daisy_Store_Taxonomy_Images.php';
require_once 'inc/templates-importer/templates-importer.php';
require_once 'inc/elementor-widgets/elementor-widgets.php';


if (!class_exists('DaisystoreCompanion')){

	class DaisystoreCompanion{	
		
		public function __construct($atts = NULL)
		{

			add_action( 'plugins_loaded', array(&$this, 'init' ) );
			add_action( 'admin_menu', array(&$this ,'plugin_menu') );
			add_action( 'switch_theme', array(&$this ,'plugin_activate') );
			add_action( 'wp_enqueue_scripts',  array(&$this , 'enqueue_scripts' ));
			add_action( 'admin_enqueue_scripts',  array(&$this , 'enqueue_admin_scripts' ));
			add_action( 'wp_footer', array( $this, 'gridlist_set_default_view' ) );

			
			//add_action( 'customize_controls_init', array( &$this,'customize_controls_enqueue') );

		}
	
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function customize_controls_enqueue(){

			
	}	

		
	public static function init() {
		
		load_plugin_textdomain( 'daisy-store-companion', false,  basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	/**
	 * Enqueue admin scripts
	*/
	function enqueue_admin_scripts()
	{
		wp_enqueue_style( 'wp-color-picker' );
		
		if(isset($_GET['page']) && $_GET['page']=='daisy-store-template'){
			wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
		}
		wp_enqueue_style( 'daisy-store-companion-admin', plugins_url('assets/css/admin.css', __FILE__));
		wp_enqueue_script( 'daisy-store-companion-admin', plugins_url('assets/js/admin.js', __FILE__),array('jquery','wp-color-picker' ),'',true);
		wp_localize_script( 'daisy-store-companion-admin', 'daisy_store_companion_admin',
				array(
					'ajaxurl' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce( 'wp_rest' ),
					'i18n' =>array('t1'=> __( 'Install and Import', 'daisy-store-companion' ),'t2'=> __( 'Import', 'daisy-store-companion' ) ),
				) );
	}
	
	/**
	 * Enqueue front scripts
	*/
	
	function enqueue_scripts()
	{

		$i18n = array();
		wp_enqueue_script( 'jquery-cookie', plugins_url('assets/js/jquery.cookie.min.js', __FILE__), array( 'jquery' ), null, true);
		wp_enqueue_style( 'daisy-store-companion-front', plugins_url('assets/css/front.css', __FILE__));
		wp_enqueue_script( 'daisy-store-companion-front', plugins_url('assets/js/front.js', __FILE__),array('jquery'),'',true);

	}
	
	/**
	 * Admin menu
	*/
	function plugin_menu() {
		add_menu_page( 'Daisy Store Companion', 'Daisy Store Companion', 'manage_options', 'daisy-store-companion', array($this , 'plugin_options') );
		add_submenu_page(
			'daisy-store-companion', __( 'Daisy Store Template Directory', 'daisy-store-companion' ), __( 'Template Directory', 'daisy-store-companion' ), 'manage_options', 'daisy-store-template',
			array( 'daisystoreTemplater', 'render_admin_page' )
		);
		
	}
	
	/**
	 * Options form
	*/
	function plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'daisy-store-companion' ) );
		}
		
		echo '<h2>'.__( 'About Daisy Store', 'daisy-store-companion' ).'</h2><div class="daisy-store-info-wrap">
	<p>'. __( 'Fully compatible with WooCommerce, Daisy Store is your best choice for creating online shop. You could easily sell anything using this most popular ecommerce plugin and this easy-to-use theme. You could just one click to import demo pages and edit your site using just drag & drop with Elementor page builder plugin.<p>'.esc_attr__('Documentation', 'daisy-store' ).': <a href="'.esc_url('https://mageewp.com/manuals/theme-guide-daisy-store.html').'" target="_brank">https://mageewp.com/manuals/theme-guide-daisy-store.html</a></p>', 'daisy-store-companion' ).'</p>
	</div>';
		
	}
	
	function gridlist_set_default_view() {
				
				$default = apply_filters( 'daisy_store_glt_default','grid' );
				
				?>
					<script>
					jQuery(document).ready(function($) {
						if ($.cookie( 'gridcookie' ) == null) {
					    	$( '.archive .post-wrap ul.products' ).addClass( '<?php echo esc_attr($default); ?>' );
					    	$( '.gridlist-toggle #<?php echo esc_attr($default); ?>' ).addClass( 'active' );
					    }
					});
					</script>
				<?php
			}
	
	/**
	 * Set default options
	*/
	
	public static function default_options(){

		$return = array(
			'license_key' => '',

		);
		
		return $return;
		
		}

		
		}
	
	new DaisystoreCompanion;
}