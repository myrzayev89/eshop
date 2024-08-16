<?php

namespace app\widgets\services;

use RedBeanPHP\R;
use core\App;
use core\Cache;

class Service
{
    protected $data;
    protected $tpl;
    protected $serviceHtml;
    protected $cache = 3600;
    protected $cacheKey = 'service_key';
    protected $language;

    public function __construct($options = [])
    {
        $this->language = App::$app->getProperty('language');
        $this->tpl = __DIR__ . '/service_tpl.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::getInstance();
        $this->data = $cache->get("{$this->cacheKey}_{$this->language['code']}");
        if (!$this->data) {
            $this->data = R::getAssoc("SELECT oa.* FROM our_advantages oa
                    WHERE oa.lang_id = ?", [$this->language['id']]);
            if ($this->cache) {
                $cache->set("{$this->cacheKey}_{$this->language['code']}", $this->data, $this->cache);
            }
        }
        echo $this->getHtml();
    }

    protected function getHtml(): string
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}