<?php get_header(); ?><main id="main"><div class="wrap">
<div class="crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> › <?php the_title(); ?></div>
<div class="content-grid"><article class="article"><?php while (have_posts()): the_post(); ?><h1 class="page-title"><?php the_title(); ?></h1><?php the_content(); endwhile; ?></article>
<aside class="side" aria-label="Related pages"><h2>Government Communications</h2><ul><li><a href="<?php echo esc_url(home_url('/about/')); ?>">About the Service</a></li><li><a href="<?php echo esc_url(home_url('/learning/')); ?>">Professional learning</a></li><li><a href="<?php echo esc_url(home_url('/resources/')); ?>">Resources and guidance</a></li><li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact the Service</a></li></ul></aside>
</div></div></main><?php get_footer(); ?>
