                               <div class="row" id="pregunta_container">
                                    <div class="col-xs-1 center margin-top-50">
                                    <div class="ace-spinner touch-spinner">
                                        <div class="input-group">
                                           <div>
                                               <button class="btn-link">
                                            <i class="green ace-icon ace-icon fa fa-plus fa-2x"></i>
                                             </button>
                                            </div>
                                            
                                            <div class="votes_number"><?=$voto_preg?></div>
                                            
                                             <div>                 
                                              
                                                      <button class="btn-link"><i class=" ace-icon ace-icon fa fa-minus red fa-2x"></i></button>            
                                                       
                                            </div></div></div>
                                    </div>
                                    <div class="col-xs-11">
                                    <div class="widget-container-col ui-sortable">
                                        <!-- #section:custom/widget-box.options.transparent -->
                                        <div class="widget-box transparent ui-sortable-handle">
                                            <div class="widget-header">
                                              <div class="row">
                                                  <div class="col-xs-6 margin-top-20">
                                                    
                                                <h4 class="widget-title lighter"><?=$pregunta["Pregunta"]["titulo"]?></h4>
                                                 </div> 
                                                 <div class="col-xs-6">
                                                 <h4 class="widget-title lighter align-right">
                                                     <?=$pregunta["Area"]["area"]?><br/>
                                                     <?php
                                                     
                                                 foreach($p_tags as $tag){
                                                                        if($tag['PreguntaTag']['pregunta']==$pregunta['Pregunta']['id']){
                                                                            $t=$tag['Tag']['tag'];
                                                                            echo '<span class="label label-sm label-purple">'.$t.'</span> ';
                                                                        }
                                                                    }
                                                 ?> 
                                                 </h4>
                                                
                                                 </div>
                                            </div>
                                            </div>
                                            <div class="widget-body" style="display: block;">
                                        
                                                <blockquote class="pull-left">
                                                    <div class="widget-main padding-6 no-padding-left no-padding-right">
                                                    <p><?=$pregunta["Pregunta"]["pregunta"]?></p>
                                                </div>
                                                    <small>
                                                            
                                                Posteado por 
                                                <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content= "
                                                <img class='modal_img' src='data:image/png;base64,<?=$pregunta["Usuario"]["p_avatar"]?>'/>
                                                <span id='profile-modal'>
                                                <?php
                                                 if($pregunta["Usuario"]["tipo"]==3){echo "Profesor <i class='ace-icon fa fa-book purple'>";}
                                                 if($pregunta["Usuario"]["tipo"]==2){echo "Estudiante <i class='ace-icon fa fa-graduation-cap purple'></i>";}
                                                 if($pregunta["Usuario"]["tipo"]==3){echo "Padre de Familia <i class='ace-icon fa fa-home purple'>";}?>
                                                  <br/><?=$pregunta["Usuario"]["ciudad"]?> <i class='ace-icon fa fa-map-marker purple'></i><br/>
                                                <?=$pregunta["Usuario"]["descripcion"]?> 
                                               </span>" data-original-title="<i class='ace-icon fa fa-user purple'></i> <?=$pregunta["Usuario"]["nombre"]." ".$pregunta["Usuario"]["apellido"]?>" aria-describedby="popover34171"><?=$pregunta["Usuario"]["nombre"]." ".$pregunta["Usuario"]["apellido"]?></span>                                               
                                                 <br/>
                                                    Fecha: <?=$pregunta["Pregunta"]["fecha_pregunta"]?>
                                                    </small>
                                                </blockquote>
                                            </div>
                                        </div>

                                        <!-- /section:custom/widget-box.options.transparent -->
                                    </div>
                                    </div>
                                </div>
                              
                                 <div class="widget-box transparent ui-sortable-handle">
                                  <div class="widget-header">
                                        <h4 class="widget-title lighter"><?=sizeof($respuestas)?> Respuestas</h4>
                                  </div>
                                  <div class="widget-body">
                                                      <div id="responses">
                                      <?php 
                                                foreach($respuestas as $respuesta){
                                                   
                                                ?>
                                    <div class="row">
                                        <div class="col-xs-1 center">
                                            <div class="ace-spinner touch-spinner">
                                        <div class="input-group">
                                           <div>
                                               <button class="btn-link">
                                            <i class="green ace-icon ace-icon fa fa-plus fa-2x"></i>
                                             </button>
                                            </div>
                                            
                                            <div class="votes_number"><?=sizeof($respuesta["RespuestaVoto"])?></div>
                                            
                                             <div>                 
                                              
                                                      <button class="btn-link"><i class=" ace-icon ace-icon fa fa-minus red fa-2x"></i></button>            
                                                       
                                            </div></div></div>
                                        </div>
                                      <div class="col-xs-11">
                                     <blockquote class="pull-left">
                                                    <div class="widget-main padding-6 no-padding-left no-padding-right">
                                                    <p><?=$respuesta["Respuesta"]["respuesta"]?></p>
                                                </div>
                                                    <small>
                                                            
                                                Posteado por 
                                                <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content= "
                                                <img class='modal_img' src='data:image/png;base64,<?=$respuesta["Usuario"]["p_avatar"]?>'/>
                                                <span id='profile-modal'>
                                                <?php
                                                 if($respuesta["Usuario"]["tipo"]==3){echo "Profesor <i class='ace-icon fa fa-book purple'></i>";}
                                                 if($respuesta["Usuario"]["tipo"]==2){echo "Estudiante <i class='ace-icon fa fa-graduation-cap purple'></i>";}
                                                 if($respuesta["Usuario"]["tipo"]==1){echo "Padre de Familia <i class='ace-icon fa fa-home purple'></i>";}?>
                                                  <br/><?=$respuesta["Usuario"]["ciudad"]?> <i class='ace-icon fa fa-map-marker purple'></i><br/>
                                                <?=$respuesta["Usuario"]["descripcion"]?> 
                                               </span>" data-original-title="<i class='ace-icon fa fa-user purple'></i> <?=$respuesta["Usuario"]["nombre"]." ".$respuesta["Usuario"]["apellido"]?>" aria-describedby="popover34171"><?=$respuesta["Usuario"]["nombre"]." ".$respuesta["Usuario"]["apellido"]?></span>                                               
                                                 <br/>
                                                    Fecha: <?=$respuesta["Respuesta"]["fecha_respuesta"]?>
                                                    </small>
                                        </blockquote>
                                        </div>
                                     </div>       
                                               <?php }?>                                                            
                     
                                
                                  </div>
                                  <i class="ace-icon fa fa-spinner fa-spin purple" id="load_resp"></i>
                                  <div class="col-xs-11" id="comment_box"> 
                                  <textarea class="col-xs-11 respuesta_txt" id="respuesta" placeholder="Escribe tu respuesta"></textarea>
                                  <button id="resp_send" class="btn btn-info respuesta_txt">Enviar</button></div>
                                  </div>

                                <script>var active="#leftp_preg"</script>