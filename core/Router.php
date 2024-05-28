<?php  
    require_once __DIR__ . '/erroHttp.php';

    class Router {
        private $routes = [];

        public function add($route, $action){
            $this->routes[$route] = $action; 
        }

        public function dispatch($uri){ 

            if(array_key_exists($uri, $this->routes)){ 
                list($controller, $method) = explode('@', $this->routes[$uri]); 

                if (class_exists($controller) && method_exists($controller, $method)){ 

                    $controllerInstance = new $controller(); 
                    $controllerInstance->$method();
                }else{
                    showErro::errorHttp(500, "Internal Server Error");
                    exit();
                }

            }else{
                showErro::errorHttp(500, "Internal Server Error");
                exit();
            }
        }
    }
?>