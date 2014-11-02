


<!-- NAVBAR-->
<!--===============================================================-->
<div id="hide-bar">
    <nav class="navbar-inverse navbar-fixed-top animated" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="scroll-smooth" href="#home">
                    <img class="navbar-brand" src="assets/images/INSTAPROFE_1.png" alt="logo">
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="scroll-bootstrap collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="scroll-smooth" href="#home">Inicio</a></li>
                    <li><a class="scroll-smooth" href="#beneficios">Beneficios</a></li>
                    <li><a class="scroll-smooth" href="#funcionalidades">Funciones</a></li>
                    <li><a class="scroll-smooth" href="#news">Prensa</a></li>
                    <li><a class="scroll-smooth" href="#contact">Contáctanos</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- INTRO-->
<!--===============================================================-->
<div id="home">
    <div class="bg-intro">
        <div class="layer-intro">
            <div class="container container-intro">
                <div class="row-intro row">
                    <div class="col-sm-12 col-xs-12">
                        <h1 class="title-intro animated fadeInLeft">¡Tu red de acompañamiento educativo!</h1>
                        <h2 class="subtitle-intro animated fadeInRight">¡Resuelve dudas académicas, contacta profesores especializados, y mejora tu desempeño!</h2>
                        <h3 class="subtitle-intro animated fadeInRight shadow1"><strong>¡Regístrate, es gratis!</strong></h3>
                        <div class="btn-delay animated fadeInUp">

                            <div id="signup-box" class="signup-box widget-box no-border">
                                <?php echo $this->Session->flash() ?>
                                <div class="widget-body">
                                    <div class="widget-main">

                                        <form id="register_form" method="POST" action="Usuarios/authOrRegister">
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="email"  id="email" name="email" class="form-control" placeholder="Email*" />
                                                        <i class="ace-icon fa fa-envelope"></i>
                                                    </span>
                                                </label>

                                                <label class="clearfix" style="display:none" id="selrol">
                                                    <span class="block input-icon input-icon-right">
                                                        <select id="rol" name="rol"  data-placeholder="Escoge tu Rol">
                                                            <option value="">-Escoge Tu Rol*-</option>
                                                            <option value="3">Profesor</option>
                                                            <option value="2">Estudiante</option>
                                                            <option value="1">Padre De Familia</option>
                                                        </select>
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                </label>

                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña*" />
                                                        <i class="ace-icon fa fa-lock"></i>
                                                        <span><a href="Usuarios" class="forgot-link" target="blank">Olvidé mi contraseña</a></span>
                                                    </span>
                                                </label>

                                                <label class=" clearfix" style="display:none" id="reppass">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Repetir Contraseña*" />
                                                        <i class="ace-icon fa fa-retweet"></i>
                                                    </span>
                                                </label>

                                                <label class="clearfix" style="display:none" id="termsycond">
                                                    <input id="agree" name="agree" type="checkbox" aria-required="true"  class="ace valid" />
                                                    <span class="lbl">
                                                        Acepto los
                                                        <a href="Home/terms">Términos y Condiciones</a>
                                                    </span>
                                                </label>

                                                <div class="space-12"></div>

                                                <div class="clearfix">
                                                    <input type="hidden" id="lor" name="lor"/>
                                                    <button  type="button" value="button" class="login_button width-50 pull-left btn btn-sm yellow-p">

                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Iniciar Sesión</span>

                                                    </button>

                                                    <button type="button" value="button" class=" register_button width-50 pull-right btn btn-sm btn-info ingresa">
                                                        <span class="bigger-110">Registrarme</span>

                                                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                    </button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>


                                </div><!-- /.widget-body -->
                            </div>
                        </div>
                    </div>

                    <!-- IMAC SLIDER -->
                    <div class="col-imac col-sm-6  col-sm-offset-3 col-xs-12">
                        <div class="col-sl  animated fadeInDown"> 
                            <img class="img-imac" src="assets/images/imac-slider/imac.png" alt="imac">
                            <div class="wrapper-sl wrapper-imac">
                                <!-- SLIDER-IMAGES -->
                                <ul id="slider-imac" class="slider" >
                                    <li><img src="assets/images/print3.png" alt="slide-3"/></li>
                                    <li><img src="assets/images/print2.png" alt="slide-2"/></li>
                                    <li><img src="assets/images/print1.png" alt="slide-1"/></li>

                                </ul>
                                <div class="wrapper-nav">
                                    <div class="div-p div-p-imac"><i id="p-imac"></i></div>
                                    <div class="div-n div-n-imac"><i id="n-imac"></i></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- IMAC SLIDER END -->


                </div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES-->
<!--===============================================================-->
<div id="beneficios">
    <div class="bg-features">
        <div class="container">
            <div class="row-features row">
                <div class="col-features col-sm-4 wow fadeInLeft">
                    <h1 class="title-features">Profesor</h1>
                    <img src="assets/images/profesor.png" alt="features-1" class="img_features">

                    <p class="p-features">Aumenta tus ingresos, resuelve dudas y consigue más clientes </p>
                </div>
                <div class="col-features col-sm-4 wow fadeInUp">
                    <h1 class="title-features">Padre de Familia</h1>
                    <img src="assets/images/acudiente.png" alt="features-2" class="img_features">

                    <p class="p-features">Sigue el desempeño académico de tus hijos y contacta profesores especializados</p>
                </div>
                <div class="col-features col-sm-4 wow fadeInRight">
                    <h1 class="title-features">Estudiante</h1>
                    <img src="assets/images/estudiante.png" alt="features-3" class="img_features">

                    <p class="p-features">Contacta profesores particulares, resuelve tus inquietudes y mejora tus notas</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- IMAC-->
<!--===============================================================-->
<div class="bg-imac" >
    <div class="container-imac container">
        <div class="row-imac row ">
            <div class="col-imac col-sm-6 col-xs-12">
                <div class="tic wow fadeInLeft">
                    <h5 class="imac-p"><span class="glyphicon glyphicon-ok"></span>Encuentra y contrata profesores.</h5>  
                </div>   
                <div class="tic wow fadeInLeft" data-wow-delay="0.1s">
                    <h5 class="imac-p"><span class="glyphicon glyphicon-ok"></span>Califícalos y recomiéndalos.</h5>
                </div>
                <div class=" tic wow fadeInLeft" data-wow-delay="0.2s">
                    <h5 class="imac-p"><span class="glyphicon glyphicon-ok"></span>Consigue gran variedad de clases.</h5>
                </div>
                <div class=" tic wow fadeInLeft" data-wow-delay="0.4s">
                    <h5 class="imac-p"><span class="glyphicon glyphicon-ok"></span>Formula y resuelve preguntas.</h5>
                </div>
                <div class="tic wow fadeInLeft" data-wow-delay="0.5s">
                    <h5 class="imac-p"><span class="glyphicon glyphicon-ok"></span>Comparte tu experiencia en redes sociales.</h5>
                </div>
            </div>
            <!-- SLIDER-BROWSER-->
            <!--===============================================================-->
            <div class="col-browser col-sm-6  col-xs-12">
                <div class="col-sl wow fadeInUp"> 
                    <img class="img-browser" src="assets/images/browser-slider/browser.png" alt="browser">
                    <div class="wrapper-sl wrapper-browser">
                        <ul id="slider-intro" class="slider" >
                            <li><img src="assets/images/print4.png" alt="slide-4"/></li>
                            <li><img src="assets/images/print5.png" alt="slide-5"/></li>
                            <li><img src="assets/images/print6.png" alt="slide-6"/></li>

                        </ul>
                        <div class="wrapper-nav">
                            <div class="div-p div-p-browser"><i id="p-intro"></i></div>
                            <div class="div-n div-n-browser"><i id="n-intro"></i></div>
                        </div>
                    </div>
                </div>
            </div><!-- SLIDER-BROWSER-END-->
        </div>
    </div>
</div>

<!-- SERVICES-->
<!--===============================================================-->
<div>
    <div class="bg-services" id="funcionalidades">
        <div class="container">
            <div class="row-services-header row">
                <div class="col-sm-12 wow fadeInUp">
                    <h1 class="header-title">¿Qué puedo hacer en Instaprofe?</h1>
                    <h2 class="subtitle">Busca y Encuentra, Pregunta y Resuelve, Califica y Comparte.</h2>

                </div>
            </div>
            <div class="space-20"></div>
            <div class="row-services row">
                <div class="col-services col-sm-4 wow fadeInLeft"  data-wow-delay="0.3s">
                    <span class="glyphicon glyphicon-search"></span>
                    <h3 class="title-services">Busca y Encuentra</h3>
                    <p class="p-services">Contacta profesores expertos en más de <strong>15</strong> áreas del conocimiento y más de <strong>150</strong> temas relacionados</p>
                </div>
                <div class="col-services col-sm-4 wow fadeInDown" data-wow-delay="0.3s">
                    <span class="glyphicon glyphicon-question-sign"></span>
                    <h3 class="title-services">Pregunta y Resuelve</h3>
                    <p class="p-services">Publica tus inquietudes en cualquier área, obtén respuestas y selecciona la mejor </p>
                </div>
                <div class="col-services col-sm-4 wow fadeInRight"  data-wow-delay="0.3s">
                    <span class="glyphicon glyphicon-ok"></span>
                    <h3 class="title-services">Califica y Comparte</h3>
                    <p class="p-services">Califica tu experiencia con profesores que hayas contratado y recomiendalo en tus redes sociales.</p>
                </div>
            </div>
            <div class="row-services-last row">
                <div class="col-services col-sm-4 wow fadeInLeft">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    <h3 class="title-services">Profesores</h3>
                    <p class="p-services">Contamos con más de <strong>150</strong> Profesores expertos en diversas áreas del conocimiento.</p>
                </div>
                <div class="col-services col-sm-4 wow fadeInUp" data-wow-delay="0.3s">
                    <span class="glyphicon glyphicon-book"></span>
                    <h3 class="title-services">Estudiantes</h3>
                    <p class="p-services">Contamos con más de <strong>150</strong> Estudiantes de colegio, universitarios y otras instituciones interesados en diversas áreas.</p>
                </div>
                <div class="col-services col-services-last col-sm-4 wow fadeInRight">
                    <span class="glyphicon glyphicon-user"></span>
                    <h3 class="title-services">Padres de Familia</h3>
                    <p class="p-services">Contamos con más de <strong>100</strong> Padres de Familia interesados en mejorar el rendimiento académico de sus hijos</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PORTFOLIO-->
<!--===============================================================-->
<div id="news">
    <div class="bg-portfolio">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="header-title">¿Quienes hablan de nosotros?</h1>
                    <h2 class="subtitle">Instaprofe en los medios de comunicación</h2>
                    <hr class="hr-portfolio">
                </div>
            </div>


            <div id="Grid" class="row">
                <div class="mix women all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="https://apps.co/comunicaciones/noticias/descubre-la-red-educativa-que-ayuda-a-los-estudian/">
                            <img class="img-portfolio" src="assets/images/medios/appsco.jpg" alt="appsco">
                        </a>
                    </div>
                </div>

                <div class="mix web-design all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://www.mintic.gov.co/portal/604/w3-article-6932.html">
                            <img class="img-portfolio" src="assets/images/medios/mintic.png" alt="portfolio">
                        </a>
                    </div>
                </div>

                <div class="mix video all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://www.eltiempo.com/archivo/documento/CMS-14436767">
                            <img class="img-portfolio" src="assets/images/medios/eltiempo.png" alt="portfolio">
                        </a>
                    </div>
                </div>

                <div class="mix all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://www.elheraldo.co/tendencias/10-aplicaciones-digitales-creadas-por-barranquilleros-164065">
                            <img class="img-portfolio" src="assets/images/medios/heraldo.png" alt="portfolio">
                        </a>
                    </div>
                </div>

                <div class="mix web-design all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://diarioadn.co/barranquilla/mi-ciudad/demo-day-para-apps-en-barranquilla-1.122110">
                            <img class="img-portfolio" src="assets/images/medios/logo_adn.png" alt="portfolio">
                        </a>

                    </div>
                </div>

                <div class="mix web-design all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://zonacero.info/barranquilla/56381-lanzaron-10-nuevas-soluciones-digitales-desarrolladas-por-barranquilleros">
                            <img class="img-portfolio" src="assets/images/medios/zonacero.png" alt="portfolio">
                        </a>
                    </div>
                </div>

                <div class="mix women all col-sm-4">
                    <div class="img-wrapper">

                        <a  target="blank" href="http://www.eluniversal.com.co/tecnologia/lanzan-10-nuevas-soluciones-digitales-desarrolladas-por-barranquilleros-168813">
                            <img class="img-portfolio" src="assets/images/medios/eluniversal.png" alt="portfolio">
                        </a>
                    </div>
                </div>

                <div class="mix women all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://blogvoluntariadocolombia.wordpress.com/2014/09/24/soluciones-tic-para-ong/">
                            <img class="img-portfolio" src="assets/images/medios/voluntariado.png" alt="portfolio">
                        </a>
                    </div>
                </div>
                <div class="mix web-design all col-sm-4">
                    <div class="img-wrapper">
                        <a target="blank" href="http://noticias.sergusproducciones.com/blog/2014/08/25/app-colombiana-para-estudiantes-padres-de-familia-y-profesores/">
                            <img class="img-portfolio" src="assets/images/medios/sglogo.jpg" alt="portfolio">
                        </a>
                    </div>
                </div>
            </div>



        </div><!-- PORTFOLIO GALLERY CONTAINER END-->
    </div>
</div>




<!-- CONTACT-->
<!--===============================================================-->
<div id="contact">
    <div class="bg-contact grey">
        <div class="container-contact container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="header-title wow fadeInLeft">Contáctanos</h1>
                    <h2 class="subtitle wow fadeInRight">¿Tienes alguna duda, comentario o sugerencia?</h2>

                </div>
            </div>
            <div class="space-20"></div>
            <!-- CONTACT-FORM -->
            <div class="row-contact row">
                <div class="col-sm-6">
                    <div class="row wow fadeInUp">
                        <form method="POST" id="ajax_form" action="email.php" role="form" class="form-contact">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control form-flat" type="text" name="name" id="name" placeholder="Nombre" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="form-control form-flat" type="text" name="email2" id="email2" placeholder="Email" > 
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control form-flat" id="message"></textarea>
                                </div>
                                <button type="submit" class="submit btn btn-flat">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- CONTACT-INFO -->
                <div class="col-sm-6">
                    <div class="row-info row">
                        <div class="wow fadeInUp">

                            <div class="col-info col-sm-12">
                                <h4 class="title-contact">Tu opinión es importante...</h4>
                                <P class="p-contact">Nos encantaría conocerla, escríbenos si tienes alguna duda o déjanos saber cuales son tus necesidades, para que podamos encontrar la manera de ayudarte.
                                </P>
                            </div>

                            <div class="col-info col-sm-12">
                                <h4 class="title-contact">Correo</h4>
                                <h5 class="title-contact-sm"><i class="fa fa-envelope fa-2x"></i> soporte@instaprofe.com</h5>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER-->
<!--===============================================================-->
<div class="bg-footer">
    <div class="container">
        <div class="row row-footer">
            <div class="col-md-12">
                <div class="wrapper-social">
                    <a target="blank" href="http://www.facebook.com/instaprofeoficial"><i class="fa fa-facebook facebook-footer wow bounce"></i></a>
                    <a target="blank"  href="http://www.twitter.com/instaprofe"><i class="fa fa-twitter twitter-footer wow bounce"  data-wow-delay="0.2s"></i></a>
                    <a target="blank"  href="http://www.instagram.com/instaprofeoficial"><i class="fa fa-instagram dribbble-footer wow bounce"  data-wow-delay="0.3s"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER-BOTTOM-->
<!--===============================================================-->
<div class="bg-footer-bottom">
    <div class="container">
        <div class="row-footer-bottom row">
            <div class="col-sm-12 hidden-xs">
                <p class="pull-left">&copy;2014 Todos los derechos reservados por Instaprofe.com.</p>

            </div>

            <!-- VISIBLE XS REMOVES CLASS "PULL-RIGHT" AND CENTERS-->
            <div class="hidden-sm visible-xs">
                <p>&copy;2014 Todos los derechos reservados por Instaprofe.com.</p>

            </div>

        </div>
    </div>
</div>
<!-- JAVASCRIPT-->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js-theme/hide-nav.js"></script>
<script src="assets/js-theme/wow.min.js"></script>
<script>
    wow = new WOW(
            {
                animateClass: 'animated',
                mobile: false
            }
    );
    wow.init();
</script>
<script src="assets/js-theme/jquery.bxslider.min.js"></script>
<script src="assets/js-theme/nivo-lightbox.min.js"></script>
<script src="assets/js-theme/jquery.mixitup.min.js"></script>
<script src="assets/js-theme/bootbox.min.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiUHrtP7COzKY2azegkJZzps3J7pQ4Qs4&sensor=false">
</script> 
<script src="assets/js-theme/call.js"></script> 

