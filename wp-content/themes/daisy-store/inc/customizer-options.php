<?php

function daisy_store_sanitize_woo_categories( $input )
{
    $valid = daisy_store_get_woo_categories();
    foreach ($input as $value) {
        if ( !array_key_exists( $value, $valid ) ) {
            return array();
        }
    }

    return $input;
}
function daisy_store_get_pages(){
  $pages = get_pages(); 
  $return = array();
  foreach ( $pages as $page ) {
	$return [$page->ID] = $page->post_title;
  }
  return $return;
}
/**
 * Defines customizer options
 */

function daisy_store_customizer_library_options() {
	
	global $daisy_store_customizer_options, $daisy_store_customizer_options, $wp_version;

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
	
	$imagepath = get_template_directory_uri().'/assets/images/';
	
	$target = array(
		'_blank' => __( 'Blank', 'daisy-store' ),
		'_self'  => __( 'Self', 'daisy-store' )
	);
	
	$transport = '';
	if ( version_compare( $wp_version, '4.9' ) >= 0 ){
		$transport = 'postMessage';
	}
	


	// Panel Header
	
	$panel = 'panel-header';
	
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Daisy Store: Header Options', 'daisy-store' ),
		'priority' => '5'
	);
	
	$section = 'section-header-general-options';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'General Options', 'daisy-store' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['header_full_width'] = array(
		'id' => 'header_full_width',
		'label'   => __( 'Full-width Header', 'daisy-store' ),
		'section' => $section,
		'type'    => 'checkbox',
		'transport' => $transport,
		'default' => '',
	);
	
	
	$options['sticky_logo'] = array(
		'id' => 'sticky_logo',
		'label'   => __( 'Sticky Header Logo', 'daisy-store' ),
		'section' => 'title_tagline',
		'type'    => 'image',
		'default' => '',
		//'transport' => 'postMessage',
	);
	
	$section = 'section-header-topbar';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Top Bar', 'daisy-store' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['display_topbar'] = array(
		'id' => 'display_topbar',
		'label'   => __( 'Display Top Bar', 'daisy-store' ),
		'section' => $section,
		'type'    => 'checkbox',
		'transport' => $transport,
		'default' => '',
	);
	
	$options['topbar_left'] = array(
		'id' => 'topbar_left',
		'label'   => __( 'Top Bar Left', 'daisy-store' ),
		'section' => $section,
		'type'    => 'repeater',
		'choices' => array('limit' => '5'),
		'transport' => $transport,
		'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Item', 'daisy-store' ),
					'field' => 'text',),
		'fields' => array(
			'icon'=>array('type'=>'iconpicker','default'=>'','label'=> __( 'Font-awesome Icon', 'daisy-store' )),
			'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'daisy-store' )),
			'link'=>array('type'=>'text','default'=>'','label'=> __( 'Link', 'daisy-store' )),
			'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'daisy-store' )),
		),
		'default' =>  ''
		);
		
	$options['topbar_icons'] = array(
		'id' => 'topbar_icons',
		'label'   => __( 'Top Bar Icons', 'daisy-store' ),
		'section' => $section,
		'type'    => 'repeater',
		'choices' => array('limit' => '5'),
		'transport' => $transport,
		'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Icon', 'daisy-store' ),
					'field' => 'icon',),
		'fields' => array(
			'icon'=>array('type'=>'iconpicker','default'=>'','label'=> __( 'Font-awesome Icon', 'daisy-store' )),
			'link'=>array('type'=>'text','default'=>'','label'=> __( 'Link', 'daisy-store' )),
			'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'daisy-store' )),
		),
		'default' =>  '',
		);
	
	$options['topbar_right'] = array(
		'id' => 'topbar_right',
		'label'   => __( 'Top Bar Right', 'daisy-store' ),
		'section' => $section,
		'type'    => 'repeater',
		'choices' => array('limit' => '5'),
		'transport' => $transport,
		'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Item', 'daisy-store' ),
					'field' => 'text',),
		'fields' => array(
			'icon'=>array('type'=>'iconpicker','default'=>'','label'=> __( 'Font-awesome Icon', 'daisy-store' )),
			'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'daisy-store' )),
			'link'=>array('type'=>'text','default'=>'','label'=> __( 'Link', 'daisy-store' )),
			'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'daisy-store' )),
		),
		'default' =>  ''
		);		
	
	$section = 'section-navigation-bar';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Navigation Bar', 'daisy-store' ),
		'priority' => '2',
		'panel' => $panel
	);
	$options['display_shopping_cart_icon'] = array(
			'id' => 'display_shopping_cart_icon',
			'label'   => __( 'Display Shopping Cart Icon', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			//'transport' => $transport,
		);
	
	$options['sticky_header'] = array(
			'id' => 'sticky_header',
			'label'   => __( 'Sticky Navigation Bar', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	$options['sticky_header_background_color'] = array(
			'id' => 'sticky_header_background_color',
			'label'   => __( 'Sticky Navigation Bar background Color', 'daisy-store' ),
			'section' => $section,
			'type'    => 'color',
			'default' => '#ffffff',
			'transport' => $transport,
		);
		
	$options['sticky_header_background_opacity'] = array(
			'id' => 'sticky_header_background_opacity',
			'label'   => __( 'Sticky Navigation Bar background Opacity', 'daisy-store' ),
			'section' => $section,
			'type'    => 'range-value',
			'default' => '1',
			'transport' => $transport,
			'input_attrs' => array(
			'min'    => 0,
			'max'    => 1,
			'step'   => 0.1,
			'suffix' => '',
  	),
	);
	
	$options['categories_menu_toggle'] = array(
			'id' => 'categories_menu_toggle',
			'label'   => __( 'Display Categories Menu Toggle', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			//'transport' => $transport,
		);
	
	$options['categories_menu_toggle_text'] = array(
			'id' => 'categories_menu_toggle_text',
			'label'   => __( 'Categories Menu Toggle Text', 'daisy-store' ),
			'section' => $section,
			'type'    => 'text',
			'default' => 'Browse Categories',
			//'transport' => $transport,
		);
	
		
	// Panel Footer
	$section = 'panel-footer';

	$sections[] = array(
			'id' => $section,
			'title' => __( 'Daisy Store: Footer Options', 'daisy-store' ),
			'priority' => '9'
		);
	
	$options['display_footer_widgets'] = array(
			'id' => 'display_footer_widgets',
			'label'   => __( 'Display Footer Widgets', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '',
		);
	
	$options['display_footer_icons'] = array(
			'id' => 'display_footer_icons',
			'label'   => __( 'Display Footer Icons', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	
	$options['footer_icons'] = array(
				'id' => 'footer_icons',
				'label'   => __( 'Footer Icons', 'daisy-store' ),
				'section' => $section,
				'type'    => 'repeater',
				'choices' => array('limit' => '6'),
				//'transport' => $transport,
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Icon', 'daisy-store' ),
							'field' => 'title',),
				'fields' => array(
					'icon'=>array('type'=>'iconpicker','default'=>'','label'=> __( 'Font-awesome Icon', 'daisy-store' )),
					'title'=>array('type'=>'text','default'=>'','label'=> __( 'Title', 'daisy-store' )),
					'link'=>array('type'=>'text','default'=> '','label'=> __( 'Link', 'daisy-store' )),
				
				),
				'default' =>  ''
				);
	
	$options['copyright'] = array(
		'id' => 'copyright',
		'label'   => __( 'Copyright', 'daisy-store' ),
		'section' => $section,
		'type'    => 'daisy_store_editor',
		//'transport' => 'postMessage',
		'default' => ''
		);
			
	$options['section_order'] = array(
		'id' => 'section_order',
		'label'   => __( 'Section Order', 'daisy-store' ),
		'section' => $section,
		'type'    => 'text',
		'default' => '',
		);

	// Panel Typography
	$panel = 'panel-typography';
	
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Daisy Store: Typography', 'daisy-store' ),
		'priority' => '11'
	);
	
	$section = 'section-font-family';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Font Family', 'daisy-store' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['headings_font_family'] = array(
		'id' => 'headings_font_family',
		'label'   => __( 'Headings font family', 'daisy-store' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Montserrat'
	);
	
	$options['body_font_family'] = array(
		'id' => 'body_font_family',
		'label'   => __( 'Body font family', 'daisy-store' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Montserrat'
	);
	
	$section = 'section-font-size';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'General Font Size', 'daisy-store' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	$options['body_font_size'] = array(
		'id' => 'body_font_size',
		'label'   => __( 'Body Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '14',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	
	$options['h1_font_size'] = array(
		'id' => 'h1_font_size',
		'label'   => __( 'H1 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '36',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	$options['h2_font_size'] = array(
		'id' => 'h2_font_size',
		'label'   => __( 'H2 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '30',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	$options['h3_font_size'] = array(
		'id' => 'h3_font_size',
		'label'   => __( 'H3 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '24',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	$options['h4_font_size'] = array(
		'id' => 'h4_font_size',
		'label'   => __( 'H4 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '20',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	$options['h5_font_size'] = array(
		'id' => 'h5_font_size',
		'label'   => __( 'H5 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '18',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	$options['h6_font_size'] = array(
		'id' => 'h6_font_size',
		'label'   => __( 'H6 Font Size', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '16',
		'input_attrs' => array(
			'min'    => 1,
			'max'    => 60,
			'step'   => 1,
			'suffix' => 'px',
  	),
	);
	
	// Panel Pages & Posts Options
	$panel = 'panel-pages-posts-options';
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Daisy Store: Pages & Posts Options', 'daisy-store' ),
		'priority' => '14'
	);
	
	$section = 'section-title-bar';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Title Bar', 'daisy-store' ),
		'priority' => '9',
		'panel' => $panel
	);
	
	$options['display_titlebar'] = array(
			'id' => 'display_titlebar',
			'label'   => __( 'Display Title Bar', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			//'transport' => $transport,
		);
	
	
	$section = 'section-posts-archive';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Posts archive', 'daisy-store' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['blog_list_style'] = array(
		'id' => 'blog_list_style',
		'label'   => __( 'Posts Archive Layout', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		//'transport' => $transport,
		'choices' => array(
				'1'=> array('label'=>__( 'Full Width Image', 'daisy-store' ),'url'=> $imagepath.'customize/blog-style1.png'),
				'2'=> array('label'=>__( 'Side Image', 'daisy-store' ),'url'=> $imagepath.'customize/blog-style2.png'),
				'3'=> array('label'=>__( 'Grid', 'daisy-store' ),'url'=> $imagepath.'customize/blog-style3.png'),
				),
		'default' => '1'
	);
	
	//Display: Full Post/Excerpt
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	$options['excerpt_style'] = array(
		'id' => 'excerpt_style',
		'label'   => __( 'Excerpt', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => array(
				'0'=> __( 'Excerpt', 'daisy-store' ),
				'1'=> __( 'Full Post', 'daisy-store' ),
				),
		'default' => '0'
	);
	
	$options['excerpt_display_feature_image'] = array(
			'id' => 'excerpt_display_feature_image',
			'label'   => __( 'Display Feature Image', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
		
	$options['excerpt_display_category'] = array(
			'id' => 'excerpt_display_category',
			'label'   => __( 'Display Category', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	$options['excerpt_display_author'] = array(
			'id' => 'excerpt_display_author',
			'label'   => __( 'Display Author', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	$options['excerpt_display_date'] = array(
			'id' => 'excerpt_display_date',
			'label'   => __( 'Display Date', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	
	
	$section = 'section-posts-single';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Single Post', 'daisy-store' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	
	$options['display_feature_image'] = array(
			'id' => 'display_feature_image',
			'label'   => __( 'Display Feature Image', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
		
	$options['display_category'] = array(
			'id' => 'display_category',
			'label'   => __( 'Display Category', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	$options['display_author'] = array(
			'id' => 'display_author',
			'label'   => __( 'Display Author', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	$options['display_date'] = array(
			'id' => 'display_date',
			'label'   => __( 'Display Date', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	
	$section = 'section-sidebar-options';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Sidebar Settings', 'daisy-store' ),
		'priority' => '11',
		'panel' => $panel
	);
	// Sidebar
	
	$options['page_sidebar_layout'] = array(
		'id' => 'page_sidebar_layout',
		'label'   => __( 'Sidebar: Pages', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		//'choices' => array('no' =>__( 'No Sidebar', 'daisy-store' ),'left'=>__( 'Left Sidebar', 'daisy-store' ),'right'=>__( 'Right Sidebar', 'daisy-store' )),
		'choices' => array(
				'no'=> array('label'=>__( 'No Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-none.png'),
				'left'=> array('label'=>__( 'Left Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-left.png'),
				'right'=> array('label'=>__( 'Right Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-right.png'),
				),
		);
	
	$options['blog_sidebar_layout'] = array(
		'id' => 'blog_sidebar_layout',
		'label'   => __( 'Sidebar: Single Post', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		//'choices' => array('no' =>__( 'No Sidebar', 'daisy-store' ),'left'=>__( 'Left Sidebar', 'daisy-store' ),'right'=>__( 'Right Sidebar', 'daisy-store' )),
		'choices' => array(
				'no'=> array('label'=>__( 'No Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-none.png'),
				'left'=> array('label'=>__( 'Left Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-left.png'),
				'right'=> array('label'=>__( 'Right Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-right.png'),
				),
		);
	
	$options['blog_archives_sidebar_layout'] = array(
		'id' => 'blog_archives_sidebar_layout',
		'label'   => __( 'Sidebar: Posts Archive', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		'choices' => array('no' =>__( 'No Sidebar', 'daisy-store' ),'left'=>__( 'Left Sidebar', 'daisy-store' ),'right'=>__( 'Right Sidebar', 'daisy-store' )),
		'choices' => array(
				'no'=> array('label'=>__( 'No Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-none.png'),
				'left'=> array('label'=>__( 'Left Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-left.png'),
				'right'=> array('label'=>__( 'Right Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-right.png'),
				),
		);
		
	$options['woo_single_sidebar_layout'] = array(
		'id' => 'woo_single_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Single Product', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'daisy-store' ),'left'=>__( 'Left Sidebar', 'daisy-store' ),'right'=>__( 'Right Sidebar', 'daisy-store' )),
		'choices' => array(
				'no'=> array('label'=>__( 'No Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-none.png'),
				'left'=> array('label'=>__( 'Left Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-left.png'),
				'right'=> array('label'=>__( 'Right Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-right.png'),
				),
		);
		
	$options['woo_archives_sidebar_layout'] = array(
		'id' => 'woo_archives_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Archive', 'daisy-store' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'daisy-store' ),'left'=>__( 'Left Sidebar', 'daisy-store' ),'right'=>__( 'Right Sidebar', 'daisy-store' )),
		'choices' => array(
				'no'=> array('label'=>__( 'No Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-none.png'),
				'left'=> array('label'=>__( 'Left Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-left.png'),
				'right'=> array('label'=>__( 'Right Sidebar', 'daisy-store' ),'url'=> $imagepath.'customize/sidebar-right.png'),
				),
		);
	
	// General Options
/*	$panel = 'general-options';
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'General Options', 'daisy-store' ),
		'priority' => '12'
	);*/
	$section = 'dstore-general-options';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Daisy Store: General Options', 'daisy-store' ),
		'priority' => '15',
		'panel' => ''
	);
	
	$options['scheme'] = array(
			'id' => 'scheme',
			'label'   => __( 'Scheme', 'daisy-store' ),
			'section' => $section,
			'type'    => 'radio',
			//'transport' => 'postMessage', 
			'default' => 'light',
			'choices' => array(
				'light'    => __( 'Light', 'daisy-store' ),
				'dark'    => __( 'Dark', 'daisy-store' ),
  			),
			
		);
	
	$options['page_preloader'] = array(
			'id' => 'page_preloader',
			'label'   => __( 'Display Page Pre-loader', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '',
		);
		
	$options['preloader_background'] = array(
			'id' => 'preloader_background',
			'label'   => __( 'Pre-loader Background Color', 'daisy-store' ),
			'section' => $section,
			'type'    => 'color',
			//'transport' => 'postMessage', 
			'default' => '#999999',
		);
	
	$options['preloader_opacity'] = array(
		'id' => 'preloader_opacity',
		'label'   => __( 'Pre-loader Background Opacity', 'daisy-store' ),
		'section' => $section,
		'type'    => 'range-value',
		'default' => '0.8',
		'input_attrs' => array(
			'min'    => 0,
			'max'    => 1,
			'step'   => 0.1,
			'suffix' => '',
  	),
	);
	
	$options['preloader_image'] = array(
			'id' => 'preloader_image',
			'label'   => __( 'Pre-loader Image', 'daisy-store' ),
			'section' => $section,
			'type'    => 'image',
			//'transport' => 'postMessage', 
			'default' =>  $imagepath.'preloader.gif',
		);
		
	$options['display_scroll_to_top'] = array(
			'id' => 'display_scroll_to_top',
			'label'   => __( 'Enable Scroll to Top Button', 'daisy-store' ),
			'section' => $section,
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);
	
	$options['homepage_animation'] = array(
			'id' => 'homepage_animation',
			'label'   => __( 'Homepage Animation', 'daisy-store' ),
			'section' => 'static_front_page',
			'type'    => 'checkbox',
			//'transport' => 'postMessage', 
			'default' => '1',
		);

	$daisy_store_customizer_options = $options;
	
	$new_options = array();
	foreach( $options as $option ){
		if( isset($option['default']) ){
			$key = DAISY_STORE_TEXTDOMAIN.'['.$option['id'].']';
			$option['id'] = $key;
			$new_options[$key] = $option;
			}

		}
	// Adds the sections to the $options array
	$new_options['sections'] = $sections;

	// Adds the panels to the $options array
	$new_options['panels'] = $panels;
	
	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $new_options );
	return $options;

}
add_action( 'init', 'daisy_store_customizer_library_options' );