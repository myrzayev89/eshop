<?php

namespace  app\controllers;

use app\models\Cart;
use core\App;

class LanguageController extends AppController
{
    public function changeAction()
    {
        $lang = get('lang', 's');
        if ($lang) {
            if (array_key_exists($lang, App::$app->getProperty('languages'))) {
                // esas url (PATH) silirik
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');
                
                // explode ile 2 hisseye boluruk
                $url_parts = explode('/', $url, 2);

                // birinci hissedeki dili axtaririq massivde
                if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
                    // birinci hisseye yeni dili menimsedirik eger esas dil deyilse
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        // eger esas dildirse - urlden silirik
                        array_shift($url_parts);
                    }
                } else {
                    // birinci hisseye yeni dili menimsedirik eger esas dil deyilse
                    if ($lang != App::$app->getProperty('language')['code']) {
                        array_unshift($url_parts, $lang);
                    }
                }

                Cart::translate_cart(App::$app->getProperty('languages')[$lang]);
                
                $url = PATH . '/' . implode('/', $url_parts);
                // var_dump('http://myshop.loc/en/product/apple');
                // var_dump($url); die;
                redirect($url);
            }
        }
        redirect();
    }
}