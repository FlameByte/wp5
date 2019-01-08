<?php
	get_header();
?>
<div class="page-wrap">
<?php do_action('daisy_store_before_page_wrap');?>  
  <div class="container">
    <div class="page-inner row no-aside">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="post-entry text-left">
            <?php do_action('cactus_before_page_content');?>
           <h1><?php esc_html_e( '404 Nothing Found', 'daisy-store' );?></h1>
<p><?php esc_html_e( 'Sorry, the page could not be found.', 'daisy-store' );?></p>
<a href="javascript:;" onClick="javascript :history.back(-1);"><span class="cactus-btn cactus-primary"><?php echo esc_html_e( 'Go Back', 'daisy-store' );?></span></a>
           <?php do_action('daisy_store_after_page_content');?>         
          </article>
          
        </section>
      </div>
    </div>
  </div>
</div>

<?php get_footer();