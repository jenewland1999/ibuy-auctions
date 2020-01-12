<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// Check if user is logged in if not redirect to login
if (!isset($_SESSION['uuid']))
  header('location: /id/login.php');

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';

  if (isset($_POST['submit'])) {
    // Delete the review from the form information
    deleteReview($pdo, $_POST['review_id']);

    // If the user came from an auction redirect them there otherwise redirect them to dashboard
    if (isset($_GET['auction_id'])) 
      header('location: /auctions/auction.php?id=' . $_GET['auction_id']);
    else 
      header('location: /id/dashboard.php');
  } else {
    // Retrieve the review being edited
    $review = getReview($pdo, $_GET['id']);

    // If the review doesn't exist redirect to homepage
    // TODO: Improve this error handling
    if ($review === false)
      header('location: /');

    // Check if the review belongs to the person logged in if not redirect to homepage
    // TODO: Improve this error handling
    if ($review['review_author'] !== $_SESSION['uuid'])
      header('location: /');

    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/reviews/delete.html.php';

    // Set the page title and output variables
    $title = 'Delete - Review';
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
