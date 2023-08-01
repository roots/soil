<?php // phpcs:disable ?>

<?php if (!$should_load) return; ?>

<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $google_analytics_id; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?= $google_analytics_id; ?>');

  <?php foreach ($tags as $tag) : ?>
    <?php if (!empty($tag[2])) : ?>
      gtag(<?= $tag[0] ?>, <?= $tag[1] ?>, <?= $tag[2] ?>);
    <?php else : ?>
      gtag(<?= $tag[0] ?>, <?= $tag[1] ?>);
    <?php endif; ?>
  <?php endforeach; ?>
</script>
