<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Update Category</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
      <input type="hidden" name="category_id" id="category_id" value="<?= $_GET['id'] ?>" required />
      <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Home & Garden" value="<?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?>" required />
      </div>
      <div class="form-group">
        <label for="category_slug">Category Slug</label>
        <input type="text" name="category_slug" id="category_slug" class="form-control" placeholder="home-and-garden" value="<?= htmlspecialchars($category['category_slug'], ENT_QUOTES, 'UTF-8'); ?>" required />
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-warning">Update Category</button>
      </div>
    </form>
    <a href="/admin/categories/" class="btn btn-block btn-secondary">Return to Categories List</a>
  </div>
</div>
