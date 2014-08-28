<?php
App::uses('AppController', 'Controller');
/**
 * Logins Controller
 *
 * @property Login $Login
 * @property PaginatorComponent $Paginator
 */
class LoginController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $uses = array('Usuario');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if(isset($_POST["user"])&&isset($_POST["pass"])){
		$this->set('session', $this->Paginator->paginate());
		}
	}

	public function auth() {
		$this->autoRender = false;
		
		if(isset($_POST["user"])&&isset($_POST["pass"])){
			$user=$_POST["user"];
		    $pass=$_POST["pass"];
			$this->Usuario->recursive = 0;
		    $auth = $this->Usuario->find('first', array(
        	'conditions' => array('Usuario.email' => $user,'Usuario.pass' => $pass)
    		));
			$sw=true;
			if(count($auth)==1){
				$this->Session->write('init', true);
				$type=$auth['Usuario']['tipo'];
				$this->Session->write('type', $type);
				$this->Session->write('nick', $auth['Usuario']['nick']);
				$this->Session->write('nom', $auth['Usuario']['nombre']);
				Configure::write('nom',$auth['Usuario']['nombre']);
				$this->Session->setFlash('nom');
				$this->Session->write('ap', $auth['Usuario']['apellido']);
				$this->Session->write('nom', $auth['Usuario']['nombre']);
				$this->Session->write('userid', $auth['Usuario']['id']);
				$sw=false;
				if($type==-1){
					$this -> render('/Admin/');
				}
				if($type==3){}
				if($type==2){
					$this->redirect('/Estudiante/');
					
				}
				if($type==1){}
				

			}
		}
		if($sw){
		$this->redirect(
            array('controller' => 'Usuarios', 'action' => 'index')
        );}
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Login->exists($id)) {
			throw new NotFoundException(__('Invalid Login'));
		}
		$options = array('conditions' => array('Login.' . $this->Login->primaryKey => $id));
		$this->set('Login', $this->Login->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Login->create();
			if ($this->Login->save($this->request->data)) {
				$this->Session->setFlash(__('The Login has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Login could not be saved. Please, try again.'));
			}
		}
		$users = $this->Login->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Login->exists($id)) {
			throw new NotFoundException(__('Invalid Login'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Login->save($this->request->data)) {
				$this->Session->setFlash(__('The Login has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Login could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Login.' . $this->Login->primaryKey => $id));
			$this->request->data = $this->Login->find('first', $options);
		}
		$users = $this->Login->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Login->id = $id;
		if (!$this->Login->exists()) {
			throw new NotFoundException(__('Invalid Login'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Login->delete()) {
			$this->Session->setFlash(__('The Login has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Login could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
