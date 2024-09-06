<?php

namespace app\models\admin;

use RedBeanPHP\R;
use app\models\AppModel;
use core\App;

class Category extends AppModel
{
    public function category_validate(): bool
    {
        $errors = '';
        foreach ($_POST['category_description'] as $langId => $item) {
            $item['title'] = trim($item['title']);
            if (empty($item['title'])) {
                $errors .= "Bölmə adı boş qoyula bilməz! Tab #{$langId}<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function category_save(): bool
    {
        R::begin();
        try {
            // add category
            $langId = App::$app->getProperty('language')['id'];
            $category = R::dispense('categories');
            $category->parent_id = post('parent_id', 'i');
            $categoryId = R::store($category);
            $category->slug = AppModel::create_slug(
                'categories', 
                'slug',
                $_POST['category_description'][$langId]['title'],
                $categoryId,
            );
            R::store($category);

            // add category description
            foreach ($_POST['category_description'] as $langId => $item) {
                R::exec("INSERT INTO category_description (category_id, lang_id, title, excerpt, description, keywords) VALUES (?,?,?,?,?,?)", [
                    $categoryId,
                    $langId,
                    $item['title'],
                    $item['excerpt'],
                    $item['description'],
                    $item['keywords'],
                ]);
            }
            return R::commit();
        } catch (\Throwable $th) {
            R::rollback();
            throw $th;
            return false;
        }
    }

    public function delete_category($id): bool
    {
        R::begin();
        try {
            $children = R::count('categories', 'parent_id = ?', [$id]);
            $products = R::count('products', 'category_id = ?', [$id]);
            if ($children) {
                $_SESSION['errors'] = 'Kateqoriya aid alt kateqoriya var!';
                return false;
            }
            if ($products) {
                $_SESSION['errors'] = 'Kateqoriya aid məhsul var!';
                return false;
            }
            R::exec('DELETE FROM categories WHERE id = ?', [$id]);
            R::exec('DELETE FROM category_description WHERE category_id = ?', [$id]);
            return R::commit();
        } catch (\Throwable $th) {
            R::rollback();
            //throw $th;
            return false;
        }
    }
}