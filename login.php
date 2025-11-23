<?php
/*
Template Name: Login Page
*/
?>

<?php
// REMOVE session_start() - it's now handled in functions.php
include('db_connect.php');

$message = "";

// ONLY run login code when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM login WHERE Username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['Password'])) {

            // LOGIN SUCCESSFUL
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $row['Username'];

            // record login to database
            $user = $row['Username'];
            $ip = $_SERVER['REMOTE_ADDR'];
            mysqli_query($conn, "INSERT INTO login_activity (Username, ip_address) VALUES ('$user', '$ip')");

            wp_redirect(home_url('/'));
            exit;

        } else {
            $message = "❌ Incorrect password.";
        }

    } else {
        $message = "❌ No account found with that username.";
    }
}
?>

<?php get_header(); ?>

<main class="contact-main">
  <div class="contact-container">
    <h2>Login</h2>

    <?php 
    if (!empty($message)) {
        echo "<p class='contact-error'>$message</p>";
    }
    ?>

    <form method="POST" class="contact-form">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p style="margin-top:15px;">
      Don't have an account? <a href="<?php echo home_url('/register-page/'); ?>" style="color:#00ffff;">Register here</a>
    </p>
  </div>
</main>

<?php get_footer(); ?>