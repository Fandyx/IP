		<?php
		$user=$this->Session->read('UserProfile');
		?>
		<script>
                var user_id=<?=$user["id"]?>;
                var user_type=<?=$user["tipo"]?>;
                </script>
		<div class="page-content-area">
            <div class="page-header">
                    <h1>
                            Perfil

                    </h1>
            </div><!-- /.page-header -->

            <div class="row">
                    <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <!-- <div class="clearfix">
                                    <div class="pull-left alert alert-warning no-margin">
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

                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                            <div class="inline position-relative">
                                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                    <span class="white"><?=$user["nombre"]." ".$user["apellido"]?></span>
                                                    </a>


                                            </div>
                                    </div>
                            </div>

                            <div class="space-6"></div>

                            <!-- #section:pages/profile.contact -->
                            <div class="profile-contact-info">
                                    <div class="profile-contact-links align-left">
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
                                             <?php }if($user["tipo"]===3){if($contactado==0){?>
                                            <a href="#" id="contact-<?=$user["id"]?>" class="btn btn-link contact_user">
                                                    <i class="ace-icon fa fa-hand-o-right bigger-120 blue"></i>
                                                    Contactar
                                            </a>
                                             <?php }else{
                                                 ?>
                                              <a href="#" id="contacted-<?=$user["id"]?>" class="btn btn-link contacted_user">
                                                    <i class="ace-icon fa fa-hand-o-down bigger-120 blue"></i>
                                                    Contactado
                                            </a>
                                                     <?php
                                             }}?>
                                    </div>

                                   

                            </div>

                            <!-- /section:pages/profile.contact -->
                            
                          
                            <?php if($contactado>0){?>
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

                            <!-- /section:custom/extra.grid -->
                            <div class="hr hr16 dotted"></div>
                    </div>

                    <div class="col-xs-12 col-sm-9" id="profile-opt">
                            <div class="center">


                                    <span class="btn btn-app btn-sm btn-purple no-hover">
                                            <span class="line-height-1 bigger-170"> <?=$p_hechas?> </span>

                                            <br />
                                            <span class="line-height-1 smaller-90"> Preguntas Hechas </span>
                                    </span>

                                    <span class="btn btn-app btn-sm btn-blue no-hover">
                                            <span class="line-height-1 bigger-170"><?=$p_resueltas?> </span>

                                            <br />
                                            <span class="line-height-1 smaller-90">Preguntas Resueltas </span>
                                    </span>

                                    <span class="btn btn-app btn-sm btn-yellow no-hover">
                                            <span class="line-height-1 bigger-170"> <?=$m_respuestas?>  </span>

                                            <br />
                                            <span class="line-height-1 smaller-90"> Mejores Respuestas </span>
                                    </span>
                                 <span class="btn btn-app btn-sm btn-success no-hover">
                                            <span class="line-height-1 bigger-170"> <?=$n_contactos?>  </span>

                                            <br />
                                            <span class="line-height-1 smaller-90"> Veces Contactado </span>
                                    </span>

                            </div>

                            <div class="space-12"></div>

                            <!-- #section:pages/profile.info -->
                            <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Nombre </div>

                                            <div class="profile-info-value">
                                                    <span id="user_name"><?=$user["nombre"]." ".$user["apellido"]?></span>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Ubicación </div>

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
                                            <div class="profile-info-name"> Rol </div>

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
                                            <div class="profile-info-name"> Interesado en </div>

                                            <div class="profile-info-value">
                                                <?php
    $t_areas="";
    foreach($u_area as $area){
        $code= '<span class="themes" onclick="showThemes('.$area["ip_area"]["id"].',\''.$area["ip_area"]["area"].'\')">'.$area["ip_area"]["area"].'</span>';
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
                    <div class="profile-info-row">
                            <div class="profile-info-name"> Sobre Mi </div>

                            <div class="profile-info-value">
                                    <span  id="descripcion">
                                    <?=$user["descripcion"]?>
                                    </span>
                            </div>
                    </div>
            </div>

            <!-- /section:pages/profile.info -->
            <div class="space-20"></div>

           
</div>

							<!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
<script>
	var active="#leftp_perfil"
</script>