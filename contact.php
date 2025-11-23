<?php
/*
Template Name: Contact Page
*/
?>

<?php
include('db_connect.php');

// Show if connection works


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo "<pre style='color:white; text-align:center;'>POST DATA:\n";
  print_r($_POST);
  echo "</pre>";
}


if (isset($_POST['send_message'])) {
  echo "<p style='color:yellow; text-align:center;'>Form detected. Processing...</p>";

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

  if (mysqli_query($conn, $query)) {
    echo "<p align='center' style='color:lightgreen;'>Message sent successfully!</p>";
  } else {
    echo "<p align='center' style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
  }
  
}
?>

<?php get_header(); ?>

<main class="contact-page" align="center">

<?php if ( isset($_GET['sent']) && $_GET['sent'] == 1 ) :
?>
<?php endif; ?>
  
  <h2>Contact Me</h2>
  <p>Phone: (473)407-1193<br>Personal Email: Cdgreasley@gmail.com<br>School Email: CadellG5223@TAMCC.EDU.GD</p>

<form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
  <input type="hidden" name="action" value="send_contact_message">
  <input type="text" name="name" placeholder="Your Name" required><br><br>
  <input type="email" name="email" placeholder="Your Email" required><br><br>
  <textarea name="message" placeholder="Your Message" required rows="5" cols="40"></textarea><br><br>
  <button type="submit" name="send_message">Send</button>
</form>

</main>

<?php get_footer(); ?>