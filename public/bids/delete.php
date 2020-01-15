<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// Check if user is logged in if not redirect to login
if (!isset($_SESSION['uuid']))
  header('location: /id/login.php');

// Check if id is set in qry string if not redirect to homepage
if (!isset($_GET['id']))
  header('location: /');

// Check if from is set in the qry string if not redirect to homepage
if (!isset($_GET['from']))
  header('location: /');

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';

  // Retrieve the bid from the query string id
  $bid = getBid($pdo, $_GET['id']);

  // If no bid is found return to homepage
  if ($bid === false)
    header('location: /');

  // Check if the logged in user created the bid and if not return to homepage
  if ($bid['bid_author'] !== $_SESSION['uuid'])
    header('location: /');

  // Retrieve the auction that relates to the bid
  $auction = getAuction($pdo, $bid['auction_id']);

  // If no auction is found return to homepage
  if ($auction === false)
    header('location: /');

  // Check where the user came from so they can be redirected to the correct place
  if ($_GET['from'] === 'dashboard')
    $origin = '/id/dashboard.php';
  else if ($_GET['from'] === 'bids')
    $origin = '/bids/index.php?auction=' . $bid['auction_id'];
  else
    $origin = '/';

  if (isset($_POST['submit'])) {
    // Delete the bid from the database
    deleteBid($pdo, $_POST['bid_id']);

    header('location: ' . $origin);
  } else {
    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/bids/delete.html.php';

    // Set the page title and output variables
    $title = 'Delete - Bid';
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
