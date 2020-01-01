<?php

// Auctions
// Retrieves all auctions from the DB
function getAuctions($pdo) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions`
    ORDER BY `auction_timestamp` 
    DESC
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved and haven't finished.
function getAuctionsRestricted($pdo) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions` 
    WHERE `approved` = TRUE 
    AND `finished` = FALSE 
    AND `end_date` > SYSDATE() 
    AND `start_date` <= SYSDATE()
    ORDER BY `auction_timestamp` 
    DESC
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by category
function getAuctionsByCatRestricted($pdo, $category_id) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions` 
    WHERE `approved` = TRUE 
    AND `finished` = FALSE 
    AND `end_date` > SYSDATE() 
    AND `start_date` <= SYSDATE()
    AND `category_id` = :category_id
    ORDER BY `auction_timestamp` 
    DESC
  ');
  $stmt->execute([
    'category_id' => $category_id
  ]);
  return $stmt->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by name
function getAuctionsByNameRestricted($pdo, $auction_name) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions` 
    WHERE `approved` = TRUE 
    AND `finished` = FALSE 
    AND `end_date` > SYSDATE() 
    AND `start_date` <= SYSDATE() 
    AND `auction_name` LIKE :auction_name
    ORDER BY `auction_timestamp` 
    DESC
  ');
  $stmt->execute([
    'auction_name' => '%' . $auction_name . '%'
  ]);
  return $stmt->fetchAll();
}

// Retrieves all auctions from the DB that:
// have started, haven't ended, are approved, haven't finished...
// and are filtered by category and name
function getAuctionsByNameAndCatRestricted($pdo, $auction_name, $category_id) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions` 
    WHERE `approved` = TRUE 
    AND `finished` = FALSE 
    AND `end_date` > SYSDATE() 
    AND `start_date` <= SYSDATE() 
    AND `auction_name` LIKE :auction_name 
    AND `category_id` = :category_id
    ORDER BY `auction_timestamp` 
    DESC
  ');
  $stmt->execute([
    'auction_name' => '%' . $auction_name . '%',
    'category_id' => $category_id
  ]);
  return $stmt->fetchAll();
}

// Retrieve the auction with the matching auction_id from the DB
function getAuction($pdo, $auction_id) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions`
    WHERE `auction_id` = :auction_id
  ');
  $stmt->execute([
    'auction_id' => $auction_id
  ]);
  return $stmt->fetch();
}

// Retrieve the auction with the matching auction_id from the DB that:
// has started, hasn't ended, is approved, hasn't finished...
function getAuctionRestricted($pdo, $auction_id) {
  $stmt = $pdo->prepare('
    SELECT `auction_id`, `auction_name`, `auction_description`, `auction_timestamp`, `category_id`, `user_id`, `start_date`, `end_date`, `approved`, `finished`, `start_price`, `buy_price`
    FROM `auctions` 
    WHERE `approved` = TRUE 
    AND `finished` = FALSE 
    AND `end_date` > SYSDATE() 
    AND `start_date` <= SYSDATE()
    AND `auction_id` = :auction_id
  ');
  $stmt->execute([
    'auction_id' => $auction_id
  ]);
  return $stmt->fetch();
}

// Delete one and only one auction with the matching auction_id from the DB
function deleteAuction($pdo, $auction_id) {
  $stmt = $pdo->prepare('
    DELETE FROM `auctions`
    WHERE `auction_id` = :auction_id
    LIMIT 1
  ');
  $stmt->execute([
    'auction_id' => $auction_id
  ]);
}

// Create an auction and add it to the DB
function createAuction($pdo, $auction_name, $auction_description, $auction_timestamp, $category_id, $user_id, $start_date, $end_date, $approved, $finished, $start_price, $buy_price) {
  $stmt = $pdo->prepare('
    INSERT INTO `auctions` (auction_name, auction_description, auction_timestamp, category_id, user_id, start_date, end_date, approved, finished, start_price, buy_price)
    VALUES (:auction_name, :auction_description, :auction_timestamp, :category_id, :user_id, :start_date, :end_date, :approved, :finished, :start_price, :buy_price)
  ');
  $stmt->execute([
    'auction_name' => $auction_name,
    'auction_description' => $auction_description,
    'auction_timestamp' => $auction_timestamp,
    'category_id' => $category_id,
    'user_id' => $user_id,
    'start_date' => $start_date,
    'end_date' => $end_date,
    'approved' => $approved,
    'finished' => $finished,
    'start_price' => $start_price,
    'buy_price' => $buy_price
  ]);
}

// Update an auction with the matching auction_id
function updateAuction($pdo, $auction_id, $auction_name, $auction_description, $auction_timestamp, $category_id, $user_id, $start_date, $end_date, $approved, $finished, $start_price, $buy_price) {
  $stmt = $pdo->prepare('
    UPDATE `auctions`
    SET `auction_name` = :auction_name,
        `auction_description` = :auction_description,
        `auction_timestamp` = :auction_timestamp,
        `category_id` = :category_id,
        `user_id` = :user_id,
        `start_date` = :start_date,
        `end_date` = :end_date,
        `approved` = :approved,
        `finished` = :finished,
        `start_price` = :start_price,
        `buy_price` = :buy_price
    WHERE `auction_id` = :auction_id
  ');
  $stmt->execute([
    'auction_name' => $auction_name,
    'auction_description' => $auction_description,
    'auction_timestamp' => $auction_timestamp,
    'category_id' => $category_id,
    'user_id' => $user_id,
    'start_date' => $start_date,
    'end_date' => $end_date,
    'approved' => $approved,
    'finished' => $finished,
    'start_price' => $start_price,
    'buy_price' => $buy_price,
    'auction_id' => $auction_id
  ]);
}

// Categories
// Retrieves all categories from the DB
function getCategories($pdo) {
  $stmt = $pdo->prepare('
    SELECT `category_id`, `category_name`, `category_slug` 
    FROM `categories`
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Retrieve the category with the matching category_id from the DB
function getCategory($pdo, $category_id) {
  $stmt = $pdo->prepare('
    SELECT `category_id`, `category_name`, `category_slug` 
    FROM `categories` 
    WHERE `category_id` = :category_id
  ');
  $stmt->execute([
    'category_id' => $category_id
  ]);
  return $stmt->fetch();
}

// Retrieve the category with the matching category_slug from the DB
function getCategoryBySlug($pdo, $category_slug) {
  $stmt = $pdo->prepare('
    SELECT `category_id`, `category_name`, `category_slug` 
    FROM `categories` 
    WHERE `category_slug` = :category_slug'
  );
  $stmt->execute([
    'category_slug' => $category_slug
  ]);
  return $stmt->fetch();
}

// Delete one and only one category with the matching category_id from the DB
function deleteCategory($pdo, $category_id) {
  $stmt = $pdo->prepare('
    DELETE FROM `categories` 
    WHERE `category_id` = :category_id 
    LIMIT 1
  ');
  $stmt->execute([
    'category_id' => $category_id
  ]);
}

// Create a category and add it to the DB
function createCategory($pdo, $category_name, $category_slug) {
  $stmt = $pdo->prepare('
    INSERT INTO `categories` (`category_name`, `category_slug`) 
    VALUES (:category_name, :category_slug)
  ');
  $stmt->execute([
    'category_name' => $category_name, 
    'category_slug' => $category_slug
  ]);
}

// Update a category with the matching category_id
function updateCategory($pdo, $category_id, $category_name, $category_slug) {
  $stmt = $pdo->prepare('
    UPDATE `categories` 
    SET `category_name` = :category_name, 
        `category_slug` = :category_slug 
    WHERE `category_id` = :category_id
  ');
  $stmt->execute([
    'category_name' => $category_name,
    'category_slug' => $category_slug,
    'category_id' => $category_id
  ]);
}

// Reviews
// Retrieves all reviews from the DB
function getReviews($pdo) {
  $stmt = $pdo->prepare('
    SELECT `review_id`, `review_text`, `review_timestamp`, `review_user`, `user_id`
    FROM `reviews`
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Retrieve the review with the matching review_id from the DB
function getReview($pdo, $review_id) {
  $stmt = $pdo->prepare('
    SELECT `review_id`, `review_text`, `review_timestamp`, `review_user`, `user_id`
    FROM `reviews`
    WHERE `review_id` = :review_id
  ');
  $stmt->execute([
    'review_id' => $review_id
  ]);
  return $stmt->fetch();
}

// Delete one and only one review with the matching review_id from the DB
function deleteReview($pdo, $review_id) {
  $stmt = $pdo->prepare('
    DELETE FROM `reviews`
    WHERE `review_id` = :review_id
  ');
  $stmt->execute([
    'review_id' => $review_id
  ]);
}

// Create a review and add it to the DB
function createReview($pdo, $review_text, $review_timestamp, $review_user, $user_id) {
  $stmt = $pdo->prepare('
    INSERT INTO `reviews` (review_text, review_timestamp, review_user, user_id)
    VALUES (:review_text, :review_timestamp, :review_user, :user_id)
  ');
  $stmt->execute([
    'review_text' => $review_text,
    'review_timestamp' => $review_timestamp,
    'review_user' => $review_user,
    'user_id' => $user_id
  ]);
}

// Update a review with the matching review_id
function updateReview($pdo, $review_id, $review_text, $review_timestamp, $review_user, $user_id) {
  $stmt = $pdo->prepare('
    UPDATE `reviews`
    SET `review_text` = :review_text,
        `review_timestamp` = :review_timestamp,
        `review_user` = :review_user,
        `user_id` = :user_id
    WHERE `review_id` = :review_id
  ');
  $stmt->execute([
    'review_text' => $review_text,
    'review_timestamp' => $review_timestamp,
    'review_user' => $review_user,
    'user_id' => $user_id,
    'review_id' => $review_id
  ]);
}

// Users
// Retrieves all users from the DB
function getUsers($pdo) {
  $stmt = $pdo->prepare('
    SELECT `user_id`, `user_email`, `user_pwd`, `first_name`, `last_name`, `is_admin`
    FROM `users`
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Retrieve the user with the matching user_id from the DB
function getUser($pdo, $user_id) {
  $stmt = $pdo->prepare('
    SELECT `user_id`, `user_email`, `user_pwd`, `first_name`, `last_name`, `is_admin`
    FROM `users`
    WHERE `user_id` = :user_id
  ');
  $stmt->execute([
    'user_id' => $user_id
  ]);
  return $stmt->fetch();
}

// Delete one and only one user with the matching user_id from the DB
function deleteUser($pdo, $user_id) {
  $stmt = $pdo->prepare('
    DELETE FROM `users`
    WHERE `user_id` = :user_id
  ');
  $stmt->execute([
    'user_id' => $user_id
  ]);
}

// Create a user and add it to the DB
function createUser($pdo, $user_email, $user_pwd, $first_name, $last_name, $is_admin) {
  $stmt = $pdo->prepare('
    INSERT INTO `users` (user_email, user_pwd, first_name, last_name, is_admin)
    VALUES (:user_email, :user_pwd, :first_name, :last_name, :is_admin)
  ');
  $stmt->execute([
    'user_email' => $user_email,
    'user_pwd' => $user_pwd,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'is_admin' => $is_admin
  ]);
}

// Update a user with the matching user_id
function updateUser($pdo, $user_id, $user_email, $user_pwd, $first_name, $last_name, $is_admin) {
  $stmt = $pdo->prepare('
    UPDATE `users`
    SET `user_email` = :user_email,
        `user_pwd` = :user_pwd,
        `first_name` = :first_name,
        `last_name` = :last_name,
        `is_admin` = :is_admin
    WHERE `user_id` = :user_id
  ');
  $stmt->execute([
    'user_email' => $user_email,
    'user_pwd' => $user_pwd,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'is_admin' => $is_admin,
    'user_id' => $user_id
  ]);
}
