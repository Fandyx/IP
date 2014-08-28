		<?php
		$user=$this->Session->read('User');
		?>
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
													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
														Seguir
													</a>

													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-envelope bigger-120 pink"></i>
														Contactar
													</a>
                                                    <a href="#" id="edit" class="btn btn-link">
                                                        <i class="ace-icon fa fa-gear bigger-120 purple"></i>
                                                        Editar
                                                    </a>
												
												</div>

												<div class="space-6"></div>

											</div>

											<!-- /section:pages/profile.contact -->
											<div class="hr hr12 dotted"></div>

											<!-- #section:custom/extra.grid -->
											<div class="clearfix">
												<div class="grid2">
													<span class="bigger-175 blue">25</span>

													<br />
													Seguidores
												</div>

												<div class="grid2">
													<span class="bigger-175 blue">12</span>

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
													<span class="line-height-1 bigger-170"> 4 </span>

													<br />
													<span class="line-height-1 smaller-90"> Preguntas Hechas </span>
												</span>

												<span class="btn btn-app btn-sm btn-blue no-hover">
													<span class="line-height-1 bigger-170"> 8 </span>

													<br />
													<span class="line-height-1 smaller-90">Preguntas Resueltas </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 5  </span>

													<br />
													<span class="line-height-1 smaller-90"> Mejores Respuestas </span>
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

											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="ace-icon fa fa-rss orange"></i>
														Actividad Reciente
													</h4>

													<div class="widget-toolbar action-buttons">
														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh blue"></i>
														</a>
&nbsp;
														<a href="#" class="pink">
															<i class="ace-icon fa fa-trash-o"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-8">
														<!-- #section:pages/profile.feed -->
														<div id="profile-feed-1" class="profile-feed">
															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="data:image/jpeg;base64,<?=$user["p_avatar"]?>" />
																	<a class="user" href="#"><?=$user["nombre"]?> </a>
																	cambió su foto de perfil.
															

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		hace 1 hora
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Susan Smith's avatar" src="../assets/avatars/avatar1.png" />
																	<a class="user" href="#"> Susana Rojas </a>

																	se ha puesto en contacto con <?=$user["nombre"]?>
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		hace 2 horas
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
																	<a class="user" href="#"> <?=$user["nombre"]?> </a>
																	empezó a seguir el área de
																	<a href="#">Matemáticas</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		hace 5 horas
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-question btn-info no-hover"></i>
																	<a class="user" href="#"> <?=$user["nombre"]." ".$user["apellido"]?> </a>
																	respondio una pregunta de Física.
																	<a href="#"> Ver pregunta</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		Hace 5 horas
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															
														</div>

														<!-- /section:pages/profile.feed -->
													</div>
												</div>
											</div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<div class="center">
												<button type="button" class="btn btn-sm btn-primary btn-white btn-round">
													<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
													<span class="bigger-110">Ver mas</span>

													<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
												</button>
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