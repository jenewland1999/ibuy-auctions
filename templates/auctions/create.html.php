<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Create Auction</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
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
        <input type="text" name="auction_name" id="auction_name" class="form-control" placeholder="XBOX One X (Black, 1TB, New)" value="" maxlength="2048" required />
      </div>

      <!-- Auction Description -->
      <div class="form-group">
        <label for="auction_description">Auction Description</label>
        <textarea name="auction_description" id="auction_description" class="form-control" placeholder="Provide a detailed and meaningful description of your auction." rows="3" required></textarea>
      </div>

      <!-- Auction Category -->
      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
          <option value="" selected disabled>Please select a category...</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Start Date -->
      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" min="<?= $startDate; ?>" max="<?= $startDateMax; ?>" value="<?= $startDate; ?>" required />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" min="<?= $startTime; ?>" value="<?= $startTime; ?>" required />
          </div>
        </div>
      </div>

      <!-- End Date -->
      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" min="<?= $endDate; ?>" max="<?= $endDateMax; ?>" value="<?= $endDate; ?>" required />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="<?= $endTime; ?>" required />
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
              <input type="text" name="start_price" id="start_price" class="form-control" pattern="\d+\.\d\d" placeholder="299.99" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." required />
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
              <input type="text" name="buy_price" id="buy_price" class="form-control" pattern="\d+\.\d\d" placeholder="299.99" title="A valid price (e.g. 3.50, 353.23 or 24.43) must be entered." />
            </div>
            <small class="form-text text-muted">Leave blank for no buy price.</small>
          </div>
        </div>
      </div>

      <div class="form-row mb-2">
        <div class="col-9">
          <button type="submit" name="submit" class="btn btn-block btn-success">Create Auction</button>
        </div>
        <div class="col-3">
          <button type="reset" class="btn btn-block btn-danger">Clear Form</button>
        </div>
      </div>
    </form>

    <a href="/admin/categories/" class="btn btn-block btn-secondary">Return to Auctions</a>
  </div>
</div>
