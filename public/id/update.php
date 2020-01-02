<?php

// Includes (Database Interface, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DBInterface.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// If the user isn't logged in send them to the login page
if (!isset($_SESSION['uuid']))
  header('location: /id/login.php');


// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';
  
  // Get the user from the query string
  $user = getUser($pdo, $_GET['id']);
  
  // If the form has been submitted process the data if not show the form
  if (isset($_POST['submit'])) {

    // Update the user (Exc. user_pwd and is_admin)
    updateUser($pdo, $_POST['user_id'], $_POST['user_email'], $user['user_pwd'], $_POST['first_name'], $_POST['last_name'], $user['is_admin']);

    // Redirect the user back to the dashboard
    header('location: /id/dashboard.php');
  } else {
    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/id/update.html.php';

    // Set the page title and output variables
    $title = 'Update - Account';
    $output = ob_get_clean();
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

// Include the layout template
include __DIR__ . '/../../templates/layout.html.php';
