<?php namespace Friparia\Lrm\Controllers;
use \Illuminate\Routing\Controllers\Controller;
class LrmController extends \Controller{
    public function index(){
        $routeCollection = \Route::getRoutes();
        return \View::make('lrm::index')->with('routes', $routeCollection);

    }

    public function show($id){
    }

    public function create(){
    }

    public function store(){
        // $route = new \Route(Input::get('method'), Input::get('uri'), function(){
        //     return Input::get('action');
        // });
        Lrm::storeRoute(\Input::get('method'), \Input::get('uri'), \Input::get('action'));

    }

    public function edit($id){
    }

    public function update($id){
    }

    public function destory($id){
    }
}
