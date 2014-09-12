<?php
App::uses('AppController', 'Controller');
/**
 * UsuarioAreas Controller
 *
 * @property UsuarioArea $UsuarioArea
 * @property PaginatorComponent $Paginator
 */
class UsuarioAreasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session');
	var $uses = array('Area','Pregunta','Tag','Respuesta','Instituto','Usuario','UsuarioArea','UsuarioTag');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UsuarioArea->recursive = 0;
		$this->set('usuarioAreas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     public function getUsuarioAreas(){
      $user=$_SESSION['User'];
      $id=$user["id"];
             $options = array('conditions' => array('UsuarioArea.usuario' => $id));
           return $this->UsuarioArea->query("SELECT ip_area.id as area_id, ip_area.area as area FROM Instaprofe.ip_usuario inner join ip_usuario_area on ip_usuario_area.usuario=ip_usuario.id inner join ip_area on ip_usuario_area.area=ip_area.id where ip_usuario.id=".$id." AND ip_area.id<=31");
        }
	public function view($id = null) {
		if (!$this->UsuarioArea->exists($id)) {
			throw new NotFoundException(__('Invalid usuario area'));
		}
		$options = array('conditions' => array('UsuarioArea.' . $this->UsuarioArea->primaryKey => $id));
		$this->set('usuarioArea', $this->UsuarioArea->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsuarioArea->create();
			if ($this->UsuarioArea->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario area could not be saved. Please, try again.'));
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
		if (!$this->UsuarioArea->exists($id)) {
			throw new NotFoundException(__('Invalid usuario area'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsuarioArea->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario area has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario area could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsuarioArea.' . $this->UsuarioArea->primaryKey => $id));
			$this->request->data = $this->UsuarioArea->find('first', $options);
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
		$this->UsuarioArea->id = $id;
		if (!$this->UsuarioArea->exists()) {
			throw new NotFoundException(__('Invalid usuario area'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsuarioArea->delete()) {
			$this->Session->setFlash(__('The usuario area has been deleted.'));
		} else {
			$this->Session->setFlash(__('The usuario area could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
