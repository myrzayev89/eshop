<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
class MainController extends AppController
{
    public function indexAction()
    {
        $orders = R::count('orders');
        $new_orders = R::count('orders', 'status = 0');
        $users = R::count('users');
        $products = R::count('products');
        $this->set(compact('orders', 'new_orders', 'users', 'products'));
        $this->setMeta('Əsas');
    }
}