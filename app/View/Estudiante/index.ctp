                                                   
                                    <div class="row">
                                            <div class="col-xs-6 col-sm-8">
                                                    <div class="input-group">
                                                           <div class="col-md-6">
     
                                                        <select class="chosen-select" id="area_search" data-placeholder="Busco un profesor de..." style="display: none;">
                                                        <option> </option>
                                                        <?php
                                                        foreach($areas as $area){
                                                            echo '<option value="'.$area["Area"]["id"].'">'.$area["Area"]["area"].'</option>';
                                                        }
                                                        ?>
                                                            
                                                        </select>
                                                       </div>
                                                          
                                                    <?php
                                                    $user=$this->Session->read('User');
                                                    ?>
                                                        <script>
                                                        var u_ciudad='<?=$user["ciudad"]?>';
                                                        </script>
                                                        <div class="col-md-6">
                                                            <select class="chosen-select" id="filter_ciudad" data-placeholder="En la ciudad de" value="<?php echo $user["ciudad"]?>" style="display: none;">
                                                        <option> </option>
                                                        

                                                        </select>
                                                           
                                                            
                                                        </div>     
                                                        <span class="input-group-btn">
                                                                    <button id="prof_search" type="button" class="btn btn-purple btn-sm">

                                                                            Buscar
                                                                            <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                                                    </button>
                                                            </span>
                                                        
                                                    </div>
                                                
                                                    <div class="space-6"></div>
                                                    <div >
                                                  
                                                    
                                                        <div class="col-xs-6">
                                                            <select multiple="" class="chosen-select tag-input-style" id="tema_filter" data-placeholder="Que sepa de..." style="display: none;">
																
                                                            </select>
                                                        </div>
                                                         <div class="col-md-6">
                                                             <select class="chosen-select" id="filter_inst" data-placeholder="Que de clases en..."></select>
                                                        </div>
                                                      
                                                    </div>
                                                     <div class="space-32" ></div>
                                                     
                                                   
										<!-- #section:custom/widget-box.options.transparent -->
										<div class="widget-box transparent ui-sortable-handle" id="wid-results">
											<div class="widget-header">
                                                                                         
												<h4 class="widget-title lighter">Resultados de Busqueda</h4>

												<div class="widget-toolbar no-border">
											

													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
                                                                                                        <a href="#" data-action="fullscreen" class="orange2">
														<i class="ace-icon fa fa-expand"></i>
													</a>
													<a href="#" data-action="toggle" id="wid-results-close">
														<i class="ace-icon fa red fa-times"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
                                                                                        <div class="widget-main padding-4">
													<!-- #section:custom/scrollbar -->
													<div class="scrollable ace-scroll scroll-active" data-height="100" style="position: relative;">
                                                                                                           
														
															<div  id="search_list_container">
                                                                                                     <ul id="search_list" class="dd-list">

                                                                                                     </ul>                
                   
                                                                                                  </div>
													</div>

													<!-- /section:custom/scrollbar -->
												</div>
                                                                                                
												
											</div>
										</div>

                
<!-- #section:pages/timeline -->
        <div class="widget-box transparent ui-sortable-handle" id="timeline">
            <div class="widget-header">
                    <h4 class="widget-title lighter">Timeline</h4>

                    <div class="widget-toolbar no-border">

                            <a href="#" data-action="reload">
                                    <i class="ace-icon fa fa-refresh"></i>
                            </a>

                            <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                            </a>

                            <a href="#" data-action="close">
                                    <i class="ace-icon fa fa-times"></i>
                            </a>
                    </div>
            </div>
            <div class="widget-body">
                   <div class="timeline-container">
                           <div class="timeline-label">
                                   <!-- #section:pages/timeline.label -->
                                   <span class="label label-primary arrowed-in-right label-lg">
                                           <b>Today</b>
                                   </span>

                                   <!-- /section:pages/timeline.label -->
                           </div>

                           <div class="timeline-items">
                                   <!-- #section:pages/timeline.item -->
                                   <div class="timeline-item clearfix">
                                           <!-- #section:pages/timeline.info -->
                                           <div class="timeline-info">
                                                   <img alt="Susan't Avatar" src="../assets/avatars/avatar1.png">
                                                   <span class="label label-info label-sm">16:22</span>
                                           </div>

                                           <!-- /section:pages/timeline.info -->
                                           <div class="widget-box transparent">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">
                                                                   <a href="#" class="blue">Susana</a>
                                                                   <span class="grey">hizo una pregunta en trigonometria</span>
                                                           </h5>

                                                           <span class="widget-toolbar no-border">
                                                                   <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                   16:22
                                                           </span>

                                                           <span class="widget-toolbar">
                                                                   <a href="#" data-action="reload">
                                                                           <i class="ace-icon fa fa-refresh"></i>
                                                                   </a>

                                                                   <a href="#" data-action="collapse">
                                                                           <i class="ace-icon fa fa-chevron-up"></i>
                                                                   </a>
                                                           </span>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Anim pariatur cliche reprehenderit, enim eiusmod
                                                                   <span class="red">high life</span>

                                                                   accusamus terry richardson ad squid …
                                                                   <div class="space-6"></div>

                                                                   <div class="widget-toolbox clearfix">
                                                                           <div class="pull-left">
                                                                                   <i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
                                                                                   <a href="#" class="bigger-110">Click to read …</a>
                                                                           </div>

                                                                           <!-- #section:custom/extra.action-buttons -->
                                                                           <div class="pull-right action-buttons">
                                                                                   <a href="#">
                                                                                           <i class="ace-icon fa fa-check green bigger-130"></i>
                                                                                   </a>

                                                                                   <a href="#">
                                                                                           <i class="ace-icon fa fa-pencil blue bigger-125"></i>
                                                                                   </a>

                                                                                   <a href="#">
                                                                                           <i class="ace-icon fa fa-times red bigger-125"></i>
                                                                                   </a>
                                                                           </div>

                                                                           <!-- /section:custom/extra.action-buttons -->
                                                                   </div>
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <!-- /section:pages/timeline.item -->
                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Going to cafe for lunch
                                                                   <div class="pull-right">
                                                                           <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                           12:30
                                                                   </div>
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-star btn btn-warning no-hover green"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">New logo</h5>

                                                           <span class="widget-toolbar no-border">
                                                                   <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                   9:15
                                                           </span>

                                                           <span class="widget-toolbar">
                                                                   <a href="#" data-action="reload">
                                                                           <i class="ace-icon fa fa-refresh"></i>
                                                                   </a>

                                                                   <a href="#" data-action="collapse">
                                                                           <i class="ace-icon fa fa-chevron-up"></i>
                                                                   </a>
                                                           </span>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Designed a new logo for our website. Would appreciate feedback.
                                                                   <div class="space-6"></div>

                                                                   <div class="widget-toolbox clearfix">
                                                                           <div class="pull-right action-buttons">
                                                                                   <div class="space-4"></div>

                                                                                   <div>
                                                                                           <a href="#">
                                                                                                   <i class="ace-icon fa fa-heart red bigger-125"></i>
                                                                                           </a>

                                                                                           <a href="#">
                                                                                                   <i class="ace-icon fa fa-facebook blue bigger-125"></i>
                                                                                           </a>

                                                                                           <a href="#">
                                                                                                   <i class="ace-icon fa fa-reply light-green bigger-130"></i>
                                                                                           </a>
                                                                                   </div>
                                                                           </div>
                                                                   </div>
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-flask btn btn-default no-hover"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-body">
                                                           <div class="widget-main"> Took the final exam. Phew! </div>
                                                   </div>
                                           </div>
                                   </div>
                           </div><!-- /.timeline-items -->
                   </div><!-- /.timeline-container -->

                   <div class="timeline-container">
                           <div class="timeline-label">
                                   <span class="label label-success arrowed-in-right label-lg">
                                           <b>Yesterday</b>
                                   </span>
                           </div>

                           <div class="timeline-items">
                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-beer btn btn-inverse no-hover"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">Haloween party</h5>

                                                           <span class="widget-toolbar">
                                                                   <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                   1 hour ago
                                                           </span>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   <div class="clearfix">
                                                                           <div class="pull-left">
                                                                                   Lots of fun at Haloween party.
                                                                                   <br>
                                                                                   Take a look at some pics:
                                                                           </div>

                                                                           <div class="pull-right">
                                                                                   <i class="ace-icon fa fa-chevron-left blue bigger-110"></i>

                                                                                   &nbsp;
                                                                                   <img alt="Image 4" width="36" src="../assets/images/gallery/thumb-4.jpg">
                                                                                   <img alt="Image 3" width="36" src="../assets/images/gallery/thumb-3.jpg">
                                                                                   <img alt="Image 2" width="36" src="../assets/images/gallery/thumb-2.jpg">
                                                                                   <img alt="Image 1" width="36" src="../assets/images/gallery/thumb-1.jpg">
                                                                                   &nbsp;
                                                                                   <i class="ace-icon fa fa-chevron-right blue bigger-110"></i>
                                                                           </div>
                                                                   </div>
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-trophy btn btn-pink no-hover green"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">Lorum Ipsum</h5>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Anim pariatur cliche reprehenderit, enim eiusmod
                                                                   <span class="green bolder">high life</span>
                                                                   accusamus terry richardson ad squid …
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-body">
                                                           <div class="widget-main"> Going to cafe for lunch </div>
                                                   </div>
                                           </div>
                                   </div>

                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-bug btn btn-danger no-hover"></i>
                                           </div>

                                           <div class="widget-box widget-color-red2">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">Critical security patch released</h5>

                                                           <span class="widget-toolbar no-border">
                                                                   <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                   9:15
                                                           </span>

                                                           <span class="widget-toolbar">
                                                                   <a href="#" data-action="reload">
                                                                           <i class="ace-icon fa fa-refresh"></i>
                                                                   </a>

                                                                   <a href="#" data-action="collapse">
                                                                           <i class="ace-icon fa fa-chevron-up"></i>
                                                                   </a>
                                                           </span>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Please download the new patch for maximum security.
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>
                           </div><!-- /.timeline-items -->
                   </div><!-- /.timeline-container -->

                   <div class="timeline-container">
                           <div class="timeline-label">
                                   <span class="label label-grey arrowed-in-right label-lg">
                                           <b>May 17</b>
                                   </span>
                           </div>

                           <div class="timeline-items">
                                   <div class="timeline-item clearfix">
                                           <div class="timeline-info">
                                                   <i class="timeline-indicator ace-icon fa fa-leaf btn btn-primary no-hover green"></i>
                                           </div>

                                           <div class="widget-box transparent">
                                                   <div class="widget-header widget-header-small">
                                                           <h5 class="widget-title smaller">Lorum Ipsum</h5>

                                                           <span class="widget-toolbar no-border">
                                                                   <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                   10:22
                                                           </span>

                                                           <span class="widget-toolbar">
                                                                   <a href="#" data-action="reload">
                                                                           <i class="ace-icon fa fa-refresh"></i>
                                                                   </a>

                                                                   <a href="#" data-action="collapse">
                                                                           <i class="ace-icon fa fa-chevron-up"></i>
                                                                   </a>
                                                           </span>
                                                   </div>

                                                   <div class="widget-body">
                                                           <div class="widget-main">
                                                                   Anim pariatur cliche reprehenderit, enim eiusmod
                                                                   <span class="blue bolder">high life</span>
                                                                   accusamus terry richardson ad squid …
                                                           </div>
                                                   </div>
                                           </div>
                                   </div>
                           </div><!-- /.timeline-items -->
                   </div><!-- /.timeline-container -->
                   </div>
                                    <!-- /section:pages/timeline -->

                                            </div>

                                           
</div>
  
 

<!-- /section:custom/widget-box.header.options -->
<div class="col-xs-4">
    <div class="widget-box widget-color-blue2">
            <div class="widget-header">
                    <h4 class="widget-title lighter smaller">Área</h4>
            </div>

            <div class="widget-body">
                    <div class="widget-main padding-8">
                            <div id="tree1" class="tree tree-selectable">
                                <div class="tree-folder" style="display:none;">	
                                    <div class="tree-folder-header">		
                                        <i class=" ace-icon ace-icon tree-plus"></i>
                                        <div class="tree-folder-name"></div>
                                    </div>				
                                    <div class="tree-folder-content"></div>
                                    <div class="tree-loader" style="display: none;"></div>
                                </div>			
                                <div class="tree-item" style="display:none;">
                                    <i class=" ace-icon ace-icon fa fa-times"></i>
                                    <div class="tree-item-name"></div>
                                </div><div class="tree-folder" style="display: block;">
                                    <div class="tree-folder-header">
                                        <i class="ace-icon tree-plus"></i>
                                        <div class="tree-folder-name">For Sale</div>
                                    </div>				
                                    <div class="tree-folder-content" style="display: none;">
                                        <div class="tree-item" style="display: block;">
                                            <i class="ace-icon ace-icon fa fa-times tree-dot"></i>
                                            <div class="tree-item-name">Appliances</div>
                                        </div><div class="tree-item" style="display: block;">
                                            <i class=" ace-icon ace-icon fa fa-times"></i>
                                            <div class="tree-item-name">Arts &amp; Crafts</div>	
                                        </div><div class="tree-item" style="display: block;">
                                            <i class=" ace-icon ace-icon fa fa-times"></i>
                                            <div class="tree-item-name">Clothing</div>
                                        </div><div class="tree-item" style="display: block;">
                                            <i class=" ace-icon ace-icon fa fa-times"></i>	
                                            <div class="tree-item-name">Computers</div>	
                                        </div><div class="tree-item" style="display: block;">
                                            <i class=" ace-icon ace-icon fa fa-times"></i>
                                            <div class="tree-item-name">Jewelry</div>		
                                        </div><div class="tree-item" style="display: block;">	
                                            <i class=" ace-icon ace-icon fa fa-times"></i>	
                                            <div class="tree-item-name">Office &amp; Business</div>	
                                        </div><div class="tree-item" style="display: block;">	
                                            <i class=" ace-icon ace-icon fa fa-times"></i>	
                                            <div class="tree-item-name">Sports &amp; Fitness</div>
                                        </div></div>			
                                    <div class="tree-loader" style="display: none;">
                                        <div class="tree-loading">
                                            <i class="ace-icon fa fa-refresh fa-spin blue"></i>
                                        </div></div>
                                </div><div class="tree-folder" style="display: block;">
                                    <div class="tree-folder-header">
                                        <i class=" ace-icon ace-icon tree-plus"></i>
                                        <div class="tree-folder-name">Vehicles</div>
                                    </div>				
                                    <div class="tree-folder-content"></div>
                                    <div class="tree-loader" style="display: none;">
                                        <div class="tree-loading">
                                            <i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>			</div><div class="tree-folder" style="display: block;">				<div class="tree-folder-header">					<i class=" ace-icon ace-icon tree-plus"></i>					<div class="tree-folder-name">Rentals</div>				</div>				<div class="tree-folder-content"></div>				<div class="tree-loader" style="display: none;"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>			</div><div class="tree-folder" style="display: block;">				<div class="tree-folder-header">					<i class=" ace-icon ace-icon tree-plus"></i>					<div class="tree-folder-name">Real Estate</div>				</div>				<div class="tree-folder-content"></div>				<div class="tree-loader" style="display: none;"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>			</div><div class="tree-folder" style="display: block;">				<div class="tree-folder-header">					<i class=" ace-icon ace-icon tree-plus"></i>					<div class="tree-folder-name">Pets</div>				</div>				<div class="tree-folder-content"></div>				<div class="tree-loader" style="display: none;"><div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div></div>			</div><div class="tree-item" style="display: block;">				<i class=" ace-icon ace-icon fa fa-times"></i>				<div class="tree-item-name">Tickets</div>			</div><div class="tree-item" style="display: block;">				<i class=" ace-icon ace-icon fa fa-times"></i>				<div class="tree-item-name">Services</div>			</div><div class="tree-item" style="display: block;">				<i class=" ace-icon ace-icon fa fa-times"></i>				<div class="tree-item-name">Personals</div>			</div></div>
                    </div>
            </div>
    </div>
</div>

</div>

<script>
var active="#leftp_inicio";
</script>