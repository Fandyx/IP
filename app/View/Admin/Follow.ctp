
<title>Panel de Admin - Instaprofe</title>
<!-- ajax layout which only needs content area -->

<div class="page-header">
    <h1>
        Panel de Control
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Datos Administrador
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row" id="admin_panel">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <!-- <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                </button>

                <i class="ace-icon fa fa-check green"></i>

                Welcome to
                <strong class="green">
                        Ace
                        <small>(v1.3.1)</small>
                </strong>,
the lightweight, feature-rich and easy to use admin template.
        </div> -->
        <div class="row">
            <div class="space-6"></div>

            <div class=" infobox-container">
                <!-- #section:pages/dashboard.infobox -->
                <div class="infobox infobox-green">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-users"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            print_r($c_registrados);
                            ?>
                        </span>
                        <div class="infobox-content">Registrados</div>
                    </div>

                    <!-- #section:pages/dashboard.infobox.stat -->
                    <!-- <div class="stat stat-success">8%</div> -->

                    <!-- /section:pages/dashboard.infobox.stat -->
                </div>

                <div class="infobox infobox-blue">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-book"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            print_r($c_profesores);
                            ?>
                        </span>
                        <div class="infobox-content">Profesores</div>
                    </div>

                    <!-- <div class="badge badge-success">
                            +32%
                            <i class="ace-icon fa fa-arrow-up"></i>
                    </div> -->
                </div>

                <div class="infobox infobox-pink">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-pencil"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            print_r($c_estudiantes);
                            ?>
                        </span>
                        <div class="infobox-content">Estudiantes</div>
                    </div>
                    <!-- <div class="stat stat-important">4%</div> -->
                </div>

                <div class="infobox infobox-red">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-child"></i>
                    </div>

                    <div class="infobox-data">
                        <span class="infobox-data-number">
                            <?php
                            print_r($c_padres);
                            ?>
                        </span>
                        <div class="infobox-content">Padres de Familia</div>
                    </div>
                </div>

                <div class="space-6"></div>
                <div class="btn_tables" id="reg_users"><span>+</span> Lista de seguidores</div>
                <table id="tabla_users" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Quien sigue</th>
                            <th>email</th>
                            <th>A quien sigue</th>
                            <th>email</th>
                            <th>
                                <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                Fecha de contacto
                            </th>
                         
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($follow as $row) {
                            $sigue = $row["Follow"]["usuario_sigue"];
                            $seguido = $row["Follow"]["usuario_seguido"];
                            $fecha = $row["Follow"]["fecha"];
                            $nameUsuario = $this->requestAction('/Admin/nameUser/' . $sigue);
                            $us1=  explode(";", $nameUsuario);
                            $nameUsuario2 = $this->requestAction('/Admin/nameUser/' . $seguido);
                            $us2=  explode(";", $nameUsuario2);
                            echo "<tr><td class='capitalize'>$us1[0]</td><td>$us1[1]</td><td>$us2[0]</td><td>$us2[1]</td><td>$fecha</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
<!--                <div class="btn_tables" id="reg_profe"><span>+</span> Profesores Registrados</div>
                <table id="tabla_profe" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Nombre</th>

                            <th>Institución</th>
                            <th>Tipo</th>
                            <th>Ciudad</th>
                            <th>
                                Enseña
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
//                        foreach ($profesores as $r) {
//                            $nombre = $r["ip_usuario"]["nombre"];
//                            $instituto = "";
//                            $tipo = "";
//                            $ciudad = "";
//                            $area = "";
//                            echo "<tr><td class='capitalize'>$nombre</td><td class='capitalize'>$instituto</td><td>$tipo</td><td>$ciudad</td><td class='capitalize'>$areas</td></tr>";
//                        }
                        ?>

                    </tbody>
                </table>
                <div class="btn_tables" id="reg_est"><span>+</span>  Estudiantes Registrados</div>
                <table id="tabla_est" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Institucion</th>
                            <th>Tipo</th>
                            <th>Ciudad</th>
                            <th>
                                Interesado en:
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
//                        $result = mysqli_query($con, "SELECT ip_usuario.id,nombre,ip_instituto_tipo.tipo as tipo, ip_instituto.instituto as ins,ciudad 
//													FROM ip_usuario left outer join ip_usuario_instituto on ip_usuario.id=ip_usuario_instituto.usuario 
//													left outer join ip_instituto on ip_usuario_instituto.instituto=ip_instituto.id 
//													left outer join ip_instituto_tipo on ip_instituto_tipo.id=ip_instituto.tipo where ip_usuario.tipo=2");
//                        while ($row = mysqli_fetch_array($result)) {
//                            $nombre = mb_strtolower($row['nombre'], 'utf8');
//                            $instituto = $row['ins'];
//                            $ciudad = $row['ciudad'];
//                            $tipo = $row['tipo'];
//                            $areas = "";
//
//                            $result2 = mysqli_query($con, "SELECT ip_area.area as area FROM ip_usuario inner join ip_usuario_area on ip_usuario.id=ip_usuario_area.usuario inner join ip_area on ip_usuario_area.area=ip_area.id where ip_usuario.id=" . $row["id"]);
//                            while ($row2 = mysqli_fetch_array($result2)) {
//                                $areas = $areas . $row2["area"] . ", ";
//                            }
//                            $areas = substr($areas, 0, -2);
//                            echo "<tr><td class='capitalize'>$nombre</td><td class='capitalize'>$instituto</td><td>$tipo</td><td>$ciudad</td><td class='capitalize'>$areas</td></tr>";
//                        }
                        ?>

                    </tbody>
                </table>
                <div class="btn_tables" id="reg_pad"><span>+</span>  Padres de Familia Registrados</div>
                <table id="tabla_pad" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Institucion</th>
                            <th>Tipo</th>
                            <th class="hidden-480">Ciudad</th>
                            <th>
                                Interesado en:
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
//                        $result = mysqli_query($con, "SELECT ip_usuario.id,ip_instituto_tipo.tipo as tipo,nombre, ip_instituto.instituto as ins,ciudad 
//													FROM ip_usuario left outer join ip_usuario_instituto on ip_usuario.id=ip_usuario_instituto.usuario 
//													left outer join ip_instituto on ip_usuario_instituto.instituto=ip_instituto.id
//													left outer join ip_instituto_tipo on ip_instituto_tipo.id=ip_instituto.tipo where ip_usuario.tipo=1");
//                        while ($row = mysqli_fetch_array($result)) {
//                            $nombre = mb_strtolower($row['nombre'], 'utf8');
//                            $instituto = $row['ins'];
//                            $ciudad = $row['ciudad'];
//                            $tipo = $row['tipo'];
//                            $areas = "";
//
//                            $result2 = mysqli_query($con, "SELECT ip_area.area as area FROM ip_usuario inner join ip_usuario_area on ip_usuario.id=ip_usuario_area.usuario inner join ip_area on ip_usuario_area.area=ip_area.id where ip_usuario.id=" . $row["id"]);
//                            while ($row2 = mysqli_fetch_array($result2)) {
//                                $areas = $areas . $row2["area"] . ", ";
//                            }
//                            $areas = substr($areas, 0, -2);
//                            echo "<tr><td class='capitalize'>$nombre</td><td class='capitalize'>$instituto</td><td>$tipo</td><td>$ciudad</td><td class='capitalize'>$areas</td></tr>";
//                        }
                        ?>

                    </tbody>
                </table>
            </div>-->


            <!-- #section:custom/extra.hr -->
            <div class="hr hr32 hr-dotted"></div>

            <!-- /section:custom/extra.hr -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="../../assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/my.js"></script>
<script>
    var active = "#leftp_inicio"
</script>

