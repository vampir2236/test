<?php

namespace core;

class Redirect
{

    public static function locate($page)
    {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $page = trim($page, '/');
        header("Location: http://$host$uri/$page");
    }


    public static function error($message, $code = null)
    {
        $header = 'HTTP/1.1 500 Internal Server Error';
        $template = '500.tpl';

        switch ($code) {
            case 404:
                $header = 'HTTP/1.1 404 Not Found';
                $template = '404.tpl';
                break;
            default:
                break;
        }

        header($header);

        $controller = new \controllers\Error;
        $content = $controller->render($template, array('message' => $message));
        exit($controller->render('base.tpl', array('content' => $content)));
    }
}