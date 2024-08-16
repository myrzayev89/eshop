<?php

namespace app\models;

use RedBeanPHP\R;

class User extends AppModel
{
    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
    ];

    public array $rules = [
        'required' => ['email', 'password', 'name', 'address',],
        'email' => ['email',],
        'lengthMin' => [
            ['password', 6],
        ],
        'optional' => ['email', 'password'],
    ];

    public array $labels = [
        'emal' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input',
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function checkUnique($text_error = ''): bool
    {
        $user = R::findOne('users', 'email = ?', [$this->attributes['email']]);
        if ($user) {
            $this->errors['unique'][] = $text_error ?: ___('user_signup_error_email_unique');
            return false;
        }
        return true;
    }

    public function login($is_admin = false): bool
    {
        $email = post('email');
        $password = post('password');
        if ($email && $password) {
            if ($is_admin) {
                $user = R::findOne('users', "email = ? AND role = 'admin'", [$email]);
            } else {
                $user = R::findOne('users', "email = ?", [$email]);
            }

            if ($user) {
                if (password_verify($password, $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k != 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function get_count_orders($userId): int
    {
        return R::count('orders', 'user_id = ?', [$userId]);
    }

    public function get_user_orders($userId, $start, $perpage): array
    {
        return R::getAll("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT $start, $perpage", [$userId]);
    }

    public function get_user_order($orderId): array
    {
        return R::getAll("SELECT o.*, oi.* FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
        WHERE o.id = ?", [$orderId]);
    }

    public function get_count_files($userId): int
    {
        return R::count('order_downloads', 'user_id = ?', [$userId]);
    }

    public function get_user_files($userId, $start, $perpage, $langId): array
    {
        return R::getAll("SELECT od.*, d.*, dd.* FROM order_downloads od
            JOIN downloads d ON d.id = od.download_id
            JOIN download_description dd ON d.id = dd.download_id
        WHERE od.user_id = ? AND dd.lang_id = ? AND od.status = 1 LIMIT $start, $perpage", [$userId, $langId]);
    }

    public function get_user_file($userId, $downloadId, $langId): array
    {
        return R::getRow("SELECT od.*, d.*, dd.* FROM order_downloads od
            JOIN downloads d ON d.id = od.download_id
            JOIN download_description dd ON d.id = dd.download_id
        WHERE od.user_id = ? AND dd.download_id = ? AND dd.lang_id = ? AND od.status = 1", [$userId, $downloadId, $langId]);
    }
}