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

    public static function create_slug($table, $field, $str, $id): string
    {
        $str = self::str2url($str); // Salam Əhməd => salam-ehmed
        $res = R::findOne($table, "$field = ?", [$str]);
        if ($res) {
            $str = "{$str}-{$id}"; // salam-ehmed-5
            $res = R::count($table, "$field = ?", [$str]);
            if ($res) {
                $str = self::create_slug($table, $field, $str, $id);
            }
        }
        return $str;
    }

    public static function str2url($str): string
    {
        // cevirme islerini edirik
        $str = self::translit($str);
        // hamisini balaca heriflere deyisirik
        $str = strtolower($str);
        // lazim olmayanlari bunla "-" evez edirik
        $str = preg_replace('~[^-a-z0-9]+~u', '-', $str);
        // evvelde ve sonda olan '-' silirik
        $str = trim($str, "-");
        return $str;
    }

    public static function translit($string): string
    {
        $converter = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',

            'г' => 'g',
            'д' => 'd',
            'е' => 'e',

            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',

            'и' => 'i',
            'й' => 'y',
            'к' => 'k',

            'л' => 'l',
            'м' => 'm',
            'н' => 'n',

            'о' => 'o',
            'п' => 'p',
            'р' => 'r',

            'с' => 's',
            'т' => 't',
            'у' => 'u',

            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',

            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',

            'ь' => '\'',
            'ы' => 'y',
            'ъ' => '\'',

            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            'Ş' => 'S',
            'İ' => 'I',
            'Ç' => 'C',
            'Ü' => 'U',
            'Ö' => 'O',
            'Ğ' => 'G',
            'Ə' => 'E',
            'ş' => 's',
            'ı' => 'i',
            'ç' => 'c',
            'ü' => 'u',
            'ö' => 'o',
            'ğ' => 'g',
            'ə' => 'e',


            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',

            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',

            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',

            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',

            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',

            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',

            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',

            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',

            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',

            'Ь' => '\'',
            'Ы' => 'Y',
            'Ъ' => '\'',

            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',

        ];
        return strtr($string, $converter);
    }
}