<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Delete Auction</h1>
    <hr class="my-5" />

    <p class="lead">Are you sure you want to delete this auction?</p>
    <p>This action is permanent.</p>
    
    <form action="" method="post">
      <input type="hidden" name="auction_id" id="auction_id" value="<?= $_GET['id'] ?>" required />
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-block btn-danger">Delete Auction</button>
      </div>
    </form>
    <a href="/admin/auctions/" class="btn btn-block btn-secondary">Return to Auction List</a>
  </div>
</div>
