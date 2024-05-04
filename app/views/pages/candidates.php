<?php
$currentUrl = $_SERVER['REQUEST_URI'];
if (strpos($currentUrl, '?') === false) {
  $currentUrl = $currentUrl . '?';
}
$pos = strpos($currentUrl, '&num');
if ($pos !== false) {
    $currentUrl = substr($currentUrl, 0, $pos);
}
?>



<div>
  <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" href="<?= $currentUrl?>&num=<?= $Previous; ?>" aria-label="Previous">Previous</a>
          </li>
          <?php for($i = 1; $i<= $pages; $i++) : ?>
              <li class="page-item">
                  <a class="page-link" href="<?= $currentUrl?>&num=<?= $i; ?>"><?= $i; ?></a>
              </li>
          <?php endfor; ?>
          <li class="page-item">
            <a class="page-link" href="<?= $currentUrl?>&num=<?= $Next; ?>" aria-label="Next">Next</a>
          </li>
      </ul>
  </nav>
</div>

