<div class="row">
  <div class="col-12">
    <h1>Categories</h1>
    <hr class="my-5" />

    <a href="/admin/categories/create.php" class="btn btn-success">Create Category</a>

    <div class="table-responsive">
      <table class="table table-striped mt-5">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="align-middle text-nowrap">Category ID</th>
            <th scope="col" class="align-middle text-nowrap">Category Name</th>
            <th scope="col" class="align-middle text-nowrap">Category Slug</th>
            <th scope="col" class="align-middle text-nowrap">Category Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($categories as $category): ?>
            <tr>
              <th scope="row" class="align-middle text-nowrap"><?= $category['category_id']; ?></th>
              <td class="align-middle text-nowrap"><?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td class="align-middle text-nowrap"><?= htmlspecialchars($category['category_slug'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td class="align-middle text-nowrap">
                <a href="/admin/categories/update.php?id=<?= $category['category_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/admin/categories/delete.php?id=<?= $category['category_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
