<?php

App::uses('AppController', 'Controller');

/**
 * Areas Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 */
class EstudianteController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    var $uses = array('Area', 'Follow', 'Pregunta', 'Tag', 'Respuesta', 'Contacto', 'Instituto', 'Usuario', 'UsuarioArea', 'UsuarioTag');

    /**
     * index method

     *
     * @return void
     */
    public function index() {
        if (AppController::checkAuth()) {
            App::import('Controller', 'UsuarioAreas');
            $UsuarioAreas = new UsuarioAreasController;

            $this->Area->recursive = 0;
            $this->set('areas', $this->Area->find('all', array('limit' => 16, 'order' => array('area' => 'asc'), 'conditions' => array('id<=31'))));

            $this->set('usuarioAreas', $UsuarioAreas->getUsuarioAreas());
            $this->layout = "default";
            $this->render("index");
        } else {
            $this->redirect("../Usuarios");
        }
    }

    public function saveAreas() {
        if ($this->request->is('post')) {
            $areas = $this->request->data("areas");
            $user = $this->Session->read('User');

            $this->UsuarioArea->recursive = 0;
            $this->UsuarioTag->recursive = 0;
            $this->Tag->recursive = 0;
            $ua = $this->UsuarioArea->deleteAll(array('usuario' => $user["id"]));
            $ut = $this->UsuarioTag->deleteAll(array('usuario' => $user["id"]));

            foreach ($areas as $area) {

                $arid = $area["area"];

                $this->UsuarioArea->create();
                $this->UsuarioArea->set('usuario', $user["id"]);
                $this->UsuarioArea->set('area', $arid);
                $this->UsuarioArea->save();
                $tags = explode(",", $area["tags"]);

                foreach ($tags as $tag) {
                    if (trim($tag) != "") {
                        $istag = $this->Tag->find('first', array('conditions' => array('tag' => $tag, 'area' => $area["area"])));

                        $tag_id = $istag["Tag"]["id"];

                        if (sizeof($istag) == 0) {
                            $this->Tag->create();
                            $this->Tag->set('tag', $tag);
                            $this->Tag->set('area', $arid);
                            $this->Tag->save();
                            $tag_id = $this->Tag->id;
                        }
                        $this->UsuarioTag->create();
                        $this->UsuarioTag->set('usuario', $user["id"]);
                        $this->UsuarioTag->set('tags_id', $tag_id);
                        $this->UsuarioTag->save();
                    }
                }
            }
            return new CakeResponse(array('body' => json_encode(array('message' => 'ok')), 'status' => 200));
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function saveProfileImg() {

        if ($this->request->is('post')) {
            $user = $this->Session->read('User');

            $this->Usuario->id = $user["id"];
            $p_avatar = $this->request->data("url");

            if ($this->Usuario->saveField('p_avatar', $p_avatar)) {
                $this->Session->write('User.p_avatar', $p_avatar);

                return new CakeResponse(array('body' => json_encode(array('message' => 'ok', 'url' => 'data:image/jpeg;base64,' . $p_avatar)), 'status' => 200));
            } else {
                return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
            }
        }
    }

    public function profile() {
        $this->Area->recursive = 0;
        $this->set('areas', $this->Area->find('all', array('limit' => 16, 'order' => array('area' => 'asc'), 'conditions' => array('id<=31'))));

        if (AppController::authReturnLogin()) {
            $user = $this->Session->read('User');
            $uid = $user["id"];
            $this->set('seguidores', $this->Follow->find('count', array('conditions' => array('usuario_seguido' => $uid))));
            $this->set('siguiendo', $this->Follow->find('count', array('conditions' => array('usuario_sigue' => $uid))));

            $this->set('p_hechas', $this->Pregunta->find('count', array('conditions' => array('id_usuario_preg' => $uid))));
            $this->set('p_resueltas', $this->Respuesta->find('count', array('conditions' => array('id_usuario_res' => $uid))));
            $this->set('m_respuestas', $this->Respuesta->find('count', array('conditions' => array('id_usuario_res' => $uid, 'mejor_respuesta' => true))));
            $this->set('contactos', $this->Contacto->find('count', array('conditions' => array('id_contactado' => $uid))));
            $this->set('n_contactos', $this->Contacto->find('count', array('conditions' => array('id_contactador' => $uid))));
            $this->set('u_instituto', $this->Instituto->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_usuario_instituto on ip_usuario_instituto.usuario=ip_usuario.id inner join ip_instituto on ip_instituto.id=ip_usuario_instituto.instituto where ip_usuario.id=" . $user['id']));
            $this->set('u_area', $this->UsuarioArea->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_usuario_area on ip_usuario_area.usuario=ip_usuario.id inner join ip_area on ip_usuario_area.area=ip_area.id where ip_usuario.id=" . $user['id'] . " AND ip_area.id<=31"));
            $this->set('u_tags', $this->UsuarioTag->query("SELECT * FROM Instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=" . $user["id"]));
            $this->render();
        } else {
            $this->layout = "login";
            $this->render("/Usuarios");
        }
    }

}
