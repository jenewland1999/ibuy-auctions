<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Delete Bid</h1>
    <hr class="my-5" />

    <p class="lead">Are you sure you want to delete this bid?</p>

    <ul class="list-group">
      <li class="list-group-item">
        <p class="mb-0"><small class="text-muted">Auction Name</small></p>
        <?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?>
      </li>
      <li class="list-group-item">
        <p class="mb-0"><small class="text-muted">Bid Amount</small></p>
        <?= htmlspecialchars(formatCurrency($bid['bid_amount'], '£'), ENT_QUOTES, 'UTF-8'); ?>
      </li>
      <li class="list-group-item">
        <p class="mb-0"><small class="text-muted">Bid Timestamp</small></p>
        <?= htmlspecialchars(getFormattedDateTime($bid['bid_timestamp']), ENT_QUOTES, 'UTF-8'); ?>
      </li>
    </ul>

    <form action="" method="post" class="my-2">
      <input type="hidden" name="bid_id" value="<?= $bid['bid_id']; ?>" required />
      <button type="submit" name="submit" class="btn btn-block btn-danger">Delete Bid</button>
    </form>

    <?php if (strpos($origin, '/id/dashboard.php') !== false): ?>
      <a href="<?= $origin; ?>" class="btn btn-block btn-secondary">Return to Dashboard</a>
    <?php elseif (strpos($origin, '/bids/index.php') !== false): ?>
      <a href="<?= $origin; ?>" class="btn btn-block btn-secondary">Return to Bids</a>
    <?php else: ?>
      <a href="<?= $origin; ?>" class="btn btn-block btn-secondary">Return to Homepage</a>
    <?php endif; ?>
  </div>
</div>
