<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';

  // If the auction is not specified redirect user to homepage
  // TODO: Improve error handling
  if (!isset($_GET['auction']))
    header('location: /');

  // Retrieve the auction details
  $auction = getAuction($pdo, $_GET['auction']);

  // If the auction can't be found redirect user to homepage
  // TODO: Improve error handling
  if ($auction === false)
    header('location: /');

  // Retrieve all the bids for the auction found
  $bids = getBidsByAuction($pdo, $auction['auction_id']);

  if (isset($_POST['submit'])) {
    // Check the amount being entered and if it's lower than the current bid display an error
    echo 'Bid Entered: ' . processCurrency($_POST['bid_amount']);
    echo 'Bid Current: ' . getBidCurrentPrice($pdo, $auction['auction_id']);
    if (processCurrency($_POST['bid_amount']) < getBidCurrentPrice($pdo, $auction['auction_id'])) {
      $_SESSION['errors'] = [[
        'lvl' => 'warning',
        'msg' => '<strong>Too Low Maestro!</strong> Please enter a bid amount higher than the current bid'
      ]];
      header('refresh: 0');
    } else {
      // Clear errors
      unset($_SESSION['errors']);

      createBid($pdo, [
        'bid_amount' => processCurrency($_POST['bid_amount']),
        'bid_author' => $_SESSION['uuid'],
        'bid_timestamp' => new DateTime(),
        'auction_id' => $auction['auction_id']
      ]);

      // Refresh the page so the new review shows up.
      header('location: /bids/index.php?auction=' . $auction['auction_id']);
    }
  } else {
    // Clear errors
    unset($_SESSION['errors']);
  }

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/bids/index.html.php';

  // Set the page title and output variables
  $title = 'Bids - ' . htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8');
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
