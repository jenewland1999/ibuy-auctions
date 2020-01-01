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
    // TODO: Implement form validation
    // TODO: formValidUserRegister($_POST)
    if (true) {
      // Create the user using the form
      createUser($pdo, $_POST['user_email'], password_hash($_POST['user_pwd'], PASSWORD_DEFAULT), $_POST['first_name'], $_POST['last_name'], false);

      // Fetch the user that was just created then login the user by storing their user_id in the $_SESSION super global
      $user = getUserByEmail($pdo, $_POST['user_email']);
      $_SESSION['uuid'] = $user['user_id'];

      // Redirect to the dashboard
      header('location: /id/dashboard.php');
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
  include __DIR__ . '/../../templates/id/register.html.php';

  // Set the page title and output variables
  $title = 'Register';
  $output = ob_get_clean();
}

// Include the layout template
include __DIR__ . '/../../templates/layout.html.php';
