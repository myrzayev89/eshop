<?php

namespace app\models;

use core\Model;
use core\App;
use Valitron\Validator;
use RedBeanPHP\R;

class AppModel extends Model
{
    public function load($post = true)
    {
        $data = $post ? $_POST : $_GET;
        foreach ($this->attributes as $key => $value) {
            if (isset($data[$key])) {
                $this->attributes[$key] = $data[$key];
            }
        }
    }

    public function validate($data): bool
    {
        $lang = App::$app->getProperty('language')['code'];
        Validator::langDir(APP.'/languages/validator/lang');
        Validator::lang($lang);
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors(): void
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }

    public function getLabels(): array
    {
        $labels = [];
        foreach ($this->labels as $key => $value) {
            $labels[$key] = ___($value);
        }
        return $labels;
    }

    public function save($table): int|string
    {
        $tpl = R::dispense($table);
        foreach ($this->attributes as $key => $value) {
            $tpl->$key = $value;
        }
        return R::store($tpl);
    }

    public function update($table, $id): int|string
    {
        $tpl = R::load($table, $id);
        foreach ($this->attributes as $key => $value) {
            if ($value != '') {
                $tpl->$key = $value;
            }
        }
        return R::store($tpl);
    }
}