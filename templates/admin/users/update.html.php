<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Update User</h1>
    <hr class="my-5" />

    <form action="" method="post">
      <input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id']; ?>" required />
      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" placeholder="John" class="form-control" value="<?= $user['first_name'] ?>" required />
          </div>
          <div class="col">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" placeholder="Smith" class="form-control" value="<?= $user['last_name'] ?>" required />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" name="user_email" id="user_email" placeholder="john.smith@example.org" class="form-control" value="<?= $user['user_email'] ?>" required />
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-warning">Update User</button>
      </div>
    </form>
    <a href="/admin/users/" class="btn btn-block btn-secondary">Return to Users</a>
  </div>
</div>
