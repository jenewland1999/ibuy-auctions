<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Update Auction</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
      <!-- Auction ID -->
      <input type="hidden" name="auction_id" value="<?= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); ?>" required />


      <!-- Auction Images -->
      <div class="form-group">
        <label for="auction_images">Auction Images</label>
        <div class="custom-file">
          <input type="file" name="auction_images[]" id="auction_images" class="custom-file-input" multiple>
          <label class="custom-file-label" for="auction_images">Choose images...</label>
        </div>
      </div>

      <!-- Auction Name -->
      <div class="form-group">
        <label for="auction_name">Auction Name</label>
        <input type="text" name="auction_name" id="auction_name" class="form-control" placeholder="XBOX One X (Black, 1TB, New)" value="<?= htmlspecialchars($auction['auction_name'], ENT_QUOTES, 'UTF-8'); ?>" maxlength="2048" required />
      </div>

      <!-- Auction Description -->
      <div class="form-group">
        <label for="auction_description">Auction Description</label>
        <textarea name="auction_description" id="auction_description" class="form-control" placeholder="A brand new, unopened 1TB, Black XBOX One X complete with one black controller, HDMI/Power lead and instructions." rows="3" required><?= htmlspecialchars($auction['auction_description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
      </div>

      <!-- Auction Category -->
      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
          <option value="" selected disabled>Please select a category...</option>
          <?php foreach ($categories as $category): ?>
            <?php if ($category['category_id'] === $auction['category_id']): ?>
              <option value="<?= $category['category_id']; ?>" selected><?= $category['category_name']; ?></option>
            <?php else: ?>
              <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Start Date -->
      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" min="<?= $startDate; ?>" max="<?= $startDateMax; ?>" value="<?= htmlspecialchars(substr($auction['start_date'], 0, 10), ENT_QUOTES, 'UTF-8'); ?>" required />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" min="<?= $startTime; ?>" value="<?= htmlspecialchars(substr($auction['start_date'], 11), ENT_QUOTES, 'UTF-8'); ?>" required />
          </div>
        </div>
      </div>

      <!-- End Date -->
      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" min="<?= $endDate; ?>" max="<?= $endDateMax; ?>" value="<?= htmlspecialchars(substr($auction['end_date'], 0, 10), ENT_QUOTES, 'UTF-8'); ?>" required />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="<?= htmlspecialchars(substr($auction['end_date'], 11), ENT_QUOTES, 'UTF-8'); ?>" required />
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="start_price">Start Price</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">£</div>
              </div>
              <input type="text" name="start_price" id="start_price" class="form-control" pattern="\d+\.\d\d" placeholder="299.99" value="<?= htmlspecialchars(formatCurrency($auction['start_price']), ENT_QUOTES, 'UTF-8'); ?>" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." required />
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="buy_price">Buy Price</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">£</div>
              </div>
              <input type="text" name="buy_price" id="buy_price" class="form-control" pattern="\d+\.\d\d" placeholder="299.99" value="<?= htmlspecialchars(formatCurrency($auction['buy_price']), ENT_QUOTES, 'UTF-8'); ?>" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." />
            </div>
            <small class="form-text text-muted">Leave blank for no buy price.</small>
          </div>
        </div>
      </div>

      <div class="form-row mb-2">
        <div class="col-9">
          <button type="submit" name="submit" class="btn btn-block btn-warning">Update Auction</button>
        </div>
        <div class="col-3">
          <button type="reset" class="btn btn-block btn-danger">Clear Form</button>
        </div>
      </div>
    </form>

    <a href="/admin/categories/" class="btn btn-block btn-secondary mb-2">Return to Auctions</a>
    
    <p><small class="text-muted">Once submitted the auction will have to wait for re-approval by an administrator.</small></p>
  </div>
</div>
