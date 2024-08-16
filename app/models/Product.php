<?php

namespace app\models;

use RedBeanPHP\R;

class Product extends AppModel
{
    public function get_product($slug, $langId): array
    {
        return R::getRow("SELECT p.*, pd.* FROM products p
            JOIN product_description pd ON p.id = pd.product_id
        WHERE p.status = 1 AND p.slug = ? AND pd.lang_id = ?", [$slug, $langId]);
    }

    public function get_galery($productId): array
    {
        return R::getAll("SELECT * FROM product_gallery WHERE product_id = ?", [$productId]);
    }
}