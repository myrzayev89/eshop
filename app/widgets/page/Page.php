<?php

namespace app\widgets\page;

use RedBeanPHP\R;
use core\App;
use core\Cache;

class Page
{
    protected $language;
    protected $container = 'ul';
    protected $class = 'page';
    protected $cache = 3600;
    protected $cacheKey = 'eshop_page';
    protected $menuPageHtml;
    protected $prepend = '';
    protected $data;

    public function __construct($options = [])
    {
        $this->language = App::$app->getProperty('language');
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
        $this->menuPageHtml = $cache->get("{$this->cacheKey}_{$this->language['code']}");
        if (!$this->menuPageHtml) {
            $this->data = R::getAssoc("SELECT p.*, pd.* FROM pages p
                    JOIN pages_description pd ON p.id = pd.page_id
                WHERE pd.lang_id = ?", [$this->language['id']]);
            $this->menuPageHtml = $this->getMenuPageHtml();
            if ($this->cache) {
                $cache->set("{$this->cacheKey}_{$this->language['code']}", $this->menuPageHtml, $this->cache);
            }
        }
        $this->output();
    }

    protected function getMenuPageHtml()
    {
        $html = '';
        foreach ($this->data as $k => $v) {
            $html .= "<li><a href='page/{$v['slug']}'>{$v['title']}</a></li>";
        }
        return $html;
    }

    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->prepend;
        echo $this->menuPageHtml;
        echo "</{$this->container}>";
    }
}