<?php

namespace classes;


abstract class Controller
{
    protected $model;
    protected static $twig = [];

    public function __construct()
    {
        self::init();
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    }

    public static function error404()
    {
        self::init();
        header('HTTP/1.0 404 Not Found');
        echo self::$twig[0]->render(
            "404.html.twig"
        );
    }

    protected static function init()
    {
        $loader = new \Twig_Loader_Filesystem(APP_VIEWS_DIR);
        $twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
        self::$twig[0] = $twig;
    }
}