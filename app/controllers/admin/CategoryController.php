<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
class CategoryController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Kateqoriyalar');
    }

    public function deleteAction()
    {
        $id = get('id');
        $errors = '';
        $children = R::count('categories', 'parent_id = ?', [$id]);
        $products = R::count('products', 'category_id = ?', [$id]);

        if ($children) {
            $errors .= 'Kateqoriya aid alt kateqoriya var!';
        }
        if ($products) {
            $errors .= 'Kateqoriya aid məhsul var!';
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
        } else {
            R::exec('DELETE FROM categories WHERE id = ?', [$id]);
            R::exec('DELETE FROM category_description WHERE category_id = ?', [$id]);
            $_SESSION['success'] = 'Kateqoriya silindi';
        }
        redirect();
    }
}