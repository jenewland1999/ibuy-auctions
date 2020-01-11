<div class="row mb-5">
  <div class="col-md-5">
    <!-- Card Image Carousel -->
    <section id="carousel<?= $auction['auction_id'] ?>" class="carousel slide carousel-fade mb-4" date-ride="carousel">
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

    <p class="text-center h5">Share this Auction:</p>
    <div class="sharethis-inline-share-buttons"></div>
  </div>
  <div class="col-md-7">

    <!-- Auction Name -->
    <h1><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></h1>
    
    <!-- Auction Category -->
    <h2 class="text-secondary"><?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <ul class="list-group list-group-flush mb-4">
      <!-- Auction Timestamp -->
      <?php 
        $timestampDateTime = new DateTime($auction['auction_timestamp']);
        $timestampDate = $timestampDateTime->format('dS F Y');
        $timestampTime = $timestampDateTime->format('H:i');
      ?>
      <li class="list-group-item bg-transparent pl-0">Posted on <?= htmlspecialchars($timestampDate . ' at ' . $timestampTime, ENT_QUOTES, 'UTF-8'); ?></li>
      
      <!-- Auction Author -->
      <li class="list-group-item bg-transparent pl-0">Auction created by <a href="/auctions?user=<?= $user['user_id'] ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
      
      <!-- Current Bid -->
      <li class="list-group-item bg-transparent pl-0">Current Bid: <?= htmlspecialchars(getCurrentBid(), ENT_QUOTES, 'UTF-8'); ?></li>
      
      <!-- Time Remaining (NOTE: JS Handles the countdown magic) -->
      <li class="list-group-item bg-transparent pl-0">Time Remaining: <?= $timeRemaining->format('%m Months, %d Days, %h Hours, %i Minutes, %s Seconds') ?></li>
    </ul>

    <?php if (isset($_SESSION['uuid'])): ?>
      <form action="" method="post" class="form-inline">
        <input type="hidden" name="auction_id" value="<?= $_GET['id']; ?>" required />
        
        <div class="form-group mr-2 flex-grow-1">
          <label for="bid_amount" class="sr-only">Bid Amount</label>
          <div class="input-group input-group-lg flex-grow-1">
            <div class="input-group-prepend">
              <span class="input-group-text rounded-0">£</span>
            </div>
            <input type="text" name="bid_amount" id="bid_amount" class="form-control form-control-lg flex-grow-1 rounded-0" pattern="\d+\.\d\d" placeholder="Enter bid amount" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." required />
          </div>
        </div>
      
        <button type="submit" name="submit__bid" class="btn btn-lg btn-primary rounded-0 flex-grow-1">Place Bid</button>
      </form>
    <?php else: ?>
      <p>You must be logged in to bid on auctions. <a href="/id/login.php">Login</a></p>
    <?php endif ?>
  </div>
</div>
<div class="row">
  <div class="col-12 mb-5">
    <!-- Auction Description -->
    <h3>Description</h3>
    <p style="white-space: pre-wrap;"><?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
  </div>
  <div class="col-12">
    <!-- User Reviews -->
    <h3>Reviews of <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
    <ul class="list-group list-group-flush mb-4">
      <?php foreach($reviews as $review): ?>
        <li class="list-group-item bg-transparent pl-0">
          <strong><?= htmlspecialchars(getUser($pdo, $review['user_id'])['first_name'], ENT_QUOTES, 'UTF-8'); ?> said</strong> <?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?> <em><?= htmlspecialchars($review['review_timestamp'], ENT_QUOTES, 'UTF-8'); ?></em>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php if (isset($_SESSION['uuid']) && $user['user_id'] === $_SESSION['uuid']): /* If it's your auction */ ?>
      <p>You can't post a review on yourself.</p>
    <?php elseif (isset($_SESSION['uuid'])): /* If you're logged in */ ?>
      <form action="" method="post">
        <!-- Review User -->
        <input type="hidden" name="review_user" value="<?= $auction['user_id'] ?>" required />
        
        <!-- User ID -->
        <input type="hidden" name="user_id" value="<?= $_SESSION['uuid'] ?>" required />
        
        <!-- Review Text -->
        <div class="form-group">
          <label for="review_text" class="sr-only">Review Text</label>
          <textarea name="review_text" id="review_text" rows="8" class="form-control rounded-0" placeholder="Enter your review..." required></textarea>
        </div>

        <button type="submit" name="submit__review" class="btn btn-block btn-primary rounded-0">Post Review</button>
      </form>
    <?php else: /* If you're not logged in */ ?>
      <p>You must be logged in to post a review. <a href="/id/login.php">Login</a></p>
    <?php endif; ?>
  </div>
</div>
