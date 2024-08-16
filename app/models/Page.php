<?php

namespace app\models;

use RedBeanPHP\R;

class Page extends AppModel
{
    public function get_page($slug, $langId): array
    {
        return R::getRow("SELECT p.*, pd.* FROM pages p 
            JOIN pages_description pd ON p.id = pd.page_id 
        WHERE p.slug = ? AND pd.lang_id = ?", [$slug, $langId]);
    }
}