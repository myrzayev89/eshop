<?php

namespace app\models;

use RedBeanPHP\R;
class Main extends AppModel
{
    public function getHits($langId, $limit): array
    {
        return R::getAll("SELECT p.*, pd.* FROM products p JOIN product_description pd 
        ON p.id = pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.lang_id = ? LIMIT $limit", [$langId]);
    }
}