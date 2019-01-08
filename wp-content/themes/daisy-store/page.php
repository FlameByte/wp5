<?php
	get_header();
	$page_sidebar_layout = apply_filters('daisy_store_page_sidebar_layout',daisy_store_option('page_sidebar_layout'));
	switch($page_sidebar_layout){
		case 'left':
			$aside_class = 'left-aside';
		break;
		case 'right':
			$aside_class = 'right-aside';
		break;
		default:
			$aside_class = 'no-aside';
		break;
		
		};
		
?>

<div class="page-wrap">
<?php do_action('daisy_store_before_page_wrap');?>
  <div class="container">
    <div class="page-inner row <?php echo $aside_class; ?>">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="post-entry text-left">
            <?php do_action('daisy_store_before_page_content');?>
            <?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/page/content' );

					the_posts_pagination( array(
					'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . __( 'Previous page', 'daisy-store' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'daisy-store' ) . '</span><i class="fa fa-arrow-right"></i>' ,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'daisy-store' ) . ' </span>',
				) );

				endwhile; // End of the loop.
			?>
           <?php do_action('daisy_store_after_page_content');?>         
          </article>
          <?php
		  global $post;
		  if ( comments_open($post->ID) ) :?>
          <div class="post-attributes">
         <!--Comments Area-->
            <div class="comments-area text-left">
              <?php
						comments_template();
			  ?>
            </div>            
          </div>
          <?php endif;?>
        </section>
      </div>
      <?php daisy_store_get_sidebar($page_sidebar_layout,'page');?>
    </div>
  </div>
</div>

<?php get_footer();