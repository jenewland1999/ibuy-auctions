<h1>Dashboard</h1>
<hr class="my-5" />

<!-- Page -->
<div class="row">
  <!-- User Sidebar -->
  <div class="col-12 col-xl-3">
    <figure class="ibuy__profile-pic mb-2">
      <img src="https://via.placeholder.com/512.png?text=Profile+Picture" alt="" class="img-thumbnail">
    </figure>
    <ul class="list-group mb-2">
      <li class="list-group-item">
        <p class="my-0"><small>First Name</small></p>
        <p class="my-0"><?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Last Name</small></p>
        <p class="my-0"><?= htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Email Address</small></p>
        <p class="my-0"><?= htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8') ?></p>
      </li>
    </ul>
    <a href="/id/update.php?id=<?= $user['user_id']; ?>" class="btn btn-block btn-warning">Update Account</a>
    <a href="/id/delete.php?id=<?= $user['user_id']; ?>" class="btn btn-block btn-danger">Delete Account</a>
  </div> <!-- /User Sidebar -->

  <!-- Main Dashboard Content -->
  <div class="col-12 col-xl-9">
    <!-- AUCTIONS -->
    <section class="mb-5">
      <h2 class="section__heading">My Auctions</h2>
      <hr class="section__rule my-3" />
      
      <!-- Auctions Listing -->
      <div class="row">
        <?php foreach($auctions as $auction): ?>
          <div class="col-12 col-xl-6">
            <article class="card">
              <!-- Card Image Carousel -->
              <section id="carousel<?= $auction['auction_id'] ?>" class="carousel slide carousel-fade" date-ride="carousel">
                <ol class="carousel-indicators">
                  <?php for($i = 0; $i < 5; $i++): ?>
                    <li data-target="#carousel<?= $auction['auction_id'] ?>" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
                  <?php endfor; ?>
                </ol>
                <div class="carousel-inner">
                  <?php for($i = 1; $i <= 5; $i++): ?>
                    <figure class="carousel-item mb-0 <?= $i === 1 ? 'active' : '' ?>">
                      <img src="/uploads/images/auctions/<?= $auction['auction_id']; ?>/<?= $i ?>.jpg" alt="" class="d-block w-100" />
                    </figure>
                  <?php endfor; ?>
                </div>
                <a class="carousel-control-prev" href="#carousel<?= $auction['auction_id'] ?>" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel<?= $auction['auction_id'] ?>" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </section>

              <!-- Card Body -->
              <div class="card-body">
                <p>
                  <?php if ($auction['approved'] == 0): ?>
                    <span class="badge badge-danger">Not Approved</span>
                  <?php else: ?>
                    <span class="badge badge-success">Approved</span>
                  <?php endif; ?>
                  <?php if ($auction['finished'] == 0): ?>
                    <span class="badge badge-success">Running</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Finished</span>
                  <?php endif; ?>

                  <span class="badge badge-info">Posted on <?= htmlspecialchars($auction['auction_timestamp'], ENT_QUOTES, 'UTF-8'); ?></span>
                </p>

                <h5 class="card-title"><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars(getCategory($pdo, $auction['category_id'])['category_name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                <p class="card-text"><?= strlen($auction['auction_description']) > 128 ? substr(htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'), 0, 128) . '...' : htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
              </div>
              <ul class="list-group list-group-flush" style="border-top: 1px solid rgba(0,0,0,.125)">
                <li class="list-group-item">Current Bid: <?= htmlspecialchars(formatCurrency(getCurrentBid($auction)), ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item">Buy Now Price: <?= htmlspecialchars(formatCurrency($auction['buy_price']), ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item">Auction starts on <?= htmlspecialchars($auction['start_date'], ENT_QUOTES, 'UTF-8'); ?></li>
                <li class="list-group-item">Auction ends on <?= htmlspecialchars($auction['end_date'], ENT_QUOTES, 'UTF-8'); ?></li>
              </ul>
              <div class="card-body">
                <a href="/auctions/auction.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-primary">View Auction</a>
                <a href="/auctions/update.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-warning">Edit Auction</a>
                <a href="/auctions/delete.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-danger">Delete Auction</a>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div> <!-- /Auctions Listing -->
    </section>

    <!-- REVIEWS RECEIVED -->
    <section class="mb-5">
      <h2 class="section__heading">My Reviews (Received)</h2>
      <hr class="section__rule my-3" />

      <!-- Reviews Listing -->
      <div class="row">
        <div class="col-12">
          <ul class="list-group">
            <?php foreach($reviewsReceived as $review): ?>
              <?php $user = getUser($pdo, $review['user_id']); ?>
              <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?= $user['first_name'] . ' ' . $user['last_name']; ?> said...</h5>
                  <small><?= $review['review_timestamp']; ?></small>
                </div>
                <p class="mb-1"><?= $review['review_text']; ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div> <!-- /Reviews Listing -->
    </section>

    <!-- REVIEWS RECEIVED -->
    <section class="mb-5">
      <h2 class="section__heading">My Reviews (Given)</h2>
      <hr class="section__rule my-3" />

      <!-- Reviews Listing -->
      <div class="row">
        <div class="col-12">
          <ul class="list-group">
            <?php foreach($reviewsGiven as $review): ?>
              <?php $user = getUser($pdo, $review['review_user']); ?>
              <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">I reviewed <?= $user['first_name'] . ' ' . $user['last_name']; ?> saying...</h5>
                  <small><?= $review['review_timestamp']; ?></small>
                </div>
                <p class="mb-1"><?= $review['review_text']; ?></p>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div> <!-- /Reviews Listing -->
    </section>
  </div> <!-- /Main Dashboard Content -->
</div> <!-- /Page -->
