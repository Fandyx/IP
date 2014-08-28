 jQuery(function($) {	
toggleTable("users");
toggleTable("profe");
toggleTable("est");
toggleTable("pad");

$('.page-content-area').prevAll('.ajax-loading-overlay').remove();
$("#edit").click(function(){
	$("#user-profile-1").hide("fadeOut");
	$("#edit-panel").show("fadeIn");
});
var select=$("#filter_ciudad");
$.each(ciudades,function(key, value) 
{   var sel="";
    if(u_ciudad==value){
        sel="selected";
    }
    select.append('<option value="' + value + '" '+sel+'>' + value + '</option>');
});
select.trigger('chosen:updated');

$("#area_search").change(function(){
    var ciudad=$("#filter_ciudad").val();
    var ins=$("#filter_isnt").val();
    var tema=$("#tema_filter").val();
    $("#tema_filter").val("");
    $("#tema_filter").html("");
    $("#tema_filter").trigger('chosen:updated');
    $.ajax({
        url:"../Areas/getTemas",
        data:{area:$(this).val()},
        method:"POST",
        success:function(data){
            

          var t=$.parseJSON(data);
          var temas=t.temas.split(",");
          console.log(temas);
          for(var i=0;i<temas.length;i++){
              $("#tema_filter").append("<option>"+temas[i]+"</option>");
              $("#tema_filter").trigger('chosen:updated');
              
          }

             }   
          });
        });
$("#wid-results-close").click(function(){
    $('#wid-results').hide('slow');
});
	
		$("#cancel-change").click(function(){
			    	$("#edit-panel").hide();
			    	$("#user-profile-1").show("fadeIn");
		});

		$("#resp_send").click(function(){
					    	var resp=$("#respuesta").val();
					    	var pid=getUrlParameter("pid");
					    	console.log(pid);
					    	$("#comment_box").hide("fadeOut");
					    	$("#load_resp").show("fadeIn");
					    	$.ajax({
				        url: "saveRespuesta",
				        type: 'post',
				        data: {resp:resp,pid:pid},
				        success: function (data) {
				        	$("#comment_box textarea").val("");
				          	$("#comment_box").show("fadeIn");
					    	$("#load_resp").hide("fadeOut");
					    	var block=$.parseJSON(data).block;
					    	console.log(block);
					    	$("#responses").append('<div class="row">\
					    							<div class="col-xs-1 center">\
                                            <div class="ace-spinner touch-spinner">\
                                        <div class="input-group">\
                                           <div>\
                                               <button class="btn-link">\
                                            <i class="green ace-icon ace-icon fa fa-plus fa-2x"></i>\
                                             </button>\
                                            </div>\
                                            <div class="votes_number">0</div>\
                                             <div>\
                                          <button class="btn-link"><i class="ace-icon ace-icon fa fa-minus red fa-2x">\
                                          </i></button></div></div></div></div><div class="col-xs-11">'+block);
                                          	$('[data-rel=popover]').popover({html:true});
                                          	 $('[data-rel=popover]').hover(function(){
			             
			              $(this).popover("show");
			         },function(){
			             $(this).popover("hide");
			         });
				        			}
    			});
		})
$("#form-send").click(function(){
	if($(".form-horizontal").valid()){
		var mats=[];
		$(".area_chk:checked").each(function(){
			var id=$(this).attr("id").split("-")[1];
			var tags=$("#tema-"+id).val();
			tags=$(tags).capitalize(',');
			
			var json={area:id,tags:tags};
			console.log(tags);
			mats.push(json);
		});
		    	$.ajax({
        url: "saveProfile",
        type: 'post',
        data: $("#profile_form").serialize(),
        success: function (data) {
        	console.log(mats);
		    	$.ajax({
				        url: "saveAreas",
				        type: 'post',
				        data: {areas:mats},
				        success: function (data) {
				          		if($(".file img").css("background-image")){
							var url=$(".file img").css("background-image").split("(")[1].split(",")[1];
							url=url.substring(0,url.length -1)
							    	$.ajax({
							        url: "saveProfileImg",
							        type: 'post',
							        data: {url:url},
							        success: function (data) {
							        	console.log(mats);
							        						document.getElementById("profile_form").submit();
		        								}
    								});
									}else{
									document.getElementById("profile_form").submit();
									}
				        			}
    			});
        
        		}
    });






}

}

);
$(".nav-list .active").removeClass("active");
$(active).addClass("active");
$(".area_chk").change(function(){
	var id=$(this).attr("id").split("-")[1];
	$("#area_cont_"+id).slideToggle();
	
});

$(".ins_chk").change(function(){
	var id=$(this).attr("id").split("-")[1];
	var checked=$(this).is(":checked");
	if(checked){
		$("#nom-"+id).show();
	}else{
		$("#nom-"+id).hide();
	}
	
});

$("#send_question").click(function(){
	$("#data-alert").hide();
	var title=$("#ques_title").val();
	var desc=$("#ques_desc").val();
	var tags=$("#form-field-tags").val();
	var area=$("#form-field-select-4").val();
	var msj='<strong><i class="ace-icon fa fa-times"></i>¡Error!</strong> ';											
	var sw=true;					
											

											
										
	if(title===""){
		msj+="Coloca un titulo para tu pregunta.	<br>";
		sw=false;
	
	}
	if(sw===true&&desc===""){
		msj+="Describe tu pregunta brevemente.	<br>";
		sw=false;
		
	}
	if(sw===true&&tags===""){
		msj+="Coloca algunas etiquetas.	<br>";
		sw=false;
		
	}
	if(sw===true&&area===""){
		msj+="Escoge el área.	<br>";
		sw=false;
		
	}
	
	
	if(!sw){
		console.log(msj);
	showMissingAlert(msj);
	return;}
	else{
		$("#question-form").hide("fadeOut");
		$("#send_question").hide("fadeOut");
		$("#load_ques").show("fadeIn");
		$.ajax({
			url:"add",
			data:{titulo:title,pregunta:desc,tags:tags,area:area}
			,method:"POST",
			success:function(data){
				console.log(data);
				$("#load_ques").hide("fadeOut");
				$("#alert-success").show("fadeIn");
				resetQuestionForm();
				$("#question-form").show("fadeIn");
				$("#send_question").show("fadeIn");
			}
		});
	}
	
});
function resetQuestionForm(){
	
	$(".chosen-select").val("").trigger('chosen:updated');
	document.getElementById("question-form").reset();
	$(".tags span").remove()
}

function showMissingAlert(msj){
	$("#alert_content").html(msj);
	$("#data-alert").show("slow");
}
function toggleTable(sel){
	var oTable1 =$('#tabla_'+sel).dataTable({pageLength:25});	
	$("#reg_"+sel).click(function(){
					
							var s=$("#reg_"+sel+" span").html();
							
						s==="+"?s="-":s="+";
						$("#reg_"+sel+" span").html(s);
						$("#tabla_"+sel+"_wrapper").slideToggle("slow");
				});
}
$("#prof_search").click(function(){
	console.log($("#area_search").val());
	var ar=$("#area_search").val();
	$("#search_list").empty();
	$.ajax({
		url:"../Usuarios/buscarProfe",
		method:"POST",
		data:{area:ar},
		success:function(response){
			console.log(response);
				$("#search_list").hide();
			var data=$.parseJSON(response).data;
			
		
			$(data).each(function(){
				var usr=$(this)[0].Usuario;
                                var inst=$(this)[0].Instituto;  
                                var instname=inst.instituto.toString();
					var src='data:image/jpeg;base64,'+usr.p_avatar;
				console.log(usr.id+" "+usr.nombre+" "+usr.p_avatar);
				if(usr.p_avatar==null){
				src="../assets/avatars/profile-pic.jpg";
				}
                            
			$("#search_list").append('\
			<li class="dd-item" data-id="1">\
			<div class="dd-handle">\
                                <div id="prof_img_container">\
				<img class="li_img" src="'+src+'">\
                               </div>\
				<div class="search_cont">\
				<h4 class="capitalize">'+$(usr.nombre).capitalize(" ")+' '+$(usr.apellido).capitalize(" ")+'</h4>\
				<p class="grey">\
                                <i class="ace-icon fa fa-briefcase grey"></i> Profesor<br/>\
                                <i class="ace-icon fa fa-university grey"></i> '+instname+'<br/>\
				&nbsp;<i class="ace-icon fa fa-map-marker grey center"></i>&nbsp;&nbsp;'+usr.ciudad+'<br/>\
				</p>	\
				</div>\
				<div class="search_right" id="sr_'+usr.id+'">\
					<h4>\
						Area de conocimiento:\
					</h4>\
				</div>\
				<div class="reput">\
                               <input id="input-id" type="number" class="stars" min=0 max=5 data-size="xs">\
                                <div class="">Preguntas respondidas: <span>0</span></div>\
					<div class="">Mejores respuestas: <span>0</span></div>\
				</div>\
				<div id="button_inside">\
				<button class="btn btn-primary btn-sm" onclick="$(\'#sr_'+usr.id+'\').slideToggle(\'slow\')">Ver mas...</button>\
				<button class="btn btn-purple btn-sm" id="contactar-'+usr.id+'">Contactar</button>\
				</div>\
			</div>\
		</li>');
                          
                $(".stars").rating({readonly:true,showClear:false,step:1});
		$("#wid-results").show("slide");		
		$("#search_list").show("fade");
		$('#contactar-23').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'Gracias por contactar a '+usr.nombre+' '+usr.apellido+'!',
						text: 'Te hemos puesto en contacto con '+usr.nombre+' '+usr.apellido+' dentro de unos instantes, recibiras sus datos en tu correo.',
						image: src,
						sticky: false,
						time: '',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 1)
							{
								return false;
							}
						},
						limit:'1',
						class_name: 'gritter-info'
					});
			
					return false;
				});
		$.ajax({
		url:"../ProfesorAreas/areaProfe",
		method:"POST",
		data:{prof_id:usr.id,area:ar},
		success:function(response){
			
				var data=$.parseJSON(response).data;
			
		$("#sr_"+usr.id).html('<h4>\
						Temas:\
					</h4>');
			$(data).each(function(){
				console.log($(this));
				var obj2=$(this)[0].ip_area;
				var data2=$.parseJSON(response).data2;

			$("#sr_"+usr.id).append("<p id='thems_"+usr.id+"'>"+obj2.area+": </p>");
							var temas="";
				var elems = $(data2), count = elems.length;
				elems.each(function(){
					
					var user=$(this)[0].UsuarioTag.usuario;
					var area=$(this)[0].Tags.area;
				
					if(parseInt(user)==parseInt(usr.id)){
					temas+=$(this)[0].Tags.tag;
					}
					 if (!--count) $('#thems_'+usr.id).append(temas);
					 
					});
				
		});
		}
		});
		});
		},
		error:function(i,e,x){
			console.log(i);
			console.log(e);
			console.log(x);
		}
	});
	
});
});
function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}
function showThemes(id,tema){
	
	$.ajax({
        url: "getThemes",
        type: 'post',
        data: {area:id},
        success: function (data) {
          
		$("#tema_title").html(tema);
		var temas=$.parseJSON(data);
		temas=temas.temas;	
		$("#temas").html($(temas).capitalize(','));
		$("#row_temas").css("display","table-row");
        }
    	});
        
}

$.fn.capitalize = function (schar) {
	
        var split = this.selector.split(schar);
		     
        for (var i = 0, len = split.length; i < len; i++) {
        	split[i]=split[i].trim(); 
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1).toLowerCase();
        }
		
      
        this.selector = split.join(schar+' ');

    return this.selector;
};
