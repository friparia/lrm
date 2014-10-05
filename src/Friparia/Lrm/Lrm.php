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
            $routeCollection[$i] = new Route($pregMatches[1][$i], $pregMatches[2][$i], $pregMatches[3][$i]);
        }
        return $routeCollection;
    }

    public function addRoute($method, $uri, $action){
        $this->routeCollection[] = new Route($method, $uri, $action);
    }

    public function updateRoute($method, $uri, $action, $id){
        $this->routeCollection[$id] = new Route($method, $uri, $action);
    }

    public function deleteRoute($id){
        unset($this->routeCollection[$id]);
    }

    public function save(){
        $contents = "<?php\n";
        foreach($this->routeCollection as $route){
            $contents .="Route::".strtolower($route->getMethodStr())."('".$route->getUriStr()."', ".$route->getActionStr().");\n";
        }
        file_put_contents(app_path()."/routes.php", $contents);
    }
        
}
