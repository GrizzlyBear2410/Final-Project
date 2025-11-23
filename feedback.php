<?php
/*
Template Name: Feedback
*/
?>

<?php
  include('db_connect.php');
   
 
 if (isset($_POST['submit'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);
      
      $query = "INSERT INTO feedback (name, message) VALUES ('$name', '$message')";
      if (mysqli_query($conn, $query)) {
        echo "<p class='feedback-success'>Thank you for your feedback!!</p>";
      } else {
        echo "<p class='feedback-error'>There was a problem saving your feedback.</p>";
      }
    }
    ?>


  <?php get_header(); ?>

<main class="feedback-main">
  <div class="feedback-container">
    <h2> Share Your Feedback</h2>
    <p>Any views or suggestions you may have is greatly appreciated! Your feedback helps us to improve the app further.</p>

    <?php if ( isset($_GET['sent']) && $_GET['sent'] == 1 ): ?>
      <p class="contact-success">Message sent successfully!</p>
    <?php endif; ?>

    <form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
  <input type="hidden" name="action" value="send_feedback">
  <input type="text" name="name" placeholder="Your Name" required><br><br>
  <textarea name="message" placeholder="Your Feedback" required rows="5" cols="40"></textarea><br><br>
  <button type="submit" name="submit">Send</button>
</form>

</main>

<?php get_footer(); ?>