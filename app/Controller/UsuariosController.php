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
'Paginator'
);


function logout()
{
  $this->redirect($this->Auth->logout());
}	

		
    public function index() {
        if(AppController::checkAuth()){
            $user=$this->Session->read('User');
          
           
         
             $auth=$this->getUsuario(array('Usuario.id' => $user["id"]));
             $type=$user["tipo"];
            $completo=$user["completo"];
             $this->Session->write('User', $auth['Usuario']);
           $this->typeRedir($type,$completo);
        }else{
        $this->layout="login";
        
    	$this->render("index");
        }
    }
/**
 * index method
 *
 * @return void
 */
 	public function typeRedir($type,$completo){
 			$c="";	
 			if($completo==0){$c="Profile";$this->Session->setFlash('
 										<div class="clearfix">
 										<div class="pull-left alert alert-danger no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-user bigger-120 blue"></i>
										Tu perfil esta incompleto, completalo para continuar.&nbsp;   
									</div></div><div class="hr dotted"></div>
								');}
			
			if($type==-1){
					$this -> redirect('/Admin/'.$c);
				}
				if($type==3){
						$this->redirect('/Profesor/'.$c);
				}
				if($type==2){
					$this->redirect('/Estudiante/'.$c);
					
				}
				if($type==1){
						$this->redirect('/Padre/'.$c);
				}
 	}
	public function auth() {
       
		if(isset($_POST["user"])&&isset($_POST["pass"])){
			$user=$_POST["user"];
		    $pass=$_POST["pass"];
      
		  
		    $auth = $this->getUsuario(array('Usuario.email' => $user,'Usuario.pass' => $pass));
            
			$sw=true;
            
            
			if(count($auth)==1){
				
				$this->Session->write('init', true);
                $this->Session->write('User', $auth['Usuario']);
				$completo=$auth['Usuario']['completo'];
				$type=$auth['Usuario']['tipo'];
				$sw=false;
				$this->typeRedir($type,$completo);
			}

        }
        $this->redirect(
            array('controller' => 'Usuarios', 'action' => 'index')
        );
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
    public function getUsuario($array_c){
                     $auth = $this->Usuario->find('first', array(
            'conditions' => $array_c,
            'fields' => array('id','documento','nick','nombre','apellido','completo',
            'sexo','email','tipo','fecha_nacimiento','ciudad','barrio','direccion',
            'telefono1','telefono2','telefono3','descripcion','p_avatar','tipo_doc')
            ));
            return $auth;
    }
	public function view($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
		$this->set('usuario', $this->Usuario->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
			}
		}
		$areas = $this->Usuario->Area->find('list');
		$institutos = $this->Usuario->Instituto->find('list');
		$this->set(compact('areas', 'institutos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash(__('The usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
			$this->request->data = $this->Usuario->find('first', $options);
		}
		$areas = $this->Usuario->Area->find('list');
		$institutos = $this->Usuario->Instituto->find('list');
		$this->set(compact('areas', 'institutos'));
	}
	//profile
	public function profile(){
		
		$this->set('usuarios', $this->Usuario->find('all', array(
        	'conditions' => array('Usuario.id=1')
    		)));
		$this->render('profile');
	}
	public function file_upload() {
		$this->layout=null;
	$this->render('file_upload');
	}
	//busca profe
	public function buscarProfe() {
		$this->autoRender = false;
	
	
		 $area = $this->request->data("area");
		 $ciudad=$this->request->data("ciudad");
                 $temas=$this->request->data("temas");
                 $inst=$this->request->data("inst");
		if(isset($area)){
    $this->Usuario->recursive=1;
    $data=$this->Usuario->find('all', array('joins' => array(
     array(
         'table' => 'profesor_area',
          'alias' => 'p_area',
         'type' => 'inner',
         'conditions'=> array('profesor =Usuario.id')
     ),
     array(
         'table' => 'ip_area',
         'type' => 'inner',
         'foreignKey' => false,
         'conditions'=> array(
             'ip_area.id = p_area.area',
            
         )
         ),
     array(
         'table' => 'usuario_instituto',
         'alias' =>'UsuarioInstituto',
         'type' => 'left outer',
         'foreignKey' => false,
         'conditions'=> array(
             'UsuarioInstituto.usuario= Usuario.id',
            
         )
         ),
                      array(
         'table' => 'Instituto',
         'alias' =>'Instituto',
         'type' => 'left outer',
         'foreignKey' => false,
         'conditions'=> array(
             'UsuarioInstituto.instituto= Instituto.id',
            
         )
         )   ,
        ),'conditions' =>  array('ip_area.id' => $area),'order'=>array('Usuario.id ASC'),
                   'fields' => array('Usuario.*', 'Instituto.*')
                    ));
return new CakeResponse(array('body'=> json_encode(array('data'=>$data)),'status'=>200));
		}
       return new CakeResponse(array('body'=> json_encode(array('message'=>'FAIL')),'status'=>500));        
	
		
	}
	
	//area profe

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Usuario->id = $id;
		if (!$this->Usuario->exists()) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Usuario->delete()) {
			$this->Session->setFlash(__('The usuario has been deleted.'));
		} else {
			$this->Session->setFlash(__('The usuario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
