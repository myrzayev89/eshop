<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
use app\models\admin\Category;

/** @property Category $model */
class CategoryController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Kateqoriyalar');
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            if ($this->model->category_validate()) {
                if ($this->model->category_save()) {
                    $_SESSION['success'] = 'Kateqoriya əlavə edildi';
                } else {
                    $_SESSION['errors'] = 'Xəta baş verdi!';
                }
            }
            redirect();
        }
        $this->setMeta('Yeni Kateqoriya');
    }

    public function deleteAction()
    {
        $categoryId = get('id');
        $result = $this->model->delete_category($categoryId);
        if ($result) {
            $_SESSION['success'] = 'Kateqoriya silindi';
        }
        redirect();
    }
}