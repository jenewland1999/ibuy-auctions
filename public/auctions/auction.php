<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';

  // If no id is specified in the query string send user back to auctions page
  // TODO: Present error message somehow
  if (!isset($_GET['id']))
    header('location: /auctions/');

  // Get the auction from the query string
  $auction = getAuction($pdo, $_GET['id']);

  // If the auction isn't valid redirect user to auctions page
  // TODO: Present error message somehow
  if ($auction === false)
    header('location: /auctions/');

  // Get the user who posted the auction
  $user = getUser($pdo, $auction['user_id']);

  // Get the category for the auction
  $category = getCategory($pdo, $auction['category_id']);

  // Get the reviews for the user who posted the auction
  $reviews = getReviewsForUser($pdo, $auction['user_id']);

  // Retrieve all the categories
  $categories = getCategories($pdo);

  // Handle review submission
  if (isset($_POST['submit__review'])) {
    createReview($pdo, [
      'review_author' => $_POST['review_author'],
      'review_rating' => $_POST['review_rating'],
      'review_reviewee' => $_POST['review_reviewee'],
      'review_text' => $_POST['review_text'],
      'review_timestamp' => new DateTime(),
    ]);

    // Refresh the page so the new review shows up.
    header('location: /auctions/auction.php?id=' . $auction['auction_id']);
  }

  if (isset($_POST['submit__bid'])) {
    // Check the amount being entered is greater than current bid before submitting
    // TODO: Improve error handling
    if (processCurrency($_POST['bid_amount']) > getBidCurrentPrice($pdo, $auction['auction_id'])) {
      createBid($pdo, [
        'bid_amount' => processCurrency($_POST['bid_amount']),
        'bid_author' => $_SESSION['uuid'],
        'bid_timestamp' => new DateTime(),
        'auction_id' => $auction['auction_id']
      ]);

      // Refresh the page so the new review shows up.
      header('location: /auctions/auction.php?id=' . $auction['auction_id']);
    }
  }

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/auctions/auction.html.php';

  // Set the page title and output variables
  $title = $auction['auction_name'] . ' by ' . $user['first_name'] . ' ' . $user['last_name'] . ' - Auction';
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
