<?php
App::uses('AppController', 'Controller');
/**
 * UsuarioInstitutos Controller
 *
 * @property UsuarioInstituto $UsuarioInstituto
 * @property PaginatorComponent $Paginator
 */
class UsuarioInstitutosController extends AppController {

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
		$this->UsuarioInstituto->recursive = 0;
		$this->set('usuarioInstitutos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsuarioInstituto->exists($id)) {
			throw new NotFoundException(__('Invalid usuario instituto'));
		}
		$options = array('conditions' => array('UsuarioInstituto.' . $this->UsuarioInstituto->primaryKey => $id));
		$this->set('usuarioInstituto', $this->UsuarioInstituto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsuarioInstituto->create();
			if ($this->UsuarioInstituto->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario instituto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario instituto could not be saved. Please, try again.'));
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
		if (!$this->UsuarioInstituto->exists($id)) {
			throw new NotFoundException(__('Invalid usuario instituto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsuarioInstituto->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario instituto has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario instituto could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsuarioInstituto.' . $this->UsuarioInstituto->primaryKey => $id));
			$this->request->data = $this->UsuarioInstituto->find('first', $options);
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
		$this->UsuarioInstituto->id = $id;
		if (!$this->UsuarioInstituto->exists()) {
			throw new NotFoundException(__('Invalid usuario instituto'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsuarioInstituto->delete()) {
			$this->Session->setFlash(__('The usuario instituto has been deleted.'));
		} else {
			$this->Session->setFlash(__('The usuario instituto could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
