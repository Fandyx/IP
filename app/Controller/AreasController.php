<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 * @property PaginatorComponent $Paginator
 */
class AreasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        var $uses = array('Area','Pregunta','Tag','Respuesta','Instituto','Usuario','UsuarioArea','ProfesorArea','UsuarioTag');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->Paginator->paginate());
		$this->render("index");
	}
	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
		$this->set('area', $this->Area->find('first', $options));
	}
        public function getTemas(){
              if ($this->request->is('post')) {
                  $area=$_POST["area"];
                  if(isset($area)){
                    $at=$this->Tag->find('all',array('conditions'=>array('area'=>$area)));
                    $tags="";
                        foreach($at as $tag){

                                     if($tags==""){    
                                      $tags=$tag["Tag"]["tag"];}
                                      else{
                                      $tags=$tags.", ".$tag["Tag"]["tag"];
                                      } 
                        }
                  return new CakeResponse(array('body'=> json_encode(array('temas'=>$tags)),'status'=>200));
                  }
              }
                return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500)); 
        }
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Area->create();
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		}
		$profesors = $this->Area->Profesor->find('list');
		$usuarios = $this->Area->Usuario->find('list');
		$this->set(compact('profesors', 'usuarios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     public function dataAreas(){
        $id=$this->request->data("area_id");
        $user=$this->Session->read('User');
        if($id>0){
         
        $temas=$this->Tag->find('count',array('conditions'=>array('area'=>$id)));
        $preguntas=$this->Pregunta->find('count',array('conditions'=>array('Pregunta.area'=>$id)));
        $profesores="";
        if($user["tipo"]==3){
         $profesores=$this->UsuarioArea->find('count',array('conditions'=>array('UsuarioArea.area'=>$id)))." Estudiantes";   
        }else{
        $profesores=$this->ProfesorArea->find('count',array('conditions'=>array('ProfesorArea.area'=>$id)))." Profesores";
        }
        
        return new CakeResponse(array('body'=> json_encode(array('temas'=>$temas,'preguntas'=>$preguntas,'profesores'=>$profesores)),'status'=>200));
        }else{
            return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));    
        }
        }
	public function edit($id = null) {
		if (!$this->Area->exists($id)) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Area.' . $this->Area->primaryKey => $id));
			$this->request->data = $this->Area->find('first', $options);
		}
		$profesors = $this->Area->Profesor->find('list');
		$usuarios = $this->Area->Usuario->find('list');
		$this->set(compact('profesors', 'usuarios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('The area has been deleted.'));
		} else {
			$this->Session->setFlash(__('The area could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
