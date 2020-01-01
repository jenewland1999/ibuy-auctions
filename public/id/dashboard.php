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

  // Get the user's details
  $user = getUser($pdo, $_SESSION['uuid']);

  // Get all the reviews for the user
  $reviews = getReviewsByUser($pdo, $_SESSION['uuid']);

  // Get all the auctions for the user
  $auctions = getAuctionsByUser($pdo, $_SESSION['uuid']);

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/id/dashboard.html.php';

  // Set the page title and output variables
  $title = 'Dashboard';
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
include __DIR__ . '/../../templates/layout.html.php';
