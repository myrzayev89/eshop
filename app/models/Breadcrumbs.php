<?php

namespace app\models;

use core\App;

class Breadcrumbs extends AppModel
{
    public static function getBreadcrumbs($categoryId, $categoryTitle = ''): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $breadcrumbs_array = self::getParts($categories, $categoryId);
        $breadcrumbs = "<li class='breadcrumb-item'><a href='" . base_url() . "'>" . ___('tpl_home_breadcrumbs') . "</a></li>";
        if ($breadcrumbs_array) {
            foreach ($breadcrumbs_array as $slug => $title) {
                $breadcrumbs .= "<li class='breadcrumb-item'><a href='category/{$slug}'>{$title}</a></li>";
            }
        }
        if ($categoryTitle) {
            $breadcrumbs .= "<li class='breadcrumb-item active' aria-current='page'>{$categoryTitle}</li>";
        }
        return $breadcrumbs;
    }

    public static function getParts($categories, $id): array|false
    {
        if (!$id) {
            return false;
        }
        $breadcrumbs = [];
        foreach ($categories as $k => $v) {
            if (isset($categories[$id])) {
                $breadcrumbs[$categories[$id]['slug']] = $categories[$id]['title'];
                $id = $categories[$id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs, true);
    }
}