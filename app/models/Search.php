<?php

namespace app\models;

use RedBeanPHP\R;

class Search extends AppModel
{
    public function get_find_count_products($query, $langId)
    {
        return R::getCell("SELECT COUNT(*) FROM products p
            JOIN product_description pd ON p.id = pd.product_id
        WHERE p.status = 1 AND pd.lang_id = ? AND pd.title LIKE ?", [$langId, "%{$query}%"]);
    }

    public function get_find_products($query, $langId, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.* FROM products p
            JOIN product_description pd ON p.id = pd.product_id
        WHERE p.status = 1 AND pd.lang_id = ? AND pd.title LIKE ? LIMIT $start, $perpage", [$langId, "%{$query}%"]);
    }
}