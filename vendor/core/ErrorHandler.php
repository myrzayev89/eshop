<?php

namespace core;

use Throwable;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']); // Fərdi istisna işləyicisini təyin edir
        set_error_handler([$this, 'errorHandler']); // Fərdi səhv idarəedicisini təyin edir
        ob_start(); // Çıxış buferini aktivləşdirir
        register_shutdown_function([$this, 'fatalErrorHandler']); // Skript başa çatdıqda yerinə yetiriləcək funksiyanı qeyd edir
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & 
            (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
                $this->logError($error['message'], $error['file'], $error['line']);
                ob_end_clean();
                $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler(Throwable $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('İstisna', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logError($message = '', $file = '', $line = '')
    {
        file_put_contents(
            LOGS . '/errors.log',
            "[" . date('d.m.Y H:i:s') . "] Xəta: {$message} | Fayl: {$file} | Xətt: {$line}\n=====================\n",
            FILE_APPEND
        );
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $errcode = 500)
    {
        if ($errcode == 0) {
            $errcode = 404;
        }
        http_response_code($errcode);
        if ($errcode == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require_once WWW . '/errors/development.php';
        } else {
            require_once WWW . '/errors/production.php';
        }
        die;
    }
}
