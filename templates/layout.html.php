<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />

    <!-- Page Title -->
    <title>iBuy Auctions</title>

    <!-- iBuy CSS -->
    <link rel="stylesheet" href="/public/stylesheets/ibuy.css" />

    <!-- iBuy JS -->
    <script async defer src="/public/scripts/ibuy.js"></script>
  </head>
  <body class="ibuy">
    <nav class="ibuy__navbar ibuy__navbar--general">
      <ul class="ibuy__navbar-nav">
        <li class="ibuy__nav-item ibuy__nav-dropdown">
          <a href="#" class="ibuy__nav-link ibuy__nav-dropdown-toggle" id="navDropdownToggleGeneral">Admin</a>
          <ul class="ibuy__navbar-nav ibuy__nav-dropdown-menu">
            <li class="ibuy__nav-item"><a href="/admin/auctions/" class="ibuy__nav-link">Auctions</a></li>
            <li class="ibuy__nav-item"><a href="/admin/categories/" class="ibuy__nav-link">Categories</a></li>
            <li class="ibuy__nav-item"><a href="/admin/reviews/" class="ibuy__nav-link">Reviews</a></li>
            <li class="ibuy__nav-item"><a href="/admin/users/" class="ibuy__nav-link">Users</a></li>
          </ul>
        </li>
        <li class="ibuy__nav-item"><a href="/auctions/" class="ibuy__nav-link">Auctions</a></li>
      </ul>
      <ul class="ibuy__navbar-nav">
        <li class="ibuy__nav-item"><a href="/id/dashboard.php" class="ibuy__nav-link">Dashboard</a></li>
        <li class="ibuy__nav-item"><a href="/id/login.php" class="ibuy__nav-link">Login</a></li>
        <li class="ibuy__nav-item"><a href="/id/register.php" class="ibuy__nav-link">Register</a></li>
        <li class="ibuy__nav-item"><a href="/id/logout.php" class="ibuy__nav-link">Logout</a></li>
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
        <li class="ibuy__nav-item"><a href="/auctions?cat=home-and-garden" class="ibuy__nav-link">Home & Garden</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=electronics" class="ibuy__nav-link">Electronics</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=fashion" class="ibuy__nav-link">Fashion</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=sport" class="ibuy__nav-link">Sport</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=health" class="ibuy__nav-link">Heath</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=toys" class="ibuy__nav-link">Toys</a></li>
        <li class="ibuy__nav-item"><a href="/auctions?cat=motors" class="ibuy__nav-link">Motors</a></li>
        <li class="ibuy__nav-item ibuy__nav-dropdown">
          <a href="#" class="ibuy__nav-link ibuy__nav-dropdown-toggle" id="navDropdownToggleCategories">More...</a>
          <ul class="ibuy__navbar-nav ibuy__nav-dropdown-menu">
            <li class="ibuy__nav-item"><a href="/auctions?cat=video-games" class="ibuy__nav-link">Video Games</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <figure class="ibuy__banner">
      <img src="/public/images/random-banner.php" alt="" />
      <figcaption></figcaption>
    </figure>
    <main class="ibuy__main">
      <?= $output; ?>
    </main>
    <footer class="ibuy__footer">
      <p class="ibuy__copyright">
        Copyright &copy; <?= date('Y'); ?> iBuy Auctions
      </p>
    </footer>
  </body>
</html>
