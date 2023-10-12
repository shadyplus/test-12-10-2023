<?php

class Sale11RuTopInjector {

    public $template = 'sale_11_ru_top.tpl.php';

    public function __construct($params) {
        $this->params = $params;
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
        require($this->template);
        $code = ob_get_clean();
        return $code;
    }
}