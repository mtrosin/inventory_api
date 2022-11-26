<?php
header('Content-Type: application/json');

require_once '../vendor/autoload.php';

// api/users/1
if ($_SERVER['REQUEST_URI']) {
    $url = explode('/', $_SERVER['REQUEST_URI']);
    array_shift($url);

    if ($url[0] === 'api') {
        array_shift($url);

        $service = 'App\Services\\'.ucfirst($url[0]).'Service';
        array_shift($url);

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if(class_exists($service)) {
            try {
                $response = call_user_func_array(array(new $service, $method), $url);
    
                http_response_code($response['status']);
                echo json_encode($response['data']);
            } catch(\Exception $e) {
                http_response_code(404);
                echo json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(404);
            echo json_encode('The provided endpoint doesn\'t exists.', JSON_UNESCAPED_UNICODE);
        }
    }
}
