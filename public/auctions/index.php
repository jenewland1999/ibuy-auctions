<?php

// Includes (Database Functions, Session Initialiser and Utilities)
include_once __DIR__ . '/../../includes/DatabaseFunctions.php';
include_once __DIR__ . '/../../includes/SessionInitialiser.php';
include_once __DIR__ . '/../../includes/Utilities.php';

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../../includes/DatabaseConnection.php';

  // Auctions retrieved is one of four outcomes (in order of appearance)
  // 1. Filtered by name and category
  // 2. Filtered by name
  // 3. Filtered by category
  // 4. Not filtered at all
  if (isset($_GET['q']) && isset($_GET['cat'])) {
    $category_id = getCategoryBySlug($pdo, $_GET['cat'])['category_id'];
    $auctions = getAuctionsByNameAndCatRestricted($pdo, $_GET['q'], $category_id);
  } else if (isset($_GET['q'])) {
    $auctions = getAuctionsByNameRestricted($pdo, $_GET['q']);
  } else if (isset($_GET['cat'])) {
    $category_id = getCategoryBySlug($pdo, $_GET['cat'])['category_id'];
    $auctions = getAuctionsByCatRestricted($pdo, $category_id);
  } else {
    $auctions = getAuctionsRestricted($pdo);
  }

  // Retrieve all the categories
  $categories = getCategories($pdo);

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../../templates/auctions/index.html.php';

  // Set the page title and output variables
  $title = 'Auctions';
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
