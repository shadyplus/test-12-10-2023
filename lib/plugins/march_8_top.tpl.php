<link rel="stylesheet" href="shared/plugins/march_8/style.css">

<div class="march_8__container">
    <span class="march_8__close">x</span>

    <div class="march_8__content">
        <div class='march_8__content__variant_1'>
            Распродажа к 8 марта!
        </div>
        <div class='march_8__content__variant_2' style="display: none;">
            Распродажа для милых дам!
        </div>
    </div>
</div>
<script>
    let random_int = Math.floor(Math.random() * 2);

    let content_variant_1 = document.querySelector('.march_8__content__variant_1');
    let content_variant_2 = document.querySelector('.march_8__content__variant_2');

    if (random_int) {
        content_variant_1.style = 'display: none;'
        content_variant_2.style = 'display: block; font-size: 40px;'
    }
</script>
<script src="shared/plugins/march_8/script.js"></script>
