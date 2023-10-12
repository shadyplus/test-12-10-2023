<!-- BIGO Ads pixel -->
<script>
    window.bgdataLayer = window.bgdataLayer || [];
    function bge(){bgdataLayer.push(arguments);}
    bge('init', '<?= $pixel_id ?>');
    <?php if (!$lead): ?>
    bge('event', 'page_view');
    <?php else: ?>
    bge('event', 'ec_purchase');
    <?php endif ?>
</script>
<script async src="https://api.imotech.video/ad/events.js?pixel_id=<?= $pixel_id ?>"></script>
<!-- /BIGO Ads pixel -->
