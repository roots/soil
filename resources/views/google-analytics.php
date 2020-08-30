<?php // phpcs:disable ?>
<script>
  <?php if ($should_load) : ?>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
  <?php else : ?>
    (function(s,o,i,l){s.ga=function(){s.ga.q.push(arguments);if(o['log'])o.log(i+l.call(arguments))}
    s.ga.q=[];s.ga.l=+new Date;}(window,console,'Google Analytics: ',[].slice))
  <?php endif; ?>
  ga('create','<?= $google_analytics_id; ?>','auto');
  <?php if ($optimize_id) : ?>ga('require','<?= $optimize_id; ?>');<?php endif; ?>
  <?php if ($anonymize_ip) : ?>ga('set','anonymizeIp',true);<?php endif; ?>
  ga('set','transport','beacon');ga('send','pageview');
</script>
<?php if ($should_load) : ?>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
<?php endif; ?>
