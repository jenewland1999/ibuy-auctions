<div class="row">
  <div class="col-12">
    <h1>Users</h1>
    <hr class="my-5" />

    <div class="table-responsive">
      <table class="table table-striped mt-5">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="align-middle text-nowrap">User ID</th>
            <th scope="col" class="align-middle text-nowrap">User Email</th>
            <th scope="col" class="align-middle text-nowrap">User First Name</th>
            <th scope="col" class="align-middle text-nowrap">User Last Name</th>
            <th scope="col" class="align-middle text-nowrap">User Rank</th>
            <th scope="col" class="align-middle text-nowrap">User Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>
            <tr>
              <th scope="row" class="align-middle text-nowrap"><?= $user['user_id']; ?></th>
              <td class="align-middle text-nowrap"><?= htmlspecialchars($user['user_email'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td class="align-middle text-nowrap"><?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td class="align-middle text-nowrap"><?= htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td class="align-middle text-nowrap"><?= $user['is_admin'] == 1 ? 'Admin' : 'Regular' ?></td>
              <td class="align-middle text-nowrap">
                <a href="/admin/users/update.php?id=<?= $user['user_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/admin/users/delete.php?id=<?= $user['user_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
