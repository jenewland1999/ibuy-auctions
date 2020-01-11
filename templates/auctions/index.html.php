<div class="row">
  <div class="col-12">
    <h1>Auctions</h1>
    <hr class="my-5" />

    <a href="/auctions/create.php" class="btn btn-success">Create Auction</a>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <form action="" class="form my-5">
      <div class="form-row">
        <div class="col-6">
          <label for="search" class="sr-only">Search</label>
          <input type="text" name="q" id="search" class="form-control form-control-lg" placeholder="Search for anything..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8') : '' ?>" />
        </div>
        <div class="col-4">
          <label for="cat" class="sr-only">Category</label>
          <select name="cat" id="cat" class="form-control form-control-lg">
            <option value="" disabled <?= isset($_GET['cat']) ? '' : 'selected' ?>>Select a category...</option>
            <?php foreach($categories as $category): ?>
              <?php if (isset($_GET['cat'])): ?>
                <option value="<?= htmlspecialchars($category['category_slug'], ENT_QUOTES, 'UTF-8'); ?>" <?= $category['category_slug'] === $_GET['cat'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php else: ?>
                <option value="<?= htmlspecialchars($category['category_slug'], ENT_QUOTES, 'UTF-8'); ?>">
                  <?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
          <button class="btn btn-link p-0" id="btnCatClear"><small class="text-muted">Clear category</small></button>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-lg btn-block btn-primary">Search</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <?php foreach($auctions as $auction): ?>
    <?php include __DIR__ . '/../../components/auction.html.php'; ?>
  <?php endforeach; ?>
</div>
