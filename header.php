<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
  <h1 align="center"><?php bloginfo('name'); ?></h1>
</header>

<?php
// Check current URL
$current_url = $_SERVER['REQUEST_URI'];
$hide_nav = (strpos($current_url, '/login') !== false || strpos($current_url, '/register-page') !== false);

if (!$hide_nav) :
?>
  <nav id="topmenu" align="center">
    <a href="<?php echo home_url('/'); ?>">Home</a>
    <a href="<?php echo home_url('/aboutapp/'); ?>">About App</a>
    <a href="<?php echo home_url('/aboutme/'); ?>">About Me</a>
    <a href="<?php echo home_url('/contact/'); ?>">Contact</a>
    <a href="<?php echo home_url('/feedback/'); ?>">Feedback</a>
    <a href="<?php echo home_url('/updates/'); ?>">Updates</a>
    <a href="<?php echo home_url('/download/'); ?>">Download</a>
    <a href="<?php echo home_url('/projects/'); ?>">Projects</a>
    
    <?php
    // Show logout button if user is logged in
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) :
    ?>
      <a href="<?php echo home_url('/?action=logout'); ?>">Logout</a>
    <?php endif; ?>
  </nav>
<?php endif; ?>