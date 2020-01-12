<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Update Review</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
      <input type="hidden" name="review_id" id="review_id" value="<?= $review['review_id'] ?>" required />
      
      <div class="form-group d-inline-block">
        <label>Review Rating</label>
        <fieldset class="ibuy__rating">
          <?php for ($i = 5; $i > 0; $i--): ?>
            <?php if ($review['review_rating'] == $i): ?>
              <input type="radio" name="review_rating" id="review_rating_<?= $i ?>" class="d-none" value="<?= $i ?>" checked required />
            <?php else: ?>
              <input type="radio" name="review_rating" id="review_rating_<?= $i ?>" class="d-none" value="<?= $i ?>" required />
            <?php endif; ?>
            <label for="review_rating_<?= $i ?>" class="mb-0 mr-1" title="<?= $i ?> star(s)"><i class="fas fa-star"></i></label>
          <?php endfor; ?>
        </fieldset>
      </div>

      <div class="form-group">
        <label for="review_text">Review Text</label>
        <textarea name="review_text" id="review_text" rows="8" class="form-control" required><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?></textarea>
      </div>

      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-warning">Update Review</button>
      </div>
    </form>
    <?php if (isset($_GET['auction_id'])): ?>
      <a href="/auctions/auction.php?id=<?= $_GET['auction_id']; ?>" class="btn btn-block btn-secondary">Return to Auction</a>
    <?php else: ?>
      <a href="/id/dashboard.php" class="btn btn-block btn-secondary">Return to Dashboard</a>
    <?php endif; ?>
  </div>
</div>
