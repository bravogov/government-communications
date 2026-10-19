<?php get_header(); ?>
<main id="main">
<section class="hero"><div class="wrap"><p class="eyebrow">Government Communication Service</p><h1>The professional body for government communicators</h1><p class="lead">Professional standards, career guidance, learning and practical resources for people delivering government communications across United Hampshire.</p>
<div class="hero-actions"><a class="button" href="<?php echo esc_url(home_url('/resources/')); ?>">Explore resources</a><a class="button button-alt" href="<?php echo esc_url(home_url('/membership/')); ?>">Professional membership</a></div></div></section>
<section class="section"><div class="wrap"><h2>Explore Government Communications</h2>
<?php uh_gcs_cards([
['About', 'about', 'Who we are, what we do and how the profession operates.'],
['Membership', 'membership', 'Eligibility, professional responsibilities and participation.'],
['Careers', 'careers', 'Recruitment routes and opportunities in government communications.'],
['Learning', 'learning', 'Build your skills through guidance, development and shared practice.'],
['Standards', 'standards', 'Civil Service propriety, effective practice and communications assurance.'],
['Resources', 'resources', 'Professional guidance and practical materials for communicators.'],
]); ?></div></section>
<section class="section"><div class="wrap"><div class="callout"><h2>Communications that serve the public</h2><p>Our work supports clear, accessible and impartial communication so that people can understand government decisions and use public services. Professional communicators work across departments, agencies and public bodies while remaining accountable to their own organisations.</p><a href="<?php echo esc_url(home_url('/standards/')); ?>">Read our professional standards</a></div></div></section>
<section class="section"><div class="wrap"><h2>Latest from Government Communications</h2>
<ul class="posts"><?php $latest = new WP_Query(['post_type'=>'post','posts_per_page'=>4,'post_status'=>'publish']); if ($latest->have_posts()) { while ($latest->have_posts()) { $latest->the_post(); echo '<li><div class="meta">' . esc_html(get_the_date()) . '</div><h3><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3><p>' . esc_html(get_the_excerpt()) . '</p></li>'; } wp_reset_postdata(); } else { echo '<li><p>Professional guidance and service updates are available through the links above.</p></li>'; } ?></ul>
<a href="<?php echo esc_url(home_url('/news/')); ?>">Read all news and updates</a></div></section>
</main><?php get_footer(); ?>
