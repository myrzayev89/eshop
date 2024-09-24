<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
use core\App;
use core\Pagination;

/** @property Product $model */
class ProductController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page', 's');
        $perpage = App::$app->getProperty('pagination');
        $total = R::count('products');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products($lang['id'], $start, $perpage);
        $this->setMeta('Mallar');
        $this->set(compact('products', 'pagination'));
    }

    public function createAction()
    {
        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->save_product() ) {
                    $_SESSION['success'] = 'Mal əlavə edildi';
                } else {
                    $_SESSION['errors'] = 'Xəta baş verdi!';
                }
                redirect();
            }
        }
        $this->setMeta('Yeni Mal');
    }

    public function getDownloadAction()
    {
        // $data = [
        //     'items' => [
        //         [
        //             'id' => 1,
        //             'text' => 'Fayl',
        //         ],
        //         [
        //             'id' => 2,
        //             'text' => 'File',
        //         ],
        //     ]
        // ];
        $q = get('q', 's');
        $downloads = $this->model->get_downloads($q);
        echo json_encode($downloads);
        die;
    }
}