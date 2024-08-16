<?php

use core\Language;

function debug($data, $die = false): void
{
    echo '<pre>' . print_r($data, true) . '</pre>';
    if ($die)
        die;
}

function h($str): string
{
    return htmlspecialchars($str);
}

function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    die;
}

function base_url()
{
    if (\core\App::$app->getProperty('lang')) {
        return PATH . '/' . \core\App::$app->getProperty('lang') . '/';
    } else {
        return PATH . '/';
    }
}

/**
 * @param $key Key of GET array
 * @param string $type Values 'i', 'f', 's'
 * @return int|float|string
 */
function get($key, $type = 'i')
{
    $param = $key;
    $$param = $_GET[$param] ?? '';
    $result = match ($type) {
        'i' => (int) $$param,
        'f' => (float) $$param,
        's' => trim($$param),
    };
    return $result;
}

/**
 * @param $key Key of POST array
 * @param string $type Values 'i', 'f', 's'
 * @return int|float|string
 */
function post($key, $type = 's')
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    $result = match ($type) {
        'i' => (int) $$param,
        'f' => (float) $$param,
        's' => trim($$param),
    };
    return $result;
}

function __($key)
{
    echo Language::get($key);
}

function ___($key)
{
    return Language::get($key);
}

function get_cart_icon($id)
{
    !empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])
        ? $icon = '<i class="fas fa-dolly-flatbed"></i>'
        : $icon = '<i class="fas fa-shopping-cart"></i>';
    return $icon;
}

function get_field_value($name)
{
    return isset($_SESSION['form_data'][$name]) ? $_SESSION['form_data'][$name] : '';
}
