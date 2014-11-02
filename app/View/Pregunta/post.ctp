<div  id="pregunta_container">
    <div class="col-xs-1 center margin-top-50">
        <div class="ace-spinner touch-spinner">
            <div class="input-group">
                <div>
                    <button class="btn-link" id='upvote_btn' onclick='upvote_p(<?= $pregunta["Pregunta"]["id"] ?>)'>
                        <?php
                        $color = "";
                        if ($vote == "1") {
                            echo '<i class="green ace-icon ace-icon fa fa-thumbs-up fa-2x" ></i>';
                        } else {
                            echo '<i class="green ace-icon ace-icon fa fa-thumbs-o-up fa-2x" ></i>';
                        }
                        ?>
                    </button>
                </div>
                <?php
                if ($voto_preg > 0) {
                    $color = "green";
                } else if ($voto_preg < 0) {
                    $color = "red";
                }
                ?>
                <div class="votes_number <?= $color ?>" id="pregunta_votes"><?= $voto_preg == "" ? 0 : $voto_preg ?></div>

                <div>                 

                    <button class="btn-link" id='downvote_btn' onclick='downvote_p(<?= $pregunta["Pregunta"]["id"] ?>)'>

                        <?php
                        if ($vote == "-1") {
                            echo '  <i class=" ace-icon ace-icon fa fa-thumbs-down red fa-2x"></i>';
                        } else {
                            echo '  <i class=" ace-icon ace-icon fa fa-thumbs-o-down red fa-2x"></i>';
                        }
                        ?>
                    </button>            

                </div></div></div>
    </div>
    <div class="col-xs-11"  style="z-index:1000">
        <div class="widget-container-col ui-sortable">
            <!-- #section:custom/widget-box.options.transparent -->
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xs-6 margin-top-20">

                            <h4 class="widget-title lighter"><?= $pregunta["Pregunta"]["titulo"] ?></h4>
                        </div> 
                        <div class="col-xs-6">
                            <h4 class="widget-title lighter align-right">
                                <?= $pregunta["Area"]["area"] ?><br/>
                                <?php
                                foreach ($p_tags as $tag) {
                                    if ($tag['PreguntaTag']['pregunta'] == $pregunta['Pregunta']['id']) {
                                        $t = $tag['Tag']['tag'];
                                        echo '<span class="label label-sm label-purple">' . $t . '</span> ';
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
                            <p><?= $pregunta["Pregunta"]["pregunta"] ?></p>
                        </div>
                        <small>

                            Publicado por 
                            <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content= "
                                  <img class='modal_img' src='data:image/png;base64,<?= $pregunta["Usuario"]["p_avatar"] ?>'/>
                                  <span id='profile-modal'>
                                  <?php
                                  if ($pregunta["Usuario"]["tipo"] == 3) {
                                      echo "Profesor <i class='ace-icon fa fa-book purple'></i>";
                                  }
                                  if ($pregunta["Usuario"]["tipo"] == 2) {
                                      echo "Estudiante <i class='ace-icon fa fa-graduation-cap purple'></i>";
                                  }
                                  if ($pregunta["Usuario"]["tipo"] == 1) {
                                      echo "Padre de Familia <i class='ace-icon fa fa-home purple'></i>";
                                  }
                                  ?>
                                  <br/><?= $pregunta["Usuario"]["ciudad"] ?> <i class='ace-icon fa fa-map-marker purple'></i><br/>
                                  <p class='user_description'><?= $pregunta["Usuario"]["descripcion"] ?> </p>
                                  </span>" data-original-title="<i class='ace-icon fa fa-user purple'></i> <?= $pregunta["Usuario"]["nombre"] . " " . $pregunta["Usuario"]["apellido"] ?>" aria-describedby="popover34171"><a href="../Usuarios/profile?uid=<?= $pregunta["Usuario"]["id"] ?>"><?= $pregunta["Usuario"]["nombre"] . " " . $pregunta["Usuario"]["apellido"] ?></a></span>                                               
                            <br/>
                            Fecha: <?= $pregunta["Pregunta"]["fecha_pregunta"] ?>
                            <?php $img = "'http://www.instaprofe.com/assets/images/apple_back2.png'"; ?>

                        </small>
                        <br/>
                        <a href="#" id="share-<?= $pregunta["Pregunta"]["id"] ?>" class="share_user" 
                           onclick="fb_share('<?= strtoupper($pregunta["Usuario"]["nombre"] . " " . $pregunta["Usuario"]["apellido"]) ?> Preguntó: <?= $pregunta['Pregunta']["titulo"] ?>',
                                           'http://www.instaprofe.com/Pregunta/Post?pid=<?= $pregunta["Pregunta"]["id"] ?>',<?= $img ?>, 'Pregunta de <?= $pregunta["Area"]["area"] ?>',
                                           'Ingresa ya a Instaprofe.com para resolverla.')">
                            <i class="ace-icon fa fa-facebook-square bigger-150 blue"></i>
                            Compartir
                        </a>
                    </blockquote>
                </div>
            </div>

            <!-- /section:custom/widget-box.options.transparent -->
        </div>
    </div>
</div>

<div class="widget-box transparent ui-sortable-handle">
    <div class="widget-header">
        <h4 class="widget-title lighter"><span id="respuestas_n"><?= sizeof($respuestas) ?></span> Respuestas</h4>
    </div>
    <div class="widget-body">
        <div id="responses">
            <?php
            foreach ($respuestas as $respuesta) {

                $m_res = !($respuesta["Respuesta"]["mejor_respuesta"] == null);
                $res_class = "";
                if ($m_res) {
                    $res_class = "bestanswer";
                }
                ?>

                <div class="row" id="respuesta-<?= $respuesta["Respuesta"]["id"] ?>">
                    <div class="col-xs-1 center">
                        <div class="ace-spinner touch-spinner">
                            <div class="input-group">
                                <div>
                                    <button class="btn-link" id ="upvote-<?= $respuesta["Respuesta"]["id"] ?>" onclick='upvote_r(<?= $respuesta["Respuesta"]["id"] ?>)'>
                                        <?php
                                        $color = "";
                                        $voted = $respuesta[0]["voted"];
                                        if ($voted == "1") {
                                            echo '<i class="green ace-icon ace-icon fa fa-thumbs-up fa-2x" ></i>';
                                        } else {
                                            echo '<i class="green ace-icon ace-icon fa fa-thumbs-o-up fa-2x" ></i>';
                                        }
                                        ?>
                                    </button>
                                </div>
                                <?php
                                $voto_res = $respuesta[0]["nvotes"];
                                if ($voto_res > 0) {
                                    $color = "green";
                                } else if ($voto_res < 0) {
                                    $color = "red";
                                }
                                ?>
                                <div class="votes_number <?= $color ?>" id="votes-<?= $respuesta["Respuesta"]["id"] ?>"><?= $voto_res ?></div>

                                <div>                 

                                    <button class="btn-link" id="downvote-<?= $respuesta["Respuesta"]["id"] ?>" onclick='downvote_r(<?= $respuesta["Respuesta"]["id"] ?>)'>
                                        <?php
                                        if ($voted == "-1") {
                                            echo '  <i class=" ace-icon ace-icon fa fa-thumbs-down red fa-2x"></i>';
                                        } else {
                                            echo '  <i class=" ace-icon ace-icon fa fa-thumbs-o-down red fa-2x"></i>';
                                        }
                                        ?></button>            

                                </div>
                                <?php
                                if ($m_res) {
                                    echo '<span class="badge badge-transparent bestanswer_chk" title="El usuario que pregunto, marcó esta como la mejor respuesta.">
									<i class="ace-icon fa fa-check green fa-2x"></i>
								</span>';
                                }
                                ?>
                            </div></div>
                    </div>
                    <div class="col-xs-11  <?= $res_class ?>">
                        <blockquote class="pull-left">
                            <div class="widget-main padding-6 no-padding-left no-padding-right">
                                <p><?= $respuesta["Respuesta"]["respuesta"] ?></p>
                            </div>
                            <small>

                                Publicado por 
                                <span class="btn-link no-padding btn-sm popover-info" data-rel="popover" data-placement="right" title="" data-content= "
                                      <img class='modal_img' src='data:image/png;base64,<?= $respuesta["Usuario"]["p_avatar"] ?>'/>
                                      <span id='profile-modal'>
                                      <?php
                                      if ($respuesta["Usuario"]["tipo"] == 3) {
                                          echo "Profesor <i class='ace-icon fa fa-book purple'></i>";
                                      }
                                      if ($respuesta["Usuario"]["tipo"] == 2) {
                                          echo "Estudiante <i class='ace-icon fa fa-graduation-cap purple'></i>";
                                      }
                                      if ($respuesta["Usuario"]["tipo"] == 1) {
                                          echo "Padre de Familia <i class='ace-icon fa fa-home purple'></i>";
                                      }
                                      ?>
                                      <br/><?= $respuesta["Usuario"]["ciudad"] ?> <i class='ace-icon fa fa-map-marker purple'></i><br/>
                                      <p class='user_description'><?= $respuesta["Usuario"]["descripcion"] ?> </p>
                                      </span>" data-original-title="<i class='ace-icon fa fa-user purple'></i> <?= $respuesta["Usuario"]["nombre"] . " " . $respuesta["Usuario"]["apellido"] ?>" aria-describedby="popover34171"><a href="../Usuarios/profile?uid=<?= $respuesta["Usuario"]["id"] ?>"><?= $respuesta["Usuario"]["nombre"] . " " . $respuesta["Usuario"]["apellido"] ?></a></span>                                               
                                <br/>
                                Fecha: <?= $respuesta["Respuesta"]["fecha_respuesta"] ?>

                            </small>

                            <?php
                            $user = $this->Session->read("User");
                            if ($pregunta["Usuario"]["id"] == $user["id"] && !$m_res) {
                                echo '<button class="btn-primary btn-sm" id="bestAnswer-' . $respuesta["Respuesta"]["id"] . '" onclick="bestAnswer(' . $respuesta["Respuesta"]["id"] . ')" style="margin-top:10px;">Marcar como Mejor Respuesta</button>';
                            } else if ($pregunta["Usuario"]["id"] == $user["id"]) {
                                echo '<button class="btn-danger btn-sm" id="unBestAnswer-' . $respuesta["Respuesta"]["id"] . '" onclick="unBestAnswer(' . $respuesta["Respuesta"]["id"] . ')" style="margin-top:10px;">Desmarcar como Mejor Respuesta</button>';
                            }
                            ?>
                        </blockquote>
                    </div>
                </div>       
            <?php } ?>                                                            


        </div>
        <i class="ace-icon fa fa-spinner fa-spin purple" id="load_resp"></i>
        <div class="col-xs-11" id="comment_box"> 
            <textarea class="col-xs-11 respuesta_txt" id="respuesta" placeholder="Escribe tu respuesta"></textarea>
            <button id="resp_send" class="btn btn-primary respuesta_txt">Enviar Respuesta</button></div>
    </div>

    <script>var active = "#leftp_preg"</script>