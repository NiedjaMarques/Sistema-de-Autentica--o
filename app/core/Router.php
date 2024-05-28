<?php
    require_once __DIR__ . '..\..\config\Config.php'; //arquivo com a função de errorHttp, encaminha para pagina personalizada de erros
    
    class Router {
        private $routes = [];

        public function add($route, $action){
            $this->routes[$route] = $action; //router é p caminho da url e action é a ação a ser executada (Controller@method = classe e metodo)
        }

        public function dispatch($uri){ //processa a url recebida e direcina para  a ação correta
            $uri = parse_url($uri, PHP_URL_PATH);

            if(array_key_exists($uri, $this->routes)){ //verificando se a rota existe no array
                list($controller, $method) = explode('@', $this->routes[$uri]); //(Controller@method = classe e metodo)

                if (class_exists($controller) && method_exists($controller, $method)){ //verifica se a classe e o metodo existem
                    $controllerInstance = new $controller(); //se for true, cria uma instancia do controlador e chama o metodo correspondente 
                    $controllerInstance->$method();
                }else{
                    Config::errorHttp(404, 'Página não encontrada'); //se for false chama o errorHttp de config com a mensage de erro
                }

            }else{
                Config::errorHttp(404, 'Página não encontrada'); //se a rota não existir no array, tamebm retonra um erro
            }
        }
    }
?>