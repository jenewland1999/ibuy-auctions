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
    // Check if a buy price was supplied and create an auction accordingly
    if (isset($_POST['buy_price'])) {
      // Create the auction from the form information
      updateAuction($pdo, [
        'auction_id' => $_POST['auction_id'],
        'auction_name' => $_POST['auction_name'],
        'auction_description' => $_POST['auction_description'],
        'category_id' => $_POST['category_id'],
        'start_date' => $_POST['start_date'] . ' ' . $_POST['start_time'] . ':00',
        'end_date' => $_POST['end_date'] . ' ' . $_POST['end_time'] . ':00',
        'start_price' => processCurrency($_POST['start_price']),
        'buy_price' => processCurrency($_POST['buy_price']),
        'approved' => false // ? Ensure that updated auctions are re-approved by administrators.
      ]);
    } else {
      // Create the auction from the form information
      updateAuction($pdo, [
        'auction_id' => $_POST['auction_id'],
        'auction_name' => $_POST['auction_name'],
        'auction_description' => $_POST['auction_description'],
        'category_id' => $_POST['category_id'],
        'start_date' => $_POST['start_date'] . ' ' . $_POST['start_time'] . ':00',
        'end_date' => $_POST['end_date'] . ' ' . $_POST['end_time'] . ':00',
        'start_price' => processCurrency($_POST['start_price']),
        'approved' => false // ? Ensure that updated auctions are re-approved by administrators.
      ]);

      // TODO: Add image uploading - If images are supplied check they're valid types and upload them to the correct place. If no images are supplied copy dummies into a folder to so something displays.
    }

    // Redirect user to dashboard page
    // TODO: Redirect the user to the updated auction
    // ! This can only be implemented once a user can view the auction page for auctions they own (regardless of approval status)
    header('location: /id/dashboard.php');
  } else {

    // Get the auction being edited
    $auction = getAuction($pdo, $_GET['id']);

    // Prevent other users editing (except admins) editing auctions
    if ($auction['user_id'] !== $_SESSION['uuid'])
      header('location: /');

    // Get a list of categories
    $categories = getCategories($pdo);

    // TODO: Move this code to a function of some kind to reduce repetition
    // Start DateTime
    $currentDateTime = new DateTime();
    $startDate = $currentDateTime->format('Y-m-d');
    $startTime = $currentDateTime->format('H:i');

    // Start Date (Max)
    $startDateMax = new DateTime();
    $startDateMax->add(new DateInterval('P3M'));
    $startDateMax = $startDateMax->format('Y-m-d');

    // End DateTime
    $endDateTime = new DateTime();
    $endDateTime->add(new DateInterval('P1D'));
    $endDate = $endDateTime->format('Y-m-d');
    $endTime = $endDateTime->format('H:i');

    // End Date (Max)
    $endDateMax = new DateTime();
    $endDateMax->add(new DateInterval('P3M'));
    $endDateMax = $endDateMax->format('Y-m-d');

    // Start the Output Buffer
    ob_start();

    // Include the page template
    include __DIR__ . '/../../templates/auctions/update.html.php';

    // Set the page title and output variables
    $title = 'Update - Auction';
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
