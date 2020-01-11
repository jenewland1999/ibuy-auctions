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

  if (isset($_POST['submit'])) {
    // Update the auction's approve field to true
    updateAuction($pdo, [
      'auction_id' => $_POST['auction_id'],
      'approved' => true
    ]);

    // Redirect user to auctions page
    header('location: /admin/auctions/');
  } else {
    // Retrieve the auction being edited
    $auction = getAuction($pdo, $_GET['id']);

    // Get category and user information
    $category = getCategory($pdo, $auction['category_id']);
    $user = getUser($pdo, $auction['user_id']);

    // Format timestamp
    $timestampDateTime = new DateTime($auction['auction_timestamp']);
    $timestampDate = $timestampDateTime->format('d-M-Y');
    $timestampTime = $timestampDateTime->format('H:i');

    // Format start date
    $startDateTime = new DateTime($auction['start_date']);
    $startDate = $startDateTime->format('d-M-Y');
    $startTime = $startDateTime->format('H:i');

    // Format end date
    $endDateTime = new DateTime($auction['end_date']);
    $endDate = $endDateTime->format('d-M-Y');
    $endTime = $endDateTime->format('H:i');

    // Get start price and buy price
    $startPrice = formatCurrency($auction['start_price'], '£');
    $buyPrice = formatCurrency($auction['buy_price'], '£');

    // TODO: Implement retrieval of current bid
    // Get current bid
    // $currentBid = formatCurrency(getCurrentBid($auction['auction_id']));

    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../../templates/admin/auctions/approve.html.php';

    // Set the page title and output variables
    $title = 'Approve - Auction - Admin';
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
include __DIR__ . '/../../../templates/layout.html.php';
