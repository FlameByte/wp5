  <div class="cactus-header cactus-classic-header right">
  <?php get_template_part( 'template-parts/header/header', 'top-bar' ); ?>
            <div class="cactus-main-header">
            
                <div class="cactus-logo">
                <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
                   
                    <div class="cactus-f-microwidgets">
                        <div class="cactus-microwidget cactus-search-full">
                            <form role="search" class="searchform searchform-cats" method="get" action="<?php echo esc_url( home_url( '/'  ) );?>">
                                <div>
                                    
                                    <label class="screen-reader-text"><?php esc_attr__('Search for','daisy-store');?>:</label>
                                    <input type="text" class="search-field" placeholder="<?php esc_attr_e('Search','daisy-store');?> ..." value="<?php echo get_search_query(); ?>" name="s">
                                    <input type="hidden" value="product" name="post_type" id="post_type" />
                                    <?php
								
								if ( class_exists( 'WooCommerce' ) ) {	

								$args = array(
								  'taxonomy' => 'product_cat',
								  'show_option_all' => esc_attr__('All Categories','daisy-store'),
								  'class' => 'select_products',
								  'name' => 'product_cat',
								  'value_field' => 'slug',
								  'selected' => isset($_GET['product_cat'])?$_GET['product_cat']:'',
								);
								wp_dropdown_categories( $args );
								
								}
								
								?>
                                    <input type="submit" class="search-submit" value="<?php esc_attr_e('Search','daisy-store');?>">
                                </div>                                    
                            </form>
                        </div>
                    </div>
                    <?php
					$display_shopping_cart_icon = daisy_store_option('display_shopping_cart_icon');
					$display_shopping_cart_icon = apply_filters('daisy_store_display_shopping_cart_icon', $display_shopping_cart_icon);
					?>
                    <div class="cactus-f-microwidgets">
                    <?php
					global $woocommerce;
					if ( $woocommerce && $display_shopping_cart_icon == '1' ):
						
						$cart_contents_count = $woocommerce->cart->cart_contents_count;
						$cart_url = esc_url(wc_get_cart_url());
						if ( $cart_contents_count <= 0 )
							$cart_url = 'javascript:;';
							
					?>
                        <div class="cactus-microwidget cactus-shopping-cart">
                            <a href="<?php echo $cart_url;?>" class="cactus-shopping-cart-label">
                                <span class="cactus-shopping-cart-num"><?php echo $cart_contents_count;?></span>
                            </a>
                            <div class="cactus-shopping-cart-wrap right-overflow">
                                <div class="cactus-shopping-cart-inner">
                                    <ul class="cart_list product_list_widget empty">
                                        <li> <?php echo apply_filters('daisy_store_shopping_cart',esc_html__( 'No products in the cart.', 'daisy-store' ));?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    
                </div>
                
                <nav class="cactus-navigation">
                <?php
					
					$categories_menu_toggle = daisy_store_option('categories_menu_toggle');
					$categories_menu_toggle = apply_filters('daisy_store_categories_menu_toggle', $categories_menu_toggle);
					
					if( $categories_menu_toggle == '1' ){
						get_template_part( 'template-parts/header/header', 'cate-menu' );
						}
				?>
      
              <?php get_template_part( 'template-parts/header/header', 'top-menu' ); ?>
                </nav>                
            </div>
            <?php get_template_part( 'template-parts/header/header', 'mobile' ); ?>
        </div>
        
  <div class="cactus-fixed-header-wrap" style="display: none;">
            <div class="cactus-header cactus-inline-header right shadow">
                <div class="cactus-main-header">
                    <div class="cactus-logo">
                        <?php get_template_part( 'template-parts/header/header', 'stickylogo' ); ?>
                    </div>
                     <?php get_template_part( 'template-parts/header/header', 'top-menu' ); ?>
                   
                </div>
               <?php get_template_part( 'template-parts/header/header', 'mobile' ); ?>
            </div>
        </div>