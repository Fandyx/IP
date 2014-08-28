<?php
App::uses('AppController', 'Controller');
/**
 * ProfesorAreas Controller
 *
 * @property ProfesorArea $ProfesorArea
 * @property PaginatorComponent $Paginator
 */
class ProfesorAreasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    var $uses = array('Area','Tag','Usuario','ProfesorArea','UsuarioTag');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProfesorArea->recursive = 0;
		$this->set('profesorAreas', $this->Paginator->paginate());
	}
	public function areaProfe() {
		$this->layout = null;
	   
	
		 $prof =  $_POST['prof_id'];
		 $data=$prof;
         $area=$_POST['area'];
    
		if(!empty($data)){
		
		$data=$this->ProfesorArea->find('first', array('joins' => array(

         array(
         'table' => 'area',
         'type' => 'inner',
		  'conditions'=> array(
         'ip_area.id =ProfesorArea.Area'
		 )
     )
     ),'fields'=>array('ip_area.area','ip_area.id'),'conditions'=> 
         array('profesor ='.$data,'ip_area.id ='.$area)
		 
 ));
            $data2=$this->UsuarioTag->find('all',array('conditions'=>array('usuario'=>$prof,'Tags.area'=>$data["ip_area"]["id"])));

		return new CakeResponse(array('body'=> json_encode(array('data'=>$data,'data2'=>$data2)),'status'=>200));
		}
        
	return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));
		
	}	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProfesorArea->exists($id)) {
			throw new NotFoundException(__('Invalid profesor area'));
		}
		$options = array('conditions' => array('ProfesorArea.' . $this->ProfesorArea->primaryKey => $id));
		$this->set('profesorArea', $this->ProfesorArea->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProfesorArea->create();
			if ($this->ProfesorArea->save($this->request->data)) {
				$this->Session->setFlash(__('The profesor area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profesor area could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProfesorArea->exists($id)) {
			throw new NotFoundException(__('Invalid profesor area'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProfesorArea->save($this->request->data)) {
				$this->Session->setFlash(__('The profesor area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profesor area could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ProfesorArea.' . $this->ProfesorArea->primaryKey => $id));
			$this->request->data = $this->ProfesorArea->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProfesorArea->id = $id;
		if (!$this->ProfesorArea->exists()) {
			throw new NotFoundException(__('Invalid profesor area'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ProfesorArea->delete()) {
			$this->Session->setFlash(__('The profesor area has been deleted.'));
		} else {
			$this->Session->setFlash(__('The profesor area could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
