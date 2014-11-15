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
    var $prof,$est,$padr,$reg;
    
    public function index() {
        $profesores = $this->Usuario->query("SELECT ip_usuario.id,nombre, ip_instituto_tipo.tipo as tipo,ip_instituto.instituto as ins,ciudad 
													FROM ip_usuario left outer join ip_usuario_instituto on ip_usuario.id=ip_usuario_instituto.usuario 
													left outer join ip_instituto on ip_usuario_instituto.instituto=ip_instituto.id 
													left outer join ip_instituto_tipo on ip_instituto_tipo.id=ip_instituto.tipo where ip_usuario.tipo=3");
        $prof=profesores;
        $estudiantes = $this->Usuario->find('all', array(
            'conditions' => array("tipo=2")
        ));
        $est=$estudiantes;
        $padres = $this->Usuario->find('all', array(
            'conditions' => array("tipo=1")
        ));
        $padr=$padres;
        $registrados = $this->Usuario->find('all', array(
            'conditions' => array("id>1")
        ));
        $reg=$registrados;
        $this->set('profesores', $profesores);
        $this->set('estudiantes', $estudiantes);
        $this->set('padres', $padres);
        $this->set('registrados', $registrados);
        $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
        
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
    
    public function follow() {
        
        $follow = $this->Follow->find('all');
        
        $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
        $this->set('follow',$follow);
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
        $this->render('follow');
    }
    
    public function contact() {

        $contact = $this->Contacto->find('all');
        
        
        $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
        $this->set('contact',$contact);
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
        $this->render('contact');
    }
    
    public function antiguo() {
       
        $registrados = $this->Usuario->find('all', array(
            'conditions' => array(
            array("id>1"),
            array("completo=1"),
            array("fecha_inscripcion<'2014-10-26 23:59:59'")
        )));
        
        $this->set('registrados', $registrados);
        $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
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
        $this->render('antiguo');
    }
    
    public function nuevos() {
       
        $registrados = $this->Usuario->find('all', array(
            'conditions' => array(
            array("id>1"),
            array("completo=1"),
            array("fecha_inscripcion>'2014-10-26 23:59:59'")
        )));
       
        $this->set('registrados', $registrados);
        $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
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
        $this->render('nuevos');
    }
    
     public function info() {
        /*$registrados = $this->Usuario->query("(SELECT ip_usuario.nombre, ip_usuario.tipo, ip_area.area,ip_instituto.instituto
                                                FROM ip_usuario,ip_usuario_area,ip_usuario_instituto,ip_area,ip_instituto
                                                WHERE ip_usuario_area.usuario=ip_usuario.id 
                                                AND ip_usuario_instituto.usuario=ip_usuario.id
                                                AND ip_usuario_area.area=ip_area.id 
                                                AND ip_usuario_instituto.instituto=ip_instituto.id
                                                AND ip_usuario.tipo<>3)
                                                 union
                                                (SELECT ip_usuario.nombre, ip_usuario.tipo, ip_area.area,ip_instituto.instituto
                                                FROM ip_usuario,ip_usuario_area,ip_usuario_instituto,ip_area,ip_instituto,ip_profesor_area
                                                WHERE ip_profesor_area.profesor=ip_usuario.id 
                                                AND ip_usuario_instituto.usuario=ip_usuario.id
                                                AND ip_profesor_area.area=ip_area.id 
                                                AND ip_usuario_instituto.instituto=ip_instituto.id
                                                AND ip_usuario.tipo=3)");*/
       $registrados = $this->Usuario->query("(SELECT ip_usuario.nombre, ip_usuario.apellido, ip_usuario.email, ip_usuario.tipo, ip_area.area,ip_instituto.instituto
                                                FROM ip_usuario,ip_usuario_area,ip_usuario_instituto,ip_area,ip_instituto
                                                WHERE ip_usuario_area.usuario=ip_usuario.id 
                                                AND ip_usuario_instituto.usuario=ip_usuario.id
                                                AND ip_usuario_area.area=ip_area.id 
                                                AND ip_usuario_instituto.instituto=ip_instituto.id
                                                AND ip_usuario.tipo<>3)");
      
       $this->set('registrados', $registrados);
       $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
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
        $this->render('info');
    }
    
    public function profesor(){
        
        $registrados = $this->Usuario->query("(SELECT ip_usuario.nombre, ip_usuario.apellido, ip_usuario.email, ip_usuario.tipo, ip_area.area,ip_instituto.instituto
                                                FROM ip_usuario,ip_usuario_instituto,ip_area,ip_instituto,ip_profesor_area
                                                WHERE ip_profesor_area.profesor=ip_usuario.id 
                                                AND ip_usuario_instituto.usuario=ip_usuario.id
                                                AND ip_profesor_area.area=ip_area.id 
                                                AND ip_usuario_instituto.instituto=ip_instituto.id
                                                AND ip_usuario.tipo=3)");
        $this->set('registrados', $registrados);
       $this->set('c_profesores', sizeof($prof));
        $this->set('c_estudiantes', sizeof($est));
        $this->set('c_padres', sizeof($padr));
        $this->set('c_registrados', sizeof($reg));
        
        $this->render('profesor');
        
    }
    
    public function nameUser($id){
        $query = $this->Usuario->findById($id);
	$dato =  $query['Usuario']['nombre'] . " " . $query['Usuario']['apellido'] . ";" . $query['Usuario']['email'];
        return $dato;
    }

}
