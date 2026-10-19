<?php get_header(); ?><main id="main"><div class="wrap"><div class="crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> › News</div><h1>News and updates</h1><ul class="posts">
<?php if (have_posts()):while (have_posts()):the_post(); ?><li><p class="meta"><?php echo esc_html(get_the_date()); ?></p><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php the_excerpt(); ?></p></li><?php endwhile; the_posts_pagination(); else: ?><li><p>There are no news items to display.</p></li><?php endif; ?>
</ul></div></main><?php get_footer(); ?>
