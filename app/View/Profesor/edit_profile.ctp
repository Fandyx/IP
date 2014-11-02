<?php $user = $this->Session->read('User'); ?>
<div id="user-profile-3" class="user-profile row">
    <div class="col-sm-offset-1 col-sm-10">
        <!-- <div class="well well-sm">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            &nbsp;
            <div class="inline middle blue bigger-110"> Your profile is 70% complete </div>

            &nbsp; &nbsp; &nbsp;
            <div style="width:200px;" data-percent="70%" class="inline middle no-margin progress progress-striped active">
                <div class="progress-bar progress-bar-success" style="width:70%"></div>
            </div>
        </div><!-- /.well --> 

        <div class="space"></div>

        <form class="form-horizontal" id="profile_form" enctype="multipart/form-data" action="#" method="POST">
            <div class="tabbable">
                <ul class="nav nav-tabs padding-16">
                    <li class="active">
                        <a data-toggle="tab" href="#edit-basic">
                            <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                            Información Personal
                        </a>
                    </li>



                    <li>
                        <a data-toggle="tab" href="#edit-password">
                            <i class="blue ace-icon fa fa-key bigger-125"></i>
                            Cambiar Contraseña
                        </a>
                    </li>
                </ul>

                <div class="tab-content profile-edit-tab-content">
                    <div id="edit-basic" class="tab-pane in active">
                        <h4 class="header blue bolder smaller">General</h4>

                        <div class="row">

                            <div class="col-xs-12 col-sm-4">

                                <?php
                                if (!empty($user["p_avatar"])) {
                                    echo '<img class="profile_img avatar" src="data:image/jpeg;base64,' . $user["p_avatar"] . '" id="avatar" editable>';
                                } else {
                                    echo $this->Form->input('p_avatar', array('type' => 'file', 'label' => false));
                                }
                                ?>


                            </div>

                            <div class="vspace-12-sm"></div>

                            <div class="col-xs-12 col-sm-8">
                                <!-- <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-username">Nombre de usuario</label>

                                    <div class="col-sm-8">
                                        <input class="col-xs-12 col-sm-10" type="text" name="username" id="form-username" editable required placeholder="Usuario" value="<?php echo $user["nick"] ?>" />
                                    </div>
                                </div> -->

                                <div class="space-4"></div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-first">¿Cómo te llamas?*</label>

                                    <div class="col-sm-8">
                                        <?php
                                        $nombre = "";
                                        $apellido = "";
                                        if ($user["completo"] == 0) {
                                            $nom = spliti(" ", $user["nombre"]);
                                            $nombre = $nom[0];
                                            if (sizeof($nom) > 1) {
                                                $nombre+=" " . $nom[1];
                                            }
                                            if (sizeof($nom) > 2) {
                                                $apellido = $nom[2];
                                            } else {
                                                $apellido = $user["apellido"];
                                            }
                                            if (sizeof($nom) > 3) {
                                                $apellido+=$nom[3];
                                            }
                                        } else {
                                            $nombre = $user["nombre"];
                                            $apellido = $user["apellido"];
                                        }
                                        ?>
                                        <input class="input-medium" type="text" name="nombre"  id="nombre" placeholder="Nombre" value="<?= $nombre ?>"/>
                                        <input class="input-medium" type="text" name="apellido" id="apellido" placeholder="Apellido" required value="<?= $apellido ?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"  for="form-field-ciudad">¿Dónde vives?*</label>

                                    <div class="col-sm-8">
                                        <input class="col-xs-12 col-sm-10 ciudad" type="text" name="ciudad" id="ciudad" required placeholder="Ciudad" value="<?php echo $user["ciudad"] ?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right">¿Precio de clase por hora?</label>
                                    <div class="col-sm-8"> 
                                        <input type="text" placeholder="Precio/hora" value="<?= $user["precio_hora"] ?>" name="precio_hora" id="precio">
                                        <input <?php if ($user["negociable"] == "1") echo "checked"; ?> name="negociable" type="checkbox" id="negociable"  class="ace valid area_chk" aria-required="true" aria-invalid="true"><span class="lbl">Negociable</span>
                                    </div>

                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-select">¿Cuál es tu rol?*</label>

                                    <div class="col-sm-8">
                                        <select class="col-xs-12 col-sm-10" id="form-type-select" name="tipo">
                                            <option value="3" <?php
                                            if ($user["tipo"] == 3) {
                                                echo "selected";
                                            }
                                            ?>>Profesor</option>
                                            <option value="2" <?php
                                            if ($user["tipo"] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Estudiante</option>
                                            <option value="1" <?php
                                            if ($user["tipo"] == 1) {
                                                echo "selected";
                                            }
                                            ?>>Padre de Familia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-first">¿Dónde estudian tus clientes?*</label>

                                    <div class="col-sm-8">
                                        <?php
                                        $nombre = "";
                                        $apellido = "";
                                        $c_input = "";
                                        $u_input = "";
                                        $o_input = "";
                                        $c_checked = "";
                                        $u_checked = "";
                                        $o_checked = "";
                                        $c_name = "";
                                        $u_name = "";
                                        $o_name = "";
                                        $c_visible = "";
                                        $u_visible = "";
                                        $o_visible = "";
                                        $first_c = true;
                                        $first_u = true;
                                        $first_o = true;

                                        foreach ($u_instituto as $instituto) {
                                            $button_c = "";
                                            $button_u = "";
                                            $button_o = "";

                                            if ($instituto["ip_instituto"]["tipo"] == 1) {
                                                $c_checked = " checked";
                                                $c_name = $instituto["ip_instituto"]["instituto"];
                                                $c_visible = "style='display:block;'";
                                                if ($first_c) {
                                                    $button_c = "<button  " . $c_visible . " class='btn btn-info btn-sm ins_name'  type='button' id='add_col'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button>";
                                                    $first_c = false;
                                                } else {
                                                    $button_c = "<button onclick='$(this).parent().remove()' class='btn btn-danger btn-sm ins_name' style='display:block' type='button' class='del_col'><i class='white ace-icon ace-icon glyphicon glyphicon-minus'></i></button>";
                                                }
                                                $c_input.="<span><input type='text' placeholder='Especifique Colegio...' class='colegio ins_name col-sm-10 valid' id='nom-col' name='nom-cole[]' value='" . $c_name . "' " . $c_visible . "/>" . $button_c;
                                            }




                                            if ($instituto["ip_instituto"]["tipo"] == 2) {
                                                $u_checked = " checked";
                                                $u_name = $instituto["ip_instituto"]["instituto"];
                                                $u_visible = "style='display:block;'";
                                                if ($first_u) {

                                                    $button_u = "<button  " . $u_visible . " class='btn btn-info btn-sm ins_name'  type='button' id='add_univ'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button>";
                                                    $first_u = false;
                                                } else {
                                                    $button_u = "<button onclick='$(this).parent().remove()' class='btn btn-danger btn-sm ins_name' style='display:block' type='button' class='del_col'><i class='white ace-icon ace-icon glyphicon glyphicon-minus'></i></button>";
                                                }
                                                $u_input.="<span><input type='text' placeholder='Especifique Universidad...' class='ins_name col-xs-12 col-sm-10 valid universidad' id='nom-univ' name='nom-univ[]' value='" . $u_name . "' " . $u_visible . "/>" . $button_u;
                                            }


                                            if ($instituto["ip_instituto"]["tipo"] == 3) {
                                                $o_checked = " checked";
                                                $o_name = $instituto["ip_instituto"]["instituto"];
                                                $o_visible = "style='display:block;'";
                                                if ($first_o) {

                                                    $button_o = "<button  " . $o_visible . " class='btn btn-info btn-sm ins_name'  type='button' id='add_otro'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button>";
                                                    $first_o = false;
                                                } else {
                                                    $button_o = "<button onclick='$(this).parent().remove()' class='btn btn-danger btn-sm ins_name' style='display:block' type='button' class='del_col'><i class='white ace-icon ace-icon glyphicon glyphicon-minus'></i></button>";
                                                }
                                                $o_input.="<span><input type='text' id='nom-otro' placeholder='Especifique Otro...' class='ins_name col-xs-12 col-sm-10 valid' name='nom-otro[]' value='" . $o_name . "' " . $o_visible . "/>" . $button_o;
                                            }
                                        }
                                        echo '<label class="pad-10">
                                                                                <input name="instituto" type="checkbox" id="check-col"  class="ace valid ins_chk" aria-required="true" aria-invalid="true"' . $c_checked . '>
                                                                                <span class="lbl">Colegio</span>
                                                                                
                                                                                </label>';
                                        echo '<label class="pad-10"><input name="instituto"  type="checkbox" id="check-univ"  class="ace valid ins_chk" aria-required="true" aria-invalid="true"' . $u_checked . '>
                                                                                <span class="lbl">Universidad</span>
                                                                                </label>';
                                        echo '<label class="pad-10">
                                                                                <input name="instituto" type="checkbox" id="check-otro"  class="ace valid ins_chk" aria-required="true" aria-invalid="true"' . $o_checked . '>
                                                                                <span class="lbl">Otro</span>
                                                                                </label><div id="ins_names">';
                                        if ($c_input == "") {
                                            $c_input = "<span><input type='text' placeholder='Especifique Colegio...' class='colegio ins_name col-sm-10 valid' id='nom-col' name='nom-cole[]' /> <button class='btn btn-info btn-sm ins_name' type='button' id='add_col'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button></span>";
                                        } if ($u_input == "") {
                                            $u_input = "<span><input type='text' placeholder='Especifique Universidad...' class='ins_name col-xs-12 col-sm-10 valid universidad' name='nom-univ[]' id='nom-univ'/><button class='btn btn-info btn-sm ins_name' type='button' id='add_univ'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button></span>";
                                        } if ($o_input == "") {
                                            $o_input = "<span><input type='text' id='nom-otro' placeholder='Especifique Otro...' class='ins_name col-xs-12 col-sm-10 valid' name='nom-otro[]' /><button class='btn btn-info btn-sm ins_name' type='button' id='add_otro'><i class='white ace-icon ace-icon glyphicon glyphicon-plus'></i></button></span>";
                                        }
                                        echo $c_input;
                                        echo "<div id='extra_col'></div>";
                                        echo $u_input;
                                        echo "<div id='extra_univ'></div>";
                                        echo $o_input;
                                        echo "<div id='extra_otro'></div>";
                                        echo "</div>"
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-date">¿En qué fecha naciste?*</label>

                            <div class="col-sm-9">
                                <div class="input-medium">
                                    <div class="input-group">
                                        <?php
                                        $time = substr($user["fecha_nacimiento"], 0, -9);

                                        $val = $time;
                                        if ($time == "0000-00-00") {
                                            $val = "";
                                        } else {
                                            $time = strtotime(substr($user["fecha_nacimiento"], 0, -9));
                                            $val = $time;
                                            $val = date('d-m-Y', $val);
                                        }
                                        ?>
                                        <input class="input-medium date-picker" id="fecha_nacimiento" name="fecha_nacimiento" type="text" data-date-format="dd-mm-yyyy" value="<?= $val ?>" placeholder="dd-mm-yyyy" />


                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="space-4"></div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right">¿Cuál es tu género?*</label>

                            <div class="col-sm-9">
                                <label class="inline">
                                    <input name="sexo" type="radio" class="ace" value="M" <?php if ($user["sexo"] == 'M') echo 'checked' ?> required/>
                                    <span class="lbl middle"> Masculino</span>
                                </label>

                                &nbsp; &nbsp; &nbsp;
                                <label class="inline">
                                    <input name="sexo" type="radio" class="ace" value="F"  <?php if ($user["sexo"] == 'F') echo 'checked' ?> required/>
                                    <span class="lbl middle"> Femenino</span>
                                </label>
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Cuéntanos sobre ti <br/><small>(Descripción general del perfil)</small> </label>

                            <div class="col-sm-6">
                                <textarea id="descripcion" name="descripcion" class="form-control limited" maxlength="150"><?= $user["descripcion"] ?></textarea>
                            </div>
                        </div>

                        <div class="space"></div>
                        <h4 class="header blue bolder smaller">Información Personal</h4>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-email">Documento*</label>

                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <select id="tipo_doc" name="tipo_doc" class="chosen-select">
                                        <option value="">--Tipo de Documento--</option>
                                        <option value="CC" <?php if ($user["tipo_doc"] == "CC") echo "selected"; ?>>Cédula de Ciudadanía</option>
                                        <option value="TI" <?php if ($user["tipo_doc"] == "TI") echo "selected"; ?>>Tarjeta de Identidad</option>
                                        <option value="CE" <?php if ($user["tipo_doc"] == "CE") echo "selected"; ?>>Cédula de Extranjería</option>
                                        <option value="PP" <?php if ($user["tipo_doc"] == "PP") echo "selected"; ?>>Pasaporte</option>
                                    </select>
                                    <input type="text" id="document" name="documento" value="<?= $user['documento'] ?>" />

                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email*</label>

                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <input type="email" id="email" name="email" value="<?= $user['email'] ?>" />
                                    <i class="ace-icon fa fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Celular*</label>

                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <input class="input"  aria-required="true" aria-invalid="true" value="<?= $user["telefono1"] ?>" name="telefono1" type="text" id="telefono1" />
                                    <i class="ace-icon fa fa-mobile-phone fa-flip-horizontal"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Teléfono 2 (Opcional)</label>

                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <input class="input-mask-phone" aria-required="true" aria-invalid="true" value="<?= $user["telefono2"] ?>" name="telefono2" type="text" id="telefono2" />
                                    <i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Teléfono 3 (Opcional)</label>

                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <input class="input-mask-phone" aria-required="true" aria-invalid="true" name="telefono3" value="<?= $user["telefono3"] ?>" type="text" id="telefono3" />
                                    <i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9">
                                <span class="input-icon input-icon-right">
                                    <label>

                                        <input <?php if ($user["contactar"] == "1" || ($user["completo"] == 0 && $user["contactar"] == null)) echo "checked"; ?> name="contactar" type="checkbox" id="contactar"  class="ace valid area_chk" aria-required="true" aria-invalid="true">
                                        <span class="lbl"> Deseo que mi información de contacto (Email y Teléfonos) esté disponible al público para que me puedan contactar.</span>
                                    </label>

                                </span>
                            </div>
                        </div>
                        <div class="space"></div>
                        <h4 class="header blue bolder smaller">Educación y Experiencia</h4>
                        <h5>Educación*</h5> 
                        <div class="profile-user-info" id="prof_edu">
                            <?php
                            if (sizeof($profe_edu) == 0) {
                                ?>

                                <div class="profile-info-row educacion_prof">

                                    <select class="col-sm-2" name="tipo_edu[]" >
                                        <option value="F" >Formal</option>
                                        <option value="NF"> No Formal</option>
                                    </select>

                                    <select class="col-sm-2" name="inst_edu[]">
                                        <option value="2" >Universidad</option>
                                        <option value="3">Otro</option>
                                    </select>
                                    <input type="text" placeholder="Nombre de la institución"  name="nombre_inst[]" class="universidad col-sm-3">
                                    <input type="text" placeholder="Título Obtenido" name="titulo[]" class=" col-sm-2">
                                    <input type="text" placeholder="Año" class="input-mini spinner-input form-control instituto col-sm-1" name="year_inst[]" maxlength="4">
                                    <button class="btn btn-info btn-sm" type="button" id="add_edu">
                                        <i class="white ace-icon ace-icon glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                                <?php
                            } else {
                                $first = true;



                                foreach ($profe_edu as $pe) {

                                    $pe = $pe["ProfesorEducacion"];
                                    echo '<div class="profile-info-row educacion_prof">
                                                                    
                                                                        <select class="col-sm-2" name="tipo_edu[]" >
                                                                            <option value="F"';
                                    if ($pe["tipo"] == "F") {
                                        echo 'selected';
                                    }echo '>Formal</option>
                                                                             <option value="NF"';
                                    if ($pe["tipo"] == "NF") {
                                        echo 'selected';
                                    }echo'> No Formal</option>
                                                                        </select>
                                                                       
                                                                        <select class="col-sm-2" name="inst_edu[]">
                                                                            <option value="2"';
                                    if ($pe["instituto_tipo"] == "2") {
                                        echo 'selected';
                                    }echo'>Universidad</option>
                                                                            <option value="3"';
                                    if ($pe["instituto_tipo"] == "3") {
                                        echo 'selected';
                                    }echo'>Otro</option>
                                                                        </select>
                                                                        <input type="text" placeholder="Nombre de la institución" value="' . $pe["instituto_nombre"];
                                    echo'" name="nombre_inst[]" class="universidad col-sm-3">
                                                                        <input type="text" placeholder="Título Obtenido" value="' . $pe["titulo"];
                                    echo'" name="titulo[]" class=" col-sm-2">
                                                                         <input type="text" placeholder="Año" value="' . $pe["ano"] . '" class="input-mini spinner-input form-control instituto col-sm-1" name="year_inst[]" maxlength="4">
                                                                            ';
                                    if ($first) {
                                        $first = false;
                                        echo ' <button class="btn btn-info btn-sm" id="add_edu">
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-plus"></i>
                                                                        </button></div>';
                                    } else {
                                        echo '<button class="btn btn-danger btn-sm" onclick="$(this).parent().remove()">
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-minus"></i>
                                                                        </button>
                                                                    </div>';
                                    }
                                }
                            }
                            ?>
                        </div>  
                        <h5>Experiencia</h5>
                        <div class="profile-user-info" id="prof_exp">

                            <?php if (sizeof($profe_exp) == 0) { ?>
                                <div class="profile-info-row educacion_prof">
                                    <select class="col-sm-2" name="tipo_exp[]">
                                        <option value="E">Empleado</option>
                                        <option value="I">Independiente</option>
                                    </select>

                                    <input type="text"  name="inst_exp[]" placeholder="¿Dónde trabajaste?" class="instituto col-sm-4">
                                    <input type="text"  name="rol_exp[]" placeholder="Rol" class="col-sm-3">
                                    <input type="text"  name="year_exp[]" placeholder="Años" class="input-mini spinner-input form-control instituto col-sm-1" maxlength="2">
                                    <button class="btn btn-info btn-sm" id="add_exp">
                                        <i class="white ace-icon ace-icon glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                                <?php
                            } else {
                                $first = true;
                                foreach ($profe_exp as $pe) {

                                    $pe = $pe["ProfesorExperiencia"];
                                    echo '<div class="profile-info-row educacion_prof">
                                                                    
                                                                        <select class="col-sm-2" name="tipo_exp[]" >
                                                                            <option value="E"';
                                    if ($pe["tipo"] == "E") {
                                        echo 'selected';
                                    }echo '>Empleado</option>
                                                                             <option value="I"';
                                    if ($pe["tipo"] == "I") {
                                        echo 'selected';
                                    }echo'>Independiente</option>
                                                                        </select>
                                                                       
                                                                       <input type="text"  name="inst_exp[]" placeholder="¿Dónde trabajaste?" class="instituto col-sm-4" value="' . $pe["nombre"] . '">
                                                                         <input type="text"  name="rol_exp[]" placeholder="Rol" class="instituto col-sm-3" value="' . $pe["rol"] . '">
                                                                          <input type="text"  name="year_exp[]" placeholder="Años"  maxlength="2" class="input-mini spinner-input form-control instituto col-sm-1" value="' . $pe["anos"] . '" >
                                                                     ';
                                    if ($first) {
                                        $first = false;
                                        echo ' <button class="btn btn-info btn-sm" id="add_exp">
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-plus"></i>
                                                                        </button></div>';
                                    } else {
                                        echo '<button class="btn btn-danger btn-sm" onclick="$(this).parent().remove()">
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-minus"></i>
                                                                        </button>
                                                                    </div>';
                                    }
                                }
                            }
                            ?>  
                        </div>

                        <div class="space"></div>
                        <h4 class="header blue bolder smaller">Intereses</h4>
                        <h6 class="grey">Selecciona las áreas del conocimiento que enseñas.</h6>
                        <div class="form-group">

                            <div class="col-xs-12 col-lg-12 form-inline">
                                <?php
                                $cont = 0;
                                foreach ($areas as $area) {
                                    if ($cont % 2 == 0) {
                                        $class = " class='area_left'";
                                    } else {
                                        $class = " class='area_right'";
                                    }
                                    $sel = "";
                                    $display = "none";
                                    $i = 0;
                                    while ($i < sizeof($u_area)) {

                                        if ($area["Area"]["id"] == $u_area[$i]["ip_area"]["id"]) {
                                            $sel = "checked";
                                            $display = "block";
                                        }
                                        $i++;
                                    }
                                    $a_tags = "";
                                    foreach ($u_tags as $tag) {
                                        if ($tag["ip_tags"]["area"] == $area["Area"]["id"]) {
                                            if ($a_tags == "") {
                                                $a_tags = $tag["ip_tags"]["tag"];
                                            } else {
                                                $a_tags = $a_tags . " ," . $tag["ip_tags"]["tag"];
                                                ;
                                            }
                                        }
                                    }
                                    echo ('<div' . $class . '>
                                                                    <label>
                                                                        <input name="subscription" type="checkbox" id="check-' . $area["Area"]["id"] . '"  class="ace valid area_chk" aria-required="true" aria-invalid="true" ' . $sel . '>
                                                                        <span class="lbl">' . $area["Area"]["area"] . '</span>
                                                                    </label>
                                                                        <div class="area_cont" id="area_cont_' . $area["Area"]["id"] . '" style="display:' . $display . ';">
                                                                        <input type="text" class="area_temas" name="temas-' . $area["Area"]["id"] . '" id="temas-' . $area["Area"]["id"] . '"  placeholder="Ingresa algunos temas ..." value="' . $a_tags . '" style="display:' . $display . ';">
                                                                            <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Ingresa temas relativos a esta area enseñes (Ej: ' . $area["Area"]["descripcion"] . ')" title="">?</span>
                                                                        </div>
                                                                </div>');
                                    $cont++;
                                }
                                ?>


                            </div>
                        </div>

                        <div class="space-4"></div>


                    </div>



                    <div id="edit-password" class="tab-pane">
                        <div class="space-10"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right " for="form-field-pass1">Nueva Contraseña</label>

                            <div class="col-sm-9">
                                <input type="password"  autocomplete="off" class="n_password" />
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirmar Contraseña</label>

                            <div class="col-sm-9">
                                <input type="password" name="pass" id="password2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix form-actions">
                <div class="col-md-9">
                    <button class="btn btn-info" id="form-send" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Guardar Cambios
                    </button>
                    <button class="btn btn-cancel" id="cancel-change" type="submit">
                        <i class="ace-icon fa fa-times bigger-110"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div><!-- /.span -->
</div><!-- /.user-profile -->