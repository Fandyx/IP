<?php

App::uses('AppController', 'Controller');

/**
 * Pregunta Controller
 *
 * @property Pregunta $Pregunta
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PreguntaController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    var $uses = array('Area', 'Pregunta', 'Tag', 'Respuesta', 'Usuario', 'PreguntaTag', 'PreguntaVoto', 'RespuestaVoto');

    /**
     * index method
     *
     * @return void
     *     
     */ public function setForIndex($uid, $user_table, $user_type) {
        $this->Area->recursive = 0;
        $this->Pregunta->recursive = 0;
        $this->set('areas', $this->Area->find('all', array('conditions' => array('id<33'), 'order' => 'area')));
        $this->set('mis_preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_pregunta.id_usuario_preg=" . $uid . " group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;"));
        $this->set('preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_area.id in (SELECT area from " . $user_table . " where " . $user_type . "=" . $uid . ") group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;"));
        $this->set('rec_preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id WHERE fecha_pregunta between date_sub(now(),INTERVAL 4 WEEK) and now() group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;"));
        $this->set('top_preguntas', $this->Pregunta->query("SELECT DISTINCT(ip_respuesta.id),titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido,  (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id inner join ip_pregunta_votos on pregunta_id=ip_pregunta.id group by ip_pregunta.id order by numpreg desc,crespuesta desc;"));
        $this->set('p_tags', $this->PreguntaTag->find('all', array('joins' => array(
                        array(
                            'table' => 'tags',
                            'alias' => 'Tags',
                            'type' => 'inner',
                            'conditions' => array('Tags.id=PreguntaTag.tag')
                        )), 'fields' => array('id', 'pregunta', 'Tags.tag'))));
    }

    public function hechas() {
        if (AppController::authReturnLogin()) {
            $id = $this->request->query["uid"];
            $this->Pregunta->recursive = 0;
            $this->Area->recursive = false;
            $this->set('areas', $this->Area->find('all', array('conditions' => array('id<33'), 'order' => 'area')));
            $hechas = $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_pregunta.id_usuario_preg=" . $id . " group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;");
            $this->set('p_tags', $this->PreguntaTag->find('all', array('joins' => array(
                            array(
                                'table' => 'tags',
                                'alias' => 'Tags',
                                'type' => 'inner',
                                'conditions' => array('Tags.id=PreguntaTag.tag')
                            )), 'fields' => array('id', 'pregunta', 'Tags.tag'))));
            $this->set('preg_req', $hechas);
            if (sizeof($hechas) > 0) {
                $this->set('tab_name', "Preguntas hechas por " . $hechas[0]["ip_usuario"]["nombre"] . " " . $hechas[0]["ip_usuario"]["apellido"]);
            } else {
                $this->set('tab_name', "0 Resultados");
            }$this->render("index");
        }
    }

    public function resueltas() {
        if (AppController::authReturnLogin()) {
            $id = $this->request->query["uid"];
            $this->Area->recursive = false;
            $this->set('areas', $this->Area->find('all', array('conditions' => array('id<33'), 'order' => 'area')));

            $resueltas = $this->Respuesta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_respuesta.id_usuario_res=" . $id . " group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;");
            $this->set('p_tags', $this->PreguntaTag->find('all', array('joins' => array(
                            array(
                                'table' => 'tags',
                                'alias' => 'Tags',
                                'type' => 'inner',
                                'conditions' => array('Tags.id=PreguntaTag.tag')
                            )), 'fields' => array('id', 'pregunta', 'Tags.tag'))));
            $this->set('preg_req', $resueltas);
            if (sizeof($resueltas) > 0) {
                $this->set('tab_name', "Preguntas resueltas por " . $resueltas[0]["ip_usuario"]["nombre"] . " " . $resueltas[0]["ip_usuario"]["apellido"]);
            } else {
                $this->set('tab_name', "0 Resultados");
            }
            $this->render("index");
        }
    }

    public function mejores() {
        if (AppController::authReturnLogin()) {
            $id = $this->request->query["uid"];
            $this->Area->recursive = false;
            $this->set('areas', $this->Area->find('all', array('conditions' => array('id<33'), 'order' => 'area')));

            $resueltas = $this->Respuesta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_respuesta.id_usuario_res=" . $id . " AND mejor_respuesta=1 group by ip_pregunta.id order by fecha_pregunta desc,numpreg desc,crespuesta desc ;");
            $this->set('p_tags', $this->PreguntaTag->find('all', array('joins' => array(
                            array(
                                'table' => 'tags',
                                'alias' => 'Tags',
                                'type' => 'inner',
                                'conditions' => array('Tags.id=PreguntaTag.tag')
                            )), 'fields' => array('id', 'pregunta', 'Tags.tag'))));
            $this->set('preg_req', $resueltas);
            if (sizeof($resueltas) > 0) {
                $this->set('tab_name', "Mejores respuestas de " . $resueltas[0]["ip_usuario"]["nombre"] . " " . $resueltas[0]["ip_usuario"]["apellido"]);
            } else {
                $this->set('tab_name', "0 Resultados");
            }
            $this->render("index");
        }
    }

    public function index() {
        if (AppController::authReturnLogin()) {
            $user = $this->Session->read("User");
            $user_table = "ip_usuario_area";
            $user_type = "usuario";
            if ($user["tipo"] === "3") {
                $user_type = "profesor";
                $user_table = "ip_profesor_area";
            }

            $this->setForIndex($user["id"], $user_table, $user_type);
            $this->render('index');
        }
    }

    public function buscarPregunta() {
        if (AppController::authReturnLogin()) {
            $area = $this->request->data("area");
            $tags = $this->request->data("tags");
            $keys = $this->request->data("keywords");
            $cond = " AND (";
            $sw = true;
            if ($tags != "") {
                foreach ($tags as $tag) {
                    $cond.=" ip_tags.tag='" . $tag . "' OR";

                    $sw = false;
                }
            }
            $cond = substr($cond, 0, -3);
            $cond.=")";
            $join_tags = "";
            if ($sw) {
                $cond = "";
            }
            if ($tags != "") {
                $join_tags = "inner join ip_pregunta_tags on ip_pregunta_tags.pregunta=ip_pregunta.id inner join ip_tags on ip_pregunta_tags.tag=ip_tags.id";
            }
            $p_tags = $this->PreguntaTag->find('all', array('joins' => array(
                    array(
                        'table' => 'tags',
                        'alias' => 'Tags',
                        'type' => 'inner',
                        'conditions' => array('Tags.id=PreguntaTag.tag')
                    )), 'fields' => array('id', 'pregunta', 'Tags.tag')));

            $uid = "";
            if (isset($this->request->data["uid"])) {

                $id = $this->request->data("uid");
                $uid = " AND ip_usuario.id=" . $id;
            }

            $q_area = "";
            $t_area = "";
            if ($area != "") {
                $t_area = "ip_area.area,";
                $q_area = " inner join ip_area on ip_pregunta.area=ip_area.id where ip_area.id= " . $area;
            }
            $q_keys = "";
            if ($keys != "") {

                $q_keys = " AND (ip_pregunta.titulo like '%" . $keys . "%' OR ip_pregunta.pregunta like '%" . $keys . "%' OR ip_area.area like '%" . $keys . "%' OR ip_tags.tag like '%" . $keys . "%')";
                $join_tags = "inner join ip_pregunta_tags on ip_pregunta_tags.pregunta=ip_pregunta.id inner join ip_tags on ip_pregunta_tags.tag=ip_tags.id";
                $t_area = "ip_area.area,";
                if ($area == "") {
                    $q_area = " inner join ip_area on ip_pregunta.area=ip_area.id";
                }
            }
            $preg = $this->Pregunta->query("SELECT ip_pregunta.id,titulo,ip_pregunta.id," . $t_area . "ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, "
                    . "(SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg  FROM Instaprofe.ip_pregunta left outer join ip_respuesta"
                    . " on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id "
                    . $join_tags
                    . " left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id"
                    . $q_area . $uid . $q_keys
                    . $cond . " group by ip_pregunta.id "
                    . "order by numpreg desc, crespuesta desc, fecha_pregunta desc ;");



            return new CakeResponse(array('body' => json_encode(array('preg' => $preg, 'p_tags' => $p_tags)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    private function vote($user, $preg, $fecha, $voto) {
        $exists = $this->PreguntaVoto->find('first', array('conditions' => array('pregunta_id' => $preg, 'usuario_id' => $user)));

        if (sizeof($exists) == 0) {
            $this->PreguntaVoto->create();
            $this->PreguntaVoto->saveField("pregunta_id", $preg);
            $this->PreguntaVoto->saveField("usuario_id", $user["id"]);
            $this->PreguntaVoto->saveField("pregunta_id", $preg);
            $this->PreguntaVoto->saveField("fecha", $fecha);
            $this->PreguntaVoto->saveField("voto", $voto);
        } else {
            if ($voto == $exists["PreguntaVoto"]["voto"]) {
                $voto = 0;
            }
            $this->PreguntaVoto->id = $exists["PreguntaVoto"]["id"];
            $this->PreguntaVoto->saveField("fecha", $fecha);
            $this->PreguntaVoto->saveField("voto", $voto);
        }
        $pv = $this->PreguntaVoto->find("all", array('conditions' => array('PreguntaVoto.pregunta_id' => $preg), 'fields' => array('sum(PreguntaVoto.voto) AS voto,' . $voto . ' as type')));
        return $pv[0][0];
    }

    public function votarPos() {
        if (AppController::authReturnLogin()) {
            $user = $this->Session->read('User');
            $preg = $this->request->data("pid");
            $fecha = date('Y-m-d G:i:s', time() - 18000);
            $res = $this->vote($user, $preg, $fecha, 1);

            return new CakeResponse(array('body' => json_encode(array('votes' => $res)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    public function votarNeg() {
        if (AppController::authReturnLogin()) {
            $user = $this->Session->read('User');
            $preg = $this->request->data("pid");
            $fecha = date('Y-m-d G:i:s', time() - 18000);
            $res = $this->vote($user, $preg, $fecha, -1);

            return new CakeResponse(array('body' => json_encode(array('votes' => $res)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    private function voteRes($user, $res, $fecha, $voto) {
        $exists = $this->RespuestaVoto->find('first', array('conditions' => array('respuesta' => $res, 'usuario_id' => $user)));

        if (sizeof($exists) == 0) {
            $this->RespuestaVoto->create();
            $this->RespuestaVoto->saveField("respuesta", $res);
            $this->RespuestaVoto->saveField("usuario_id", $user["id"]);
            $this->RespuestaVoto->saveField("respuesta", $res);
            $this->RespuestaVoto->saveField("fecha", $fecha);
            $this->RespuestaVoto->saveField("voto", $voto);
        } else {
            if ($voto == $exists["RespuestaVoto"]["voto"]) {
                $voto = 0;
            }
            $this->RespuestaVoto->id = $exists["RespuestaVoto"]["id"];
            $this->RespuestaVoto->saveField("fecha", $fecha);
            $this->RespuestaVoto->saveField("voto", $voto);
        }
        $pv = $this->RespuestaVoto->find("all", array('conditions' => array('RespuestaVoto.respuesta' => $res), 'fields' => array('sum(RespuestaVoto.voto) AS voto,' . $voto . ' as type')));
        return $pv[0][0];
    }

    public function votarPosRes() {
        if (AppController::authReturnLogin()) {
            $user = $this->Session->read('User');
            $res = $this->request->data("rid");
            $fecha = date('Y-m-d G:i:s', time() - 18000);
            ;
            $res = $this->voteRes($user, $res, $fecha, 1);

            return new CakeResponse(array('body' => json_encode(array('votes' => $res)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    public function votarNegRes() {
        if (AppController::authReturnLogin()) {
            $user = $this->Session->read('User');
            $res = $this->request->data("rid");
            $fecha = date('Y-m-d G:i:s', time() - 18000);
            $res = $this->voteRes($user, $res, $fecha, -1);

            return new CakeResponse(array('body' => json_encode(array('votes' => $res)), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    public function Post() {
        if (AppController::authReturnLogin()) {
            $id = $_GET["pid"];
            $user = $this->Session->read('User');
            $this->set('pregunta', $this->Pregunta->find("first", array('conditions' => array('Pregunta.id' => $id))));
            $this->set('p_tags', $this->PreguntaTag->find("all", array('conditions' => array('pregunta' => $id))));
            $pv = $this->PreguntaVoto->find("all", array('conditions' => array('PreguntaVoto.pregunta_id' => $id), 'fields' => array('sum(PreguntaVoto.voto) AS voto')));
            $exists = $this->PreguntaVoto->find('first', array('conditions' => array('pregunta_id' => $id, 'usuario_id' => $user["id"])));


            if (sizeof($exists) > 0) {
                $this->set('vote', $exists["PreguntaVoto"]["voto"]);
            } else {
                $this->set('vote', 0);
            }
            $this->set('voto_preg', $pv[0][0]["voto"]);
            $this->set('respuestas', $this->Respuesta->query("SELECT *,IFNULL((SELECT voto from ip_respuesta_votos where ip_respuesta_votos.respuesta=Respuesta.id and usuario_id=" . $user["id"] . "),0) as voted,IFNULL((SELECT SUM(RespuestaVoto.voto) FROM ip_respuesta_votos as RespuestaVoto where RespuestaVoto.respuesta=Respuesta.id),0) as nvotes from ip_respuesta as Respuesta left outer join ip_respuesta_votos as RespuestaVoto on RespuestaVoto.respuesta=Respuesta.id inner join ip_usuario as Usuario on Respuesta.id_usuario_res=Usuario.id where Respuesta.pregunta=" . $id . " GROUP BY Respuesta.id ORDER BY mejor_respuesta desc,nvotes desc"));
            $this->render();
        }
    }

    public function bestAnswer() {
        if (AppController::isRequestOK($this->request)) {
            $res_id = $this->request->data("rid");
            $this->Respuesta->id = $res_id;
            $user = $this->Session->read('User');
            $preg = $this->Respuesta->field("pregunta");
            $this->Pregunta->id = $preg;
            $user_id = $this->Pregunta->field("id_usuario_preg");

            if ($user_id == $user["id"]) {
                $preg_id = $this->Respuesta->field("pregunta");

                $this->Respuesta->updateAll(array('mejor_respuesta' => null), array('Respuesta.pregunta' => $preg_id, 'mejor_respuesta' => 1));
                $this->Respuesta->saveField('mejor_respuesta', true);
                App::import('Controller', 'Email');
                $EmailController = new EmailController();
                $EmailController->bestAnswer($res_id);
                return new CakeResponse(array('body' => json_encode(array('title' => '¡Gracias!', 'text' => 'Has seleccionado la mejor respuesta a tu pregunta')), 'status' => 200));
            }
        }

        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    public function delBestAnswer() {
        if (AppController::isRequestOK($this->request)) {
            $res_id = $this->request->data("rid");
            $this->Respuesta->id = $res_id;
            $preg_id = $this->Respuesta->field("pregunta");
            $this->Respuesta->updateAll(array('mejor_respuesta' => null), array('Respuesta.pregunta' => $preg_id, 'mejor_respuesta' => 1));

            return new CakeResponse(array('body' => json_encode(array('title' => 'Realizado', 'text' => 'Esta ya no será más la mejor respuesta')), 'status' => 200));
        }


        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    public function saveRespuesta() {
        if (AppController::isRequestOK($this->request)) {
            $user = $this->Session->read('User');
            $resp = $this->request->data("resp");
            $pid = $this->request->data("pid");
            $this->Respuesta->create();
            $this->Respuesta->set("pregunta", $pid);
            $this->Respuesta->set("respuesta", $resp);
            $this->Respuesta->set("id_usuario_res", $user["id"]);
            $fecha = date('Y-m-d G:i:s', time() - 18000);
            $this->Respuesta->set("fecha_respuesta", $fecha);
            $this->Respuesta->save();
            if ($this->Respuesta->id > 0) {
                App::import('Controller', 'Email');
                $EmailController = new EmailController();

                $EmailController->quesAnswer($pid);
                $block = '<blockquote class="pull-left">
                                                    <div class="widget-main padding-6 no-padding-left no-padding-right">
                                                    <p>' . $resp . '</p>
                                                </div>
                                                    <small>
                                                Publicado por
                                               
                                                <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content="
                                                <img class=\'modal_img\' src=\'data:image/png;base64,' . $user["p_avatar"] . '\'/>
                                                <span id=\'profile-modal\'>
                                                  <br/>' . $user["ciudad"] . ' <i class=\'ace-icon fa fa-map-marker purple\'></i><br/>
                                               <p class=\'user_description\'> ' . $user["descripcion"] . ' </p>
                                               </span>" data-original-title="<i class=\'ace-icon fa fa-user purple\'></i> ' . $user["nombre"] . " " . $user["apellido"] . '" aria-describedby="popover34171"> <a href="../Usuarios/profile?uid=' . $user["id"] . '">' . $user["nombre"] . " " . $user["apellido"] . ' </a> </span>                                           
                                               <br/>
                                                    Fecha: ' . $fecha . '
                                                    </small>
                                        </blockquote>
                                        </div>
                                     </div>';
                return new CakeResponse(array('body' => json_encode(array('block' => $block, 'avatar' => $user["p_avatar"], 'id' => $this->Respuesta->id)), 'status' => 200));
            }
        }
        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Pregunta->exists($id)) {
            throw new NotFoundException(__('Invalid Pregunta'));
        }
        $options = array('conditions' => array('Pregunta.' . $this->Pregunta->primaryKey => $id));
        $this->set('Pregunta', $this->Pregunta->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if (AppController::isRequestOK($this->request)) {

            $this->Pregunta->create();

            $tags = $this->request->data("tags");
            $taga = explode(", ", $tags);
            $user = $this->Session->read("User");
            $this->Pregunta->set('id_usuario_preg', $user["id"]);
            $date = date('Y-m-d G:i:s', time() - 18000);

            if ($this->Pregunta->save($this->request->data)) {
                App::import('Controller', 'Email');
                $EmailController = new EmailController();
                $preg_id = $this->Pregunta->id;

                $this->Pregunta->saveField('fecha_pregunta', $date);

                foreach ($taga as $tag) {

                    $this->Tag->create();
                    $this->Tag->set('tag', $tag);
                    $this->Tag->set('area', $this->request->data("area"));
                    $this->Tag->save();
                    $this->PreguntaTag->create();
                    $this->PreguntaTag->set('pregunta', $this->Pregunta->id);
                    $this->PreguntaTag->set('tag', $this->Tag->id);
                    $this->PreguntaTag->save();
                }
                $n_preg = $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, (SELECT count(ip_respuesta.id) FROM ip_respuesta where ip_respuesta.pregunta=ip_pregunta.id ) as crespuesta, IFNULL((SELECT SUM(ip_pregunta_votos.voto) FROM ip_pregunta_votos where ip_pregunta_votos.pregunta_id=ip_pregunta.id),0) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_pregunta_votos on pregunta_id=ip_pregunta.id left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_pregunta.id=" . $this->Pregunta->id);

                $EmailController->seguidorPregunta($user, $this->request->data("area"), $preg_id, $n_preg[0]["ip_area"]["area"]);
                return new CakeResponse(array('body' => json_encode(array('npreg' => $n_preg, 'id' => $this->Pregunta->id)), 'status' => 200));
            } else {
                
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
        if (!$this->Pregunta->exists($id)) {
            throw new NotFoundException(__('Invalid Pregunta'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Pregunta->save($this->request->data)) {
                $this->Session->setFlash(__('The Pregunta has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Pregunta could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Pregunta.' . $this->Pregunta->primaryKey => $id));
            $this->request->data = $this->Pregunta->find('first', $options);
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
        $this->Pregunta->id = $id;
        if (!$this->Pregunta->exists()) {
            throw new NotFoundException(__('Invalid Pregunta'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Pregunta->delete()) {
            $this->Session->setFlash(__('The Pregunta has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Pregunta could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
