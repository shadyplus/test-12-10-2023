<?php

class PluginsInjector {

    public $template = 'plugins.tpl.php';

    private $topBanners = [
        'black_friday_eng_top',
        'black_friday_ru_top',
        'christmas_sale_eng_top',
        'christmas_sale_ru_top',
        'corona_delivery_eng_top',
        'corona_delivery_top',
        'online_visitors_top',
        'sale_11_ru_top'
    ];

    public function __construct($params)
    {
        $this->params = $params;
        $this->isUsingTopBanner = !empty(array_intersect(
            array_keys($params['plugins']),
            $this->topBanners
        ));
    }
    
    public function __invoke($content, $cwd) {        
        return str_replace('</body>',  $this->code . '</body>', $content);
    }
    
    public function prepare() {        
        $this->code = $this->render();
    }

    private function render() {        
        ob_start();
        $params = $this->params;          
        $productPrice = $params['newPrice'];
        $productPriceOld = $params['oldPrice'];
        $productPricePromo = $params['promoPrice'];
        $productCurrency = $params['currency'];
        $client_city = $params['client_city'];
        $isUsingTopBanner = $this->isUsingTopBanner;

        $country_info = countrySelect();
        $country_info = str_replace("\n", "", $country_info);
        $country_info = str_replace("'", '"', $country_info);
        $country_info = preg_replace('/\s{2,}/', ' ', $country_info);
        
        require($this->template);
        $code = ob_get_clean();
        return $code;
    }
}
