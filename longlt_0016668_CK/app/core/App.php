<?php
class App {
    public function __construct() {
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        $segments = $url ? explode('/', $url) : [];

        $controller = 'auth';
        $action     = 'login';
        $params     = [];

        if (!empty($segments[0])) {
            $ctrlFile = __DIR__ . '/../controllers/' . $segments[0] . '.php';
            if (file_exists($ctrlFile)) {
                $controller = $segments[0];
                if (!empty($segments[1])) {
                    $action = $segments[1];
                    $params = array_slice($segments, 2);
                } else {
                    $action = 'index';
                }
            }
        }

        require_once __DIR__ . '/../controllers/' . $controller . '.php';
        $obj = new $controller();

        if (!method_exists($obj, $action)) {
            $action = 'index';
        }

        call_user_func_array([$obj, $action], $params);
    }
}