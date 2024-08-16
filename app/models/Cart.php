<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{
    public function get_product($id, $langId): array
    {
        return R::getRow("SELECT p.*, pd.* FROM products p JOIN product_description pd 
            ON p.id = pd.product_id WHERE p.status = 1 AND p.id = ? AND lang_id= ?", [$id, $langId]);
    }

    public function add_to_cart($product, $qty = 1)
    {
        $qty = abs($qty);

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product['id']] = [
                'img' => $product['img'],
                'title' => $product['title'],
                'slug' => $product['slug'],
                'qty' => $qty,
                'price' => $product['price'],
                'is_download' => $product['is_download'],
            ];
        }
        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum'])
            ? $_SESSION['cart.sum'] + $qty * $product['price']
            : $qty * $product['price'];
    }

    public function delete_item($id)
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $sum_minus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }

    public function clear_cart()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
    }

    public static function translate_cart($lang)
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }
        $ids = implode(',', array_keys($_SESSION['cart']));// 1,2,3
        $products = R::getAll("SELECT p.id, pd.title FROM products p JOIN product_description pd
            ON p.id = pd.product_id WHERE p.id IN ($ids) AND p.status = 1 AND pd.lang_id = ?", [$lang['id']]);

        foreach ($products as $product) {
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
    }
}