<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to main content</a>
<div class="notice"><div class="wrap">United Hampshire civic community · Government Communication Service · <a href="<?php echo esc_url(home_url('/about/')); ?>">About this service</a></div></div>
<header class="masthead"><div class="wrap masthead-inner">
<a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Government Communications homepage"><span>Government<br>Communications<small>Government Communication Service</small></span></a>
<form class="searchform" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><label for="site-search" class="screen-reader-text">Search professional resources</label><input id="site-search" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search this website"><button type="submit">Search</button></form>
</div></header>
<?php uh_gcs_navigation(); ?>
