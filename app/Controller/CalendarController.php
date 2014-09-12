<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 * @property PaginatorComponent $Paginator
 */
class BuscarProfeController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
 var $uses = array('Usuario','Calendario');
/**
 * index method

 *SELECT * FROM ip_usuario  inner join ip_profesor_area on
 * ip_usuario.id=ip_profesor_area.profesor inner join 
 * ip_area on ip_profesor_area.area=ip_area.id 
 * where ip_area.area like 
 * @return void
 */

public function add(){
    if(AppController::isRequestOK($this->request)){
        $title=$this->request->data("title");
        $description=$this->request->data("description");
        $this->Calendar->create();
        $this->Calendar->saveField('usuario');
        $this->Calendar->saveField('titulo');
        $this->Calendar->saveField('descripcion');
        $this->Calendar->saveField('fecha_inicio');
        $this->Calendar->saveField('fecha_fin');        
    }
}
public function delete(){
        if(AppController::isRequestOK($this->request)){
        $id=$this->request->data("id");
        $this->Calendar->deleteAll(array('id'=>$id));
    }
}
public function update(){
        if(AppController::isRequestOK($this->request)){
        $title=$this->request->data("title");
        $description=$this->request->data("description");
         $id=$this->request->data("id");
         $data = array('id' =>$id, 'title' => $title,'description' => $description);
          $this->Calendar->save($data);
    }
}
public function render(){
    if(AppController::isRequestOK($this->request)){
        $uid=$this->Session->read("User");
        $this->Calendar->find('all',array('usuario'=>$uid));
        return new CakeResponse(array('body'=> json_encode(array('calendar'=>$calendar)),'status'=>200));}
          
        
       return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));    
}
}
