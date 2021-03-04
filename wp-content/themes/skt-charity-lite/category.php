<?php 
/**
 * The Category page for SKT Charity Lite
 *
 * Displays the Category pages.
 *
 * @package SKT Charity Lite
 * 
 * @since SKT Charity Lite 1.0
 */
global $complete;?>

<?php get_header(); ?>
        
	<!--Category Posts-->
    <div class="category_wrap layer_wrapper">
        <!--CUSTOM PAGE HEADER STARTS-->
            <?php get_template_part('sktframe/core','pageheader'); ?>
        <!--CUSTOM PAGE HEADER ENDS-->
        
        <?php get_template_part('templates/post','layout'.absint($complete['cat_layout_id']).''); ?>
    </div><!--layer_wrapper class END-->

<?php get_footer(); ?>