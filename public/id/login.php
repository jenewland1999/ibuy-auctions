<?php

// Includes (Database Interface, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DBInterface.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// If the user is logged in send them to the dashboard page
if (isset($_SESSION['uuid']))
  header('location: /id/dashboard.php');

if (isset($_POST['submit'])) {
  // Attempt to establish a DB connection.
  try {
    // Include the database connection (Initialises the $pdo variable)
    include_once __DIR__ . '/../../includes/DatabaseConnection.php';

    // Check if the form data is valid
    // TODO: Implement form validation (formValidUserRegister($_POST))
    if (true) {
      // Retrieve the user with the matching email address
      $user = getUserByEmail($pdo, $_POST['user_email']);

      // If the entered password matches the hash in 
      // the DB log the user in and redirect them to 
      // the dashboard.
      // TODO: Implement failed login attempts (properly)
      if (password_verify($_POST['user_pwd'], $user['user_pwd'])) {
        // Log the user in
        $_SESSION['uuid'] = $user['user_id'];
        
        // Redirect to the dashboard
        header('location: /id/dashboard.php');
      } else {
        $output = 'Incorrect username or password!';
      }
    } else {
      $output = 'Incorrect form input';
    }
  } catch (PDOException $e) {
    // Catch any errors and print them to the screen.
    // ! Remove this for production!
    $title = '500 Internal Server Error';
    $output = '
      <p>Uh Oh... Something went wrong.</p>
      <pre>
        Database Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '
      </pre>
    ';
  }
} else {
  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/id/login.html.php';

  // Set the page title and output variables
  $title = 'Login - Account';
  $output = ob_get_clean();
}

// Include the layout template
include __DIR__ . '/../../templates/layout.html.php';
