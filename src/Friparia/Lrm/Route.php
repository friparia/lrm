<?php namespace Friparia\Lrm;
class Route extends \Illuminate\Routing\Route{

    private $uriStr;
    private $actionStr;
    private $methodStr;
    public function __construct($method, $uri, $action){
        $this->uriStr = $uri;
        $this->methodStr = $method;
        $this->actionStr = $action;
        parent::__construct($this->parseMethodStr($method), $this->parseUriStr($uri), $this->parseActionStr($action));
    }

    protected function parseUriStr($uriStr){
        return str_replace(array("'", '"'), "", $uriStr);
    }

    protected function parseActionStr($actionStr){
        if(FALSE == preg_match_all("/function.*\(.*\).*\{([\s\S]*)?\}/", $actionStr, $matches)){
            return $this->parseNonClosureActionStr($actionStr);
        }
        return function(){ eval($matches[1][0]); };

    }

    protected function parseNonClosureActionStr($actionStr){
        $action = array('uses' => str_replace(array("'", '"'), "", $actionStr));
        $action['controller'] = $action['uses'];
        $closure = function(){
        };
        return array_set($action, 'uses', $closure);
    }


    protected function parseMethodStr($methodStr){
        switch(strtolower($methodStr)){
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


    public function getUriStr(){
        return str_replace(array("'", '"'), "", $this->uriStr);
    }

    public function getActionStr(){
        if(!array_key_exists('controller', $this->getAction())){
            $this->actionStr = preg_replace("/^[\'\"]/", "", $this->actionStr);
            $this->actionStr = preg_replace("/^ */", "", $this->actionStr);
            return preg_replace("/[\'\"]$/", "", $this->actionStr);
        }
        return "'".str_replace(array("'", '"', ' '), "", $this->actionStr)."'";
    }

    public function getMethodStr(){
        return str_replace(array("'", '"'), "", $this->methodStr);
    }

    public function setUriStr($uri){
        $this->uriStr = $uri;
        return $this;
    }

    public function setActionStr($action){
        $this->actionStr = $action;
        return $this;
    }

    public function setMethodStr($method){
        $this->methodStr = $method;
        return $this;
    }
}
