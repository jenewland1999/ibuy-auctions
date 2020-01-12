<div class="row">
  <div class="col-12">
    <h1>Reviews</h1>
    <hr class="my-5" />

    <div class="table-responsive">
      <table class="table table-striped mt-5">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="align-middle text-nowrap">Review ID</th>
            <th scope="col" class="align-middle text-nowrap">Review Author</th>
            <th scope="col" class="align-middle text-nowrap">Review Rating</th>
            <th scope="col" class="align-middle text-nowrap">Review Reviewee</th>
            <th scope="col" class="align-middle text-nowrap">Review Text</th>
            <th scope="col" class="align-middle text-nowrap">Review Timestamp</th>
            <th scope="col" class="align-middle text-nowrap">Review Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($reviews as $review): ?>
            <tr>
              <th scope="row" class="align-middle text-nowrap"><?= $review['review_id']; ?></th>
              <td class="align-middle text-nowrap"><?= getUserFullName(getUser($pdo, $review['review_author'])); ?></td>
              <td class="align-middle text-nowrap"><?php include __DIR__ . '/../../../components/rating.html.php'; ?></td>
              <td class="align-middle text-nowrap"><?= getUserFullName(getUser($pdo, $review['review_reviewee'])); ?></td>
              <td class="align-middle text-nowrap">
                <?php if(strlen($review['review_text']) > 16): ?>
                  <span title="<?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars(substr($review['review_text'], 0, 16), ENT_QUOTES, 'UTF-8') . '...' ?></span>
                <?php else: ?>
                  <?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?>
                <?php endif; ?>
              </td>
              <td class="align-middle text-nowrap"><?= getFormattedDateTime($review['review_timestamp'], 'd-M-Y H:i') ?></td>
              <td class="align-middle text-nowrap">
                <a href="/admin/reviews/update.php?id=<?= $review['review_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/admin/reviews/delete.php?id=<?= $review['review_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
