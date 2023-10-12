<link rel="stylesheet" type="text/css" href="shared/plugins/christmas_sale_eng/index.css">

<div class="christmas-sale-banner">
    <div class="christmas-sale-banner__container">
        <p class="christmas-sale-banner_text">Christmas Sale</p>
    </div>
</div>

<script>
    let image_elem = document.querySelector('.christmas-sale-banner');

    document.addEventListener('DOMContentLoaded', () => {
        document.body.setAttribute('style', `margin-top: ${image_elem.clientHeight}px !important`);
        console.log('set style');
    });

    document.body.onresize = () => {
        document.body.setAttribute('style', `margin-top: ${image_elem.clientHeight}px !important`);
    };
</script>
