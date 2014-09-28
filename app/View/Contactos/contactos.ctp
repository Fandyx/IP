<div class="widget-box transparent ui-sortable-handle">
    <div class="widget-header">
        
    <h4>
            Contactos
            <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Usuarios a los que he solicitado información de contacto
            </small>
    </h4>
    </div>

    <div class="widget-body">
        <div class="clearfix">
            <?php
            foreach ($contactos as $c) {
                ?>
                <div class="itemdiv memberdiv">
                    <?php
                    if($c["Usuario"]["p_avatar"]==null){?>
                    <div class="user">
                        <img alt="avatar" src="../assets/avatars/avatar5.png">
                    </div>
                        <?php }else{?>
                    <div class="user">
                        <img alt="avatar" src="data:image/png;base64,<?=$c["Usuario"]["p_avatar"]?>">
                    </div>
                        <?php }?>
                    <div class="body">
                        <div class="name">
                            <a href="../Usuarios/profile?uid=<?=$c["Usuario"]["id"]?>"><?= $c["Usuario"]["nombre"] . " " . $c["Usuario"]["apellido"] ?></a>
                        </div>

                        <div class="time">
                            <i class="ace-icon fa fa-clock-o"></i>
                            <span class="green"><?=$c["Contacto"]["fecha"]?></span>
                        </div>

                        <div><?php
                            if($c["Calificacion"]["calificacion"]!=null){?>
                            <div>
                                <span class="label label-success label-sm">Calificación: <?=$c["Calificacion"]["calificacion"]?> <i class="ace-icon fa fa-star"></i></span>
                            </div>
                          <?php  }
                            else{?>
                             <div>
                                <span class="label label-danger label-sm">No Calificado</span>
                            </div>
                          <?php  }?>
                       
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<script>
    var active="#leftp_contacto,#hecontactado";
    
    </script>