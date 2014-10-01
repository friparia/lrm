<?php namespace Friparia\Lrm;
class Lrm {

    private static $_instance;
    private $routeCollection = array();

    protected function __construct(){
        $this->routeCollection = $this->parseRouteFile(app_path()."/routes.php");
    }

    public static function getInstance(){
        if(FALSE == (self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getRoutes(){
        return $this->routeCollection;
    }

    protected function parseRouteFile($routeFilename){
        $routesStr = file_get_contents($routeFilename);
    if(FALSE == preg_match_all("/Route::(.*?)\((.*),([\s\S]*?)\);/", $routesStr, $matches)){
            dd("invalid file");
        }
        return $this->parseRoute($matches);
    }

    protected function parseRoute($pregMatches){
        $routesNum = sizeof($pregMatches[0]);
        for($i = 0; $i != $routesNum; $i++){
            $routeCollection[$i] = new \Illuminate\Routing\Route($this->parseMethod($pregMatches[1][$i]), $this->parseUri($pregMatches[2][$i]), $this->parseAction($pregMatches[3][$i]));
        }
        return $routeCollection;
    }

    protected function parseUri($uriStr){
        return str_replace(array("'", '"'), "", $uriStr);
    }

    protected function parseAction($actionStr){
        if(FALSE == preg_match_all("/function.*\(.*\).*\{([\s\S]*)?\}/", $actionStr, $matches)){
            return $this->parseNonClosureActionStr($actionStr);
        }
        return function(){ eval($matches[1][0]); };

    }

    protected function parseMethod($methodStr){
        switch($methodStr){
            case 'get':
                return array('GET', 'HEAD');
            case 'post':
                return 'POST';
            case 'put':
                return 'PUT';
            case 'patch':
                return 'PATCH';
            case 'delete':
                return 'DELETE';
        };
    }

    protected function parseNonClosureActionStr($actionStr){
        $action = array('uses' => str_replace(array("'", '"'), "", $actionStr));
        $action['controller'] = $action['uses'];
        $closure = function(){
        };
        return array_set($action, 'uses', $closure);
    }

    public function addRoute($method, $uri, $action){
        $this->routeCollection[] = new \Illuminate\Routing\Route($this->parseMethod($method), $this->parseUri($uri), $this->parseAction($action));
    }

    public function updateRoute($method, $uri, $action, $id){
        $this->routeCollection[$id] = new \Illuminate\Routing\Route($this->parseMethod($method), $this->parseUri($uri), $this->parseAction($action));
    }

    public function deleteRoute($id){
    }
    public function save(){
        $contents = "<?php\n";
        foreach($this->routeCollection as $route){
            $contents .="Route::".strtolower($route->getMethods()[0])."('".$route->getPath()."', ".$route->getActionName().")\n";
        }
    }
        
}
