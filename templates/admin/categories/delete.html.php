<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Delete Category</h1>
    <hr class="my-5" />

    <p class="lead">Are you sure you want to delete this category?</p>
    <p>This action is permanent.</p>
    
    <form action="" method="post">
      <input type="hidden" name="category_id" id="category_id" value="<?= $_GET['id'] ?>" required />
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-danger">Delete Category</button>
      </div>
    </form>
    <a href="/admin/categories/" class="btn btn-block btn-secondary">Return to Categories List</a>
  </div>
</div>
