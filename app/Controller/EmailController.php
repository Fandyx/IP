<?php
App::uses('AppController', 'Controller');
/**
 * Logins Controller
 *
 * @property Login $Login
 * @property PaginatorComponent $Paginator
 */
class EmailController extends AppController {

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
 */    public function index() {
           $this->layout="default";
        $this->render("index");
    }

        function generateRandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }
        public function quesAnswer($pid){
             $this->autoRender=false;
             
           
            $this->Pregunta->recursive=0;
            $redes=" <br/><br/>Saludos,<br/>Instaprofe<br/><br/>Síguenos en <a href='www.facebook.com/instaprofeoficial'>Facebook</a> - <a href='www.twitter.com/instaprofe'>Twitter</a> - <a href='www.instagram.com/instaprofeoficial'>Instagram</a>";
            $preg=$this->Pregunta->find('first',array('conditions'=>array('Pregunta.id'=>$pid)));
            $user=$this->Usuario->find('first',array('conditions'=>array('id'=>$preg["Pregunta"]["id_usuario_preg"])));
            $email=$user["Usuario"]["email"];
            $msj="Hola ".$user["Usuario"]["nombre"]." ".$user["Usuario"]["apellido"].",<br/><br/> Tu pregunta <i>\"".$preg["Pregunta"]["titulo"]."\"</i> ha sido respondida. <br/><br/>Para ver las respuestas, ingresa a <a href='http://localhost/Inicio/cake/Pregunta/Post?pid=".$preg["Pregunta"]["id"].'>Aqui</a>'.$redes;
            $this->sendEmail($email, 'Instaprofe - ¡Pregunta Respondida!', $msj);
            
        }
        public function bestAnswer($rid){
        $this->autoRender=false;
        $res=$this->Respuesta->find('first',array('conditions'=>array('Respuesta.id'=>$rid)));
        $user=$this->Usuario->find('first',array('conditions'=>array('id'=>$res["Respuesta"]["id_usuario_res"])));
            $this->Pregunta->recursive=0;
          $redes=" <br/><br/>Saludos,<br/>Instaprofe<br/><br/>Síguenos en <a href='www.facebook.com/instaprofeoficial'>Facebook</a> - <a href='www.twitter.com/instaprofe'>Twitter</a> - <a href='www.instagram.com/instaprofeoficial'>Instagram</a>";
            $preg=$this->Pregunta->find('first',array('conditions'=>array('Pregunta.id'=>$res["Respuesta"]["pregunta"])));
           
    
           
            $email=$user["Usuario"]["email"];
            $msj="¡Felicitaciones ".$user["Usuario"]["nombre"]." ".$user["Usuario"]["apellido"]."!<br/><br/> Tu respuesta a la pregunta <i>\"".$preg["Pregunta"]["titulo"]."\"</i> ha sido seleccionada como la mejor.<br/><br/>Para verla, ingresa <a href='http://localhost/Inicio/cake/Pregunta/Post?pid=".$preg["Pregunta"]["id"].'>Aqui</a>'.$redes;
            $this->sendEmail($email, 'Instaprofe - ¡Tu respuesta fue la mejor!', $msj);
            
        }
        public function soporte(){
            $user=$this->Session->read('User');
            $asunto=$this->request->data('asunto');
            $msj=$this->request->data('msj');
            $user=$this->Usuario->find('first',array('conditions'=>array('id'=>$res["Respuesta"]["id_usuario_res"])));
            $email=$user["Usuario"]["email"];
            $msj="El usuario ".$user["Usuario"]["nombre"]." ".$user["Usuario"]["apellido"]." ";
            
        }
        public function forget(){
            $this->autoRender=false;
            $email=$this->request->data("email");
            $user=$this->Usuario->find('first',array('conditions'=>array('email'=>$email)));
            if(sizeof($user)>0){
            $newpass=$this->generateRandomString();
            $this->Usuario->id=$user["Usuario"]["id"];
            $this->Usuario->saveField('pass',$newpass);
            $msj="Hola ".$user["Usuario"]["nombre"]." ".$user["Usuario"]["apellido"].", has indicado que olvidaste tu contraseña.<br/>
                    Te hemos generado una nueva.<br/><br/>
                    <strong>Nueva Contraseña: ".$newpass."</strong><br/> 
                    <br/><br/>        
                    Ingresa a http://www.instaprofe.com";
            $this->sendEmail($email, 'Instaprofe - Contraseña Reasignada', $msj);
             $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-check bigger-120 blue"></i>
                   &nbsp;Tu contraseña ha sido reasignada. Revisa tu correo.&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
             $this->redirect("../Usuarios");
            }else{
                        $this->Session->setFlash('<div class="clearfix">
            <div class="pull-left alert alert-danger no-margin">
      <i class="ace-icon fa fa-frown-o bigger-120 blue"></i>
                   &nbsp;No existe una cuenta asociada a este email&nbsp;   
            </div></div><div class="hr dotted"></div>
    ');
           
       $this->redirect("../Usuarios");
            }
        }
        public function sendEmail($email,$title,$msj){
             App::uses('CakeEmail', 'Network/Email');
                     
                    $Email = new CakeEmail('default');
                    $Email->to($email);
                    $Email->emailFormat('html');
                    $Email->subject($title);
                    $Email->send($msj);     
        }
	public function emailRegisterEstudiante($email) {
		$this->autoRender = false;
              $usuario=$_SESSION["User"];
           
                $id=$usuario["id"];
                $user=$this->Usuario->find('first',array('conditions'=>array('id'=>$id)));
                $passt="";
                if($user["Usuario"]["completo"]==0&&$user["Usuario"]["pass"]==null){
                    $pass=$this->generateRandomString();
                    $this->Usuario->saveField('pass',$pass);
                    $passt="Tu contraseña es: ".$pass;
                }
		$html='<table>
                            <tr>
                                <td align="center" valign="top">
                                    
                              
                                        <img align="left" alt="" src="www.instaprofe.com/Inicio/cake/assets/images/instaprofe_cover.png" width="650" style="padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;outline:none;text-decoration:none">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background-color:#6AC9CD;border-top:0;border-bottom:0">
                                        <tbody><tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                                                    <tbody><tr>
                                                        <td valign="top" style="padding-top:10px;padding-bottom:10px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
    <tbody>
        <tr>
            <td valign="top">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                    <tbody><tr>
                        
                        <td valign="top" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;color:#0E1C1D;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;;font-size:15px;line-height:150%;text-align:center">
                        
                            <h1 style="margin:0;padding:0;display:block;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:30px;font-style:normal;font-weight:bold;line-height:125%;letter-spacing:-1px;text-align:center;color:#0E1C1D!important">¡Bienvenido (Nombre, Apellido)! <br/></h1>
                              <h3 style="text-align:center;color:#662D91;font-weight:bold">¡Gracias por registrarte en Instaprofe.com!</h3>

<img align="left" alt="" src="www.instaprofe.com/Inicio/cake/assets/images/hacer.png" width="564" style="max-width:1200px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;outline:none;text-decoration:none"/>

<ul align="left" style="list-style:none">
   
  <li> <strong style="color:#662D91">Resolver tus dudas académicas </strong> online y adquirir conocimientos en cualquier área. </li>
	<li><strong style="color:#662D91">Compartir tu experiencia académica</strong> con otros estudiantes y profesores del mismo nivel u otros.</li>
	<li><strong style="color:#662D91">Contactar de inmediato a profesores expertos</strong> y confiables en las materias que estés 
	dando, categorizados por instituciones.*</li>	
  <li><strong style="color:#662D91">Calificar y recomendar profesores particulares</strong> que te hayan dado clases presenciales o 
	compartido algún conocimiento a través Instaprofe.com. </li>
	
  
</ul><div align="left">
<small>*Si eres menor de edad, deberás contar con la aprobación de un adulto.</small></div>
                         
                          <div style="font-size:30px;color:#662D91;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;">
                            <h3 style="color:#662D91;text-align:center;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;">Muy pronto tambien podras...</h3>
                            <img align="left" alt="" src="www.instaprofe.com/Inicio/cake/assets/images/coming.png" width="564" style="max-width:1200px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;outline:none;text-decoration:none"/>
                          </div>
                          <br/>
<div align="center" style="font-size:20px;color:#662D91;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;">                        
 <h3 style="color:#662D91;text-align:center;font-family:\'Open Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;">¡Completa ya tu perfil!</h3>
  <h4>'.$passt.'</h4>
                          </div>
                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                      <a href="http://www.instaprofe.com/Inicio/cake" style="word-wrap:break-word;color:#6dc6dd;font-weight:normal;text-decoration:underline" target="_blank"> <img  src="www.instaprofe.com/Inicio/cake/assets/images/logos.png" alt="logos" width="650" style="max-width:1200px;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;outline:none;text-decoration:none"></a>
                                                                              
          
                </td>';
                
                    $this->sendEmail($email, 'Bienvenido a InstaProfe', $html);
	}

}
