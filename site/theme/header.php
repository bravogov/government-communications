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
<header class="gc-header">
  <div class="gc-container gc-header-inner">
    <a class="gc-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Government Communications homepage">
      <?php if ($mark = uh_gcs_media_url('crest')) : ?><img class="gc-crown" src="<?php echo esc_url($mark); ?>" alt="" width="39" height="37"><?php endif; ?>
      <span class="gc-brand-name">Government Communications</span>
    </a>
    <div class="gc-controls">
      <details class="gc-pop gc-menu">
        <summary>Menu <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="m6 9 6 6 6-6" fill="none" stroke="currentColor" stroke-width="2"/></svg></summary>
        <div class="gc-pop-panel gc-menu-panel">
          <?php uh_gcs_navigation(); ?>
          <div class="gc-extra-links"><a href="<?php echo esc_url(home_url('/learning/')); ?>">Learning and development</a><a href="<?php echo esc_url(home_url('/standards/')); ?>">Professional standards</a><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></div>
        </div>
      </details>
      <details class="gc-pop gc-search-toggle">
        <summary aria-label="Search this website"><svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="7.2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m16.2 16.2 5.2 5.2" fill="none" stroke="currentColor" stroke-width="1.8"/></svg></summary>
        <div class="gc-pop-panel gc-search-panel">
          <form class="gc-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <label for="gc-search-input">Search Government Communications</label>
            <div><input id="gc-search-input" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>"><button type="submit">Search</button></div>
          </form>
        </div>
      </details>
      <a class="gc-sign-in" href="<?php echo esc_url(wp_login_url()); ?>" aria-label="Publisher sign in"><svg viewBox="0 0 24 24" width="23" height="23" aria-hidden="true"><circle cx="12" cy="7" r="4" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M3 21v-2c0-4.4 3.5-6.5 9-6.5s9 2.1 9 6.5v2Z" fill="none" stroke="currentColor" stroke-width="1.7"/></svg><span>Sign in</span></a>
    </div>
  </div>
</header>
