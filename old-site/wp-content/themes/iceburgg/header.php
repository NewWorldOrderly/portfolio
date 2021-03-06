<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
	<style type="text/css" media="screen">
			@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
<div id="top"></div>
<div id="logo">
	<div class="title">
		<h2>
			<?php bloginfo('name'); ?>
		</h2>
	</div>
	<div class="tagline">
		<?php bloginfo('description'); ?>
	</div>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div id="navigation">
	<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary', 'fallback_cb' => 'iceburgg_page_menu' ) ); ?>
	<div style="clear: both"></div>
</div>
<div style="clear: both"></div>
<div id="header"></div>
<div style="clear: both"></div>
