<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Bienvenido- InstaProfe</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		
		
		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
	
		<!-- ace styles -->

		<link rel="stylesheet" href="../assets/css/chosen.css" />
		

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
                <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />
                <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="../assets/css/select2.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
                
		<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />
                <link href="../assets/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" href="../assets/css/ui.jqgrid.css">
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="../assets/css/style.css" />
		<!-- ace settings handler -->
                <link rel="stylesheet" href="../assets/css/ace.min.css" id="main-ace-style" />
		<script src="../assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
<!--		
<?php
$user=$this->Session->read('User');
 if($user["tipo"]==3){$type="Profesor";$user_link="../Profesor/";}
                          if($user["tipo"]==2){$type="Estudiante";$user_link="../Estudiante/";}
                            if($user["tipo"]==1){$type="Padre";$user_link="../Padre/";}
                            ?>

-->

<div id="navbar" class="navbar navbar-default navbar-fixed-top">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container"><!--
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand" id="logo_container">
					<img src="../assets/images/instaprofe_logo.png" alt="logo" class="logo_img"/>
                                            </a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
				


						
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                                            <?php if($user["completo"]!=0){?>   
                                                            <img class="nav-user-photo" alt="avatar" src="data:image/png;base64,<?=$user["p_avatar"]?>">
								
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php 
									
								
									echo ($user["nombre"]." ".$user["apellido"])?>
								</span>
                                                              <?php }?>  
								<i class="ace-icon fa fa-caret-down"></i>
                                                                
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							
								<li>
                                                                    <a href="<?=$user_link?>Profile">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../Usuarios/logout" id="logout">
										<i class="ace-icon fa fa-power-off"></i>
										Cerrar Sesión
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<!-- <button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button> --> 

						<!-- /section:basics/sidebar.layout.shortcuts -->
					<!-- </div> -->

					<!-- <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div> --><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<?php if($user["completo"]==1){?>
					<li class="active" id="leftp_inicio">
						<a data-url="page/admin" href="<?=$user_link?>">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Inicio </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="" id="leftp_preg">
						<a href="../Pregunta/">
							<i class="menu-icon fa fa-question"></i>
							<span class="menu-text"> Preguntas </span>

							<!-- <b class="arrow fa fa-angle-down"></b> -->
						</a>

			

<!--					<li class="" id="li_preguntas">
						<a href="#">
							<i class="menu-icon fa fa-graduation-cap"></i>
							<span class="menu-text"> Mi desempeño </span>

							 <b class="arrow fa fa-angle-down"></b> 
						</a>

					</li>

					<li class="" id="leftp_eval">
						<a href="#">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Evaluaciones </span>

							
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a data-url="page/form-elements" href="#page/form-elements">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/form-wizard" href="#page/form-wizard">
									<i class="menu-icon fa fa-caret-right"></i>
									Tomar
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>-->

					<li class="" id="leftp_calendario">
												<a data-url="page/calendar" href="../Usuarios/calendar">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Calendario

								<!-- #section:basics/sidebar.layout.badge -->
<!--								<span class="badge badge-transparent tooltip-error" title="1 Evento Importante">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>-->

								<!-- /section:basics/sidebar.layout.badge -->
							</span>
						</a>

						
					</li>
					<?php }?>
					<li class="" id="leftp_perfil">
                        <?php
                        $type="";
                       
                        ?>
						<a data-url="page/widgets" href="<?=$user_link?>Profile">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Perfil </span>
						</a>

						<b class="arrow"></b>
					</li>
<!-- 
					<li class="">
						<a data-url="page/gallery" href="#page/gallery">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text"> Gallery </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> More Pages </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a data-url="page/profile" href="#page/profile">
									<i class="menu-icon fa fa-caret-right"></i>
									User Profile
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/inbox" href="#page/inbox">
									<i class="menu-icon fa fa-caret-right"></i>
									Inbox
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/pricing" href="#page/pricing">
									<i class="menu-icon fa fa-caret-right"></i>
									Pricing Tables
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/invoice" href="#page/invoice">
									<i class="menu-icon fa fa-caret-right"></i>
									Invoice
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/timeline" href="#page/timeline">
									<i class="menu-icon fa fa-caret-right"></i>
									Timeline
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/email" href="#page/email">
									<i class="menu-icon fa fa-caret-right"></i>
									Email Templates
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/login" href="../login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Login &amp; Register
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>

							<span class="menu-text">
								Other Pages

								<!-- #section:basics/sidebar.layout.badge 
								<span class="badge badge-primary">5</span>

								<!-- /section:basics/sidebar.layout.badge 
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a data-url="page/faq" href="#page/faq">
									<i class="menu-icon fa fa-caret-right"></i>
									FAQ
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/error-404" href="#page/error-404">
									<i class="menu-icon fa fa-caret-right"></i>
									Error 404
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/error-500" href="#page/error-500">
									<i class="menu-icon fa fa-caret-right"></i>
									Error 500
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/grid" href="#page/grid">
									<i class="menu-icon fa fa-caret-right"></i>
									Grid
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a data-url="page/blank" href="#page/blank">
									<i class="menu-icon fa fa-caret-right"></i>
									Blank Page
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li> -->
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">


				<!-- /section:basics/content.breadcrumbs -->
				<div class="page-content">
					<!-- #section:settings.box -->
					<!-- <div class="ace-settings-container" id="ace-settings-container">
						<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
							<i class="ace-icon fa fa-cog bigger-150"></i>
						</div>

						<div class="ace-settings-box clearfix" id="ace-settings-box">
							<div class="pull-left width-50">
								<!-- #section:settings.skins 
								<div class="ace-settings-item">
									<div class="pull-left">
										<select id="skin-colorpicker" class="hide">
											<option data-skin="no-skin" value="#438EB9">#438EB9</option>
											<option data-skin="skin-1" value="#222A2D">#222A2D</option>
											<option data-skin="skin-2" value="#C6487E">#C6487E</option>
											<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
										</select>
									</div>
									<span>&nbsp; Choose Skin</span>
								</div>

								<!-- /section:settings.skins -->

								<!-- #section:settings.navbar 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
									<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
								</div>

								<!-- /section:settings.navbar 

								<!-- #section:settings.sidebar 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
									<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
								</div>

								<!-- /section:settings.sidebar -->

								<!-- #section:settings.breadcrumbs 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
									<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
								</div>

								<!-- /section:settings.breadcrumbs -->

								<!-- #section:settings.rtl 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
									<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
								</div>

								<!-- /section:settings.rtl -->

								<!-- #section:settings.container 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
									<label class="lbl" for="ace-settings-add-container">
										Inside
										<b>.container</b>
									</label>
								</div>

								<!-- /section:settings.container 
							</div><!-- /.pull-left 

							<div class="pull-left width-50">
								<!-- #section:basics/sidebar.options 
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
									<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
									<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
									<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
								</div>

								<!-- /section:basics/sidebar.options 
							</div><!-- /.pull-left 
						</div><!-- /.ace-settings-box 
					</div> --><!-- /.ace-settings-container -->

					<!-- /section:settings.box -->
					<div class="page-content-area">
						
						<?php echo $content_for_layout ?>
		<!-- ajax content goes here -->
					</div><!-- /.page-content-area -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->


			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script type="text/javascript">
			// //Load content via ajax
					// jQuery(function($) {
					  // if('enable_ajax_content' in ace) {
						// var options = {
						  // content_url: function(url) {
							// //this is for Ace demo only, you should change it
							// //please refer to documentation for more info
// 							
							// if(!url.match(/^page\//)) return false;
// 							
							// var path = document.location.pathname;
							// path=path;
							// //for Ace HTML demo version, convert #page/gallery to > gallery.html and load it
							// console.log(path);
// 							
							// if(path.match(/index\.php/)) return path.replace(/index\.php/, url.replace(/^page\//, '')+'.php') ;
// 					
							// //for Ace PHP demo version convert "page/dashboard" to "?page=dashboard" and load it
							// console.log(url);
							// console.log(path + "?" + url.substr(url.indexOf(/\//)));
							// return path + url.substr(url.indexOf("/")+1)+".php";
						  // },
						  // default_url: 'page/admin'//default url
						// }
						// console.log(options);
						// ace.enable_ajax_content($, options)
// 						
					  // }
// 					    
					// })

		</script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>
                
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/chosen.jquery.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.autosize.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.wizard.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../assets/js/bootstrap-tag.min.js"></script>
		<script src="../assets/js/x-editable/ace-editable.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../assets/js/fullcalendar.min.js"></script>
                <script src="../assets/js/fuelux/data/fuelux.tree-sample-demo-data.js"></script>
                <script src="../assets/js/fuelux/fuelux.tree.min.js"></script>
		<script src="../assets/js/lang/es.js"></script>
                <script src="../assets/js/jquery.mobile.browser.js"></script>
                <script src="../assets/js/star-rating.js" type="text/javascript"></script>
               <script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/jqGrid/jquery.jqGrid.min.js"></script>
		<script src="../assets/js/jqGrid/i18n/grid.locale-en.js"></script>
                <script src="../assets/js/ciudades.js"></script>
		<script src="../assets/js/my.js"></script>
                <script src="../assets/js/default.js"></script>
                <script src="../assets/js/grids.js"></script>
<!--                <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : 925455467469510,
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/es_LA/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>-->
	</body>
</html>

