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
