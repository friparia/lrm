<?php namespace Friparia\Lrm;
class LrmController extends \Controller{
    public function index(){
        $lrm = Lrm::getInstance();
        $routeCollection = $lrm->getRoutes();
        // dd($routeCollection);
        return \View::make('lrm::index')->with('routes', $routeCollection);

    }

    public function show($id){
        return \Response::json();
    }

    public function create(){
    }

    public function store(){
        $lrm = Lrm::getInstance();
        $lrm->addRoute(\Input::get('method'), \Input::get('uri'), \Input::get('action'));
        $lrm->save();
    }

    public function edit($id){
    }

    public function update($id){
    }

    public function destory($id){
    }
}
