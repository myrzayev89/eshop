<?php

namespace app\models;

use RedBeanPHP\R;

class Wishlist extends AppModel
{
    public function get_product($id)
    {
        return R::getCell("SELECT id FROM products WHERE status = 1 AND id = ?", [$id]);
    }

    public function add_to_wishlist($id)
    {
        $wishlistIds = self::get_wishlist_ids();
        if (!$wishlistIds) {
            setcookie('wishlist', $id, time() + 60 * 60 * 24 * 30, '/');
        } else {
            if (!in_array($id, $wishlistIds)) {
                if (count($wishlistIds) > 5) {
                    array_shift($wishlistIds);
                }
                $wishlistIds[] = $id;
                $wishlistIds = implode(',', $wishlistIds);
                setcookie('wishlist', $wishlistIds, time() + 60 * 60 * 24 * 30, '/');
            }
        }
    }

    public static function get_wishlist_ids(): array
    {
        $wishlist = $_COOKIE['wishlist'] ?? '';
        if ($wishlist) {
            $wishlist = explode(',', $wishlist);
        }
        if (is_array($wishlist)) {
            $wishlist = array_slice($wishlist, 0, 4);
            $wishlist = array_map('intval', $wishlist);
            return $wishlist;
        }
        return [];
    }

    public function get_products($langId): array
    {
        $wishlistIds = self::get_wishlist_ids();
        if ($wishlistIds) {
            $wishlistIds = implode(',', $wishlistIds);
            return R::getAll("SELECT p.*, pd.* FROM  products p 
                JOIN product_description pd ON p.id = pd.product_id 
            WHERE p.status = 1 AND p.id IN ($wishlistIds) AND pd.lang_id = ? LIMIT 6", [$langId]);
        }
        return [];
    }

    public function delete_from_wishlist($id): bool
    {
        $wishlistIds = self::get_wishlist_ids();
        $key = array_search($id, $wishlistIds);
        if (false !== $key) {
            unset($wishlistIds[$key]);
            if ($wishlistIds) {
                $wishlistIds = implode(',', $wishlistIds);
                setcookie('wishlist', $wishlistIds, time() + 60 * 60 * 24 * 30, '/');
            } else {
                setcookie('wishlist', '', time() - 3600, '/');
            }
            return true;
        }
        return false;
    }
}