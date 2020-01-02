<?php

// Includes (Session Initialiser)
include_once __DIR__ . '/../../includes/SessionInitialiser.php';

// If the user isn't logged in send them to the login page
if (!isset($_SESSION['uuid']))
  header('location: /id/login.php');

// Log the user out by clearing the session
unset($_SESSION['uuid']);

// Redirect user to homepage now that they've been logged out
// ! If this ever fails for some reason or another the logout 
// ! page will be shown.
header('location: /');

// Start the Output Buffer
ob_start();

// Include the page template
include __DIR__ . '/../../templates/id/logout.html.php';

// Set the page title and output variables
$title = 'Logout';
$output = ob_get_clean();

// Include the layout template
include __DIR__ . '/../../templates/layout.html.php';
