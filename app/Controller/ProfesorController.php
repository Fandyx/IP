<?php
App::uses('AppController', 'Controller');
/**
 * Profesors Controller
 *
 * @property Profesor $Profesor
 * @property PaginatorComponent $Paginator
 */
class ProfesorController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses =  array('Area','Pregunta','Tag','Respuesta','Instituto','Usuario','ProfesorArea','UsuarioTag');

/**
 * index method
 *
 * @return void
 */
    public function index() {
           $this->layout="default";
        $this->render("index");
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
    public function saveProfile(){
            $this->layout=null;

            if ($this->request->is('post')) {
          
            $user=$_SESSION['User'];
            $this->Usuario->id=$user["id"];
        
                    
            $time=strtotime($this->request->data("fecha_nacimiento"));
            $date = date('Y-m-d',$time);
                
            if ($this->Usuario->save($this->request->data)) {
                    $this->Usuario->recursive = 0;
                    $this->Usuario->saveField('fecha_nacimiento',$date);
                    $this->Usuario->saveField('completo',0);
                    $auth=$this->Usuario->find('first', array(
                    'conditions' => array('Usuario.id' => $this->Usuario->id),
                    'fields' => array('id','documento','nick','nombre','apellido','completo',
                    'sexo','email','tipo','fecha_nacimiento','ciudad','barrio','direccion',
                    'telefono1','telefono2','telefono3','descripcion','p_avatar','tipo_doc')
                    ));
                $this->Session->write('User', $auth["Usuario"]);
                    
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
                
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Pregunta could not be saved. Please, try again.'));
            }
        }
    }
    public function getThemes(){
        $this->autoRender=false;
        if ($this->request->is('post')) {
           $area=$this->request->data("area"); 
           $user=$this->Session->read('User');
           $this->UsuarioTag->recursive=0;
           $ut=$this->UsuarioTag->query("SELECT * FROM instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=".$user["id"]." AND area=".$area);
           $tags="";
           foreach($ut as $tag){
         
           if($tags==""){    
            $tags=$tag["ip_tags"]["tag"];}
            else{
            $tags=$tags.", ".$tag["ip_tags"]["tag"];
            } 
           } 
           return new CakeResponse(array('body'=> json_encode(array('temas'=>$tags)),'status'=>200));}
          
        
       return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));    
    }
    public function saveAreas(){
        if ($this->request->is('post')) {
            $areas=$this->request->data("areas");
                $user=$this->Session->read('User');
            
                $this->ProfesorArea->recursive = 0;
                $this->UsuarioTag->recursive = 0;
                $this->Tag->recursive = 0;
                $ua=$this->ProfesorArea->deleteAll(array('profesor'=>$user["id"]));
                $ut=$this->UsuarioTag->deleteAll(array('usuario'=>$user["id"]));
              print_r($areas);
            foreach ($areas as $area) {
                    
                $arid=$area["area"];

                    $this->ProfesorArea->create();
                    $this->ProfesorArea->set('profesor',$user["id"]);
                    $this->ProfesorArea->set('area',$arid);
                    $this->ProfesorArea->save();
                    $tags=explode(",",$area["tags"]);
                   
                    foreach ($tags as $tag) {
                    $istag= $this->Tag->find('first',array('conditions'=>array('tag'=>$tag,'area'=>$area["area"])));    
                    $tag_id=$istag["Tag"]["id"];
                    if(trim($tag)!=""){
                    if(sizeof($istag)==0){
                        $this->Tag->create();
                        $this->Tag->set('tag',$tag);
                        $this->Tag->set('area',$arid);
                        $this->Tag->save();
                        $tag_id=$this->Tag->id;    
                    }
                        $this->UsuarioTag->create();
                        $this->UsuarioTag->set('usuario',$user["id"]);
                        $this->UsuarioTag->set('tags_id',$tag_id);
                        $this->UsuarioTag->save();
                    
                    }
                    }
            
            }
 return new CakeResponse(array('body'=> json_encode(array('message'=>'ok')),'status'=>200));
        }
     return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));   
    }
    public function saveProfileImg(){
        
        if ($this->request->is('post')) {
            $user=$this->Session->read('User');
            
            $this->Usuario->id=$user["id"];
            $p_avatar=$this->request->data("url");
            
            if($this->Usuario->saveField('p_avatar',$p_avatar)){
            $this->Session->write('User.p_avatar', $p_avatar);
                
            return new CakeResponse(array('body'=> json_encode(array('message'=>'ok','url'=>'data:image/jpeg;base64,'.$p_avatar)),'status'=>200));}
            else{
            return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));   
            }
        }
    }
    public function profile() {
        $this->Area->recursive = 0;
        $this->set('areas', $this->Area->find('all',array('limit'=>16,'order'=>array('area'=>'asc'),'conditions'=>array('id<=31'))));
        
        if(AppController::checkAuth()){
            
            
        $user=$this->Session->read('User');
        $this->set('u_instituto',  
        $this->Instituto->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_usuario_instituto on ip_usuario_instituto.usuario=ip_usuario.id inner join ip_instituto on ip_instituto.id=ip_usuario_instituto.instituto where ip_usuario.id=".$user['id']));
        $this->set('u_area',  
        $this->Instituto->query("SELECT * FROM Instaprofe.ip_usuario inner join ip_profesor_area on ip_profesor_area.profesor=ip_usuario.id inner join ip_area on ip_profesor_area.area=ip_area.id where ip_usuario.id=".$user['id']." AND ip_area.id<=31"));
        $this->set('u_tags',  
        $this->UsuarioTag->query("SELECT * FROM instaprofe.ip_usuario_tags inner join ip_tags on tags_id=ip_tags.id where usuario=".$user["id"]));
        $this->render();}else{
        $this->layout="login";
        $this->render("/Usuarios");
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
