<div class="row">
  <div class="col-12">
    <h1>Auctions</h1>
    <hr class="my-5" />

    <div class="table-responsive">
      <table class="table table-striped mt-5">
        <caption>List of all Auctions (Hint: scroll horizontally over the table to see all columns)</caption>
        <thead class="thead-light">
          <tr>
            <th scope="col" class="align-middle text-nowrap">Auction ID</th>
            <th scope="col" class="align-middle text-nowrap">Auction Name</th>
            <th scope="col" class="align-middle text-nowrap">Auction Description</th>
            <th scope="col" class="align-middle text-nowrap">Auction Timestamp</th>
            <th scope="col" class="align-middle text-nowrap">Auction Category</th>
            <th scope="col" class="align-middle text-nowrap">Auction Author</th>
            <th scope="col" class="align-middle text-nowrap">Auction Start Date</th>
            <th scope="col" class="align-middle text-nowrap">Auction End Date</th>
            <th scope="col" class="align-middle text-nowrap">Auction Start Price</th>
            <th scope="col" class="align-middle text-nowrap">Auction Buy Price</th>
            <th scope="col" class="align-middle text-nowrap">Auction Approved</th>
            <th scope="col" class="align-middle text-nowrap">Auction Finished</th>
            <th scope="col" class="align-middle text-nowrap">Auction Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($auctions as $auction): ?>
            <?php
              // Get category and user information
              $category = getCategory($pdo, $auction['category_id']);
              $user = getUser($pdo, $auction['user_id']);

              // Format timestamp
              $timestampDateTime = new DateTime($auction['auction_timestamp']);
              $timestampDate = $timestampDateTime->format('d-M-Y');
              $timestampTime = $timestampDateTime->format('H:i');

              // Format start date
              $startDateTime = new DateTime($auction['start_date']);
              $startDate = $startDateTime->format('d-M-Y');
              $startTime = $startDateTime->format('H:i');

              // Format end date
              $endDateTime = new DateTime($auction['end_date']);
              $endDate = $endDateTime->format('d-M-Y');
              $endTime = $endDateTime->format('H:i');

              // Get start price and buy price
              $startPrice = formatCurrency($auction['start_price']);
              $buyPrice = formatCurrency($auction['buy_price']);

              // TODO: Implement retrieval of current bid
              // Get current bid
              // $currentBid = formatCurrency(getCurrentBid($auction['auction_id']));
            ?>
            <tr>
              <!-- Auction ID -->
              <th scope="row" class="align-middle text-nowrap">
                <?= htmlspecialchars($auction['auction_id'], ENT_QUOTES, 'UTF-8'); ?>
              </th>

              <!-- Auction Name -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Description (Truncated 128 characters) -->
              <td class="align-middle text-nowrap">
                <?php if(strlen($auction['auction_description']) > 16): ?>
                  <span title="<?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= substr(htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'), 0, 16) . '...' ?>
                  </span>
                <?php else: ?>
                  <?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?>
                <?php endif; ?>
              </td>
              
              <!-- Auction Timestamp (Formatted) -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($timestampDate . ' at ' . $timestampTime, ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Category -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Author -->
              <td class="align-middle text-nowrap">
                <span title="<?= htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8'); ?>">
                  <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8'); ?>
                </span>
              </td>

              <!-- Auction Start Date (Formatted) -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($startDate . ' at ' . $startTime, ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction End Date (Formatted) -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($endDate . ' at ' . $endTime, ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Start Price (Formatted) -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($startPrice, ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Buy Price (Formatted) -->
              <td class="align-middle text-nowrap">
                <?= htmlspecialchars($buyPrice, ENT_QUOTES, 'UTF-8'); ?>
              </td>

              <!-- Auction Approved? -->
              <td class="align-middle text-nowrap">
                <?= $auction['approved'] === '1' ? 'Approved' : 'Not Approved' ?>
              </td>

              <!-- Auction Finished? -->
              <td class="align-middle text-nowrap">
                <?= $auction['finished'] === '1' ? 'Finished' : 'Running' ?>
              </td>

              <!-- Auction Auctions -->
              <td class="align-middle text-nowrap">
                <?php if($auction['approved'] === '0'): ?>
                  <a href="/admin/auctions/approve.php?id=<?= $category['category_id']; ?>" class="btn btn-sm btn-success">Approve</a>
                <?php endif; ?>
                <a href="/admin/auctions/update.php?id=<?= $category['category_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/admin/auctions/delete.php?id=<?= $category['category_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
