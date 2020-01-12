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

  // If no profile is specified redirect to homepage
  // TODO: Improve error handling
  if (!isset($_GET['id']))
    header('location: /');

  // Get the user's details
  $user = getUser($pdo, $_GET['id']);

  // If no user was found redirect to homepage
  // TODO: Improve error handling
  if ($user === false)
    header('location: /');

  // Get all the reviews for the user
  $reviewsReceived = getReviewsForUser($pdo, $_GET['id']);

  // Get all the reviews for the user
  $reviewsGiven = getReviewsByUser($pdo, $_GET['id']);

  // Get all the auctions for the user
  $auctions = getAuctionsByUserRestricted($pdo, $_GET['id']);

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/id/profile.html.php';

  // Set the page title and output variables
  $title = getUserFullName($user) . ' - Profile';
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
