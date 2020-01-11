<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Update Review</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
      <input type="hidden" name="review_id" id="review_id" value="<?= $review['review_id'] ?>" required />
      
      <div class="form-group">
        <label for="review_text">Review Text</label>
        <textarea name="review_text" id="review_text" rows="8" class="form-control" required><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?></textarea>
      </div>

      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-warning">Update Review</button>
      </div>
    </form>
    <a href="/admin/reviews/" class="btn btn-block btn-secondary">Return to Reviews List</a>
  </div>
</div>
