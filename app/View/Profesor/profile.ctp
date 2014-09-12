		<?php
		$user=$this->Session->read('User');
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
									<?php if($user["completo"]!=0) {?>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<!-- #section:pages/profile.picture -->
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive"  alt="Alex's Avatar" src="data:image/jpeg;base64,<?=$user["p_avatar"]?>" />
												</span>

												<!-- /section:pages/profile.picture -->
												<div class="space-4"></div>

												<div class="label label-info label-xlg arrowed-in arrowed-in-right">
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
													
                                                    <a href="#" id="edit" class="btn btn-link">
                                                        <i class="ace-icon fa fa-gear bigger-120 purple"></i>
                                                        Editar
                                                    </a>
												
												</div>

												<div class="space-6"></div>

											</div>
<div class="hr hr12 dotted"></div>
   <h4 class="blue smaller">Información de Contacto</h4>
                            <div class="clearfix" id="profile-user-info">
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Email: </div>

                                            <div class="profile-info-value">
                                                    <span><?=$user["email"]?></span>
                                            </div>
                                    </div>

                                    <div class="profile-info-row">
                                                 <div class="profile-info-name"> Celular </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-mobile-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono1"]?></span>
                                            </div>
                                    </div>
                                    <?php if($user["telefono2"]!==""){ ?>
                                   <div class="profile-info-row">
                                                 <div class="profile-info-name"> Teléfono 2 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono2"]?></span>
                                            </div>
                                    </div><?php }?>
                                          <?php if($user["telefono3"]!==""){ ?>
                                    <div class="profile-info-row">
                                            <div class="profile-info-name"> Teléfono 3 </div>
                                            <div class="profile-info-value">
                                                    <i class="fa fa-phone light-orange bigger-110"></i>
                                                      <span><?=$user["telefono3"]?></span>
                                            </div>
                                    </div><?php }?>
                            </div>
                            </div>      
											<!-- /section:pages/profile.contact -->
											<div class="hr hr12 dotted"></div>

											<!-- #section:custom/extra.grid -->
											<div class="clearfix">
												<div class="grid2">
													<span class="bigger-175 blue"><?=$seguidores?></span>

													<br />
													Seguidores
												</div>

												<div class="grid2">
													<span class="bigger-175 blue"><?=$siguiendo?></span>

													<br />
													Siguiendo
												</div>
											</div>

											<!-- /section:custom/extra.grid -->
											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9" id="profile-opt">
											<div class="center">
					

                                                                                            <a href="../Pregunta/hechas/<?=$user["id"]?>"><span class="btn btn-sm btn-purple no-hover">
													<span class="line-height-1 bigger-170"> <?=$p_hechas?> </span>

													<br />
													<span class="line-height-1 smaller-90"> Preguntas Hechas </span>
                                                                                                    </span></a>
                                                                                             <a href="../Pregunta/resueltas/<?=$user["id"]?>">        
												<span class="btn btn-sm btn-primary">
													<span class="line-height-1 bigger-170"> <?=$p_resueltas?> </span>

													<br />
													<span class="line-height-1 smaller-90">Preguntas Resueltas </span>
                                                                                                </span></a>
                                                                                             <a href="../Pregunta/mejores/<?=$user["id"]?>">      
												<span class="btn btn-sm btn-yellow no-hover">
                                                                                                    <span class="line-height-1 bigger-170"> <?=$m_respuestas?>  </span>

                                                                                                    <br />
                                                                                                    <span class="line-height-1 smaller-90"> Mejores Respuestas </span>
                                                                                            </span></a><?php if($user["tipo"]==3){?>
                                                                                          <span class="btn btn-sm btn-success no-hover">
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
                                                    <div class="profile-info-name"> Mi nombre es: </div>

                                                    <div class="profile-info-value">
                                                            <span id="user_name"><?=$user["nombre"]." ".$user["apellido"]?></span>
                                                    </div>
                                            </div>

                                            <div class="profile-info-row">
                                                    <div class="profile-info-name">Me encuentro en: </div>

                                                    <div class="profile-info-value">
                                                            <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                            <?=$user["ciudad"]?>
                                                    </div>
                                            </div>

                                            <div class="profile-info-row">
                                                    <div class="profile-info-name"> Tengo </div>

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
                                                    <div class="profile-info-name"> Soy un: </div>

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
                                                    <div class="profile-info-name"> Que enseña: </div>

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

												</li>
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

												<div id="comentarios" class="tab-pane fade">
													<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
												</div>

												<div id="recomendaciones" class="tab-pane fade">
													<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
												</div>
											</div>
										</div>	
										</div>
									</div>
								</div>
									
                                <div id="edit-panel">
                                 <?php   include 'edit_profile.ctp';
                                 ?>
                                </div>
								<!-- PAGE CONTENT ENDS -->
							</div>
							<?php }else{ 
                                include 'edit_profile.ctp';
                                }?><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
<script>
	var active="#leftp_perfil"
</script>