<?php
// Start session ONCE for all pages
add_action('init', 'start_user_session', 1);
function start_user_session() {
    if (!session_id()) {
        session_start();
    }
}

// Restrict site access
function restrict_site_access() {
    // Don't redirect if user is already logged in
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        return;
    }

    // Get the current URL path (convert to lowercase for comparison)
    $current_url = strtolower($_SERVER['REQUEST_URI']);

    // If we're already on login or register page, don't redirect
    if (strpos($current_url, '/login') !== false || 
        strpos($current_url, '/register-page') !== false) {
        return;
    }

    // Redirect to login
    wp_redirect(home_url('/login/'));
    exit;
}
add_action('template_redirect', 'restrict_site_access');




// Logout handler
add_action('template_redirect', 'handle_logout');
function handle_logout() {
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        session_start();
        
        // Destroy all session data
        $_SESSION = array();
        session_destroy();
        
        // Redirect to login page
        wp_redirect(home_url('/login/?logged_out=1'));
        exit;
    }
}




// Contact form handler
add_action('admin_post_nopriv_send_contact_message', 'handle_contact_form');
add_action('admin_post_send_contact_message', 'handle_contact_form');

function handle_contact_form() {
    include get_template_directory() . '/db_connect.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO contact_messages (name, email, message)
              VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $query)) {
        wp_redirect( home_url('/contact/?sent=1') );
    } else {
        error_log("SQL Error (contact): " . mysqli_error($conn));
        wp_redirect( home_url('/contact/?sent=0') );
    }
    exit;
}

// Feedback form handler
add_action('admin_post_nopriv_send_feedback', 'handle_feedback_form');
add_action('admin_post_send_feedback', 'handle_feedback_form');

function handle_feedback_form() {
    include get_template_directory() . '/db_connect.php';

    if (!$conn) {
        die("<p style='color:red;text-align:center;'>❌ Database connection failed.</p>");
    }

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO feedback (name, message)
              VALUES ('$name', '$message')";

    if (mysqli_query($conn, $query)) {
        wp_redirect( home_url('/feedback/?sent=1') );
        exit;
    } else {
        echo "<p style='color:red;text-align:center;'>❌ SQL Error: " . mysqli_error($conn) . "</p>";
        exit;
    }
}

// Enqueue back to top JavaScript
function enqueue_back_to_top() {
    wp_enqueue_script('back-to-top', get_template_directory_uri() . '/back-to-top.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_back_to_top');