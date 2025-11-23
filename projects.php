<?php
/*
Template Name: Projects
*/
get_header();
?>

<header>
  <h1>TAMCC Navigation App</h1>
</header>

<main id="projects">
    <h2>My Projects</h2>
    <p class="projects-intro">Here are other projects I am currently working on:</p>

    <div class="project-gallery">
        <div class="project-card">
            <div class="project-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Task-manager.png" alt="File Management">
            </div>
            <div class="project-info">
                <h3>File Management System</h3>
                <p>A simple file Management system algorithm.</p>
            </div>
        </div>

        <div class="project-card">
            <div class="project-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/architecture.png" alt="Architecture">
            </div>
            <div class="project-info">
                <h3>Arcitectural History Site</h3>
                <p>A site done for practice in the fundamental basics of web design.</p>
            </div>
        </div>

        <div class="project-card">
            <div class="project-image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/hrcompany.png" alt="Hr Company">
            </div>
            <div class="project-info">
                <h3>HR Company Site</h3>
                <p>A website exercise done to practice responsive design.</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>