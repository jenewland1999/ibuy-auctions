<?php

// Standard Query Function
function query($pdo, $sql, $bindValues = []) {
  $stmt = $pdo->prepare($sql);
  $stmt->execute($bindValues);
  return $stmt;
}

// Process dates in fields passed to update or create DB functions
function processDates($fields) {
  foreach ($fields as $key => $value) {
    if ($value instanceof DateTime)
      $fields[$key] = $value->format('Y-m-d H:i:s');
  }

  return $fields;
}

// Auctions
// Retrieves all auctions from the DB
function getAuctions($pdo) {
  $sql = '
    SELECT  `auction_id`,
            `auction_name`,
            `auction_description`,
            `auction_timestamp`,
            `category_id`,
            `user_id`,
            `start_date`,
            `end_date`,
            `approved`,
            `finished`,
            `start_price`,
            `buy_price`
    FROM    `auctions`
    ORDER BY `auction_timestamp` DESC 
  ';

  return query($pdo, $sql)->fetchAll();
}

// Retrieve all auctions created by a particular user from the DB
function getAuctionsByUser($pdo, $user_id) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions`
    WHERE   `user_id` = :user_id
    ORDER BY `auction_timestamp` DESC
  ';

  $parameters = [ 
    'user_id' => $user_id 
  ];

  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved and haven't finished.
function getAuctionsRestricted($pdo) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
      FROM  `auctions` 
      WHERE `approved` = TRUE 
      AND   `finished` = FALSE 
      AND   `end_date` > SYSDATE() 
      AND   `start_date` <= SYSDATE()
      ORDER BY `auction_timestamp` DESC
  ';

  return query($pdo, $sql)->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by category
function getAuctionsByCatRestricted($pdo, $category_id) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions` 
    WHERE   `approved` = TRUE 
    AND     `finished` = FALSE 
    AND     `end_date` > SYSDATE() 
    AND     `start_date` <= SYSDATE()
    AND     `category_id` = :category_id
    ORDER BY `auction_timestamp` DESC
  ';

  $parameters = [ 
    'category_id' => $category_id 
  ];

  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by name
function getAuctionsByNameRestricted($pdo, $auction_name) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions` 
    WHERE   `approved` = TRUE 
    AND     `finished` = FALSE 
    AND     `end_date` > SYSDATE() 
    AND     `start_date` <= SYSDATE() 
    AND     `auction_name` LIKE :auction_name
    ORDER BY `auction_timestamp` DESC
  '; 
  
  $parameters = [ 
    'auction_name' => '%' . $auction_name . '%' 
  ];
  
  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by category and name
function getAuctionsByNameAndCatRestricted($pdo, $auction_name, $category_id) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions` 
    WHERE   `approved` = TRUE 
    AND     `finished` = FALSE 
    AND     `end_date` > SYSDATE() 
    AND     `start_date` <= SYSDATE() 
    AND     `auction_name` LIKE :auction_name 
    AND     `category_id` = :category_id
    ORDER BY `auction_timestamp` DESC
  ';
  
  $parameters = [ 
    'auction_name' => '%' . $auction_name . '%', 
    'category_id' => $category_id 
  ];

  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieve the auction with the matching auction_id from the DB
function getAuction($pdo, $auction_id) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions`
    WHERE   `auction_id` = :auction_id
  ';

  $parameters = [
    'auction_id' => $auction_id
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Retrieve the auction with the matching auction_id from the DB that:
// has started, hasn't ended, is approved, hasn't finished...
function getAuctionRestricted($pdo, $auction_id) {
  $sql = '
    SELECT  `auction_id`, 
            `auction_name`, 
            `auction_description`, 
            `auction_timestamp`, 
            `category_id`, 
            `user_id`, 
            `start_date`, 
            `end_date`, 
            `approved`, 
            `finished`, 
            `start_price`, 
            `buy_price`
    FROM    `auctions` 
    WHERE   `approved` = TRUE 
    AND     `finished` = FALSE 
    AND     `end_date` > SYSDATE() 
    AND     `start_date` <= SYSDATE()
    AND     `auction_id` = :auction_id
  ';

  $parameters = [
    'auction_id' => $auction_id
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Delete one and only one auction with the matching auction_id from the DB
function deleteAuction($pdo, $auction_id) {
  $sql = '
    DELETE FROM `auctions`
    WHERE `auction_id` = :auction_id
    LIMIT 1
  ';

  $parameters = [
    'auction_id' => $auction_id
  ];

  query($pdo, $sql, $parameters);
}

// Create an auction and add it to the DB
function createAuction($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'INSERT INTO `auctions` (';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '`,';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ') VALUES (';

  // Loop over each of the fields key values again for placeholders
  foreach ($fields as $key => $value) {
    $sql .= ':' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the final part of the SQL query
  $sql .= ')';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Update an auction with the matching auction_id
function updateAuction($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'UPDATE `auctions` SET ';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '` = :' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ' WHERE `auction_id` = :auction_id';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Categories
// Retrieves all categories from the DB
function getCategories($pdo) {
  $sql = '
    SELECT  `category_id`, 
            `category_name`, 
            `category_slug` 
    FROM    `categories`
  ';
  return query($pdo, $sql)->fetchAll();
}

// Retrieve the category with the matching category_id from the DB
function getCategory($pdo, $category_id) {
  $sql = '
    SELECT  `category_id`, 
            `category_name`, 
            `category_slug` 
    FROM    `categories` 
    WHERE   `category_id` = :category_id
  ';

  $parameters = [
    'category_id' => $category_id
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Retrieve the category with the matching category_slug from the DB
function getCategoryBySlug($pdo, $category_slug) {
  $sql = '
    SELECT  `category_id`, 
            `category_name`, 
            `category_slug` 
    FROM    `categories` 
    WHERE   `category_slug` = :category_slug
  ';

  $parameters = [
    'category_slug' => $category_slug
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Delete one and only one category with the matching category_id from the DB
function deleteCategory($pdo, $category_id) {
  $sql = '
    DELETE FROM `categories` 
    WHERE `category_id` = :category_id 
    LIMIT 1
  ';

  $parameters = [
    'category_id' => $category_id
  ];

  query($pdo, $sql, $parameters);
}

// Create a category and add it to the DB
function createCategory($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'INSERT INTO `categories` (';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '`,';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ') VALUES (';

  // Loop over each of the fields key values again for placeholders
  foreach ($fields as $key => $value) {
    $sql .= ':' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the final part of the SQL query
  $sql .= ')';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Update a category with the matching category_id
function updateCategory($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'UPDATE `categories` SET ';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '` = :' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ' WHERE `category_id` = :category_id';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Reviews
// Retrieves all reviews from the DB
function getReviews($pdo) {
  $sql = '
    SELECT  `review_id`, 
            `review_author`, 
            `review_rating`, 
            `review_reviewee`, 
            `review_text`, 
            `review_timestamp`
    FROM    `reviews`
  ';

  return query($pdo, $sql)->fetchAll();
}

// Retrieve all reviews by a particular user from the DB
function getReviewsByUser($pdo, $review_author) {
  $sql = '
    SELECT  `review_id`, 
            `review_author`, 
            `review_rating`, 
            `review_reviewee`, 
            `review_text`, 
            `review_timestamp`
    FROM    `reviews`
    WHERE   `review_author` = :review_author
  ';

  $parameters = [
    'review_author' => $review_author
  ];

  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieve all reviews for a particular user from the DB
function getReviewsForUser($pdo, $review_reviewee) {
  $sql = '
    SELECT  `review_id`, 
            `review_author`, 
            `review_rating`, 
            `review_reviewee`, 
            `review_text`, 
            `review_timestamp`
    FROM    `reviews`
    WHERE   `review_reviewee` = :review_reviewee
  ';

  $parameters = [
    'review_reviewee' => $review_reviewee
  ];

  return query($pdo, $sql, $parameters)->fetchAll();
}

// Retrieve the review with the matching review_id from the DB
function getReview($pdo, $review_id) {
  $sql = '
    SELECT  `review_id`, 
            `review_author`, 
            `review_rating`, 
            `review_reviewee`, 
            `review_text`, 
            `review_timestamp`
    FROM    `reviews`
    WHERE   `review_id` = :review_id
  ';

  $parameters = [
    'review_id' => $review_id
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Delete one and only one review with the matching review_id from the DB
function deleteReview($pdo, $review_id) {
  $sql = '
    DELETE FROM `reviews`
    WHERE `review_id` = :review_id
  ';

  $parameters = [
    'review_id' => $review_id
  ];

  query($pdo, $sql, $parameters);
}

// Create a review and add it to the DB
function createReview($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'INSERT INTO `reviews` (';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '`,';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ') VALUES (';

  // Loop over each of the fields key values again for placeholders
  foreach ($fields as $key => $value) {
    $sql .= ':' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the final part of the SQL query
  $sql .= ')';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Update a review with the matching review_id
function updateReview($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'UPDATE `reviews` SET ';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '` = :' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ' WHERE `review_id` = :review_id';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Users
// Retrieves all users from the DB
function getUsers($pdo) {
  $sql = '
    SELECT  `user_id`, 
            `user_email`, 
            `user_pwd`, 
            `first_name`, 
            `last_name`, 
            `is_admin`
    FROM    `users`
  ';

  return query($pdo, $sql)->fetchAll();
}

// Retrieve the user with the matching user_id from the DB
function getUser($pdo, $user_id) {
  $sql = '
    SELECT  `user_id`, 
            `user_email`, 
            `user_pwd`, 
            `first_name`, 
            `last_name`, 
            `is_admin`
    FROM    `users`
    WHERE   `user_id` = :user_id
  ';

  $parameters = [
    'user_id' => $user_id
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Retrieve the user with the matching user_email from the DB
function getUserByEmail($pdo, $user_email) {
  $sql = '
    SELECT  `user_id`, 
            `user_email`, 
            `user_pwd`, 
            `first_name`, 
            `last_name`, 
            `is_admin`
    FROM    `users`
    WHERE   `user_email` = :user_email
  ';

  $parameters = [
    'user_email' => $user_email
  ];

  return query($pdo, $sql, $parameters)->fetch();
}

// Delete one and only one user with the matching user_id from the DB
function deleteUser($pdo, $user_id) {
  // Create a variable to store the SQL query
  $sql = '
    DELETE FROM `users`
    WHERE `user_id` = :user_id
    LIMIT 1
  ';

  // Create a variable to store the parameters
  $parameters = [
    'user_id' => $user_id
  ];

  // Execute the query
  query($pdo, $sql, $parameters);
}

// Create a user and add it to the DB
function createUser($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'INSERT INTO `users` (';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '`,';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ') VALUES (';

  // Loop over each of the fields key values again for placeholders
  foreach ($fields as $key => $value) {
    $sql .= ':' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the final part of the SQL query
  $sql .= ')';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}

// Update a user with the matching user_id
function updateUser($pdo, $fields) {
  // Create the initial part of the SQL query
  $sql = 'UPDATE `users` SET ';

  // Loop over each of the fields key values for attributes
  foreach ($fields as $key => $value) {
    $sql .= '`' . $key . '` = :' . $key . ',';
  }

  // Trim the trailing comma
  $sql = rtrim($sql, ',');

  // Append the next part of the SQL query
  $sql .= ' WHERE `user_id` = :user_id';

  // Process any dates in the fields array
  $fields = processDates($fields);

  // Execute the query
  query($pdo, $sql, $fields);
}
