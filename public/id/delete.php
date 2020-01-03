<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
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
    deleteUser($pdo, $_POST['user_id']);

    // Clear the session
    unset($_SESSION['uuid']);

    // Redirect the user to the homepage
    header('location: /');
  } else {
    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/id/delete.html.php';

    // Set the page title and output variables
    $title = 'Delete - Account';
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
