<?php

// Includes (Database Interface, Session Initialiser and Utilities)
include_once __DIR__ . '/../includes/DBInterface.php';
include_once __DIR__ . '/../includes/SessionInitialiser.php';
include_once __DIR__ . '/../includes/Utilities.php';

// Attempt to establish a DB connection.
try {
  // Include the database connection (Initialises the $pdo variable)
  include_once __DIR__ . '/../includes/DatabaseConnection.php';

  // Retrieve all the categories
  $categories = getCategories($pdo);

  // If more than 7 categories exist split the categories array into
  // two the first 7 categories will be stored in the $categories array
  // And any after that will be stored in $categoriesMore
  if (count($categories) > 7) {
    $categoriesMore = array_slice($categories, 7);
    $categories = array_slice($categories, 0, 7);
  }
  
} catch (PDOException $e) {
  // Catch any errors and print them to the screen.
  // ! Remove this for production!
  // Provide default categories if DB fails to connect.
  // TODO: Improve this in some way or another.
  echo '<script>console.log("Database Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . '")</script>';
  $categories = [
    [ 'category_id' => 0, 'category_name' => 'Home & Garden', 'category_slug' => 'home-and-garden' ],
    [ 'category_id' => 1, 'category_name' => 'Electronics', 'category_slug' => 'electronics' ],
    [ 'category_id' => 2, 'category_name' => 'Fashion', 'category_slug' => 'fashion' ],
    [ 'category_id' => 3, 'category_name' => 'Sport', 'category_slug' => 'sport' ],
    [ 'category_id' => 4, 'category_name' => 'Health', 'category_slug' => 'health' ],
    [ 'category_id' => 5, 'category_name' => 'Toys', 'category_slug' => 'toys' ],
    [ 'category_id' => 6, 'category_name' => 'Motors', 'category_slug' => 'motors' ]
  ];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />

    <!-- Page Title -->
    <title><?= $title; ?> | iBuy Auctions</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/public/stylesheets/lib/bootstrap-4.4.1.min.css" />

    <!-- Font (Oxygen Regular) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" />

    <!-- iBuy CSS -->
    <link rel="stylesheet" href="/public/stylesheets/ibuy.css" />

    <!-- Bootstrap CSS -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script async defer src="/public/scripts/lib/jquery-3.4.1.slim.min.js"></script>
    <script async defer src="/public/scripts/lib/popper-1.16.0.min.js"></script>
    <script async defer src="/public/scripts/lib/bootstrap-4.4.1.min.js"></script>

    <!-- iBuy JS -->
    <script async defer src="/public/scripts/ibuy.js"></script>
  </head>
  <body class="ibuy">
    <nav class="ibuy__navbar ibuy__navbar--general">
      <ul class="ibuy__navbar-nav">
        <?php if (isset($_SESSION['uuid']) && isAdmin($_SESSION['uuid'])): ?>
          <li class="ibuy__nav-item ibuy__nav-dropdown">
            <a href="#" class="ibuy__nav-link ibuy__nav-dropdown-toggle" id="navbarDropdownToggleGeneral">Admin</a>
            <ul class="ibuy__navbar-nav ibuy__nav-dropdown-menu" id="navbarDropdownGeneral">
              <li class="ibuy__nav-item"><a href="/admin/auctions/" class="ibuy__nav-link">Auctions</a></li>
              <li class="ibuy__nav-item"><a href="/admin/categories/" class="ibuy__nav-link">Categories</a></li>
              <li class="ibuy__nav-item"><a href="/admin/reviews/" class="ibuy__nav-link">Reviews</a></li>
              <li class="ibuy__nav-item"><a href="/admin/users/" class="ibuy__nav-link">Users</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <li class="ibuy__nav-item"><a href="/auctions/" class="ibuy__nav-link">Auctions</a></li>
      </ul>
      <ul class="ibuy__navbar-nav">
        <?php if (isset($_SESSION['uuid'])): ?>
          <li class="ibuy__nav-item"><a href="/id/dashboard.php" class="ibuy__nav-link">Dashboard</a></li>
          <li class="ibuy__nav-item"><a href="/id/logout.php" class="ibuy__nav-link">Logout</a></li>
        <?php else: ?>
          <li class="ibuy__nav-item"><a href="/id/login.php" class="ibuy__nav-link">Login</a></li>
          <li class="ibuy__nav-item"><a href="/id/register.php" class="ibuy__nav-link">Register</a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <header class="ibuy__header">
      <a href="/" class="ibuy__brand">
        <h1><span id="i">i</span><span id="b">b</span><span id="u">u</span><span id="y">y</span></h1>
      </a>
      <form action="/auctions/" class="ibuy__form">
        <input type="text" name="q" id="q" placeholder="Search for anything..." />
        <input type="submit" name="submit" value="Search" />
      </form>
    </header>
    <nav class="ibuy__navbar ibuy__navbar--categories">
      <ul class="ibuy__navbar-nav">
        <?php foreach($categories as $category): ?>
          <li class="ibuy__nav-item"><a href="/auctions/index.php?cat=<?= $category['category_slug']; ?>" class="ibuy__nav-link"><?= $category['category_name']; ?></a></li>
        <?php endforeach; ?>
        <?php if(isset($categoriesMore)): ?>
          <li class="ibuy__nav-item ibuy__nav-dropdown">
            <a class="ibuy__nav-link ibuy__nav-dropdown-toggle" id="navbarCatDropdownToggle" href="#">More...</a>
            <ul class="ibuy__navbar-nav ibuy__nav-dropdown-menu" id="navbarCatDropdown">
              <?php foreach($categoriesMore as $category): ?>
                <li class="ibuy__nav-item"><a href="/auctions/index.php?cat=<?= $category['category_slug']; ?>" class="ibuy__nav-link"><?= $category['category_name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <figure class="ibuy__banner">
      <img src="/public/images/random-banner.php" alt="" />
      <figcaption></figcaption>
    </figure>
    <main class="ibuy__main container">
      <?= $output; ?>
    </main>
    <footer class="ibuy__footer">
      <div class="container">
        <p class="ibuy__copyright text-muted my-5">
          Copyright &copy; <?= date('Y'); ?> iBuy Auctions
        </p>
      </div>
    </footer>
  </body>
</html>
