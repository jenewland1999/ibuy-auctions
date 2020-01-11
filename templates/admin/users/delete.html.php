<div class="row">
  <div class="col-12 col-md-6 offset-md-3">
    <h1>Delete User</h1>
    <hr class="my-5" />
    
    <p class="lead">Are you sure you want to delete this user?</p>
    <p>This action is permanent and will delete all user data, related auctions, bids and reviews.</p>
    <form action="" method="post">
      <input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id']; ?>" required />
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-danger">Delete User</button>
      </div>
    </form>
    <a href="/admin/users/" class="btn btn-block btn-secondary">Return to Users</a>
  </div>
</div>
