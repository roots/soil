<?php // phpcs:disable ?>
<script>
  <?php if ($should_load) : ?>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
  <?php else : ?>
    (function(s,o,i,l){s.gtag=function(){s.gtag.q.push(arguments);if(o['log'])o.log(i+l.call(arguments))}
    s.gtag.q=[];}(window,console,'Google Analytics: ',[].slice))
  <?php endif; ?>
  gtag('js', new Date());
  gtag('config', '<?= $google_analytics_id; ?>', {"transport_type":"beacon"});
  gtag('event', 'page_view', { 'send_to': '<?= $google_analytics_id; ?>' });
</script>
<?php if ($should_load) : ?>
  <script async defer src="https://www.googletagmanager.com/gtag/js?id=<?= $google_analytics_id; ?>"></script>
<?php endif; ?>
