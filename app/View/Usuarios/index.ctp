<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">
            <div class="center">
                <img src="assets/images/INSTAPROFE_1.png" alt="logo" id="login_logo"/>
                <h4 class="white" id="id-company-text">¡Tu red de acompañamiento educativo!</h4>
            </div>
            <?php echo $this->Session->flash() ?>
            <div class="space-6"></div>

            <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">

                    <div class="widget-body">
                        <div class="widget-main">
                            <h4 class="header blue lighter bigger">
                                <i class="ace-icon fa fa-key"></i>
                                Recuperar contraseña
                            </h4>

                            <div class="space-6"></div>
                            <p>
                                Ingresa tu Email para recibir instrucciones
                            </p>

                            <?php echo $this->Form->end(); ?>
                            <form id="forgot-pass" action="Email/forget" method="POST">
                                <fieldset>
                                    <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="email" name="email" class="form-control" placeholder="Email" />
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                    </label>

                                    <div class="clearfix">
                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                            <i class="ace-icon fa fa-mail-forward"></i>
                                            <span class="bigger-110">Enviar</span>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div><!-- /.widget-main -->

                        <div class="toolbar white center">
                            <a href="Home" class="back-to-login-link white">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Regresar al login

                            </a>
                        </div>
                    </div><!-- /.widget-body -->

                    <!-- /.widget-body -->
                </div><!-- /.login-box -->
            </div><!-- /.position-relative -->
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->