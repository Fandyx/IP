<?php

App::uses('AppController', 'Controller');

/**
 * Alumnos Controller
 *
 * @property Alumno $Alumno
 * @property PaginatorComponent $Paginator
 */
class AdminController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    var $uses = array('Area', 'Pregunta', 'Tag', 'Reporte', 'Respuesta', 'UsuarioCalificacion', 'Colegio', 'Universidad', 'Contacto', 'ProfesorExperiencia', 'ProfesorEducacion', 'Follow', 'Instituto', 'Usuario', 'UsuarioInstituto', 'UsuarioArea', 'UsuarioTag', 'ProfesorArea');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $profesores = $this->Usuario->query("SELECT ip_usuario.id,nombre, ip_instituto_tipo.tipo as tipo,ip_instituto.instituto as ins,ciudad 
													FROM ip_usuario left outer join ip_usuario_instituto on ip_usuario.id=ip_usuario_instituto.usuario 
													left outer join ip_instituto on ip_usuario_instituto.instituto=ip_instituto.id 
													left outer join ip_instituto_tipo on ip_instituto_tipo.id=ip_instituto.tipo where ip_usuario.tipo=3");
        $estudiantes = $this->Usuario->find('all', array(
            'conditions' => array("tipo=2")
        ));
        $padres = $this->Usuario->find('all', array(
            'conditions' => array("tipo=1")
        ));
        $registrados = $this->Usuario->find('all', array(
            'conditions' => array("id>1")
        ));
        $this->set('profesores', $profesores);
        $this->set('estudiantes', $estudiantes);
        $this->set('padres', $padres);
        $this->set('registrados', $registrados);
        $this->set('c_profesores', sizeof($profesores));
        $this->set('c_estudiantes', sizeof($estudiantes));
        $this->set('c_padres', sizeof($padres));
        $this->set('c_registrados', sizeof($registrados));
//        $areas = [];
//        $i = 0;
//        foreach ($profesores as $row) {
//            $profe_areas = $this->Usuario->find("SELECT ip_area.area as area FROM ip_usuario inner join ip_profesor_area on ip_usuario.id=ip_profesor_area.profesor inner join ip_area on ip_profesor_area.area=ip_area.id where ip_usuario.id=" . $row["Usuario"]["id"]);
//            $area = "";
//            foreach ($profe_areas as $row2) {
//                $area = $area . $row2["area"]["area"] . ", ";
//            }
//            $areas[$i] = $area;
//            $i++;
//            $areas = substr($areas, 0, -2);
//        }
//        $this->set('profe_areas', $profe_areas);
        $this->render('index');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Alumno->exists($id)) {
            throw new NotFoundException(__('Invalid alumno'));
        }
        $options = array('conditions' => array('Alumno.' . $this->Alumno->primaryKey => $id));
        $this->set('alumno', $this->Alumno->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Alumno->create();
            if ($this->Alumno->save($this->request->data)) {
                $this->Session->setFlash(__('The alumno has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The alumno could not be saved. Please, try again.'));
            }
        }
        $users = $this->Alumno->User->find('list');
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
        if (!$this->Alumno->exists($id)) {
            throw new NotFoundException(__('Invalid alumno'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Alumno->save($this->request->data)) {
                $this->Session->setFlash(__('The alumno has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The alumno could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Alumno.' . $this->Alumno->primaryKey => $id));
            $this->request->data = $this->Alumno->find('first', $options);
        }
        $users = $this->Alumno->User->find('list');
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
        $this->Alumno->id = $id;
        if (!$this->Alumno->exists()) {
            throw new NotFoundException(__('Invalid alumno'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Alumno->delete()) {
            $this->Session->setFlash(__('The alumno has been deleted.'));
        } else {
            $this->Session->setFlash(__('The alumno could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
