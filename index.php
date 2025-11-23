<?php
/*
Template Name: Home
*/
get_header();
?>

<header>
  <h1>TAMCC Navigation App</h1>
</header>

<main id="home">
  <section id="intro">
    <h2>Find Your Way Around Campus, Instantly!</h2>
    <p class="tagline">Explore classrooms, labs, and study spots with ease.</p>
    <a href="<?php echo home_url('/download/'); ?>" class="cta-button">Download Now</a>
  </section>

  <section id="features-section">
    <div class="features-header">
      <h2>TNA</h2>
      <p>Everything you need to navigate campus with confidence</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <h3>Interactive Campus Map</h3>
      </div>

      <div class="feature-card">
        <h3>Search for Rooms</h3>
      </div>

      <div class="feature-card">
        <h3>Check Class Availability</h3>
      </div>

      <div class="feature-card">
        <h3>See Campus Events</h3>
      </div>
    </div>
  </section>

  <footer>
    <p>© 2025 Cadell Greasley</p>
  </footer>
</main>

<?php get_footer(); ?>