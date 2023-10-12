<?php
$dir = __DIR__;

require($dir.'/config.php');

$offers = json_decode($dataOffers, true);
$offer = json_decode($dataOffer, true);

$GLOBALS['offers'] = $offers;
$GLOBALS['offer'] = $offer;

$newPrice = 5999;
$oldPrice = 11998;
$currencyDisplay = 'DA';

require('lib/app.php');

$dbg_mod = is_debug($_debug, True);

$ip_address = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
if ( $is_geo_detect ) {
    $offer = get_offer_by_ip($ip_address, $offers, $offer);
}

$countryDetect = $offer['country']['code'];
$currencyDisplay = $offer['currency']['name'];
$newPrice = $offer['price'];
$oldPrice = $offer['price2'];

$newPriceHtml = '<x-newprice>' . $newPrice . '</x-newprice>';
$oldPriceHtml = '<x-oldprice>' . $oldPrice. '</x-oldprice>';
$currencyDisplayHtml = '<x-currency>'. $currencyDisplay .'</x-currency>';

$newPrice = $newPriceHtml;
$oldPrice = $oldPriceHtml;

$renderCallback = new BeforeRenderCallback([], getcwd());

$data_get = $_GET;
if (isset($formFields)) {
    $data_get['formFields'] = urlencode(json_encode($formFields));
}

$render_context = [
    'dir' => $dir,
    'pixels' => $pixels,
    'offer' => $offer,
    'offers' => $offers,
    'push_link' => $push_link,
    'language' => $language,
    'fb_verify' => $fb_verification,
];

$js_injector = new JsInjector($data_get, $render_context);

$renderCallback->addCallback($js_injector);

$file_translate = __DIR__.'/invoice2/languages/'. $language . '.php';
if (!file_exists($file_translate)) {
    $file_translate = __DIR__.'/invoice2/languages/ru.php';
}
require_once($file_translate);

if (!checkPluginsConflict($plugins) && isPluginsExist($plugins)) {
    $pluginPrices = [
        'newPrice' => $offer['price'],
        'oldPrice' => $offer['price2'],
        'promoPrice'=> get_promo_price($offer['price'], $offer['price2']),
        'currency' => $currencyDisplay,
        'client_city' => '',
    ];
    injectPlugins($renderCallback, $plugins, $pluginPrices);
}

ob_start();

register_shutdown_function(function() use($renderCallback) {
    $renderCallback->prepare();
    $content = $renderCallback(ob_get_clean(), 0);
    echo $content;
});
