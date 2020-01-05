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
    // Delete the auction from the form information
    deleteAuction($pdo, $_POST['auction_id']);

    // Redirect user to dashboard page
    header('location: /id/dashboard.php');
  } else {
    // Retrieve the auction being edited
    $auction = getAuction($pdo, $_GET['id']);

    // Get category information
    $category = getCategory($pdo, $auction['category_id']);

    // Format timestamp
    $timestampDateTime = new DateTime($auction['auction_timestamp']);
    $timestampDate = $timestampDateTime->format('dS F Y');
    $timestampTime = $timestampDateTime->format('H:i');

    // Format start date
    $startDateTime = new DateTime($auction['start_date']);
    $startDate = $startDateTime->format('dS F Y');
    $startTime = $startDateTime->format('H:i');

    // Format end date
    $endDateTime = new DateTime($auction['end_date']);
    $endDate = $endDateTime->format('dS F Y');
    $endTime = $endDateTime->format('H:i');

    // Get start price and buy price
    $startPrice = formatCurrency($auction['start_price']);
    $buyPrice = formatCurrency($auction['buy_price']);

    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/auctions/delete.html.php';

    // Set the page title and output variables
    $title = 'Delete - Auction';
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
