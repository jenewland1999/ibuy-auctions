<?php

// Includes (Database Interface, Session Initialiser and Utilities)
include_once __DIR__ . '/../includes/DBInterface.php';
include_once __DIR__ . '/../includes/SessionInitialiser.php';
include_once __DIR__ . '/../includes/Utilities.php';

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../includes/DatabaseConnection.php';

  // Retrieve the 10 most recently created auctions that:
  // have started, haven't ended, are approved and haven't finished
  $auctions = array_slice(getAuctionsRestricted($pdo), 0, 10, true);

  // Start the Output Buffer
  ob_start();

  // Include the page template
  include __DIR__ . '/../templates/index.html.php';

  // Set the page title and output variables
  $title = 'Home';
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
include __DIR__ . '/../templates/layout.html.php';
