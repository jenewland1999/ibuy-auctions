<?php

// Includes (Database Connection, Database Functions, Session Initialiser)
include_once __DIR__ . '/DatabaseConnection.php';
include_once __DIR__ . '/DatabaseFunctions.php';
include_once __DIR__ . '/SessionInitialiser.php';

// Takes an integer and formats it as a currency
// A currency symbol can optionally be passed in 
// as the second parameter
function formatCurrency($currency, $symbol = '') {
  // If no currency is provided return nothing.
  if ($currency === '' || $currency === '0')
    return;
  return $symbol . number_format(($currency / 100), 2);
}

// Removes the decimal point from currency 
// that's been entered via a form
// TODO: Check for user manipulation of input field that prevents anything other than the regex \d+\.\d\d
function processCurrency($currency) {
  // If no currency is provided return nothing.
  if ($currency === '' || $currency === '0')
    return;
  return str_replace('.', '', $currency);
}

// Checks if the given user is an administrator
function isAdmin($pdo, $user_id) { 
  $user = getUser($pdo, $user_id);

  if ($user['is_admin'] == 1) // Double equals as SQL could return as string or number
    return true;
  else
    return false;
}

// Format a MySQL Datetime value into a desirable format
function getFormattedDateTime($dateTime, $format = 'dS F Y \a\t H:i') {
  $dateTime = new DateTime($dateTime);
  return $dateTime->format($format);
}

// get a user's full name with a space
function getUserFullName($user) {
  return htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8');
}

// Temporary function header to prevent exceptions
// TODO: Implement and move to DatabaseFunctions()
function getCurrentBid() {}
