<?php
$user = $this->Session->read('User');
?>                                          
<input type="hidden" value="<?= $user["tipo"] == 3 ? 2 : 3 ?>" id="search_type">
<div class="row">
    <div id="col_search" class="col-xs-6 col-sm-8">
        <div class="tabbable tabs-below">
            <div class="tab-content">
                <div id="profesores" class="tab-pane   <?php
                if ($user["tipo"] != 3) {
                    echo 'active';
                }
                ?>">
                    <div class="input-group">
                        <div class="col-md-7">

                            <select class="chosen-select" id="area_search_prof" data-placeholder="Busco un profesor de...(Área*)" style="display: none;">
                                <option> </option>
                                <?php
                                foreach ($areas as $area) {
                                    echo '<option value="' . $area["Area"]["id"] . '">' . $area["Area"]["area"] . '</option>';
                                }
                                ?>

                            </select>

                        </div>


                        <script>
                            var u_ciudad = '<?= $user["ciudad"] ?>';
                        </script>
                        <div class="col-md-5">
                            <span class="input-icon" id='ciudad_container'>
                                <input class="ciudad" id="filter_ciudad_prof" placeholder="En la ciudad de..." value="<?php echo $user["ciudad"] ?>" />
                                <i class='ace-icon fa fa-map-marker gray'></i>
                            </span>
                        </div>

                        <br/><div class="space-10"></div>
                        <div class="advanced" id="advanced-es">
                            <div class="col-md-7">
                                <select multiple="" class="chosen-select tag-input-style" id="tema_filter_prof" data-placeholder="Que sepa de...(Temas)" >

                                </select>
                            </div>
                            <div class="col-md-5" id="inst_container_prof">
                                <span class="input-icon">
                                    <input id="inst_filter_prof" class="instituto" placeholder="Que de clases en...(Institución)">
                                    <i class="ace-icon fa fa-university gray"></i>
                                </span>

                            </div>

                        </div>



                        <span class="input-group-btn">
                            <button id="prof_search" type="button" class="prof_search btn btn-purple btn-sm">

                                Buscar
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                        </span>

                    </div>


                    <button class="btn-link right" onclick="$('#advanced-es').slideToggle()">Búsqueda Avanzada</button>

                </div>

                <div id="estudiantes" class="tab-pane <?php
                if ($user["tipo"] == 3) {
                    echo 'active';
                }
                ?>">
                    <div class="input-group">
                        <div class="col-md-7">

                            <select class="chosen-select" id="area_search_est" data-placeholder="Busco estudiantes interesados en...(Área)" style="display: none;">
                                <option> </option>
                                <?php
                                foreach ($areas as $area) {
                                    echo '<option value="' . $area["Area"]["id"] . '">' . $area["Area"]["area"] . '</option>';
                                }
                                ?>

                            </select>

                        </div>


                        <script>
                            var u_ciudad = '<?= $user["ciudad"] ?>';
                        </script>
                        <div class="col-md-5">
                            <span class="input-icon" id='ciudad_container'>
                                <input class="ciudad" id="filter_ciudad_est" placeholder="En la ciudad de..." value="<?php echo $user["ciudad"] ?>" />
                                <i class='ace-icon fa fa-map-marker gray'></i>
                            </span>
                        </div>

                        <br/><div class="space-10"></div>
                        <div class="advanced" id="advanced-pr">
                            <div class="col-md-7">

                                <select multiple="" class="chosen-select tag-input-style" id="tema_filter_est" data-placeholder="Que quieran saber de...(Temas)" >

                                </select>

                            </div>
                            <div class="col-md-5" id="inst_container_est">
                                <span class="input-icon">
                                    <input id="inst_filter_est" class="instituto" placeholder="Que de clases en...(Institución)">
                                    <i class="ace-icon fa fa-university gray"></i>
                                </span>

                            </div>

                        </div>



                        <span class="input-group-btn">
                            <button id="est_search" type="button" class="prof_search btn btn-purple btn-sm">

                                Buscar
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                            </button>
                        </span>

                    </div>


                    <button class="btn-link right" onclick="$('#advanced-pr').slideToggle()">Búsqueda Avanzada</button>
                </div>

            </div>

            <ul class="nav nav-tabs" id="myTab2">
                <?php if ($user["tipo"] == 3) { ?>
                    <li class="active">
                        <a data-toggle="tab" href="#estudiantes">Estudiantes</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#profesores">Profesores</a>
                    </li>
                <?php } else { ?>
                    <li class="active">
                        <a data-toggle="tab" href="#profesores">Profesores</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#estudiantes">Estudiantes</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
        <div class="space-6" ></div>
        <i class="ace-icon fa fa-spinner fa-spin purple" id="load_prof"></i>

        <!-- #section:custom/widget-box.options.transparent -->
        <div class="widget-box transparent ui-sortable-handle" id="wid-results">
            <div class="widget-header">

                <h4 class="widget-title lighter">Resultados de Búsqueda</h4>
                <div class="widget-toolbar">
                    <small>Items por página</small>
                    <div>
                        <select id="ipp"><option value="10" selected>10</option><option value="20">20</option><option value="30">30</option></select>
                    </div>
                </div>

            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">

                    <!-- #section:custom/scrollbar -->


                    <div  id="search_list_container">

                        <ul id="search_list" class="dd-list">

                        </ul>                
                        <div id="bottom-page"></div>
                    </div>


                    <!-- /section:custom/scrollbar -->
                </div>


            </div>
        </div>




    </div>



    <!-- /section:custom/widget-box.header.options -->
<!--    <div class="col-xs-4" id="misareas">
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
    </div>-->

</div>

<script>
    var active = "#leftp_inicio";
    var u_area =<?= json_encode($usuarioAreas) ?>;

</script>