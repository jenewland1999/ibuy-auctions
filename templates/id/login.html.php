<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>Login</h1>
    <hr class="my-5" />

    <form action="" method="post">
      <div class="form-group">
        <label for="user_email">Email Address</label>
        <input type="email" name="user_email" id="user_email" placeholder="john.smith@example.org" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="user_pwd">Password</label>
        <input type="password" name="user_pwd" id="user_pwd" placeholder="iBuyIsGr_8!" class="form-control" required />
      </div>
      <div class="form-group">
        <div class="form-row align-items-center">
          <div class="col">
            <a href="/id/register.php">Register Instead</a>
          </div>
          <div class="col">
            <button type="submit" name="submit" class="btn btn-block btn-success">Login</button>
          </div>
        </div>
      </div>
    </form>
    <a href="/" class="btn btn-block btn-secondary">Return to Homepage</a>
  </div>
</div>
