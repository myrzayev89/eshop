<?php

namespace app\models;

use RedBeanPHP\R;
use core\App;

class Category extends AppModel
{
    public function get_category($slug, $langId): array
    {
        return R::getRow("SELECT c.*, cd.* FROM categories c
            JOIN category_description cd ON c.id = cd.category_id
        WHERE c.slug = ? AND cd.lang_id = ?", [$slug, $langId]);
    }

    public function getCategoryIds($categoryId): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_$lang");
        $ids = '';
        foreach ($categories as $k => $v) {
            if ($v['parent_id'] == $categoryId) {
                $ids .= $k . ',';
                $ids .= $this->getCategoryIds($k);
            }
        }
        return $ids;
    }

    public function get_products($categoryIds, $langId, $start, $perpage): array
    {
        $sort_values = [
            'title_asc' => 'ORDER BY title ASC',
            'title_desc' => 'ORDER BY title DESC',
            'price_asc' => 'ORDER BY price ASC',
            'price_desc' => 'ORDER BY price ASC',
        ];
        $orderBy = '';
        if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $sort_values)) {
            $orderBy = $sort_values[$_GET['sort']];
        }
        return R::getAll("SELECT p.*, pd.* FROM products p 
            JOIN product_description pd ON p.id = pd.product_id
        WHERE p.status = 1 AND p.category_id IN ($categoryIds) AND pd.lang_id = ? $orderBy LIMIT $start, $perpage", [$langId]);
    }

    public function get_count_products($categoryIds): int
    {
        return R::count('products', "category_id IN ($categoryIds) AND status = 1");
    }
}