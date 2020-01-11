<div class="row">
  <div class="col-12">
    <section class="jumbotron bg-transparent">
      <h1 class="display-4">iBuy Auctions</h1>
      <p class="lead">Welcome to iBuy Auctions the greatest auction site out there.</p>
      <hr class="my-4">
      <p>View our latest auctions below or view a full list of all our auctions by clicking the button below.</p>
      <a href="/auctions/" class="btn btn-lg btn-primary">View Auctions</a>
    </section>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <h2>Recent Auctions</h2>
    <hr class="my-5">
  </div>
</div>
<div class="row">
  <?php foreach($auctions as $auction): ?>
    <div class="col-12 col-sm-6 col-md-4 col-md-3">
      <article class="card mb-4 h-100">
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
            <?php
              $timestampDateTime = new DateTime($auction['auction_timestamp']);
              $timestampDate = $timestampDateTime->format('dS F Y');
              $timestampTime = $timestampDateTime->format('H:i');
            ?>
            <span class="badge badge-info">Posted on <?= htmlspecialchars($timestampDate . ' at ' . $timestampTime, ENT_QUOTES, 'UTF-8'); ?></span>
          </p>

          <h5 class="card-title"><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars(getCategory($pdo, $auction['category_id'])['category_name'], ENT_QUOTES, 'UTF-8'); ?></h6>
          <p class="card-text"><?= strlen($auction['auction_description']) > 128 ? substr(htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'), 0, 128) . '...' : htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <ul class="list-group list-group-flush" style="border-top: 1px solid rgba(0,0,0,.125)">
          <li class="list-group-item">Current Bid: <?= htmlspecialchars(formatCurrency(getCurrentBid($auction), '£'), ENT_QUOTES, 'UTF-8'); ?></li>
          <li class="list-group-item">Buy Now Price: <?= htmlspecialchars(formatCurrency($auction['buy_price'], '£'), ENT_QUOTES, 'UTF-8'); ?></li>
          <?php 
            $startDateTime = new DateTime($auction['start_date']);
            $startDate = $startDateTime->format('dS F Y');
            $startTime = $startDateTime->format('H:i');
            $endDateTime = new DateTime($auction['end_date']);
            $endDate = $endDateTime->format('dS F Y');
            $endTime = $endDateTime->format('H:i');
          ?>
          <li class="list-group-item">Auction starts on <?= htmlspecialchars($startDate . ' at ' . $startTime, ENT_QUOTES, 'UTF-8'); ?></li>
          <li class="list-group-item">Auction ends on <?= htmlspecialchars($endDate . ' at ' . $endTime, ENT_QUOTES, 'UTF-8'); ?></li>
        </ul>
        <div class="card-body flex-grow-0">
          <a href="/auctions/auction.php?id=<?= $auction['auction_id']; ?>" class="btn btn-sm btn-primary mb-1">View Auction</a>
        </div>
      </article>
    </div>
  <?php endforeach; ?>
</div>
