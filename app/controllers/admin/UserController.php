<?php

namespace app\controllers\admin;
use app\models\admin\User;

/** @property User $model */
class UserController extends AppController
{
    public function loginAdminAction()
    {
        if (User::isAdmin()) {
            redirect(ADMIN);
        }

        $this->layout = 'admin/login';

        if (!empty($_POST)) {
            if ($this->model->login(true)) {
                redirect(ADMIN);
            } else {
                $_SESSION['errors'] = 'Email və ya şirə yanlışdır!';
                redirect();
            }
        }
    }

    public function logoutAction()
    {
        if (User::isAdmin()) {
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');
    }
}