<div class="widget-box transparent ui-sortable-handle">
    <div class="widget-header">
        <h4>
            Contactos
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Usuarios que han solicitado mi información de contacto
            </small>
        </h4>
    </div>

    <div class="widget-body">
        <div class="clearfix">
            <?php
            if (sizeof($contactos) == 0) {
                echo '0 Usuarios encontrados';
            }
            foreach ($contactos as $c) {
                ?>
                <div class="itemdiv memberdiv">
                    <?php if ($c["Usuario"]["p_avatar"] == null) { ?>
                        <div class="user">
                            <img alt="avatar" src="../assets/avatars/avatar5.png">
                        </div>
                    <?php } else { ?>
                        <div class="user">
                            <img alt="avatar" src="data:image/png;base64,<?= $c["Usuario"]["p_avatar"] ?>">
                        </div>
                    <?php } ?>
                    <div class="body">
                        <div class="name">
                            <a href="../Usuarios/profile?uid=<?= $c["Usuario"]["id"] ?>"><?= $c["Usuario"]["nombre"] . " " . $c["Usuario"]["apellido"] ?></a>
                        </div>

                        <div class="time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span class="green"><?= $c["Contacto"]["fecha"] ?></span>
                        </div>
                        <div class="contacted">
                            <input <?php
                            if ($c["Contacto"]["contactado"] == "1") {
                                echo "disabled='true' checked";
                            }
                            ?> name="contactado" type="checkbox" id="contactado-<?= $c["Usuario"]["id"] ?>"  class="ace valid area_chk contactado" aria-required="true" aria-invalid="true">
                            <span class="lbl"> Me contrató</span>

                        </div>
                        <div><?php if ($c["Calificacion"]["calificacion"] != null) { ?>
                                <div>
                                    <small class="center">Calificación recibida:</small>
                                </div>
                                <div>
                                    <span class="white" id="star_container"><input  type="number" class="teach_stars" min=0 max=5 data-size="xs" value="<?= $c["Calificacion"]["calificacion"] ?>"></span>

                                </div>
                            <?php } else {
                                ?>
                                <div>
                                    <small class="center">Calificación recibida:</small>
                                </div>
                                <div>
                                    <span class="label label-danger label-sm">No Calificado</span>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<script>
    var active = "#leftp_contacto,#hancontactado";

</script>