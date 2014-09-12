<div class="alert alert-danger data-miss" id="data-alert">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
											<span id="alert_content">

											</span>
</div>
<div class="alert alert-success" id="alert-success">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
											<p>
												<strong>
													<i class="ace-icon fa fa-check"></i>
													¡Genial!
												</strong>
												Tu pregunta ha sido enviada.
											</p>
</div>
<div class="widget-box collapsed widget-color-blue" id="search_box">
	<div class="widget-header" >
            	<div class="widget-toolbar no-border">
											

        <a href="#" class="collapse_btn" data-action="collapse">
                <i class="ace-icon fa fa-chevron-down"></i>
        </a>
        
    </div>
	<h5 class="widget-title">Hacer Pregunta</h5>

	<!-- #section:custom/widget-box.toolbar -->

	<!-- /section:custom/widget-box.toolbar -->
</div>
<div class="widget-body">
	<div class="widget-main" id="search_widget">
		<i class="ace-icon fa fa-spinner fa-spin purple" id="load_ques"></i>
<div class="form-group" >
	<form id="question-form">
	<div class="col-sm-12">
		<input type="text" id="ques_title" placeholder="Titulo de la pregunta" class="col-xs-10 col-sm-5">
		
	</div>
	<div class="col-sm-12">
	<textarea  id="ques_desc" placeholder="Descripción de la pregunta" class="col-xs-10 col-sm-5"></textarea>
	</div>
	

	

	
											<!-- /section:plugins/input.tag-input -->
												<div class="col-sm-12">
	<div id="ques_area">

		<div class="space-2"></div>

		<select class="chosen-select tag-input-style" id="form-field-select-4" data-placeholder="Escoge un área" style="display: none;">
		<option value> </option>

			<?php
		foreach ($areas as $area){
			$id=$area['Area']['id'];
			$nom=$area['Area']['area'];
			echo "<option value='$id'>$nom</option>";
		}
		?>
		</select>
	</div>
                                                                                                    										<!-- #section:plugins/input.tag-input -->
	<div id="ques_tags">
   <input type="text" name="tags" id="form-field-tags" placeholder="Etiquetas..." style="display: none;">
												
			
												
	</div>
	</div>
	</form>
	</div>
	
		<div class="col-sm-12">
		<button type="button" id="send_question" class="btn btn-primary btn-large">Hacer Pregunta</button>
		</div>
	
</div>
</div>
</div>
<div class="widget-box widget-color-blue" id="question_box">
                    <div class="widget-header" >
                            <div class="widget-toolbar no-border">


                    <a href="#" class="collapse_btn" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-down"></i>
                    </a>

                </div>
                    <h5 class="widget-title">Ver Preguntas</h5>

                    <!-- #section:custom/widget-box.toolbar -->

                    <!-- /section:custom/widget-box.toolbar -->
            </div>
             <div class="widget-body">
            <div class="col-sm-12 widget-container-col ui-sortable">
                    <div class="widget-box transparent ui-sortable-handle">
                            <div class="widget-header">

                                    <div class="col-sm-3 right width-20" >
                                    <select class="chosen-select" id="area_search" data-placeholder="Área" style="display: none;">
                                    <option> </option>
                                    <?php
                                    foreach($areas as $area){
                                        echo '<option value="'.$area["Area"]["id"].'">'.$area["Area"]["area"].'</option>';
                                    }
                                    ?>

                                    </select>

                                    </div>
                                    <div class="col-md-3">
                                        <select multiple="" class="chosen-select chosen-question tag-input-style" id="tema_filter" data-placeholder="Temas" >

                                        </select>
                                    </div> 
                                     <button class="btn-primary right" onclick="question_search()" id="change_type_button">Buscar</button>    
                                    <div class="widget-toolbar no-border">
                                            <ul class="nav nav-tabs" id="myTab2">

                                                <li id="search_tab">
                                                                <a data-toggle="tab"  href="#search_tabpane">Búsqueda</a>
                                                </li>
                                                <li class="active">
                                                                <a data-toggle="tab" id="recent_questions" href="#profile2">Recientes</a>
                                                </li>
                                                <li>
                                                                <a data-toggle="tab"  href="#myquestions">Mis preguntas</a>
                                                </li>    
                                                <li >
                                                            <a data-toggle="tab" href="#home2">Mis Áreas</a>
                                                    </li>


                                                    <li>
                                                            <a data-toggle="tab" href="#info2">Top</a>
                                                    </li>
                                            </ul>
                                    </div>
                            </div>

                            <!--<div class="widget-body">-->
                                            <div class="widget-main padding-4 no-padding-left no-padding-right">
                                                    <div class="tab-content padding-4">
                                    <div id="search_tabpane" class="tab-pane">
                                    <div class="scrollable ace-scroll" style="position: relative; padding-top: 12px;">
                                        <div class="scroll-track" style="display: block;">
                                            <div class="scroll-bar" style="left: 0px;"></div></div><div class="scroll-content" ><div >
                                        <ul id="question_search_container" class="question_container">

                                        </ul>
                                        </div></div>
                                        </div>
                                    </div>

                                <div id="profile2" class="tab-pane active">
                                    <div class="scrollable ace-scroll" style="position: relative; padding-top: 12px;"><div class="scroll-track" style="display: block;"><div class="scroll-bar" style="left: 0px;"></div></div><div class="scroll-content" ><div >
                                        <ul class="question_container">
                                            <?php
                                            //echo print_r($preguntas);
                                            foreach($rec_preguntas as $preg){
                                            echo '<li class="question_li"><a href="Post?pid='.$preg['ip_pregunta']['id'].'">';
                                                $cres=$preg['0']['crespuesta'];
                                                $votes=$preg['0']['numpreg'];
                                                if($votes===null){$votes=0;}
                                                echo '<div class="votes"><div class="respuestas_n center">
                                                        <p>Respuestas<br/>
                                                         <span style="font-weight:bold;font-size:15px">'.$cres.'</span></p>
                                                    </div>';
                                                 $class='';
                                                if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                                                echo '<div class="puntuacion_n center">
                                                        <p >Puntuación<br/>
                                                        <span style="font-weight:bold;font-size:15px" '.$class.'>'.$votes.'</span></p>
                                                    </div></div><div class="question_rest">'; 
                                                $title=$preg['ip_pregunta']['titulo'];
                                                echo '<h4 class="blue">'.$title.'</h4><p class="hashtags">';

                                                foreach($p_tags as $tag){
                                                    if($tag['PreguntaTag']['pregunta']==$preg['ip_pregunta']['id']){
                                                        $t=$tag['Tags']['tag'];
                                                        echo '<span class="label label-sm label-purple">'.$t.'</span> ';
                                                    }
                                                }
                                                echo '</p>
                                                    <p class="area">';
                                                    $autor=$preg['ip_usuario']['nombre']." ".$preg['ip_usuario']['apellido'];
                                                    $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                                                    echo $preg['ip_area']['area'].'</p><p class="autor">'.$autor.'</p><p class="fecha">'.$fecha.'</p>
                                              </div></a></li>';
                                            }
                                            ?>


                                        </ul>
                                        </div></div>
                                        </div>
                                    </div>
                                    <div id="myquestions" class="tab-pane">
                                    <div class="scrollable ace-scroll" style="position: relative; padding-top: 12px;"><div class="scroll-track" style="display: block;"><div class="scroll-bar" style="left: 0px;"></div></div><div class="scroll-content" ><div >
                                        <ul class="question_container">
                                            <?php
                                            //echo print_r($preguntas);
                                            foreach($mis_preguntas as $preg){
                                               echo '<li class="question_li"><a href="Post?pid='.$preg['ip_pregunta']['id'].'">';
                                                $cres=$preg['0']['crespuesta'];
                                                $votes=$preg['0']['numpreg'];
                                                if($votes===null){$votes=0;}
                                                echo '<div class="votes"><div class="respuestas_n center">
                                                        <p>Respuestas<br/>
                                                         <span style="font-weight:bold;font-size:15px">'.$cres.'</span></p>
                                                    </div>';
                                                 $class='';
                                                if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                                                echo '<div class="puntuacion_n center">
                                                        <p >Puntuación<br/>
                                                        <span style="font-weight:bold;font-size:15px" '.$class.'>'.$votes.'</span></p>
                                                    </div></div><div class="question_rest">'; 
                                                $title=$preg['ip_pregunta']['titulo'];
                                                echo '<h4 class="blue">'.$title.'</h4><p class="hashtags">';

                                                foreach($p_tags as $tag){
                                                    if($tag['PreguntaTag']['pregunta']==$preg['ip_pregunta']['id']){
                                                        $t=$tag['Tags']['tag'];
                                                        echo '<span class="label label-sm label-purple">'.$t.'</span> ';
                                                    }
                                                }
                                                echo '</p>
                                                    <p class="area">';
                                                    $autor=$preg['ip_usuario']['nombre']." ".$preg['ip_usuario']['apellido'];
                                                    $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                                                    echo $preg['ip_area']['area'].'</p><p class="autor">'.$autor.'</p><p class="fecha">'.$fecha.'</p>
                                              </div></a></li>';
                                            }
                                            ?>


                                        </ul>
                                        </div></div>
                                        </div>
                                    </div>
                                            <div id="home2" class="tab-pane">
                                                                                                    <!-- #section:custom/scrollbar.horizontal -->
                                                                                                    <div class="scrollable ace-scroll" style="position: relative; padding-top: 12px;"><div class="scroll-track" style="display: block;"><div class="scroll-bar" style="left: 0px;"></div></div><div class="scroll-content" ><div >
                                                                                                    <ul class="question_container">
                                                                                                            <?php
                                                                                                            //echo print_r($preguntas);
                                                                                                            foreach($preguntas as $preg){
                                                                                                              echo '<li class="question_li"><a href="Post?pid='.$preg['ip_pregunta']['id'].'">';
                                                $cres=$preg['0']['crespuesta'];
                                                $votes=$preg['0']['numpreg'];
                                                if($votes===null){$votes=0;}
                                                echo '<div class="votes"><div class="respuestas_n center">
                                                        <p>Respuestas<br/>
                                                         <span style="font-weight:bold;font-size:15px">'.$cres.'</span></p>
                                                    </div>';
                                                 $class='';
                                                if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                                                echo '<div class="puntuacion_n center">
                                                        <p >Puntuación<br/>
                                                        <span style="font-weight:bold;font-size:15px" '.$class.'>'.$votes.'</span></p>
                                                    </div></div><div class="question_rest">'; 
                                                $title=$preg['ip_pregunta']['titulo'];
                                                echo '<h4 class="blue">'.$title.'</h4><p class="hashtags">';

                                                foreach($p_tags as $tag){
                                                    if($tag['PreguntaTag']['pregunta']==$preg['ip_pregunta']['id']){
                                                        $t=$tag['Tags']['tag'];
                                                        echo '<span class="label label-sm label-purple">'.$t.'</span> ';
                                                    }
                                                }
                                                echo '</p>
                                                    <p class="area">';
                                                    $autor=$preg['ip_usuario']['nombre']." ".$preg['ip_usuario']['apellido'];
                                                    $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                                                    echo $preg['ip_area']['area'].'</p><p class="autor">'.$autor.'</p><p class="fecha">'.$fecha.'</p>
                                              </div></a></li>';
                                                                                                            }
                                                                                                            ?>


                                                                                                    </ul>
                                                                                                    </div></div>
                                                                                                    </div>

                                                                                                    <!-- /section:custom/scrollbar.horizontal -->
                                                                                            </div>							<div id="info2" class="tab-pane">
                                                                                                    <div class="scrollable ace-scroll" style="position: relative; padding-top: 12px;"><div class="scroll-track" style="display: block;"><div class="scroll-bar" style="left: 0px;"></div></div><div class="scroll-content" ><div >
                                        <ul class="question_container">
                                            <?php
                                            //echo print_r($preguntas);
                                            foreach($top_preguntas as $preg){
                                                 echo '<li class="question_li"><a href="Post?pid='.$preg['ip_pregunta']['id'].'">';
                                                $cres=$preg['0']['crespuesta'];
                                                $votes=$preg['0']['numpreg'];
                                                if($votes===null){$votes=0;}
                                                echo '<div class="votes"><div class="respuestas_n center">
                                                        <p>Respuestas<br/>
                                                         <span style="font-weight:bold;font-size:15px">'.$cres.'</span></p>
                                                    </div>';
                                                 $class='';
                                                if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                                                echo '<div class="puntuacion_n center">
                                                        <p >Puntuación<br/>
                                                        <span style="font-weight:bold;font-size:15px" '.$class.'>'.$votes.'</span></p>
                                                    </div></div><div class="question_rest">'; 
                                                $title=$preg['ip_pregunta']['titulo'];
                                                echo '<h4 class="blue">'.$title.'</h4><p class="hashtags">';

                                                foreach($p_tags as $tag){
                                                    if($tag['PreguntaTag']['pregunta']==$preg['ip_pregunta']['id']){
                                                        $t=$tag['Tags']['tag'];
                                                        echo '<span class="label label-sm label-purple">'.$t.'</span> ';
                                                    }
                                                }
                                                echo '</p>
                                                    <p class="area">';
                                                    $autor=$preg['ip_usuario']['nombre']." ".$preg['ip_usuario']['apellido'];
                                                    $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                                                    echo $preg['ip_area']['area'].'</p><p class="autor">'.$autor.'</p><p class="fecha">'.$fecha.'</p>
                                              </div></a></li>';
                                            }
                                            ?>


                                        </ul>
                                        </div></div>
                                        </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
    </div></div>
									</div>
									<script>
										var active="#leftp_preg";
										
											
									</script>