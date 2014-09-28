		<?php
		$user=$this->Session->read('UserProfile');
                $this_user=$this->Session->read('User');
            
                if($user["id"]==$this_user["id"]){
                     if($user["tipo"]==3){$user_link="../Profesor/";}
                    if($user["tipo"]==2){$user_link="../Estudiante/";}
                        if($user["tipo"]==1){$user_link="../Padre/";}
                    header('Location: '.$user_link."Profile");
                    die();
                            }
		?>
		<script>
                var user_id=<?=$user["id"]?>;
                var user_type=<?=$user["tipo"]?>;
                </script>
                 <script src="../assets/js/grids.js"></script>
		<div class="page-content-area">
            <div class="page-header">
                    <h1>
                            <?=$user["nombre"]." ".$user["apellido"]?>

                    </h1>
            </div><!-- /.page-header -->

            <div class="row">
                    <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <!-- <div class="clearfix">
                                    <div class="pull-left alert alert-warning nfo-margin">
                                            <button type="button" class="close" data-dismiss="alert">
                                                    <i class="ace-icon fa fa-times"></i>
                                            </button>

                                            <i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
                                            Haz click en la imagen de perfil o en los campos para editarlos&nbsp;   
                                    </div>


                            </div> -->

                            <?php echo $this->Session->flash()?>


    <div>
       
            <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                            <div>
                                    <!-- #section:pages/profile.picture -->
                                    <span class="profile-picture">
                                            <?php if(!empty($user["p_avatar"])){
                                                                                                                                    echo '<img class="pull-left" alt="avatar" src="data:img/jpg;base64,'.$user["p_avatar"].'"/>';
                                                                                                                                          }else{
                                                                                                                                          ?>
                                                                                                                                    <img class="pull-left" alt="Alex Doe's avatar" src="../assets/avatars/profile-pic.jpg"/>
																	<?php }?>	
                                                                                                </span>

												<!-- /section:pages/profile.picture -->
                                    <div class="space-4"></div>
                                    <?php if($user["tipo"]==3){?>
                                 
                                            <div class="inline position-relative">
                                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                    <span class="white" id="star_container"><input id="teach_rating-<?=$user["id"]?>" type="number" class="teach_stars" min=0 max=5 data-size="xg" value="<?=$stars?>"></span>
                                                    </a>
                                                <div id="rating-caption"></div>

                                            </div>
                                    
                                    <?php }?>
                            </div>

                            <div class="space-6"></div>

                            <!-- #section:pages/profile.contact -->
                            <div class="profile-contact-info">
                                    <div class="profile-contact-links align-left">
                                        <?php 
                                        
                              
                                                  
                                            $img="'http://www.instaprofe.com/Inicio/cake/assets/images/apple_back2.png'";
                                                 
                                       $areas_e="";
                                        foreach($u_area as $area){
                                            $areas_e.=$area["ip_area"]["area"].", ";
                                        }
                                        $areas_e= substr($areas_e, 0,-2);
                                        $profe="Profesor";
                                        $seguir_y=" ingresa ya para seguirlo y contactarlo.";
                                        $sexo_p="el";
                                         if($user["sexo"]=="F"){
                                            $profe="Profesora";
                                            $seguir_y=" ingresa ya para seguirlo y contactarlo.";
                                            $sexo_p="ella";
                                            
                                         }
                                       ?>
                                      
                                        
                                             <?php if($seguido>0){?>
                                           <a href="#" id="follow-<?=$user["id"]?>"  class="btn btn-link unfollow-user">
                                          <i class="ace-icon fa fa-minus-circle bigger-120 red"></i>
                                                   Dejar de Seguir
                                           </a>
                                             <?php }else{?>
                                         <a href="#" id="follow-<?=$user["id"]?>"  class="btn btn-link follow_user">
                                                    <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                                    Seguir
                                                    
                                            </a>
                                             <?php }if($user["tipo"]==3){if($contactado==0&&$user["contactar"]==1){?>
                                        
                                            <a href="#" id="contact-<?=$user["id"]?>" class="btn btn-link contact_user">
                                                    <i class="ace-icon fa fa-hand-o-right bigger-120 blue"></i>
                                                    Contactar
                                            </a>
                                          <a href="#" id="share-<?=$user["id"]?>" class="btn btn-link share_user" 
                                           onclick="fb_share('<?=strtoupper($user["nombre"]." ".$user["apellido"])?> ESTÁ EN INSTAPROFE.COM',
                                                       'http://localhost/Inicio/cake/Usuarios/profile?uid=<?=$user["id"]?>',<?=$img?>,'<?=$profe?> de <?=$areas_e?>',
                                                       'Ingresa ya a Instaprofe.com para resolver tus dudas y contactar a este y otros profesores particulares.')">
                                                    <i class="ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                                    Compartir
                                        </a>
                                             <?php }else{
                                                 ?>
                                              <a href="#" id="contacted-<?=$user["id"]?>" class="btn btn-link contacted_user">
                                                    <i class="ace-icon fa fa-hand-o-down bigger-120 blue"></i>
                                                    Contactado
                                            </a>
                                          <a href="#" id="share-<?=$user["id"]?>" class="btn btn-link share_user" 
                                           onclick="fb_share('<?=strtoupper($user["nombre"]." ".$user["apellido"])?> ESTÁ EN INSTAPROFE.COM',
                                                       'http://localhost/Inicio/cake/Usuarios/profile?uid=<?=$user["id"]?>',<?=$img?>,'<?=$profe?> de <?=$areas_e?>',
                                                       'Ingresa ya a Instaprofe.com para resolver tus dudas y contactar a este y otros profesores particulares.')">
                                                    <i class="ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                                    Compartir
                                        </a>
                                        <?php //if($contratado==0){?>
                                        <div id="calificar" class="center blue">
                                            <span>
                                                <p><strong>Califica tu experiencia con este profesor</strong></p>
                                        </span>
                                            <?php
                                            $val=0;
                                            if(sizeof($myrating)>0){
                                                $val=$myrating["UsuarioCalificacion"]["calificacion"];
                                            }?>
                                             <input id="teach_rating-<?=$user["id"]?>" type="number" value="<?=$val?>" class="teach_rating" min=0 max=5 data-size="xg">
                                        </div>       <?php
                                        }}//}?>
                                    </div>

                                   

                            </div>

                            <!-- /section:pages/profile.contact -->
                            
                          
                            <?php if($contactado>0&&$user["contactar"]==1){?>
                               <h4 class="blue smaller">Información de Contacto</h4>
                            <div class="hr hr12 dotted"></div>
                            
                            <div class="clearfix" id="profile-user-info">
                             
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Email: </div>

                                            <div class="profile-info-value">
                                                    <span><?=$user["email"]?></span>
                                            </div>
                                    </div>
                                      <?php if($user["telefono1"]!==null&&$user["telefono1"]!==""){ ?>
                                    <div class="profile-info-row">
                                                 <div class="profile-info-name"> Celular </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-mobile-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono1"]?></span>
                                            </div>
                                    </div>
                                      <?php }if($user["telefono2"]!==null&&$user["telefono2"]!==""){ ?>
                                   <div class="profile-info-row">
                                                 <div class="profile-info-name"> Teléfono 2 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono2"]?></span>
                                            </div>
                                    </div><?php }?>
                                          <?php if($user["telefono3"]!==null&&$user["telefono3"]!==""){ ?>
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Teléfono 3 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono3"]?></span>
                                            </div>
                                    </div><?php } ?>
                            </div>
                            </div>      
                          
                            <!-- #section:custom/extra.grid -->
                            <?php }else {echo   '<span id="info_container"></span>';}?>
                              <div class="hr hr16 dotted"></div>
                            <div class="clearfix">
                                    <div class="grid2">
                                            <span class="bigger-175 blue" id="seguidores"><?=$seguidores?></span>

                                            <br />
                                            Seguidores
                                    </div>

                                    <div class="grid2">
                                            <span class="bigger-175 blue" id="siguiendo"><?=$siguiendo?></span>

                                            <br />
                                            Siguiendo
                                    </div>
                            </div>
                             <div id="siguiendo-dialog" class="hide">


    <!-- #section:pages/profile.friends -->
    <div class="profile-users clearfix">
        <?php foreach($u_siguiendo as $us){
            $us=$us["ip_usuario"];
            ?>
        
            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar4.png" alt="Bob Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    
                                                    <?=$us["nombre"]." ".$us["apellido"]?>
                                            </a>
                                    </div>
                            </div>

                            <div class="popover right">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Content Editor</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                    <span class="green"> 20 mins ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
        <?php }?>
            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar1.png" alt="Rose Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-offline"></span>
                                                    Rose Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover right">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Graphic Designer</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                    <span class="grey"> 30 min ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar.png" alt="Jim Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-busy"></span>
                                                    Jim Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover right">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">SEO &amp; Advertising</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 red"></i>
                                                    <span class="grey"> 1 hour ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar5.png" alt="Alex Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-idle"></span>
                                                    Alex Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover right">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Marketing</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                    <span class=""> 40 minutes idle </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar2.png" alt="Phil Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-online"></span>
                                                    Phil Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Public Relations</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                    <span class="green"> 2 hours ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar3.png" alt="Susan Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-online"></span>
                                                    Susan Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">HR Management</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                    <span class="green"> 20 mins ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar1.png" alt="Jennifer Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-offline"></span>
                                                    Jennifer Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Graphic Designer</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                    <span class="grey"> 2 hours ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>

            <div class="itemdiv memberdiv">
                    <div class="inline pos-rel">
                            <div class="user">
                                    <a href="#">
                                            <img src="../assets/avatars/avatar3.png" alt="Alexa Doe's avatar">
                                    </a>
                            </div>

                            <div class="body">
                                    <div class="name">
                                            <a href="#">
                                                    <span class="user-status status-offline"></span>
                                                    Alexa Doe
                                            </a>
                                    </div>
                            </div>

                            <div class="popover">
                                    <div class="arrow"></div>

                                    <div class="popover-content">
                                            <div class="bolder">Accounting</div>

                                            <div class="time">
                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                    <span class="grey"> 4 hours ago </span>
                                            </div>

                                            <div class="hr dotted hr-8"></div>

                                            <div class="tools action-buttons">
                                                    <a href="#">
                                                            <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                    </a>

                                                    <a href="#">
                                                            <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                    </a>
                                            </div>
                                    </div>
                            </div>
                    </div>
        </div>
                                </div>

                                <!-- /section:pages/profile.friends -->

                       
                            </div>   
                            <!-- /section:custom/extra.grid -->
                            <div class="hr hr16 dotted"></div>
                    </div>

                    <div class="col-xs-12 col-sm-9" id="profile-opt">
                           		<div class="center">
					

                                                                                            <a href="../Pregunta/hechas?uid=<?=$user["id"]?>"><span class="btn btn-sm btn-purple no-hover">
													<span class="line-height-1 bigger-170"> <?=$p_hechas?> </span>

													<br />
													<span class="line-height-1 smaller-90"> Preguntas Hechas </span>
                                                                                                    </span></a>
                                                                                             <a href="../Pregunta/resueltas?uid=<?=$user["id"]?>">        
												<span class="btn btn-sm btn-primary">
													<span class="line-height-1 bigger-170"> <?=$p_resueltas?> </span>

													<br />
													<span class="line-height-1 smaller-90">Respuestas </span>
                                                                                                </span></a>
                                                                                             <a href="../Pregunta/mejores?uid=<?=$user["id"]?>">      
												<span class="btn btn-sm btn-yellow no-hover">
                                                                                                    <span class="line-height-1 bigger-170"> <?=$m_respuestas?>  </span>

                                                                                                    <br />
                                                                                                    <span class="line-height-1 smaller-90"> Mejores Respuestas </span>
                                                                                            </span></a><?php if($user["tipo"]==3){?>
                                                                                          <span class="btn btn-sm btn-success cursor-default">
                                                                                                    <span class="line-height-1 bigger-170"> <?=$n_contactos?>  </span>

                                                                                                    <br />
                                                                                                    <span class="line-height-1 smaller-90"> Veces Contactado </span>
                                                                                              </span>
                                                                                                <?php } ?>
											</div>

                            <div class="space-12"></div>

                            <!-- #section:pages/profile.info -->
                            <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                           <div class="profile-info-name"> Mi nombre es </div>

                                            <div class="profile-info-value">
                                                    <span id="user_name"><?=$user["nombre"]." ".$user["apellido"]?></span>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Soy de </div>

                                            <div class="profile-info-value">
                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                    <?=$user["ciudad"]?>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                              <div class="profile-info-name"> Edad </div>

                                            <div class="profile-info-value">
                                                <?php
$today = new DateTime();
$time=strtotime($user["fecha_nacimiento"]);
$birthdate = date('Y-m-d',$time);

$interval = $today->diff(new DateTime($birthdate));


?>
                                                    <span id="edad"><?=$interval->format('%y Años');?></span>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Soy un  </div>

                                            <div class="profile-info-value">
                                                <?php
                                                $tipo="";
                                                if($user["tipo"]==3){$tipo="Profesor";}
                                                if($user["tipo"]==2){$tipo="Estudiante";}
                                                if($user["tipo"]==1){$tipo="Padre de Familia";}
                                                ?>
                                                    <span id="tipo"><?=$tipo?></span>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                            <div class="profile-info-name"><?php if($user["tipo"]==3){echo 'Qué enseña';}else{ echo 'Interesado en';} ?></div>

                                            <div class="profile-info-value">
                                                <?php
                                                    $t_areas="";
                                                    foreach($u_area as $area){
                                                       
                                                        $code= '<span class="themes" id="tema-'.$area["ip_area"]["id"].'" onclick="showThemes('.$area["ip_area"]["id"].',\''.$area["ip_area"]["area"].'\')">'.$area["ip_area"]["area"].'</span>';
                                                      if($t_areas==""){    
                                                          $t_areas=$code;}
                                                            else{
                                                            $t_areas=$t_areas.", ".$code;
                                                            } 
                                                    }
                                                 
                                                    ?>
                                                                <span id="areas"><?=$t_areas?>
                                                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Haz click en el area, para ver los temas de interes" title="">?</span>
                                                    </span>

                                            </div>
                                    </div>
            <div class="profile-info-row" id="row_temas">
                <div class="profile-info-name"> Temas (<span id="tema_title"></span>) </div>

                <div class="profile-info-value">

                    <span id="temas"></span>
                </div>
            </div>
        <?php if($user["tipo"]==3){ ?>
            <div class="profile-info-row">
                        <div class="profile-info-name"> Precio/hora </div>

                        <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                  <?=$user["precio_hora"]?><?=$user["negociable"]=="1"?" (Negociable)":""?>
                        </div>
                </div>
                                <?php }?>
                    <div class="profile-info-row">
                            <div class="profile-info-name"> Descripción </div>

                            <div class="profile-info-value">
                                    <span  id="descripcion">
                                    <?=$user["descripcion"]?>
                                    </span>
                            </div>
                    </div>
            </div>

            <!-- /section:pages/profile.info -->
            <div class="space-20"></div>
              <?php if($user["tipo"]==3){?>
<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#educacion">
														<i class="purple ace-icon fa fa-university bigger-120"></i>
														Educación
													</a>
												</li>

												<li class="">
													<a data-toggle="tab" href="#experiencia">
                                                                                                            <i class="purple ace-icon fa fa-briefcase bigger-120"></i>
														Experiencia
														
													</a>
												</li>
<!--
												<li class="">
													<a data-toggle="tab" href="#comentarios">
														 <i class="purple ace-icon fa fa-comments bigger-120"></i>
                                                                                                            Comentarios
													
													</a>

												</li>
                                                                                                <li class="">
													<a data-toggle="tab" href="#recomendaciones">
                                                                                                            <i class="purple ace-icon fa fa-check-square bigger-120"></i>
														Recomendaciones
														
													</a>

												</li>-->
											</ul>

											<div class="tab-content">
												<div id="educacion" class="tab-pane fade active in">
                                                                                                 
                                                                                                      <div class="row">
							<div class="col-xs-12">
								

								<table id="grid-edu"></table>

								<div id="edu-pager"></div>

								
								
							</div><!-- /.col -->
						</div>
                                                                                                       
                                                                                                   
                                                                                                </div>
												<div id="experiencia" class="tab-pane fade">
                                                                                                <div class="row">
							<div class="col-xs-12">
								

                                                                                                            <table id="grid-exp"></table>

                                                                                                            <div id="exp-pager"></div>



                                                                                                    </div><!-- /.col -->
                                                                                            </div>	</div>

<!--												<div id="comentarios" class="tab-pane fade">
													<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
												</div>

												<div id="recomendaciones" class="tab-pane fade">
													<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>-->
												</div>
											</div>
										</div>	
              <?php }?>
</div>

							<!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
<script>
	var active="#leftp_perfil"
</script>