<?php
App::uses('AppController', 'Controller');
/**
 * InstitutoTipos Controller
 *
 * @property InstitutoTipo $InstitutoTipo
 * @property PaginatorComponent $Paginator
 */
class InstitutoTiposController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InstitutoTipo->recursive = 0;
		$this->set('institutoTipos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InstitutoTipo->exists($id)) {
			throw new NotFoundException(__('Invalid instituto tipo'));
		}
		$options = array('conditions' => array('InstitutoTipo.' . $this->InstitutoTipo->primaryKey => $id));
		$this->set('institutoTipo', $this->InstitutoTipo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InstitutoTipo->create();
			if ($this->InstitutoTipo->save($this->request->data)) {
				$this->Session->setFlash(__('The instituto tipo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instituto tipo could not be saved. Please, try again.'));
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
		if (!$this->InstitutoTipo->exists($id)) {
			throw new NotFoundException(__('Invalid instituto tipo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InstitutoTipo->save($this->request->data)) {
				$this->Session->setFlash(__('The instituto tipo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instituto tipo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InstitutoTipo.' . $this->InstitutoTipo->primaryKey => $id));
			$this->request->data = $this->InstitutoTipo->find('first', $options);
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
		$this->InstitutoTipo->id = $id;
		if (!$this->InstitutoTipo->exists()) {
			throw new NotFoundException(__('Invalid instituto tipo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->InstitutoTipo->delete()) {
			$this->Session->setFlash(__('The instituto tipo has been deleted.'));
		} else {
			$this->Session->setFlash(__('The instituto tipo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
