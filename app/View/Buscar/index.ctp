                                                   
                                    <div class="row">
                                            <div id="col_search" class="col-xs-6 col-sm-8">
                                                   <?php
                                                    $user=$this->Session->read('User');
                                                    ?>
                                                <?php if($user["tipo"]==3){?>
                                                    <div class="input-group">
                                                           <div class="col-md-7">
     
                                                        <select class="chosen-select" id="area_search" data-placeholder="Busco estudiantes interesados en...(Área)" style="display: none;">
                                                        <option> </option>
                                                        <?php
                                                        foreach($areas as $area){
                                                            echo '<option value="'.$area["Area"]["id"].'">'.$area["Area"]["area"].'</option>';
                                                        }
                                                        ?>
                                                            
                                                        </select>
                                                       
                                                        </div>
                                                       
                                                 
                                                        <script>
                                                        var u_ciudad='<?=$user["ciudad"]?>';
                                                        </script>
                                                        <div class="col-md-5">
                                                              <span class="input-icon" id='ciudad_container'>
                                                            <input class="ciudad" id="filter_ciudad" placeholder="En la ciudad de..." value="<?php echo $user["ciudad"]?>" />
                                                           <i class='ace-icon fa fa-map-marker gray'></i>
                                                              </span>
                                                        </div>
                                                        
                                                        <br/><div class="space-10"></div>
                                                        <div class="advanced" id="advanced">
                                                        <div class="col-md-7">
                                                         
                                                            <select multiple="" class="chosen-select tag-input-style" id="tema_filter" data-placeholder="Que quieran saber de...(Temas)" >
																
                                                            </select>
                                                           
                                                        </div>
                                                         <div class="col-md-5" id="inst_container">
                                                             <span class="input-icon">
                                                             <input id="inst_filter" class="instituto" placeholder="Que de clases en...(Institución)">
                                                             <i class="ace-icon fa fa-university gray"></i>
                                                             </span>
                                                            
                                                        </div>
                                                        
                                                        </div>
                                                       
                                                       
                                                       
                                                         <span class="input-group-btn">
                                                                    <button id="prof_search" type="button" class="btn btn-purple btn-sm">

                                                                            Buscar
                                                                            <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                                                    </button>
                                                            </span>
                                                         
                                                    </div>
                                                        <input type="hidden" value="2" id="search_type">
                                                         <button class="btn-link right" onclick="changeType()" id="change_type_button">Buscar Profesores</button>
                                                         <button class="btn-link right" onclick="$('#advanced').slideToggle()">Búsqueda Avanzada</button>
                                                <?php }else{?>
                                                      <div class="input-group">
                                                           <div class="col-md-7">
     
                                                        <select class="chosen-select" id="area_search" data-placeholder="Busco un profesor de...(Área*)" style="display: none;">
                                                        <option> </option>
                                                        <?php
                                                        foreach($areas as $area){
                                                            echo '<option value="'.$area["Area"]["id"].'">'.$area["Area"]["area"].'</option>';
                                                        }
                                                        ?>
                                                            
                                                        </select>
                                                       
                                                        </div>
                                                       
                                                  
                                                        <script>
                                                        var u_ciudad='<?=$user["ciudad"]?>';
                                                        </script>
                                                        <div class="col-md-5">
                                                             <span class="input-icon" id='ciudad_container'>
                                                         <input class="ciudad" id="filter_ciudad" placeholder="En la ciudad de..." value="<?php echo $user["ciudad"]?>" />
                                                         <i class='ace-icon fa fa-map-marker gray'></i>
                                                              </span>
                                                        </div>
                                                        
                                                        <br/><div class="space-10"></div>
                                                        <div class="advanced" id="advanced">
                                                        <div class="col-md-7">
                                                            <select multiple="" class="chosen-select tag-input-style" id="tema_filter" data-placeholder="Que sepa de...(Temas)" >
																
                                                            </select>
                                                        </div>
                                                         <div class="col-md-5" id="inst_container">
                                                             <span class="input-icon">
                                                             <input id="inst_filter" class="instituto" placeholder="Que de clases en...(Institución)">
                                                             <i class="ace-icon fa fa-university gray"></i>
                                                             </span>
                                                            
                                                        </div>
                                                        
                                                        </div>
                                                       
                                                       
                                                       
                                                         <span class="input-group-btn">
                                                                    <button id="prof_search" type="button" class="btn btn-purple btn-sm">

                                                                            Buscar
                                                                            <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                                                    </button>
                                                            </span>
                                                         
                                                    </div>
                                                        <input type="hidden" value="3" id="search_type">
                                                         <button class="btn-link right" onclick="changeType()" id="change_type_button">Buscar Estudiantes</button>
                                                         <button class="btn-link right" onclick="$('#advanced').slideToggle()">Búsqueda Avanzada</button>
                                                    
                                                    
                                                    <?php } ?>
                                                     <div class="space-6" ></div>
                                                       <i class="ace-icon fa fa-spinner fa-spin purple" id="load_prof"></i>
                                                   
										<!-- #section:custom/widget-box.options.transparent -->
										<div class="widget-box widget-color-green ui-sortable-handle" id="wid-results">
											<div class="widget-header">
                                                                                         
												<h4 class="widget-title lighter">Resultados de Búsqueda</h4>

												
											</div>

											<div class="widget-body">
                                                                                        <div class="widget-main padding-4">
                                                                                            
													<!-- #section:custom/scrollbar -->
													<div class="scrollable ace-scroll scroll-active" data-height="100" style="position: relative;">
                                                                                                           
														
															<div  id="search_list_container">
                                                                                                                          
                                                                                                     <ul id="search_list" class="dd-list">

                                                                                                     </ul>                
                   
                                                                                                  </div>
													</div>

													<!-- /section:custom/scrollbar -->
												</div>
                                                                                                
												
											</div>
										</div>



                                           
</div>
  
 

<!-- /section:custom/widget-box.header.options -->
<div class="col-xs-4" id="misareas">
    <div class="widget-box widget-color-blue2">
            <div class="widget-header">
                    <h4 class="widget-title lighter smaller">Mis Áreas</h4>
            </div>

            <div class="widget-body">
                    <div class="widget-main padding-8">
                            <div id="tree1" class="tree tree-unselectable">
                              
                            </div>
                    </div>
            </div>
    </div>
</div>

</div>

<script>
var active="#leftp_inicio";
var u_area=<?=json_encode($usuarioAreas)?>;

</script>