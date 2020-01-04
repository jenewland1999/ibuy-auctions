<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Approve Auction</h1>
    <hr class="my-5" />

    <p class="lead">Are you sure you want to approve this auction?</p>
    
    <ul class="list-group mb-3">
      <li class="list-group-item">
        <p class="my-0"><small>Auction Name</small></p>
        <p><?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Description</small></p>
        <p><?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Timestamp</small></p>
        <p><?= htmlspecialchars($timestampDate . ' at ' . $timestampTime, ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Category</small></p>
        <p><?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Author</small></p>
        <p><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'] . ' <' . $user['user_email'] . '>', ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Start Date</small></p>
        <p><?= htmlspecialchars($startDate . ' at ' . $startTime, ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction End Date</small></p>
        <p><?= htmlspecialchars($endDate . ' at ' . $endTime, ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Start Price</small></p>
        <p><?= htmlspecialchars($auction['start_price'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
      <li class="list-group-item">
        <p class="my-0"><small>Auction Buy Price</small></p>
        <p><?= htmlspecialchars($auction['buy_price'], ENT_QUOTES, 'UTF-8'); ?></p>
      </li>
    </ul>
    
    <form action="" method="post">
      <input type="hidden" name="auction_id" id="auction_id" value="<?= $_GET['id'] ?>" required />
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-success">Approve Auction</button>
      </div>
    </form>
    <a href="/admin/auctions/" class="btn btn-block btn-secondary">Return to Auction List</a>
  </div>
</div>
