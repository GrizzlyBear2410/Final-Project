<?php
/*
Template Name: About App
*/
get_header();
?>

<main class="aboutapp">
  <header>
    <h1>TAMCC Navigation App</h1>
  </header>

  <section class="aboutapp_what">
    <h2>What is TNA</h2>
    <p>The TNA (TAMCC Navigation App) is a GPS based navigation application that allows for individuals to view an interactive map of campus.</p>
    <p>Students will also be able to search for classes as well as their availability times.</p>
  </section>

  <section class="aboutapp_features">
    <h2>Features</h2>
    
    <ul>
      <li id="map">
        Interactive Map ▼
        <div class="dropdown">View the entire campus layout with GPS tracking</div>
      </li>
      <li id="room">
        See Available Rooms ▼
        <div class="dropdown">Check which classrooms, labs and other areas are currently free</div>
      </li>
      <li id="event">
        Check Campus Events ▼
        <div class="dropdown">Stay updated on upcoming campus activities and schedules</div>
      </li>
      <li id="search">
        Search for Buildings, Offices, Classrooms and more ▼
        <div class="dropdown">Quick search functionality to find any location on campus</div>
      </li>
    </ul>
  </section>

  <section class="aboutapp_how">
    <h2>How does the App work?</h2>
    <ol>
      <li><span id="searchhow">Search</span>: Type the name of a Classroom or building</li>
      <li><span id="viewhow">View Map</span>: See your location on the map</li>
      <li><span id="checkhow">Check Info</span>: See class information, such as free periods</li>
    </ol>
  </section>
</main>

<?php get_footer(); ?>