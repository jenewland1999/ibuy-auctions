<div class="row">
    <div class="col-md-6 offset-md-3">
      <h1>Register</h1>
      <hr />
      
      <form action="" method="post">
        <div class="form-row form-group">
          <div class="col">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" placeholder="John" class="form-control" required />
          </div>
          <div class="col">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" placeholder="Smith" class="form-control" required />
          </div>
        </div>
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
              <a href="/id/login.php">Login Instead</a>
            </div>
            <div class="col">
              <button type="submit" name="submit" class="btn btn-block btn-success">Register</button>
            </div>
          </div>
        </div>
      </form>
      <a href="/" class="btn btn-block btn-secondary">Return to Homepage</a>
    </div>
  </div>
