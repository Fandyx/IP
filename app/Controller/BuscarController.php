<?php

App::uses('AppController', 'Controller');

/**
 * Profesors Controller
 *
 * @property Profesor $Profesor
 * @property PaginatorComponent $Paginator
 */
class BuscarController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $uses = array('Area', 'Follow', 'Contacto', 'Pregunta', 'Tag', 'Respuesta', 'Instituto', 'Usuario','UsuarioArea', 'ProfesorArea', 'ProfesorEducacion', 'ProfesorExperiencia', 'UsuarioTag');

    /**
     * index method
     *
     * @return void
     */
    public function userType(){
        $user=$this->Session->read('User');
        return $user["tipo"]==3?'P':'U';
    }
    public function index() {
        if (AppController::authReturnLogin()) {
            if($this->userType()=='P'){
            App::import('Controller', 'ProfesorAreas');
            $ProfesorAreas = new ProfesorAreasController;
            $this->Area->recursive = 0;

            $this->set('areas', $this->Area->find('all', array('limit' => 16, 'order' => array('area' => 'asc'), 'conditions' => array('id<=32'))));

            $this->set('usuarioAreas', $ProfesorAreas->getProfesorAreas());
            $this->layout = "default";
            $this->layout = "default";
            $this->render("index");}else{
            App::import('Controller', 'UsuarioAreas');
            $UsuarioAreas= new UsuarioAreasController;
           
             $this->Area->recursive = 0;
           $this->set('areas', $this->Area->find('all',array('limit'=>16,'order'=>array('area'=>'asc'),'conditions'=>array('id<=31'))));
           
               $this->set('usuarioAreas',$UsuarioAreas->getUsuarioAreas());
	       $this->layout="default";
            $this->render("index");
            }
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Profesor->exists($id)) {
            throw new NotFoundException(__('Invalid profesor'));
        }
        $options = array('conditions' => array('Profesor.' . $this->Profesor->primaryKey => $id));
        $this->set('profesor', $this->Profesor->find('first', $options));
    }

    public function getThemes() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $area = $this->request->data("area");
            $user = $this->Session->read('User');
            $this->UsuarioTag->recursive = 0;
            $ut = $this->UsuarioTag->query("SELECT * FROM instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=" . $user["id"] . " AND area=" . $area);
            $tags = "";
            foreach ($ut as $tag) {

                if ($tags == "") {
                    $tags = $tag["ip_tags"]["tag"];
                } else {
                    $tags = $tags . ", " . $tag["ip_tags"]["tag"];
                }
            }
            return new CakeResponse(array('body' => json_encode(array('temas' => $tags)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }



    public function getExperiencia() {
        if (AppController::isRequestOK($this->request)) {
            $id = $this->request->data("user");
            $edu = $this->ProfesorExperiencia->find('all', array('conditions' => array('profesor' => $id)));
            $i = 0;
            foreach ($edu as $e) {
                $edu[$i] = $e["ProfesorExperiencia"];
                if ($edu[$i]["tipo"] == "E") {
                    $edu[$i]["tipo"] = "Empleado";
                } else {
                    $edu[$i]["tipo"] = "Independiente";
                }


                $i++;
            }

            return new CakeResponse(array('body' => json_encode(array('table_data' => $edu)), 'status' => 200));
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function getRawEducacion($id) {
        if (AppController::checkAuth()) {
            $profe_edu = $this->ProfesorEducacion->find('all', array('conditions' => array('profesor' => $id)));
            return $profe_edu;
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function getRawExp($id) {
        if (AppController::checkAuth()) {
            $profe_exp = $this->ProfesorExperiencia->find('all', array('conditions' => array('profesor' => $id)));
            return $profe_exp;
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function getEducacion() {
        if (AppController::isRequestOK($this->request)) {
            $id = $this->request->data("user");
            $edu = $this->ProfesorEducacion->find('all', array('conditions' => array('profesor' => $id)));
            $i = 0;
            foreach ($edu as $e) {
                $edu[$i] = $e["ProfesorEducacion"];
                if ($edu[$i]["tipo"] == "NF") {
                    $edu[$i]["tipo"] = "No Formal";
                } else {
                    $edu[$i]["tipo"] = "Formal";
                }

                if ($edu[$i]["instituto_tipo"] === "2") {
                    $edu[$i]["instituto_tipo"] = "Universidad";
                } else {
                    $edu[$i]["instituto_tipo"] = "Otro";
                }
                $i++;
            }

            return new CakeResponse(array('body' => json_encode(array('table_data' => $edu)), 'status' => 200));
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

   
    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Profesor->create();
            if ($this->Profesor->save($this->request->data)) {
                $this->Session->setFlash(__('The profesor has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profesor could not be saved. Please, try again.'));
            }
        }
        $users = $this->Profesor->User->find('list');
        $areas = $this->Profesor->Area->find('list');
        $this->set(compact('users', 'areas'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Profesor->exists($id)) {
            throw new NotFoundException(__('Invalid profesor'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Profesor->save($this->request->data)) {
                $this->Session->setFlash(__('The profesor has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profesor could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Profesor.' . $this->Profesor->primaryKey => $id));
            $this->request->data = $this->Profesor->find('first', $options);
        }
        $users = $this->Profesor->User->find('list');
        $areas = $this->Profesor->Area->find('list');
        $this->set(compact('users', 'areas'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Profesor->id = $id;
        if (!$this->Profesor->exists()) {
            throw new NotFoundException(__('Invalid profesor'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Profesor->delete()) {
            $this->Session->setFlash(__('The profesor has been deleted.'));
        } else {
            $this->Session->setFlash(__('The profesor could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
