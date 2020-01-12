<div class="mb-2">
  <?php for ($i = 0; $i < 5; $i++): ?>
    <?php if ($review['review_rating'] > $i): ?>
      <i class="fas fa-star" style="color: #f4ae01;"></i>
    <?php else: ?>
      <i class="fas fa-star" style="color: #cccccc;"></i>
    <?php endif; ?>
  <?php endfor; ?>
</div>
