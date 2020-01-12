<h1>Dashboard</h1>
<hr class="my-5" />

<!-- Page -->
<div class="row">
  <!-- User Sidebar -->
  <div class="col-12 col-md-6 col-lg-3 mb-5">
    <figure class="ibuy__profile-pic mb-2">
      <img src="https://via.placeholder.com/512.png?text=Profile+Picture" alt="" class="img-thumbnail">
    </figure>
    <ul class="list-group mb-2">
      <li class="list-group-item">
        <p class="my-0"><small>First Name</small></p>
        <p class="my-0 text-break"><?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Last Name</small></p>
        <p class="my-0 text-break"><?= htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Email Address</small></p>
        <p class="my-0 text-break"><?= htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
    </ul>
    <a href="/id/update.php?id=<?= $user['user_id']; ?>" class="btn btn-block btn-warning">Update Account</a>
    <a href="/id/delete.php?id=<?= $user['user_id']; ?>" class="btn btn-block btn-danger">Delete Account</a>
  </div> <!-- /User Sidebar -->

  <!-- Main Dashboard Content -->
  <div class="col-12 col-md-6 col-lg-9">
    <!-- AUCTIONS -->
    <section>
      <h2 class="section__heading">My Auctions</h2>
      <hr class="section__rule my-3" />
      
      <!-- Auctions Listing -->
      <div class="row">
        <?php foreach($auctions as $auction): ?>
          <?php include __DIR__ . '/../../components/auction.html.php'; ?>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- REVIEWS RECEIVED -->
    <section class="mb-5">
      <h2 class="section__heading">My Reviews (Received)</h2>
      <hr class="section__rule my-3" />

      <ul class="list-group">
        <?php foreach($reviewsReceived as $review): ?>
          <li class="list-group-item" id="<?= 'Review_' . $review['review_id']; ?>">
            <div class="d-flex w-100 justify-content-between">
              <div class="review__rating"><?php include __DIR__ . '/../../components/rating.html.php'; ?></div>
              <small>Posted on <?= htmlspecialchars(getFormattedDateTime($review['review_timestamp']), ENT_QUOTES, 'UTF-8'); ?></small>
            </div>
            <h5><?= getUserFullName(getUser($pdo, $review['review_author'])); ?> said...</h5>
            <p class="mb-0"><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <!-- REVIEWS GIVEN -->
    <section class="mb-5">
      <h2 class="section__heading">My Reviews (Given)</h2>
      <hr class="section__rule my-3" />

      <ul class="list-group">
        <?php foreach($reviewsGiven as $review): ?>
          <li class="list-group-item" id="<?= 'Review_' . $review['review_id']; ?>">
            <div class="d-flex w-100 justify-content-between">
              <div class="review__rating"><?php include __DIR__ . '/../../components/rating.html.php'; ?></div>
              <small>Posted on <?= htmlspecialchars(getFormattedDateTime($review['review_timestamp']), ENT_QUOTES, 'UTF-8'); ?></small>
            </div>
            <h5>I reviewed <?= getUserFullName(getUser($pdo, $review['review_reviewee'])); ?> saying...</h5>
            <p class="mb-3"><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="/reviews/update.php?id=<?= $review['review_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="/reviews/delete.php?id=<?= $review['review_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div> <!-- /Main Dashboard Content -->
</div> <!-- /Page -->
