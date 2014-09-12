<?php
App::uses('AppController', 'Controller');
/**
 * Institutos Controller
 *
 * @property Instituto $Instituto
 * @property PaginatorComponent $Paginator
 */
class InstitutosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        var $uses = array('Instituto','Colegio','Universidad');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Instituto->recursive = 0;
		$this->set('institutos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Instituto->exists($id)) {
			throw new NotFoundException(__('Invalid instituto'));
		}
		$options = array('conditions' => array('Instituto.' . $this->Instituto->primaryKey => $id));
		$this->set('instituto', $this->Instituto->find('first', $options));
	}
        public function getInstitutos(){
            if ($this->request->is('post')) {

                $ciudad=$this->request->data("ciudad");
                $term=$this->request->data("term");
                $ciudad= explode(",", $ciudad);
                $options = array('conditions' => array("ciudad LIKE '%". $ciudad[0]."%' AND nombre LIKE '%".$term."%' LIMIT 10"));
                
                $universidades=$this->Universidad->find('all', $options);
                $colegios=$this->Colegio->find('all', $options);
            return new CakeResponse(array('body'=> json_encode(array('universidades'=>$universidades,'colegios'=>$colegios)),'status'=>200));}
			else{
			return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));	
			}
        }
                public function getColegios(){
            if ($this->request->is('post')) {

                $ciudad=$this->request->data("ciudad");
                $term=$this->request->data("term");
                  $terms=explode(",",$term);
                $condition="nombre LIKE '%".trim($terms[0])."%'";
                if(sizeof($terms)>1){
                    $condition.=" AND ciudad LIKE '%".trim($terms[1])."%'";
                }
                $condition.="  LIMIT 10";
                $options = array('conditions' => array($condition));
               
                $colegios=$this->Colegio->find('all', $options);
            return new CakeResponse(array('body'=> json_encode(array('colegios'=>$colegios)),'status'=>200));}
			else{
			return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));	
			}
        }
                public function getUniversidades(){
            if ($this->request->is('post')) {

                $ciudad=$this->request->data("ciudad");
                $term=$this->request->data("term");
                $terms=explode(",",$term);
                $condition="nombre LIKE '%".trim($terms[0])."%'";
                if(sizeof($terms)>1){
                    $condition.=" AND ciudad LIKE '%".trim($terms[1])."%'";
                }
                $condition.="  LIMIT 10";
                $options = array('conditions' => array($condition));
                $universidades=$this->Universidad->find('all', $options);
              
            return new CakeResponse(array('body'=> json_encode(array('universidades'=>$universidades)),'status'=>200));}
			else{
			return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));	
			}
        }
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Instituto->create();
			if ($this->Instituto->save($this->request->data)) {
				$this->Session->setFlash(__('The instituto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instituto could not be saved. Please, try again.'));
			}
		}
		$tipos = $this->Instituto->Tipo->find('list');
		$usuarios = $this->Instituto->Usuario->find('list');
		$this->set(compact('tipos', 'usuarios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Instituto->exists($id)) {
			throw new NotFoundException(__('Invalid instituto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Instituto->save($this->request->data)) {
				$this->Session->setFlash(__('The instituto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instituto could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Instituto.' . $this->Instituto->primaryKey => $id));
			$this->request->data = $this->Instituto->find('first', $options);
		}
		$tipos = $this->Instituto->Tipo->find('list');
		$usuarios = $this->Instituto->Usuario->find('list');
		$this->set(compact('tipos', 'usuarios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Instituto->id = $id;
		if (!$this->Instituto->exists()) {
			throw new NotFoundException(__('Invalid instituto'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Instituto->delete()) {
			$this->Session->setFlash(__('The instituto has been deleted.'));
		} else {
			$this->Session->setFlash(__('The instituto could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
