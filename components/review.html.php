<li class="list-group-item">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">
      <?= $give ? 'I reviewed ' . getUserFullName($user) . ' saying...' : getUserFullName($user) . ' said...' ?>
    </h5>
    <small>Posted on <?= htmlspecialchars(getFormattedDateTime($review['review_timestamp']), ENT_QUOTES, 'UTF-8'); ?></small>
  </div>
  <p class="mb-1"><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8'); ?></p>
</li>
