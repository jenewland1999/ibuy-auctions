<?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false || strpos($_SERVER['REQUEST_URI'], 'profile.php') !== false): ?>
  <div class="col-12 col-lg-6 mb-5">
<?php else: ?>
  <div class="col-12 col-sm-6 col-md-4">
<?php endif; ?>
  <article class="card h-100">
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
        <?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false): ?>
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
        <?php endif; ?>

        <span class="badge badge-info">Posted on <?= htmlspecialchars(getFormattedDateTime($auction['auction_timestamp']), ENT_QUOTES, 'UTF-8'); ?></span>
      </p>

      <h5 class="card-title"><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
      <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars(getCategory($pdo, $auction['category_id'])['category_name'], ENT_QUOTES, 'UTF-8'); ?></h6>
      <p class="card-text" style="white-space: pre-wrap;"><?= strlen($auction['auction_description']) > 128 ? substr(htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'), 0, 128) . '...' : htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <ul class="list-group list-group-flush" style="border-top: 1px solid rgba(0,0,0,.125)">
      <?php if ($auction['buy_price'] != 0): ?>
        <li class="list-group-item">Buy Now Price: <?= htmlspecialchars(formatCurrency($auction['buy_price'], '£'), ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endif; ?>
      <li class="list-group-item">Current Bid: <?= htmlspecialchars(formatCurrency(getBidCurrentPrice($pdo, $auction['auction_id']), '£'), ENT_QUOTES, 'UTF-8'); ?></li>
      <li class="list-group-item">Auction starts on <?= htmlspecialchars(getFormattedDateTime($auction['start_date']), ENT_QUOTES, 'UTF-8'); ?></li>
      <li class="list-group-item">Auction ends on <?= htmlspecialchars(getFormattedDateTime($auction['end_date']), ENT_QUOTES, 'UTF-8'); ?></li>
    </ul>
    <div class="card-body flex-grow-0">
      <a href="/auctions/auction.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-primary mb-1">View Auction</a>
      <?php if (strpos($_SERVER['REQUEST_URI'], 'dashboard.php') !== false): ?>
        <a href="/auctions/update.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-warning mb-1">Edit Auction</a>
        <a href="/auctions/delete.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-danger mb-1">Delete Auction</a>
      <?php endif; ?>
    </div>
  </article>
</div>
