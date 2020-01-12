<div class="row">
  <div class="col-12">
    <!-- The beginning of error checking. Quite elegant if you ask me. -->
    <?php if (isset($_SESSION['errors'])): ?>
      <?php foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-<?= $error['lvl']; ?> alert-dismissible fade show" role="alert">
          <?= $error['msg']; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="col-md-8">
    <a href="/auctions/auction.php?id=<?= $auction['auction_id'] ?>" class="btn btn-secondary mb-5">
      <i class="fas fa-arrow-left"></i> Return to Auction
    </a>
    <p class="bid__stats">
      <small class="text-muted mr-2">Bidders: </small><span class="bid__stat mr-2">0</span>
      <small class="text-muted mr-2">Bids: </small><span class="bid__stat mr-2">0</span>
      <small class="text-muted mr-2">Time Remaining: </small><span class="bid__stat mr-2"><?= getAuctionTimeRemaining($auction); ?></span>
    </p>
    <table class="table table-striped">
      <thead class="thead-light">
        <tr>
          <th scope="col">Bidder</th>
          <th scope="col">Bid Amount</th>
          <th scope="col">Bid Timestamp</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bids as $bid): ?>
          <tr>
            <td><?= getUserFullName(getUser($pdo, $bid['bid_author'])); ?></td>
            <td><?= formatCurrency($bid['bid_amount'], '£'); ?></td>
            <td><?= getFormattedDateTime($bid['bid_timestamp']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-4">
    <ul class="list-group">
      <!-- Auction Images -->
      <li class="list-group-item">
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
      </li>
      
      <!-- Auction Name -->
      <li class="list-group-item">
        <p class="text-muted mb-1"><small>Auction Name</small></p>
        <p class="mb-0"><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      
      <!-- Auction Current Bid -->
      <li class="list-group-item">
        <p class="text-muted mb-1"><small>Current Bid</small></p>
        <p class="mb-0"><?= htmlspecialchars(formatCurrency(getBidCurrentPrice($pdo, $auction['auction_id']), '£'), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>

      <!-- Place Bid -->
      <li class="list-group-item">
        <?php if (isset($_SESSION['uuid']) && getUser($pdo, $auction['user_id'])['user_id'] === $_SESSION['uuid']): /* If it's your auction */ ?>
          <p>You can't bid on your own auctions.</p>
        <?php elseif (isset($_SESSION['uuid'])): ?>
          <form action="" method="post">
            <input type="hidden" name="auction_id" value="<?= $auction['auction_id']; ?>" required />
            
            <div class="form-group">
              <label for="bid_amount" class="sr-only">Bid Amount</label>
              <div class="input-group input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text rounded-0">£</span>
                </div>
                <input type="text" name="bid_amount" id="bid_amount" class="form-control rounded-0" pattern="\d+\.\d\d" placeholder="Enter bid amount" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." required />
              </div>
            </div>
          
            <button type="submit" name="submit" class="btn btn-block btn-primary rounded-0">Place Bid</button>
          </form>
        <?php else: ?>
          <p>You must be logged in to bid on auctions. <a href="/id/login.php">Login</a></p>
        <?php endif ?>
      </li>

      
    </ul>
  </div>
</div>
