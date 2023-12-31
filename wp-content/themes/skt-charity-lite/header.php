<?php 
/**
 * The Header for SKT Charity Lite
 *
 * Displays all of the <head> section and everything
 *
 * @package SKT Charity Lite
 * 
 * @since SKT Charity Lite 1.0
 */
/*OPTION DEFAULTS*/ 
global $complete;
$complete = complete_option_defaults();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />	
<?php // Google Chrome Frame for IE ?>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<!--HEADER-->
<div class="header_wrap layer_wrapper">
	<?php 
		$headertype = $complete['header_layout_id']; 
		$typenum = preg_replace("/[^0-9]/","",$headertype);
	?>
	<?php get_template_part('templates/head','type'.$typenum); ?>
</div><!--layer_wrapper class END-->