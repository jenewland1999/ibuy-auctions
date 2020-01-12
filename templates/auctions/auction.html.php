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
      <li class="list-group-item bg-transparent pl-0">Posted on <?= getFormattedDateTime($auction['auction_timestamp']); ?></li>
      
      <!-- Auction Author -->
      <li class="list-group-item bg-transparent pl-0">Auction created by <a href="/id/profile.php?id=<?= $user['user_id'] ?>"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?></a></li>
      
      <!-- Current Bid -->
      <li class="list-group-item bg-transparent pl-0 font-weight-bold" style="color:red;font-size:2rem;">Current Bid: <?= htmlspecialchars(formatCurrency(getCurrentBid(), '£'), ENT_QUOTES, 'UTF-8'); ?></li>
      
      <!-- Time Remaining (NOTE: JS Handles the countdown magic) -->
      <li class="list-group-item bg-transparent pl-0">Time Remaining: <?= $timeRemaining->format('%m Months, %d Days, %h Hours, %i Minutes, %s Seconds') ?></li>
    </ul>

    <?php if (isset($_SESSION['uuid']) && $user['user_id'] === $_SESSION['uuid']): /* If it's your auction */ ?>
      <p>You can't bid on your own auctions.</p>
    <?php elseif (isset($_SESSION['uuid'])): ?>
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

    <hr class="my-5" />

    <!-- User Reviews -->
    <h3>Reviews of <?= getUserFullName($user); ?></h3>
    <ul class="reviews list-group list-group-flush mb-4">
      <?php foreach($reviews as $review): ?>
        <li class="review-item list-group-item bg-transparent pl-0" id="<?= 'Review_' . $review['review_id']; ?>">
          <?php include __DIR__ . '/../../components/rating.html.php'; ?>
          <p>
            <strong><?= htmlspecialchars(getUser($pdo, $review['review_author'])['first_name'], ENT_QUOTES, 'UTF-8'); ?> said</strong> <?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?> <em><?= getFormattedDateTime($review['review_timestamp'], 'd/m/Y') ?></em>
          </p>
          <?php if (isset($_SESSION['uuid'])): ?>
            <?php if ($review['review_author'] == $_SESSION['uuid']): ?>
              <div class="review-actions">
                <a href="/reviews/update.php?auction_id=<?= $auction['auction_id'] ?>&id=<?= $review['review_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/reviews/delete.php?auction_id=<?= $auction['auction_id'] ?>&id=<?= $review['review_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <div class="sharegrp">
            <button class="ibuy__btn-social-media" data-target="fb-share-btn" data-author="<?= getUserFullName(getUser($pdo, $review['review_author'])); ?>" data-rating="<?= $review['review_rating']; ?>" data-reviewee="<?= getUserFullName(getUser($pdo, $review['review_reviewee'])); ?>">
              <i class="fab fa-facebook-f"></i>
            </button>
            <?php
              $str = getUserFullName(getUser($pdo, $review['review_author'])) . ' gave ' . getUserFullName(getUser($pdo, $review['review_reviewee'])) . ' a ' . $review['review_rating'] . '-star rating on iBuy Auctions. Visit today and leave your own review.';
            ?>
            <a href="https://twitter.com/intent/tweet?text=<?= str_replace(' ', '+', $str) ?>" target="_blank" class="ibuy__btn-social-media" data-target="tw-share-btn">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php if (isset($_SESSION['uuid']) && $user['user_id'] === $_SESSION['uuid']): /* If it's your auction */ ?>
      <p>You can't post a review on yourself.</p>
    <?php elseif (isset($_SESSION['uuid'])): /* If you're logged in */ ?>
      <form action="" method="post">
        <!-- Review Author -->
        <input type="hidden" name="review_author" value="<?= $_SESSION['uuid'] ?>" required />
        
        <!-- Review Reviewee -->
        <input type="hidden" name="review_reviewee" value="<?= $auction['user_id'] ?>" required />

        <!-- Review Text -->
        <div class="form-group">
          <label for="review_text">Review Text</label>
          <textarea name="review_text" id="review_text" rows="8" class="form-control rounded-0" placeholder="Enter your review..." required></textarea>
        </div>

        <!-- Review Rating -->
        <div class="form-group d-inline-block">
          <label>Review Rating</label>
          <fieldset class="ibuy__rating">
            <?php for ($i = 5; $i > 0; $i--): ?>
              <input type="radio" name="review_rating" id="review_rating_<?= $i ?>" class="d-none" value="<?= $i ?>" required />
              <label for="review_rating_<?= $i ?>" class="mb-0 mr-1" title="<?= $i ?> star(s)"><i class="fas fa-star"></i></label>
            <?php endfor; ?>
          </fieldset>
        </div>

        <button type="submit" name="submit__review" class="btn btn-block btn-primary rounded-0">Post Review</button>
      </form>
    <?php else: /* If you're not logged in */ ?>
      <p>You must be logged in to post a review. <a href="/id/login.php">Login</a></p>
    <?php endif; ?>
  </div>
</div>
