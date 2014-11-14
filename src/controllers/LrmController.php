<?php namespace Friparia\Lrm;
class LrmController extends \Controller{
    public function destory($id){
        $lrm = Lrm::getInstance();
        $lrm->deleteRoute($id);
        $lrm->save();
        return \Response::json();
    }

    public function index(){
        $lrm = Lrm::getInstance();
        $routeCollection = $lrm->getRoutes();
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
        return \Redirect::to("lrm");
    }

    public function edit($id){
    }

    public function update($id){
        $lrm = Lrm::getInstance();
        $lrm->updateRoute(\Input::get('method'), \Input::get('uri'), \Input::get('action'), $id);
        $lrm->save();
        return \Response::json();
    }

    public function destroy($id){

        $lrm = Lrm::getInstance();
        $lrm->deleteRoute($id);
        $lrm->save();
        return \Response::json();
    }

}
