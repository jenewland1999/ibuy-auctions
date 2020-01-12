<div class="row">
  <div class="col-12 col-md-6 offset-md-3">
    <h1>Delete Review</h1>
    <hr class="my-5" />
    
    <p class="lead">Are you sure you want to delete this review?</p>
    <form action="" method="post">
      <input type="hidden" name="review_id" id="review_id" value="<?= $review['review_id']; ?>" required />
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-danger">Delete Review</button>
      </div>
    </form>
    <?php if (isset($_GET['auction_id'])): ?>
      <a href="/auctions/auction.php?id=<?= $_GET['auction_id']; ?>" class="btn btn-block btn-secondary">Return to Auction</a>
    <?php else: ?>
      <a href="/id/dashboard.php" class="btn btn-block btn-secondary">Return to Dashboard</a>
    <?php endif; ?>
  </div>
</div>
