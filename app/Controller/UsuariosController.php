<?php

App::uses('AppController', 'Controller');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 */
class UsuariosController extends AppController {

    /**
     * Components
     *
     * @var array   
     */
    public $components = array(
        'Paginator', 'Session'
    );
    var $uses = array('Area', 'Pregunta', 'Tag', 'Reporte', 'Respuesta', 'UsuarioCalificacion', 'Colegio', 'Universidad', 'Contacto', 'ProfesorExperiencia', 'ProfesorEducacion', 'Follow', 'Instituto', 'Usuario', 'UsuarioInstituto', 'UsuarioArea', 'UsuarioTag', 'ProfesorArea');

    function logout() {
        $this->Session->write('init', false);
        $this->Session->write('User', null);
        $this->layout = "login";
        $this->redirect('../Home');
    }

    public function getFollowers() {
        if (AppController::authReturnLogin()) {
            $uid = $this->request->data("uid");

            if ($uid < 0) {
                $user = $this->Session->read('User');
                $uid = $user["id"];
            }
            $follow = $this->Follow->find('all', array('conditions' => array('usuario_seguido' => $uid), 'joins' => array(
                    array(
                        'table' => 'usuario',
                        'alias' => 'Usuario',
                        'type' => 'inner',
                        'conditions' => array('Usuario.id=Follow.usuario_sigue')
                    )), 'fields' => array("Usuario.id,Usuario.nombre,Usuario.ciudad,Usuario.tipo,Usuario.apellido,Usuario.p_avatar")));
            $i = 0;
            foreach ($follow as $user) {
                if ($user["Usuario"]["tipo"] == 3) {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-briefcase grey'></i> Profesor";
                } else if ($user["Usuario"]["tipo"] == 2) {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-graduation-cap grey'></i> Estudiante";
                } else {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-user grey'></i> Padre de familia";
                }

                $i++;
            }

            return new CakeResponse(array('body' => json_encode(array('data' => $follow)), 'status' => 200));
        }
    }

    public function denunciar() {
        if (AppController::authReturnLogin()) {
            $uid = $this->request->data("uid");
            $motivo = $this->request->data("msj");
            $user = $this->Session->read('User');
            $this->Reporte->create();
            $this->Reporte->saveField('usuario_reporta', $user["id"]);
            $this->Reporte->saveField('usuario_reportado', $uid);
            $this->Reporte->saveField('motivo', $motivo);
            $this->Reporte->saveField('fecha', date('Y-m-d H:i:s', time() - (3600 * 5)));
            $this->autoRender = false;
        }
    }

    public function getFollowing() {

        if (AppController::authReturnLogin()) {
            $uid = $this->request->data("uid");

            if ($uid < 0) {
                $user = $this->Session->read('User');
                $uid = $user["id"];
            }
            $follow = $this->Follow->find('all', array('conditions' => array('usuario_sigue' => $uid), 'joins' => array(
                    array(
                        'table' => 'usuario',
                        'alias' => 'Usuario',
                        'type' => 'inner',
                        'conditions' => array('Usuario.id=Follow.usuario_seguido')
                    )), 'fields' => array("Usuario.id,Usuario.nombre,Usuario.ciudad,Usuario.tipo,Usuario.apellido,Usuario.p_avatar")));
            $i = 0;
            foreach ($follow as $user) {
                if ($user["Usuario"]["tipo"] == 3) {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-briefcase grey'></i> Profesor";
                } else if ($user["Usuario"]["tipo"] == 2) {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-graduation-cap grey'></i> Estudiante";
                } else {
                    $follow[$i]["Usuario"]["tipo"] = "<i class='ace-icon fa fa-user grey'></i> Padre de familia";
                }

                $i++;
            }
            return new CakeResponse(array('body' => json_encode(array('data' => $follow)), 'status' => 200));
        }
    }

    public function index() {
        if (AppController::checkAuth()) {
            $user = $this->Session->read('User');
            $auth = $this->getUsuario(array('Usuario.id' => $user["id"]));
            $type = $user["tipo"];
            $completo = $user["completo"];
            $this->Session->write('User', $auth['Usuario']);
            $this->typeRedir($type, $completo);
        } else {
            $this->layout = "login";

            $this->render();
        }
    }

    public function createUser($email, $password, $tipo, $user) {
        if (sizeof($user) == 0 && strlen($password) >= 5 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Usuario->saveField('pass', $password);
                $this->Usuario->saveField('tipo', $tipo);
                $this->Usuario->saveField('completo', false);
                $date = date('Y-m-d G:i:s', time() - 18000);
                $this->Usuario->saveField('fecha_inscripcion', $date);
                $auth = $this->getUsuario(array('id' => $this->Usuario->id));
                $this->Session->write('init', true);
                $this->Session->write('User', $auth['Usuario']);
                $type = $auth['Usuario']['tipo'];
                $menor = $auth['Usuario']['menor'];
                $completo = 0;


                $this->typeRedir($type, $completo);
            }
        } else if (sizeof($user) > 0) {
            $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;Ya hay un usuario registrado con este correo. Por favor ingrese otro correo. &nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
            $this->redirect("../Usuarios");
        } else if (strlen($password) < 5) {
            $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                  La contraseña debe tener al menos 5 caracteres. &nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
            $this->redirect("../Usuarios");
        } else {
            $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                  El formato del correo es invalido. &nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
            $this->redirect("../Usuarios");
        }
    }

    public function register() {
        $this->autoRender = false;

        $tipo = $this->request->data("rol");
        $password = $this->request->data("password");
        $email = $this->request->data("email");
        $user = $this->getUsuario(array('email' => $email));
        $this->createUser($email, $password, $tipo, $user);
    }

    /**
     * index method
     *
     * @return void
     */
    public function typeRedir($type, $completo) {
        $c = "Profile";

        if ($completo == 0) {

            $this->Session->setFlash('<div class="clearfix">
 										<div class="pull-left alert alert-danger no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button><i class="ace-icon fa fa-user bigger-120 blue"></i>
										Tu perfil esta incompleto, complétalo para continuar.&nbsp;   
									</div></div><div class="hr dotted"></div>
								');
        }

        if ($type == -1) {
            $this->redirect('/Admin/' . $c);
        }
        if ($type == 3) {
            $this->redirect('/Profesor/' . $c);
        }
        if ($type == 2) {
            $this->redirect('/Estudiante/' . $c);
        }
        if ($type == 1) {
            $this->redirect('/Padre/' . $c);
        }
    }

    public function insertInstituto($inst, $tipo) {
        $this->Instituto->create();
        $this->Instituto->saveField('tipo', $tipo);
        $this->Instituto->saveField('instituto', $inst);
        if ($tipo == 2) {
            $this->Universidad->create();
            $this->Universidad->saveField('nombre', $inst);
        }
        if ($tipo == 1) {
            $this->Colegio->create();
            $this->Colegio->saveField('nombre', $inst);
        }
        return $this->Instituto->id;
    }

    public function insertUsuarioInstituto($inst, $user) {
        $this->UsuarioInstituto->create();
        $this->UsuarioInstituto->saveField('usuario', $user);
        $this->UsuarioInstituto->saveField('instituto', $inst);
        return $this->UsuarioInstituto->id;
    }

    public function insertBoth($inst, $tipo, $user) {
        if ($inst != "") {

            $inst_id = $this->insertInstituto($inst, $tipo);

            $this->insertUsuarioInstituto($inst_id, $user);
        }
    }

    public function saveProfile() {
        $this->layout = null;
        $this->autoRender = false;
        if ($this->request->is('post')) {


            $user = $this->Session->read("User");

            $this->Usuario->id = $user["id"];


            $time = strtotime($this->request->data("fecha_nacimiento"));
            $date = date('Y-m-d', $time);
            $data = $this->request->data;

            if ($this->request->data('pass') === "") {
                unset($data["pass"]);
            }


            if ($this->Usuario->save($data)) {
                $this->Usuario->recursive = 0;
                $this->Usuario->saveField('fecha_nacimiento', $date);

                $this->Usuario->saveField('contactar', $this->request->data('contactar'));
                $this->Usuario->saveField('negociable', $this->request->data('negociable'));

                //explode the date to get month, day and year

                $tz = new DateTimeZone('America/Bogota');
                //get age from date or birthdate
                $age = DateTime::createFromFormat('Y-m-d', $date, $tz)
                                ->diff(new DateTime('now', $tz))
                        ->y;

                $menor = false;
                $email = $this->request->data('email');
                if ($age < 14) {
                    $menor = true;
                    $this->Usuario->saveField('menor', true);
                    $email = $this->request->data('email_padre');
                } else {
                    $this->Usuario->saveField('menor', false);
                }
                $auth = $this->getUsuario(array('Usuario.id' => $this->Usuario->id));
                if ($user["completo"] == 0) {

                    App::import('Controller', 'Email');
                    $EmailController = new EmailController();
                    if (!$menor) {
                        $EmailController->emailRegisterEstudiante($email);
                    } else {
                        $EmailController->emailMenorRegister($email);
                    }

                    $this->Usuario->saveField('completo', true);
                }

                $cole = $this->request->data('nom-cole');
                $univ = $this->request->data('nom-univ');
                $otro = $this->request->data('nom-otro');
                $edu = $this->request->data('tipo_edu');
                $p_avatar = $auth["Usuario"]["p_avatar"];
                if ($p_avatar == "") {
                    $p_avatar = "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";

                    if ($this->request->data('sexo') == "F") {
                        $p_avatar = "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AHg4QklNBBkAAAAAAAQAAAAeOEJJTQPzAAAAAAAJAAAAAAAAAAABADhCSU0nEAAAAAAACgABAAAAAAAAAAI4QklNA/UAAAAAAEgAL2ZmAAEAbGZmAAYAAAAAAAEAL2ZmAAEAoZmaAAYAAAAAAAEAMgAAAAEAWgAAAAYAAAAAAAEANQAAAAEALQAAAAYAAAAAAAE4QklNA/gAAAAAAHAAAP////////////////////////////8D6AAAAAD/////////////////////////////A+gAAAAA/////////////////////////////wPoAAAAAP////////////////////////////8D6AAAOEJJTQQAAAAAAAACAAE4QklNBAIAAAAAAAQAAAAAOEJJTQQwAAAAAAACAQE4QklNBC0AAAAAAAYAAQAAAAI4QklNBAgAAAAAABAAAAABAAACQAAAAkAAAAAAOEJJTQQeAAAAAAAEAAAAADhCSU0EGgAAAAADTQAAAAYAAAAAAAAAAAAAAMgAAADIAAAADABTAGkAbgAgAHQA7QB0AHUAbABvAC0AMQAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAyAAAAMgAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAQAAAAAAAG51bGwAAAACAAAABmJvdW5kc09iamMAAAABAAAAAAAAUmN0MQAAAAQAAAAAVG9wIGxvbmcAAAAAAAAAAExlZnRsb25nAAAAAAAAAABCdG9tbG9uZwAAAMgAAAAAUmdodGxvbmcAAADIAAAABnNsaWNlc1ZsTHMAAAABT2JqYwAAAAEAAAAAAAVzbGljZQAAABIAAAAHc2xpY2VJRGxvbmcAAAAAAAAAB2dyb3VwSURsb25nAAAAAAAAAAZvcmlnaW5lbnVtAAAADEVTbGljZU9yaWdpbgAAAA1hdXRvR2VuZXJhdGVkAAAAAFR5cGVlbnVtAAAACkVTbGljZVR5cGUAAAAASW1nIAAAAAZib3VuZHNPYmpjAAAAAQAAAAAAAFJjdDEAAAAEAAAAAFRvcCBsb25nAAAAAAAAAABMZWZ0bG9uZwAAAAAAAAAAQnRvbWxvbmcAAADIAAAAAFJnaHRsb25nAAAAyAAAAAN1cmxURVhUAAAAAQAA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OTozNzoxMC0wNTowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0ODk0QkIxRjhFMzRFNDExOUZCREM4RkY0QkZCMzlDNyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo0Nzk0QkIxRjhFMzRFNDExOUZCREM4RkY0QkZCMzlDNyIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjQ3OTRCQjFGOEUzNEU0MTE5RkJEQzhGRjRCRkIzOUM3IiBkYzpmb3JtYXQ9ImltYWdlL2pwZWciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ3OTRCQjFGOEUzNEU0MTE5RkJEQzhGRjRCRkIzOUM3IiBzdEV2dDp3aGVuPSIyMDE0LTA5LTA0VDE5OjM3OjEwLTA1OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6NDg5NEJCMUY4RTM0RTQxMTlGQkRDOEZGNEJGQjM5QzciIHN0RXZ0OndoZW49IjIwMTQtMDktMDRUMTk6Mzc6MTAtMDU6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg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";
                    }
                }
                $this->Usuario->saveField('p_avatar', $p_avatar);
                $auth = $this->getUsuario(array('Usuario.id' => $this->Usuario->id));
                $this->Session->write('User', $auth["Usuario"]);
                $this->UsuarioInstituto->deleteAll(array('usuario' => $user["id"]));
                $i = 0;
                while ($i < sizeof($cole)) {
                    $this->insertBoth($cole[$i], 1, $user["id"]);
                    $i++;
                }
                $i = 0;
                while ($i < sizeof($univ)) {
                    $this->insertBoth($univ[$i], 2, $user["id"]);
                    $i++;
                }
                $i = 0;
                while ($i < sizeof($otro)) {
                    $this->insertBoth($otro[$i], 3, $user["id"]);
                    $i++;
                }

                if ($user["tipo"] == 3) {
                    $cont = 0;
                    $this->ProfesorEducacion->deleteAll(array('profesor' => $user["id"]));
                    $this->ProfesorExperiencia->deleteAll(array('profesor' => $user["id"]));

                    while ($cont < sizeof($data["tipo_edu"])) {

                        $tipoedu = $data["tipo_edu"][$cont];
                        $nominst = $data["nombre_inst"][$cont];
                        $yearinst = $data["year_inst"][$cont];
                        $instedu = $data["inst_edu"][$cont];
                        $titulo = $data["titulo"][$cont];
                        if ($nominst != "" && $yearinst != "") {
                            $this->ProfesorEducacion->create();
                            $this->ProfesorEducacion->saveField('profesor', $user["id"]);
                            $this->ProfesorEducacion->saveField('tipo', $tipoedu);
                            $this->ProfesorEducacion->saveField('instituto_nombre', $nominst);
                            $this->ProfesorEducacion->saveField('instituto_tipo', $instedu);
                            $this->ProfesorEducacion->saveField('titulo', $titulo);
                            $this->ProfesorEducacion->saveField('ano', $yearinst);
                        } $cont++;
                    }
                    $cont = 0;

                    while ($cont < sizeof($data["tipo_exp"])) {
                        $tipoedu = $data["tipo_exp"][$cont];
                        $nominst = $data["inst_exp"][$cont];
                        $yearinst = $data["year_exp"][$cont];
                        $rolexp = $data["rol_exp"][$cont];
                        if ($rolexp != "" && $yearinst != "") {
                            $this->ProfesorExperiencia->create();
                            $this->ProfesorExperiencia->saveField('profesor', $user["id"]);
                            $this->ProfesorExperiencia->saveField('tipo', $tipoedu);
                            $this->ProfesorExperiencia->saveField('nombre', $nominst);
                            $this->ProfesorExperiencia->saveField('rol', $rolexp);
                            $this->ProfesorExperiencia->saveField('anos', $yearinst);
                        }$cont++;
                    }
                }


                $this->Session->setFlash('
                                        <div class="clearfix">
                                        <div class="pull-left alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>

                                        <i class="ace-icon fa fa-user bigger-120 blue"></i>
                                       ¡Haz actualizado tu perfil!&nbsp;   
                                    </div></div><div class="hr dotted"></div>
                                ');

                return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
            } else {

                $this->Session->setFlash(__('Ocurrio un error, intentalo de nuevo.'));
            }
        } else {
            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function contactar() {
        if (AppController::checkAuth()) {
            $id = $this->request->data("id");
            $this->Contacto->saveField("id_contactado", $id);
            $usr = $this->Session->read("User");
            $uid = $usr["id"];
            $this->Contacto->saveField("id_contactador", $uid);
            $date = date('Y-m-d G:i:s', time() - 18000);
            $this->Contacto->saveField("fecha", $date);
            $contacto = $this->getUsuario(array('id' => $id));
            $contacto = $contacto["Usuario"];
            $usrname = $contacto["nombre"];
            $usr2name = $contacto["apellido"];
            $avatar = $contacto["p_avatar"];
            $html = '<h4 class="blue smaller">Información de Contacto</h4>
                            <div class="hr hr12 dotted"></div>
                            
                            <div class="clearfix" id="profile-user-info">
                             
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Email: </div>

                                            <div class="profile-info-value">
                                                    <span>' . $contacto["email"] . '</span>
                                            </div>
                                    </div>';
            if ($contacto["telefono1"] !== null && $contacto["telefono1"] !== "") {
                $html.='<div class="profile-info-row">
                                                 <div class="profile-info-name"> Celular </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-mobile-phone light-orange bigger-110"></i>
                                                      <span>' . $contacto["telefono1"] . '</span>
                                            </div>
                                    </div>';
            }if ($contacto["telefono2"] !== null && $contacto["telefono2"] !== "") {
                $html.='<div class="profile-info-row">
                                                 <div class="profile-info-name"> Teléfono 2 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span>' . $contacto["telefono2"] . '</span>
                                            </div>
                                    </div>';
            }
            if ($contacto["telefono3"] !== null && $contacto["telefono3"] !== "") {
                $html.='<div class="profile-info-row">
                                            <div class="profile-info-name"> Teléfono 3 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span>' . $contacto["telefono3"] . '</span>
                                            </div>
                                    </div>';
            }
            $html.='</div>
                            </div>';
            if ($usr["menor"] == 1) {
                $html = "Se ha enviado un email a tu acudiente con los datos de este usuario para que lo contacte.";
                App::import('Controller', 'Email');
                $EmailController = new EmailController();
                $EmailController->contactoMenorEmail($usr, $contacto);
            }
            return new CakeResponse(array('body' => json_encode(array('title' => 'Gracias por contactar a ' . $usrname . ' ' . $usr2name . '!', 'html' => $html, 'text' => 'Sus datos han sido enviados a tu correo, además, puedes ver los datos de este usuario en su perfil', 'avatar' => $avatar)), 'status' => 200));
        } else {

            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function seguir() {
        if (AppController::checkAuth()) {
            $id = $this->request->data("id");
            $usr = $this->Session->read("User");
            $uid = $usr["id"];
            $followed = $this->Follow->find('first', array('conditions' => array("usuario_sigue" => $uid, "usuario_seguido" => $id)));
            if (sizeof($followed) == 0) {
                $this->Follow->saveField("usuario_seguido", $id);
                $this->Follow->saveField("usuario_sigue", $uid);
                $date = date('Y-m-d G:i:s', time() - 18000);
                $this->Follow->saveField("fecha", $date);
                $auth = $this->getUsuario(array('id' => $id));
                $user = $auth["Usuario"];
                $usrname = $user["nombre"];
                $usr2name = $user["apellido"];
                $avatar = $auth["Usuario"]["p_avatar"];
                return new CakeResponse(array('body' => json_encode(array('title' => '¡Haz empezado a seguir a ' . $usrname . ' ' . $usr2name . '!', 'text' => 'Recibirás notificaciones sobre su actividad', 'avatar' => $avatar)), 'status' => 200));
            }
            return new CakeResponse(array('body' => json_encode(array('title' => '¡Ya sigues a ' . $usrname . ' ' . $usr2name . '!', 'text' => 'Estas siguiendo a este usuario', 'avatar' => $avatar)), 'status' => 200));
        } else {

            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    public function dejar() {
        if (AppController::checkAuth()) {
            $id = $this->request->data("id");

            $usr = $this->Session->read("User");
            $uid = $usr["id"];

            $this->Follow->deleteAll(array('Follow.usuario_seguido' => $id, 'Follow.usuario_sigue' => $uid));
            $auth = $this->getUsuario(array('id' => $id));

            $usrname = $auth["Usuario"]["nombre"];
            $usr2name = $auth["Usuario"]["apellido"];
            $avatar = $auth["Usuario"]["p_avatar"];
            return new CakeResponse(array('body' => json_encode(array('title' => '¡Haz dejado de seguir a ' . $usrname . ' ' . $usr2name . '!', 'class' => 'gritter-error', 'text' => 'Su actividad no aparecerá en tu linea del conocimiento', 'avatar' => $avatar)), 'status' => 200));
        } else {

            return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
        }
    }

    private function login($user, $pass) {
        $auth = $this->getUsuario(array('Usuario.email' => $user, "Usuario.pass='" . $pass . "'"));

        $sw = true;

        if (sizeof($auth) > 0) {
            if ($auth["Usuario"]["id"] > 0) {

                $this->Session->write('init', true);
                $this->Session->write('User', $auth['Usuario']);
                $completo = $auth['Usuario']['completo'];
                $type = $auth['Usuario']['tipo'];
                $sw = false;
                $this->typeRedir($type, $completo);
                return true;
            }
        } else {
            return false;
        }
    }

    public function authOrRegister() {
        App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
        $email = $this->request->data("email");
        $passw = $this->request->data("password");
        $lor = $this->request->data("lor");
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        $pass = $passwordHasher->hash(
                $passw
        );
        $rol = $this->request->data("rol");
        $user = $this->getUsuario(array('email' => $email));

        if ($lor == "l") {
            if (sizeof($user) > 0) {
                if (!$this->login($email, $pass)) {
                    $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;    Nombre de usuario/contraseña incorrectos.&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
                    $this->Session->write('init', false);
                    $this->Session->write('User', null);
                    $this->redirect(
                            array('controller' => 'Home', 'action' => 'index')
                    );
                }
            } else {
                $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;    Nombre de usuario/contraseña incorrectos.&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
                $this->Session->write('init', false);
                $this->Session->write('User', null);
                $this->redirect(
                        array('controller' => 'Home', 'action' => 'index')
                );
            }
        } else if ($lor = "r") {
            if (sizeof($user) > 0) {
                $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;Ya hay un usuario registrado con este correo. Por favor ingrese otro correo. &nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
                $this->Session->write('init', false);
                $this->Session->write('User', null);
                $this->redirect(
                        array('controller' => 'Home', 'action' => 'index')
                );
            } else {

                $this->createUser($email, $passw, $rol, $user);
            }
        }

        $this->autoRender = false;
    }

    public function auth() {
        App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
        $this->autoRender = false;
        $user = $this->request->data("user");
        $pass = $this->request->data("pass");

        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        $this->Session->write('init', false);
        $this->Session->write('User', null);
        if ($user !== "" && $pass != "") {
            $pass = $passwordHasher->hash(
                    $pass
            );

            if (!$this->login($user, $pass)) {
                $this->Session->write('init', false);
                $this->Session->write('User', null);
                $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;    Nombre de usuario/contraseña incorrectos.&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
                $this->redirect(
                        array('controller' => 'Home', 'action' => 'index')
                );
            }
        } else {
            $this->Session->write('init', false);
            $this->Session->write('User', null);
            $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;    Nombre de usuario/contraseña incorrectos.&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
            $this->redirect(
                    array('controller' => 'Home', 'action' => 'index')
            );
        }
    }

    public function calendar() {

        $this->render('calendar');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function getUsuario($array_c) {
        $fields = array_keys($this->Usuario->getColumnTypes());
        $key = array_search('pass', $fields);
        unset($fields[$key]);
        $auth = $this->Usuario->find('first', array(
            'conditions' => $array_c,
            'fields' => $fields
        ));

        return $auth;
    }

    public function getUsuarios() {
        $user = $this->request->data("user");

        $auth = $this->Usuario->find('all', array(
            'conditions' => array("CONCAT(nombre,' ',apellido) LIKE '%|" . $user . "%' OR nombre  LIKE '%|$user%' ESCAPE '|' LIMIT 0,5")
        ));

        return new CakeResponse(array('body' => json_encode(array('users' => $auth)), 'status' => 200));
    }

    public function getCalificacion($uid) {
        $sum = $this->UsuarioCalificacion->find('all', array(
            'conditions' => array(
                'UsuarioCalificacion.usuario_calificado' => $uid),
            'fields' => array('sum(calificacion) as total_sum'
            )
                )
        );
        $count = $this->UsuarioCalificacion->find('count', array('conditions' => array('UsuarioCalificacion.usuario_calificado' => $uid)));
        $sum = $sum[0][0]["total_sum"];
        $total = $sum;
        if ($sum > 0) {
            $total = $sum / $count;
            $total = round($total, 1, PHP_ROUND_HALF_DOWN);
        }
        return $total;
    }

    //profile
    public function profile() {
        if (AppController::authReturnLogin()) {
            $uid = $this->request->query["uid"];
            $auth = $this->getUsuario(array('Usuario.id' => $uid));
            $user = $this->Session->read("User");

            $this->Session->write('UserProfile', $auth['Usuario']);
            if ($auth["Usuario"]["completo"] == 0) {
                $this->Session->setFlash('<div class="clearfix">
                                        <div class="pull-left alert alert-danger no-margin">
                                        <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                        </button><i class="ace-icon fa fa-user bigger-120 blue"></i>
                                        Este usuario no ha completado su perfil!&nbsp;   
                                        </div></div><div class="hr dotted"></div>
                                        ');
            }

            $this->set('seguido', $this->Follow->find('count', array('conditions' => array('usuario_seguido' => $uid, 'usuario_sigue' => $user["id"]))));
            $this->set('seguidores', $this->Follow->find('count', array('conditions' => array('usuario_seguido' => $uid))));
            $this->set('u_seguidores', $this->Follow->find('all', array('conditions' => array('usuario_seguido' => $uid))));
            $this->set('siguiendo', $this->Follow->find('count', array('conditions' => array('usuario_sigue' => $uid))));
            $this->set('u_siguiendo', $this->Follow->query("SELECT ip_usuario.* FROM ip_usuario inner join Instaprofe.ip_follow on ip_follow.usuario_seguido=ip_usuario.id where usuario_sigue=" . $uid));

            $this->set('contactado', $this->Contacto->find('count', array('conditions' => array('id_contactado' => $uid, 'id_contactador' => $user["id"]))));

            $this->set('p_hechas', $this->Pregunta->find('count', array('conditions' => array('id_usuario_preg' => $uid))));
            $this->set('p_resueltas', $this->Respuesta->find('count', array('conditions' => array('id_usuario_res' => $uid))));
            $this->set('m_respuestas', $this->Respuesta->find('count', array('conditions' => array('id_usuario_res' => $uid, 'mejor_respuesta' => true))));

            if ($auth["Usuario"]["tipo"] === "3") {
                $this->set('stars', $this->getCalificacion($uid));
                $this->set('myrating', $this->UsuarioCalificacion->find('first', array('conditions' => array('UsuarioCalificacion.usuario_calificado' => $uid, 'UsuarioCalificacion.usuario_califica' => $user["id"]))));
                $this->set('calificado', $this->UsuarioCalificacion->find('count', array('conditions' => array('UsuarioCalificacion.usuario_calificado' => $uid, 'UsuarioCalificacion.usuario_califica' => $user["id"]))));
                $this->set('contratado', $this->Contacto->find('first', array('conditions' => array('id_contactado' => $uid, 'id_contactador' => $user["id"]), 'fields' => array('contactado'))));
                $this->set('u_area', $this->ProfesorArea->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_profesor_area on ip_profesor_area.profesor=ip_usuario.id inner join ip_area on ip_profesor_area.area=ip_area.id where ip_usuario.id=" . $uid . " AND ip_area.id<=31"));
                $this->set('n_contactos', $this->Contacto->find('count', array('conditions' => array('id_contactado' => $uid))));
                $this->set('profe_edu', $this->getRawEducacion($uid));
                $this->set('numvotos', $this->UsuarioCalificacion->find('count', array('conditions' => array('UsuarioCalificacion.usuario_calificado' => $uid))));
                $this->set('profe_exp', $this->getRawExp($uid));
            } else {
                $this->set('u_area', $this->UsuarioArea->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_usuario_area on ip_usuario_area.usuario=ip_usuario.id inner join ip_area on ip_usuario_area.area=ip_area.id where ip_usuario.id=" . $uid . " AND ip_area.id<=31"));
                $this->set('n_contactos', $this->Contacto->find('count', array('conditions' => array('id_contactador' => $uid))));
            }
            $this->set('u_instituto', $this->Instituto->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_usuario_instituto on ip_usuario_instituto.usuario=ip_usuario.id inner join ip_instituto on ip_instituto.id=ip_usuario_instituto.instituto where ip_usuario.id=" . $uid));
            $this->set('u_tags', $this->UsuarioTag->query("SELECT * FROM Instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=" . $uid));
            $this->render();
        }
    }

    public function file_upload() {
        $this->layout = null;
        $this->render('file_upload');
    }

    public function getThemes() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $area = $this->request->data("area");
            $user = $this->Session->read('User');
            $this->UsuarioTag->recursive = 0;
            $ut = $this->UsuarioTag->query("SELECT * FROM Instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=" . $user["id"] . " AND area=" . $area);
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

    public function getThemesUser() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $area = $this->request->data("area");
            $uid = $this->request->data("uid");
           
            $this->UsuarioTag->recursive = 0;
            $ut = $this->UsuarioTag->query("SELECT * FROM Instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=" . $uid . " AND area=" . $area);
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

    public function calificar() {
        if (AppController::isRequestOK($this->request)) {
            $uid = $this->request->data("uid");
            $val = $this->request->data("val");
            $user = $this->Session->read("User");
            $califica = $this->UsuarioCalificacion->find('first', array('conditions' => array('UsuarioCalificacion.usuario_calificado' => $uid, 'UsuarioCalificacion.usuario_califica' => $user["id"])));
            if (sizeof($califica) == 0) {
                $this->UsuarioCalificacion->create();
                $this->UsuarioCalificacion->saveField('usuario_califica', $user["id"]);
                $this->UsuarioCalificacion->saveField('calificacion', $val);
                $this->UsuarioCalificacion->saveField('usuario_calificado', $uid);
                $date = date('Y-m-d G:i:s', time() - 18000);
                $this->UsuarioCalificacion->saveField('fecha', $date);
                $calificado = $this->getUsuario(array('Usuario.id' => $uid));
                $sum = $this->getCalificacion($uid);
            } else {
                $this->UsuarioCalificacion->updateAll(array('calificacion' => $val), array('UsuarioCalificacion.usuario_calificado' => $uid, 'UsuarioCalificacion.usuario_califica' => $user["id"]));
                $calificado = $this->getUsuario(array('Usuario.id' => $uid));
                $sum = $this->getCalificacion($uid);
            }
            return new CakeResponse(array('body' => json_encode(array('title' => "¡Gracias!", 'sum' => $sum, 'msg' => 'Has calificado al usuario ' . $calificado["Usuario"]["nombre"] . ' ' . $calificado["Usuario"]["apellido"] . ' con ' . $val . ' estrellas!')), 'status' => 200));
        }
        return new CakeResponse(array('body' => json_encode(array('message' => 'FAIL')), 'status' => 500));
    }

    //busca profe
    public function buscarProfe() {
        $this->autoRender = false;
        $area = $this->request->data("area");
        $ciudad = $this->request->data("ciudad");
        $temas = $this->request->data("temas");
        $inst = $this->request->data("inst");
        $tipo = $this->request->data("tipo");
        $ini = $this->request->data("ini");
        $fin = $this->request->data("fin");
        if ($area != "") {
            $this->Usuario->recursive = 0;
            $city_where = "";
            if ($ciudad != "") {
                $city = explode(",", $ciudad)[0];
                $city_where = "and Usuario.ciudad LIKE '" . $city . "%'";
            }
            $temas_inner = "";
            $temas_where = "";
            if ($temas != "null") {
                $temas_inner = "inner join ip_usuario_tags on ip_usuario_tags.usuario=Usuario.id
                    inner join ip_tags on ip_usuario_tags.tags_id=ip_tags.id";
                $temas_where = "";
                $temas = json_decode(stripslashes($temas));
                foreach ($temas as $tema) {
                    if ($temas_where === "") {
                        $temas_where.="and (ip_tags.tag like '" . $tema . "'";
                    } else {
                        $temas_where.=" or ip_tags.tag like '" . $tema . "'";
                    }
                }
                $temas_where.=")";
            }
            $inst_where = "";
            if (!empty($inst)) {
                $inst_where = "and Instituto.instituto LIKE '%" . $inst . "%'";
            }
            $area_tipo = "inner join ip_profesor_area on ip_profesor_area.profesor=Usuario.id";
            $table_area = "ip_profesor_area";
            $contact = "";
            if ($tipo != 3) {
                $table_area = "ip_usuario_area";
                $area_tipo = "inner join " . $table_area . " on ip_usuario_area.usuario=Usuario.id";
                $contact = 'left outer join ip_contacto on ip_contacto.id_contactado=Usuario.id';
            }

            if ((intval($ini) < 0 || intval($fin) > 30)) {
                $ini = 0;
                $fin = 10;
            }

            $query = "
(SELECT COUNT(ip_contacto.id) FROM ip_contacto WHERE ip_contacto.id_contactado=Usuario.id) as contact,
(SELECT COUNT(ip_respuesta.id) FROM ip_respuesta WHERE ip_respuesta.id_usuario_res=Usuario.id) as count,
(SELECT COUNT(ip_pregunta.id) FROM ip_pregunta WHERE ip_pregunta.id_usuario_preg=Usuario.id) as pregs,
(SELECT SUM(ip_respuesta.mejor_respuesta) FROM ip_respuesta where ip_respuesta.id_usuario_res=Usuario.id)  as mres,
(SELECT sum(ip_usuario_calificacion.calificacion) FROM ip_usuario_calificacion where ip_usuario_calificacion.usuario_calificado=Usuario.id) as total_sum,
(SELECT COUNT(ip_usuario_calificacion.calificacion) FROM ip_usuario_calificacion where ip_usuario_calificacion.usuario_calificado=Usuario.id) as count_votes
 FROM ip_usuario as Usuario 
                " . $area_tipo . " inner join ip_area on ip_area.id=" . $table_area . ".area " . $temas_inner . "
                left outer join ip_usuario_instituto on Usuario.id=ip_usuario_instituto.usuario
                left outer join ip_instituto as Instituto on ip_usuario_instituto.instituto=Instituto.id
                left outer join ip_respuesta as Respuesta on id_usuario_res=Usuario.id
                left outer join ip_pregunta as Pregunta on id_usuario_preg=Usuario.id
                left outer join ip_usuario_calificacion as UsuarioCalificacion on
                UsuarioCalificacion.usuario_calificado=Usuario.id
                " . $contact . "
            where  ip_area.id=" . $area . " and Usuario.tipo=" . $tipo . "
            " . $city_where . " 
            " . $temas_where . " 
            " . $inst_where . "    
            group by Usuario.id order by completo desc,total_sum desc,mres desc,count desc,pregs desc";
            $count = $this->Usuario->query("SELECT COUNT(*) as c FROM (SELECT " . $query . ") T");
            $data = $this->Usuario->query("SELECT DISTINCT *," . $query . " LIMIT " . $ini . "," . $fin);

            $bus = "estudiantes";
            if ($tipo == 3) {
                $bus = "profesores";
            }
            if (sizeof($data) == 0) {
                return new CakeResponse(array('body' => json_encode(array('message' => 'No se han encontrado ' . $bus . ' que cumplan con ese criterio.', 'title' => '¡Error!')), 'status' => 500));
            } else {
                $i = 0;
                foreach ($data as $d) {
                    $data[$i]['0']['total_sum'] = $this->getCalificacion($d["Usuario"]["id"]);
                    $i++;
                }
                return new CakeResponse(array('body' => json_encode(array('data' => $data, 'count' => $count[0][0], 'size' => sizeof($data))), 'status' => 200));
            }
        }
        return new CakeResponse(array('body' => json_encode(array('message' => 'Especifica un Área', 'title' => '¡Error!')), 'status' => 500));
    }

//    public function FBLogin() {
//        $res = $this->request->data("response");
//        $email = $res["email"];
//        $name = $res["name"];
//        $lname = $res["lname"];
//        $uid = $res["id"];
//        $gender = $res["gender"];
//        $auth = $this->getUsuario(array('Usuario.email' => $user));
//        $sw = true;
//
//
//        if ($size($auth) > 0) {
//
//            $this->Session->write('init', true);
//            $this->Session->write('User', $auth['Usuario']);
//            $completo = $auth['Usuario']['completo'];
//            $type = $auth['Usuario']['tipo'];
//            $sw = false;
//            $this->typeRedir($type, $completo);
//        } else {
//            $this->Usuario->create();
//            $this->Usuario->saveField('email', $email);
//            $this->Usuario->saveField('sexo', substr($gender, 0, 1));
//            $this->Usuario->saveField('nombre', $name);
//            $this->Usuario->saveField('apellido', $lname);
//            $auth = $this->getUsuario(array('id' => $this->Usuario->id));
//            $this->Session->write('init', true);
//            $this->Session->write('User', $auth['Usuario']);
//            $type = $auth['Usuario']['tipo'];
//            $completo = 0;
//            $this->typeRedir($type, $completo);
//        }
//    }

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

}
