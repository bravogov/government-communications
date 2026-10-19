<?php get_header(); ?>
<main id="main"><div class="wrap"><div class="crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> › <a href="<?php echo esc_url(home_url('/publication/')); ?>">Publications</a> › <?php the_title(); ?></div>
<div class="content-grid"><article class="article">
<?php while(have_posts()):the_post(); ?>
<p class="eyebrow">Professional guidance</p>
<h1><?php the_title(); ?></h1>
<p class="meta">Published <?php echo esc_html(get_the_date('j F Y')); ?></p>
<?php if (has_excerpt()): ?><p class="lead"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
<div class="publication-body"><?php the_content(); ?></div>
<?php endwhile; ?></article>
<aside class="side" aria-label="Related resources"><h2>Professional resources</h2><ul>
<li><a href="<?php echo esc_url(home_url('/publication/')); ?>">Browse all publications</a></li>
<li><a href="<?php echo esc_url(home_url('/standards/')); ?>">Professional standards</a></li>
<li><a href="<?php echo esc_url(home_url('/learning/')); ?>">Learning and development</a></li>
</ul></aside></div></div></main><?php get_footer(); ?>