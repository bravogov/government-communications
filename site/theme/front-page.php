<?php get_header(); ?>
<main id="main" class="gc-home">
  <section class="gc-hero" aria-labelledby="gc-home-title">
    <?php if ($photo = uh_gcs_media_url('hero')): ?><img class="gc-hero-image" src="<?php echo esc_url($photo); ?>" alt="" fetchpriority="high"><?php endif; ?>
    <div class="gc-hero-fade"></div>
    <div class="gc-container gc-hero-content">
      <h1 id="gc-home-title">The professional<br>body for<br>government<br>communicators</h1>
    </div>
  </section>
  <section class="gc-intro" aria-labelledby="gc-intro-title">
    <div class="gc-intro-image"><?php if ($photo = uh_gcs_media_url('welcome')): ?><img src="<?php echo esc_url($photo); ?>" alt="" loading="lazy"><?php endif; ?></div>
    <div class="gc-intro-copy">
      <h2 id="gc-intro-title">Supporting government communicators</h2>
      <p>Government Communications brings professional standards, practical resources and career development together in one place.</p>
      <p>Explore guidance and services for communicators working in departments, agencies and public bodies across United Hampshire.</p>
      <a class="gc-text-link gc-on-dark" href="<?php echo esc_url(home_url('/resources/')); ?>">Explore our guidance <span aria-hidden="true">→</span></a>
    </div>
  </section>
  <section class="gc-explore gc-section">
    <div class="gc-container">
      <h2>Explore Government Communications</h2>
      <div class="gc-quicklinks">
        <a href="<?php echo esc_url(home_url('/about/')); ?>"><strong>About</strong><span>Who we are, what we do and how the profession works</span><b aria-hidden="true">↗</b></a>
        <a href="<?php echo esc_url(home_url('/membership/')); ?>"><strong>Membership</strong><span>Professional participation, support and eligibility</span><b aria-hidden="true">↗</b></a>
        <a href="<?php echo esc_url(home_url('/careers/')); ?>"><strong>Careers</strong><span>Starting and developing a communications career</span><b aria-hidden="true">↗</b></a>
        <a href="<?php echo esc_url(home_url('/resources/')); ?>"><strong>Resources</strong><span>Professional tools, guidance and publications</span><b aria-hidden="true">↗</b></a>
        <a href="<?php echo esc_url(home_url('/news/')); ?>"><strong>News</strong><span>Latest announcements and professional updates</span><b aria-hidden="true">↗</b></a>
      </div>
    </div>
  </section>
  <section class="gc-feature">
    <div class="gc-feature-image"><?php if ($photo = uh_gcs_media_url('profession')): ?><img src="<?php echo esc_url($photo); ?>" alt="" loading="lazy"><?php endif; ?></div>
    <div class="gc-feature-copy gc-feature-dark"><blockquote>We are building a skilled, inclusive profession that supports clear communication across government.</blockquote><a href="<?php echo esc_url(home_url('/about/')); ?>">About the profession <span aria-hidden="true">→</span></a></div>
  </section>
  <section class="gc-feature gc-feature-reverse">
    <div class="gc-feature-copy gc-feature-light"><blockquote>Government communications must be effective, responsible and impartial. Our standards support good practice across the Civil Service.</blockquote><a href="<?php echo esc_url(home_url('/standards/')); ?>">Read our standards <span aria-hidden="true">→</span></a></div>
    <div class="gc-feature-image"><?php if ($photo = uh_gcs_media_url('welcome')): ?><img src="<?php echo esc_url($photo); ?>" alt="" loading="lazy"><?php endif; ?></div>
  </section>
  <section class="gc-feature">
    <div class="gc-feature-image"><?php if ($photo = uh_gcs_media_url('learning')): ?><img src="<?php echo esc_url($photo); ?>" alt="" loading="lazy"><?php endif; ?></div>
    <div class="gc-feature-copy gc-feature-blue"><blockquote>Develop your skills, strengthen professional capability and make government information clearer for everyone.</blockquote><a href="<?php echo esc_url(home_url('/learning/')); ?>">Explore learning and development <span aria-hidden="true">→</span></a></div>
  </section>
  <section class="gc-featured gc-section">
    <div class="gc-container">
      <h2>Featured guidance</h2>
      <div class="gc-featured-grid">
        <article class="gc-featured-card"><span class="gc-kicker">Professional guidance</span><h3><a href="<?php echo esc_url(home_url('/publication/communication-planning/')); ?>">Plan a communication activity</a></h3><p>Set clear objectives, identify audiences and establish responsibilities for delivery.</p></article>
        <article class="gc-featured-card"><span class="gc-kicker">Professional guidance</span><h3><a href="<?php echo esc_url(home_url('/publication/evaluating-communications/')); ?>">Evaluate government communications</a></h3><p>Use evidence and proportionate evaluation to assess outcomes and improve effectiveness.</p></article>
        <article class="gc-featured-card"><span class="gc-kicker">Professional guidance</span><h3><a href="<?php echo esc_url(home_url('/publication/accessible-communications/')); ?>">Publish accessible communication</a></h3><p>Make public information easier to find, understand and use.</p></article>
      </div>
      <p class="gc-featured-more"><a href="<?php echo esc_url(home_url('/publication/')); ?>">Browse all publications <span aria-hidden="true">→</span></a></p>
    </div>
  </section>
  <section class="gc-bottom-link"><div class="gc-container"><h2>Working in government communications?</h2><p>Find guidance on professional standards, careers and the development of communications skills.</p><a class="gc-button" href="<?php echo esc_url(home_url('/membership/')); ?>">Explore membership</a></div></section>
</main>
<?php get_footer(); ?>
