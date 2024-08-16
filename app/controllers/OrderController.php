<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;

class OrderController extends AppController
{
    public function viewAction()
    {
        if (empty($_SESSION['cart'])) {
            redirect(base_url());
        }
        $this->setMeta(___('tpl_cart_title'));
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            // add user if not auth
            if (!User::checkAuth()) {
                $user = new User();
                $user->load();
                if (!$user->validate($user->attributes) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $user->attributes;
                    redirect();
                } else {
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                    if (!$user_id = $user->save('users')) {
                        $_SESSION['errors'] = ___('tpl_order_error_register');
                        redirect();
                    }
                }
            }

            // add orders
            $data['user_id'] = $_SESSION['user']['id'] ?? $user_id;
            $data['note'] = post('note');
            $user_email = $_SESSION['user']['email'] ?? post('email');

            if (!$order_id = Order::saveOrder($data)) {
                $_SESSION['errors'] = ___('tpl_order_error_save');
            } else {
                $res = Order::sendMail($order_id, $user_email, 'order_user');
                if ($res) {
                    unset($_SESSION['cart']);
                    unset($_SESSION['cart.qty']);
                    unset($_SESSION['cart.sum']);
                    $_SESSION['success'] = ___('tpl_order_success');
                } else {
                    $_SESSION['errors'] = ___('tpl_order_error_save');
                }
            }
        }
        redirect();
    }
}