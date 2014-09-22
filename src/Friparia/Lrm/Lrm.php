<?php namespace Friparia\Lrm\Controllers;
class Lrm {
    public static function storeRoute($method, $uri, $action){
        $routeFile = __DIR__."/../../routes_add.php";
        $output = "Route::".$method."('".$uri."', '".$action."');\n";
        if(file_exists($routeFile)){
            $fs = fopen($routeFile, 'a');
            if($fs){
                fwrite($fs, $output);
                fclose($fs);
            }
            return \Redirect::to('lrm');
        }
        else{
            dd("wrong!");
        }

    }

}
