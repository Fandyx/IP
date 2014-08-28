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
	var $uses = array('Area','Pregunta','Tag','Respuesta','PreguntaTag','PreguntaVoto');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Area->recursive = 0;
		$this->Pregunta->recursive = 0;
		$this->set('areas', $this->Area->find('all',array('limit'=>16)));
          $user=$this->Session->read("User");
		$this->set('preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, COUNT(respuesta) as crespuesta FROM Instaprofe.ip_pregunta left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id where ip_area.id in (SELECT area from ip_usuario_area where usuario=".$user['id'].") group by ip_pregunta.id order by fecha_pregunta desc ;"));
	    $this->set('rec_preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, COUNT(respuesta) as crespuesta FROM Instaprofe.ip_pregunta left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id group by ip_pregunta.id order by fecha_pregunta desc ;"));
        $this->set('top_preguntas', $this->Pregunta->query("SELECT titulo,ip_pregunta.id,ip_area.area,ip_pregunta.pregunta,fecha_pregunta,nombre,apellido, COUNT(respuesta) as crespuesta, COUNT(pregunta_id) as numpreg FROM Instaprofe.ip_pregunta left outer join ip_respuesta on ip_respuesta.pregunta=ip_pregunta.id inner join ip_usuario on ip_pregunta.id_usuario_preg=ip_usuario.id inner join ip_area on ip_pregunta.area=ip_area.id inner join ip_pregunta_votos on pregunta_id=ip_pregunta.id order by numpreg desc ;"));   
        $this->set('p_tags', $this->PreguntaTag->find('all', array('joins' => array(
     array(
         'table' => 'tags',
         'alias' => 'Tags',
         'type' => 'inner',
         'conditions'=> array('Tags.id=PreguntaTag.tag')
     )),'fields' => array('id','pregunta','Tags.tag'))));
		$this->render('index');
	}

    public function Post(){
        $id=$_GET["pid"];
      
        $this->set('pregunta', $this->Pregunta->find("first",array('conditions'=>array('Pregunta.id'=>$id))));
     $this->set('p_tags', $this->PreguntaTag->find("all",array('conditions'=>array('pregunta'=>$id))));
     $this->set('voto_preg', $this->PreguntaVoto->find("count",array('conditions'=>array('PreguntaVoto.pregunta_id'=>$id))));
        $this->set('respuestas', $this->Respuesta->find("all",array('conditions'=>array('Respuesta.pregunta'=>$id),'groupby'=>'Respuesta.id')));
       $this->render();
    }
    public function saveRespuesta(){
            if ($this->request->is('post')) {
                $user=$this->Session->read('User');
                $resp=$this->request->data("resp");
                $pid=$this->request->data("pid");
                $this->Respuesta->create();
                $this->Respuesta->set("pregunta",$pid);
                $this->Respuesta->set("respuesta",$resp);
                $this->Respuesta->set("id_usuario_res",$user["id"]);
                $fecha=date('Y-m-d H:i:s');
                $this->Respuesta->set("fecha_respuesta",$fecha);
                $this->Respuesta->save();
                if($this->Respuesta->id>0){
                   $block='<blockquote class="pull-left">
                                                    <div class="widget-main padding-6 no-padding-left no-padding-right">
                                                    <p>'.$resp.'</p>
                                                </div>
                                                    <small>
                                                Posteado por 
                                                <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content="
                                                <img class=\'modal_img\' src=\'data:image/png;base64,'.$user["p_avatar"].'\'/>
                                                <span id=\'profile-modal\'>
                                                  <br/>'.$user["ciudad"].' <i class=\'ace-icon fa fa-map-marker purple\'></i><br/>
                                                '.$user["descripcion"].' 
                                               </span>" data-original-title="<i class=\'ace-icon fa fa-user purple\'></i> '.$user["nombre"]." ".$user["apellido"].'" aria-describedby="popover34171">'.$user["nombre"]." ".$user["apellido"].'</span>                                           
                                                 <br/>
                                                    Fecha: '.$fecha.'
                                                    </small>
                                        </blockquote>
                                        </div>
                                     </div>';
                      return new CakeResponse(array('body'=> json_encode(array('block'=>$block,'avatar'=>$user["p_avatar"])),'status'=>200));}
          
            }
       return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));    
                
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
		if ($this->request->is('post')) {
			$this->Pregunta->create();
		
			$tags=$this->request->data("tags");
			$taga=explode(", ",$tags);
		     $user=$this->Session->read("User");
			$this->Pregunta->set('id_usuario_preg',$user["id"]);
			$date=date('Y-m-d H:i:s', time() + 3600 * 5);
			
			if ($this->Pregunta->save($this->request->data)) {
			
				$this->Pregunta->saveField('fecha_pregunta',$date);
				foreach($taga as $tag){
					
				$this->Tag->create();
				$this->Tag->set('tag',$tag);
				$this->Tag->set('area',$this->request->data("area"));
				$this->Tag->save();
				$this->PreguntaTag->create();
				$this->PreguntaTag->set('pregunta',$this->Pregunta->id);
				$this->PreguntaTag->set('tag',$this->Tag->id);
				$this->PreguntaTag->save();
			}
				
			
				return $this->redirect(array('action' => 'index'));
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
