<div class="row">
  <div class="col-12">
    <section class="jumbotron bg-transparent">
      <h1 class="display-4">iBuy Auctions</h1>
      <p class="lead">Welcome to iBuy Auctions the greatest auction site out there.</p>
      <hr class="my-4">
      <p>View our latest auctions below or view a full list of all our auctions by clicking the button below.</p>
      <a href="/auctions/" class="btn btn-lg btn-primary">View Auctions</a>
    </section>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <h2>Recent Auctions</h2>
    <hr class="my-5">
  </div>
</div>
<div class="row">
  <?php foreach($auctions as $auction): ?>
    <?php include __DIR__ . '/../components/auction.html.php'; ?>
  <?php endforeach; ?>
</div>
