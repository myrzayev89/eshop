<?php

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;
use core\App;

class Product extends AppModel
{
    public function get_products($langId, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.title FROM products p
            JOIN product_description pd ON p.id = pd.product_id
        WHERE pd.lang_id = ? LIMIT $start, $perpage", [$langId]);
    }

    public function get_downloads($query): array 
    {
        $data = [];
        $downloads = R::getAssoc("SELECT download_id, name FROM download_description
            WHERE name LIKE ? LIMIT 10", ["%{$query}%"]);
        if ($downloads) {
            $i = 0;
            foreach ($downloads as $id => $title) {
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        return $data;
    }

    public function product_validate(): bool
    {
        $errors = '';
        if (!is_numeric(post('price'))) {
            $errors .= "Qiymət rəqəm olmalıdır!<br>";
        }
        if (!is_numeric(post('old_price'))) {
            $errors .= "Köhnə qiymət rəqəm olmalıdır!<br>";
        }

        foreach ($_POST['product_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            $item['excerpt'] = trim($item['excerpt']);
            if (empty($item['title'])) {
                $errors .= "Malın adı boş qoyula bilməz! Tab #{$lang_id}<br>";
            }
            if (empty($item['excerpt'])) {
                $errors .= "Qısa açıqlama boş qoyula bilməz! Tab #{$lang_id}<br>";
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function save_product(): bool
    {
        $lang = App::$app->getProperty('language')['id'];
        R::begin();
        try {
            // product
            $product = R::dispense('products');
            $product->category_id = post('parent_id', 'i');
            $product->price = post('price', 'f');
            $product->old_price = post('old_price', 'f');
            $product->hit = post('hit') ? 1 : 0;
            $product->img = post('img') ?: NO_IMAGE;
            $product->is_download = post('is_download') ? 1 : 0;
            $product_id = R::store($product);

            // create slug
            $product->slug = AppModel::create_slug('products', 'slug', $_POST['product_description'][$lang]['title'], $product_id);
            R::store($product);

            // product_description
            foreach ($_POST['product_description'] as $lang_id => $item) {
                R::exec("INSERT INTO product_description (product_id, lang_id, title, excerpt, content, description, keywords) VALUES (?,?,?,?,?,?,?)", [
                    $product_id,
                    $lang_id,
                    $item['title'],
                    $item['excerpt'],
                    $item['content'],
                    $item['description'],
                    $item['keywords'],
                ]);
            }

            // product_gallery if exists
            if (isset($_POST['gallery']) && is_array($_POST['gallery'])) {
                $sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
                foreach ($_POST['gallery'] as $item) {
                    $sql .= "($product_id, ?),";
                }
                $sql = rtrim($sql, ',');
                R::exec($sql, $_POST['gallery']);
            }

            // product_download if is_download
            if ($product->is_download) {
                $download_id = post('is_download', 'i');
                R::exec("INSERT INTO product_download (product_id, download_id) VALUES (?,?)", [$product_id, $download_id]);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            debug($e, true);
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }
}
