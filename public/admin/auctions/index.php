<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../../includes/Utilities.php';

// Check if user is logged in if not redirect to login
if (!isset($_SESSION['uuid']))
  header('location: /id/login.php');

// Check if user is an admin if not redirect to homepage
if (!isAdmin($pdo, $_SESSION['uuid']))
  header('location: /');

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../../includes/DatabaseConnection.php';

  // Retrieve ALL auctions 
  $auctions = getAuctions($pdo);

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../../templates/admin/auctions/index.html.php';

  // Set the page title and output variables
  $title = 'Auctions - Admin';
  $output = ob_get_clean();

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
include __DIR__ . '/../../../templates/layout.html.php';
