<?php
/*
Template Name: Register Page
*/

include('db_connect.php');
$message = "";

// Show DB errors during debugging (remove on production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Basic sanitizing
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $message = "❌ Passwords do not match.";
    } elseif (empty($username) || empty($email) || empty($password)) {
        $message = "❌ Please fill all fields.";
    } else {
        try {
            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Use prepared statements to avoid SQL injection
            $stmt = $conn->prepare("INSERT INTO login (Username, Email, Password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $username, $email, $hashed_password);
            $stmt->execute();
            $stmt->close();

            // Log signup activity (prepared)
            $stmt2 = $conn->prepare("INSERT INTO signup_activity (Username, Email) VALUES (?, ?)");
            $stmt2->bind_param('ss', $username, $email);
            $stmt2->execute();
            $stmt2->close();

            // Success message (or redirect to login)
            $message = "✅ Registration successful! You may now <a href=\"" . home_url('/login/') . "\">log in</a>.";

        } catch (mysqli_sql_exception $e) {
            // Show detailed error for debugging (unique constraint, etc.)
            $message = "❌ Database error: " . $e->getMessage();
        } catch (Exception $e) {
            $message = "❌ Error: " . $e->getMessage();
        }
    }
}

get_header();
?>

<main class="contact-main">
  <div class="contact-container">
    <h2>Sign Up</h2>

    <?php 
    if (!empty($message)) {
        echo "<p class='contact-success'>$message</p>";
    }
    ?>

    <form method="POST" class="contact-form" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>

    <p style="margin-top:15px;">
      Already have an account? <a href="<?php echo home_url('/login/'); ?>" style="color:#00ffff;">Login here</a>
    </p>
  </div>
</main>

<?php get_footer(); ?>