<?php

namespace MgahedMvc\View;

use http\Params;

class View
{
    public static function make($view, $params = [])
    {
        $baseContent = self::getBaseContent();
        $viewContent = self::getViewContent($view, $params);

        echo str_replace('{{content}}', $viewContent, $baseContent);
    }

    public static function getBaseContent()
    {
        ob_start();
        include base_path() . 'views/layouts/main.php';
        return ob_get_clean();
    }

    public static function makeError($error)
    {
        self::getViewContent($error, [], true);
    }

    public static function getViewContent($view, $params = [], $isError = false)
    {
        $path = $isError ? view_path('errors/') : view_path();

        if (str_contains($view, '.')) {
            $views = explode('.', $view);
            foreach ($views as $view) {
                if (is_dir($path . $view)) {
                    $path .= $view . '/';
                } else {
                    $path .= $view . '.php';
                }
            }
            $view = $path;
        } else {
            $view = $path . $view . '.php';
        }

        foreach ($params as $param => $value) {
            $$param = $value;
        }

        if ($isError) {
            include $view;
        } else {
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }
}