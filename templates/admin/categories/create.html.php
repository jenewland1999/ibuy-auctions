<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Create Category</h1>
    <hr class="my-5" />
    
    <form action="" method="post">
      <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Home & Garden" required />
      </div>
      <div class="form-group">
        <label for="category_slug">Category Slug</label>
        <input type="text" name="category_slug" id="category_slug" class="form-control" placeholder="home-and-garden" required />
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-success">Create Category</button>
      </div>
    </form>
    <a href="/admin/categories/" class="btn btn-block btn-secondary">Return to Categories List</a>
  </div>
</div>
