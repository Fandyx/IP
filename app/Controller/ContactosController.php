<?php

App::uses('AppController', 'Controller');

/**
 * Contactos Controller
 *
 * @property Alumno $Alumno
 * @property PaginatorComponent $Paginator
 */
class ContactosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    var $uses = array('Usuario', 'Contacto');

    /**
     * index method
     *
     * @return void
     */
    public function contactos() {
        $user = $this->Session->read('User');
        $data = $this->Usuario->find('all', array('joins' => 
            array(
                array('table' => 'ip_contacto', 'alias' => 'Contacto', 'type' => 'INNER', 'conditions' => array('Contacto.id_contactado=Usuario.id')),
                 array('table' => 'ip_usuario_calificacion', 'alias' => 'Calificacion', 'type' => 'LEFT OUTER', 'conditions' => array('Contacto.id_contactado=Calificacion.usuario_calificado AND Calificacion.usuario_califica=Contacto.id_contactador')   )), 'conditions' => array('id_contactador' => $user["id"]),'fields'=>array('Usuario.*','Contacto.*','Calificacion.*')));
        $i = 0; 
        foreach ($data as $d) {
           $time=  strtotime($d["Contacto"]["fecha"]);
            $data[$i]['Contacto']['fecha'] = $this->humanTiming($time);
            $i++;
        }
        $this->set('contactos', $data);
        $this->render();
    }
    public function contactado() {
        $user = $this->Session->read('User');
        $data = $this->Usuario->find('all', array('joins' => 
            array(
                array('table' => 'ip_contacto', 'alias' => 'Contacto', 'type' => 'INNER', 'conditions' => array('Contacto.id_contactador=Usuario.id')),
                 array('table' => 'ip_usuario_calificacion', 'alias' => 'Calificacion', 'type' => 'LEFT OUTER', 'conditions' => array('Contacto.id_contactador=Calificacion.usuario_califica AND Calificacion.usuario_calificado=Contacto.id_contactado')   )), 'conditions' => array('id_contactado' => $user["id"]),'fields'=>array('Usuario.*','Contacto.*','Calificacion.*')));
        $i = 0; 
        foreach ($data as $d) {
           $time=  strtotime($d["Contacto"]["fecha"]);
            $data[$i]['Contacto']['fecha'] = $this->humanTiming($time);
            $i++;
        }
        $this->set('contactos', $data);
        $this->render();
    }
    public function contacto(){ 
        $this->autoRender=false;
        $uid=$this->request->data("id");
        $user=$this->Session->read("User");
        $checked=$this->request->data("checked");
    
        $this->Contacto->updateAll(array('contactado'=>$checked),array('id_contactado'=>$user["id"],'id_contactador'=>$uid));
    }
    private  function humanTiming($time) {

        $time = time() - $time;

        $tokens = array(
            31536000 => 'año',
            2592000 => 'mes',
            604800 => 'semana',
            86400 => 'dia',
            3600 => 'hora',
            60 => 'minuto',
            1 => 'segundo'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? (($text=='mes')?'es':'s') : '');
        }
    }

}
