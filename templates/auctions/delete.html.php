<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Delete Auction</h1>
    <hr class="my-5" />

    <p class="lead">Are you sure you want to delete this auction?</p>
    <p class="mb-5">This action is permanent and cannot be undone.</p>
    
    <ul class="list-group">
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Name</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Description</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Timestamp</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars(getFormattedDateTime($auction['auction_timestamp']), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Category</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Start Date</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars(getFormattedDateTime($auction['start_date']), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction End Date</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars(getFormattedDateTime($auction['end_date']), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Start Price</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars(formatCurrency($auction['start_price'], '£'), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="mb-0 text-muted"><small>Auction Buy Price</small></p>
        <p class="mb-0 ibuy__text"><?= htmlspecialchars(formatCurrency($auction['buy_price'], '£'), ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
    </ul>
    
    <form action="" method="post" class="my-2">
      <input type="hidden" name="auction_id" id="auction_id" value="<?= $auction['auction_id'] ?>" required />
      <button type="submit" name="submit" class="btn btn-block btn-danger">Delete Auction</button>
    </form>
    
    <a href="/id/dashboard.php" class="btn btn-block btn-secondary">Return to Dashboard</a>
  </div>
</div>
