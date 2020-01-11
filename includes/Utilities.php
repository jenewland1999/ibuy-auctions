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

// Temporary function header to prevent exceptions
// TODO: Implement and move to DatabaseFunctions()
function getCurrentBid() {}
