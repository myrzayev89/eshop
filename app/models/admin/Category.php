<?php

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;

class Category extends AppModel
{
    public function delete_category($id): bool
    {
        R::begin();
        try {
            $children = R::count('categories', 'parent_id = ?', [$id]);
            $products = R::count('products', 'category_id = ?', [$id]);
            if ($children) {
                $_SESSION['errors'] = 'Kateqoriya aid alt kateqoriya var!';
                return false;
            }
            if ($products) {
                $_SESSION['errors'] = 'Kateqoriya aid məhsul var!';
                return false;
            }
            R::exec('DELETE FROM categories WHERE id = ?', [$id]);
            R::exec('DELETE FROM category_description WHERE category_id = ?', [$id]);
            return R::commit();
        } catch (\Throwable $th) {
            R::rollback();
            //throw $th;
            return false;
        }
    }
}