 jQuery(function($) {	
toggleTable("users");
toggleTable("profe");
toggleTable("est");
toggleTable("pad");
    autoCompleteUniversidad();
    autoCompleteColegio();
    autoCompleteInstituto();
$("#add_edu").click(function(){
    $("#prof_edu").append(' <div class="profile-info-row educacion_prof">\
                                                                        <select class="col-sm-2" name="tipo_edu[]">\
                                                                            <option value="F">Formal</option>\
                                                                             <option value="NF">No Formal</option>\
                                                                        </select>\
                                                                        <select class="col-sm-2" name="inst_edu[]">\
                                                                            <option value="2">Universidad</option>\
                                                                            <option value="3">Otro</option>\
                                                                        </select>\
                                                                        <input type="text" class="universidad col-sm-3" name="nombre_inst[]" placeholder="Nombre de la institución">\
                                                                        <input type="text" class="col-sm-2" name="titulo[]" placeholder="Titulo Obtenido">\
                                                                        <input type="text" placeholder="Año" name="year_inst[]" class="input-mini spinner-input form-control instituto col-sm-1" maxlength="4">\
                                                                        <button class="btn btn-danger btn-sm" onclick="$(this).parent().remove()" id="add_exp">\
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-minus"></i>\
                                                                        </button>\
                                                                    </div>');
    autoCompleteUniversidad();
   
    
});
$("#add_exp").click(function(){
    $("#prof_exp").append('<div class="profile-info-row educacion_prof">\
                            <select class="col-sm-2" name="tipo_exp[]">\
                                <option value="E">Empleado</option>\
                                 <option value="I">Independiente</option>\
                            </select>\
                            <input type="text" placeholder="Nombre de la institucion" name="inst_exp[]" class="instituto col-sm-4">\
                            <input type="text" placeholder="Rol" class="col-sm-3" name="rol_exp[]">\
                            <input type="text" placeholder="Años" name="year_exp[]" class="input-mini spinner-input form-control instituto col-sm-1" maxlength="3">\
                            <button class="btn btn-danger btn-sm" onclick="$(this).parent().remove()" id="add_exp">\
                                                                           <i class="white ace-icon ace-icon glyphicon glyphicon-minus"></i>\
                                                                        </button>\
                            </div>');
    autoCompleteInstituto();
});
$(".estud_fecha").change(function(){
    if(getAge($(this).val())<18){
        $.gritter.add({
                            title: 'Atención!',
                            text: 'Por ser menor de edad, tu perfil deberá ser activado por un Padre de Familia, ingresa su correo y le notificaremos!',
                            class_name: 'gritter-info gritter-center'
    });
    $("#email_padre_container").show();
    }else{
          $("#email_padre_container").hide();
    }
});
$('.page-content-area').prevAll('.ajax-loading-overlay').remove();
$("#edit").click(function(){
	$("#user-profile-1").hide("fadeOut");
	$("#edit-panel").show("fadeIn");
});
if(typeof u_ciudad!=="undefined"){
var select=$("#filter_ciudad");
$.each(ciudades,function(key, value) 
{   var sel="";
  
    if(u_ciudad==value){
        sel="selected";
    }
    select.append('<option value="' + value + '" '+sel+'>' + value + '</option>');
});
select.trigger('chosen:updated');
}
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
        $(".contact_user").click(function(){
            var id=$(this).attr("id").split("-")[1];
            contactar(id);
        });
        $(".follow_user").click(function(){
            var id=$(this).attr("id").split("-")[1];
           follow(id);
        });
        $(".unfollow-user").click(function(){
            var id=$(this).attr("id").split("-")[1];
           unfollow(id);
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
                                                var id=$.parseJSON(data).id;
					    	console.log(block);
					    	$("#responses").append('<div class="row">\
					    							<div class="col-xs-1 center">\
                                            <div class="ace-spinner touch-spinner">\
                                        <div class="input-group">\
                                           <div>\
                                               <button class="btn-link" onclick="upvote_r('+id+')">\
                                            <i class="green ace-icon ace-icon fa fa-thumbs-o-up fa-2x"></i>\
                                             </button>\
                                            </div>\
                                            <div class="votes_number">0</div>\
                                             <div>\
                                          <button class="btn-link" onclick="downvote_r('+id+')"><i class=" ace-icon ace-icon fa fa-thumbs-o-down red fa-2x">\
                                          </i></button></div></div></div></div><div class="col-xs-11">'+block);
                                            var r=parseInt($("#respuestas_n").html());
                                            $("#respuestas_n").html(r+1);
                                          	$('[data-rel=popover]').popover({html:true});
                                          	 $('[data-rel=popover]').hover(function(){
			             
			              $(this).popover("show");
			         },function(){
			             $(this).popover("hide");
			         });
				        			}
    			});
		});
                $("#search_box .widget-header:not(.widget-toolbar)").click(function(e){
                 
                      if(!$(e.target).is("i")){
                     $(this).parent().widget_box('toggle');}
                });
                $("#question_box .widget-header:not(.widget-toolbar)").click(function(e){
                     
                     if(!$(e.target).is("i")){
                     $(this).parent().widget_box('toggle');}
                });
$("#form-send").click(function(){
	if($(".form-horizontal").valid()){
		var mats=[];
		$(".area_chk:checked").each(function(){
			var id=$(this).attr("id").split("-")[1];
			var tags=$("#tema-"+id).val();
			tags=$(this).capitalize(tags,',');
			
			var json={area:id,tags:tags};
			console.log(tags);
			mats.push(json);
		});
                var sw=true;
                if($(".n_password").val()!==""){
                    if($(".n_password").val()!==$("#password2").val()){
                        sw=false;
                    }
                }
                console.log(sw);
                if(sw){
                   // $("#profile_form").hide();
		    	$.ajax({
        url: "../Usuarios/saveProfile",
        type: 'post',
        data: $("#profile_form").serialize(),
        success: function (data) {
        	console.log(data);
		    	$.ajax({
				        url: "saveAreas",
				        type: 'post',
				        data: {areas:mats},
				        success: function (data) {
                                                        console.log(data);
				          		if($(".file img").css("background-image")){
							var url=$(".file img").css("background-image").split("(")[1].split(",")[1];
							url=url.substring(0,url.length -1);
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
			data:{titulo:title,pregunta:desc,tags:$(this).capitalize(tags,", "),area:area}
			,method:"POST",
			success:function(data){
				console.log(data);
                                    
				$("#load_ques").hide("fadeOut");
				$("#alert-success").show("fadeIn");
				resetQuestionForm();
				$("#question-form").show("fadeIn");
				$("#send_question").show("fadeIn");
                               data=$.parseJSON(data);
                                $preg=data.npreg[0];
                    var preg_html= '<li class="question_li"><a href="Post?pid='+data.id+'">';
                    $cres=$preg['0']['crespuesta'];
                    $votes=$preg['0']['numpreg'];
                    if($votes===null){$votes=0;}
                    preg_html+= '<div class="votes"><div class="respuestas_n center">\
                            <p>Respuestas<br/>\
                             <span style="font-weight:bold;font-size:15px">'+$cres+'</span></p>\
                        </div>';
                     $class='';
                    if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                    preg_html+= '<div class="puntuacion_n center">\
                            <p >Puntuación<br/>\
                            <span style="font-weight:bold;font-size:15px" '+$class+'>'+$votes+'</span></p>\
                        </div></div><div class="question_rest">'; 
                    $title=$preg['ip_pregunta']['titulo'];
                    preg_html+= '<h4 class="blue">'+$title+'</h4><p class="hashtags">';
                        var i=0;
                       tags=$(this).capitalize(tags,", ");
                        var $t=tags.split(", ");
                 while(i<$t.length){
                       
                           
                           preg_html+= '<span class="label label-sm label-purple">'+$t[i]+'</span> ';
                        
                    i++;
                }
                     preg_html+= '</p>\
                        <p class="area">';
                   
                        $autor=$preg['ip_usuario']['nombre']+" "+$preg['ip_usuario']['apellido'];
                        $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                       preg_html+=$preg['ip_area']['area']+'</p><p class="autor">'+$autor+'</p><p class="fecha">'+$fecha+'</p>\
                  </div></a></li>';
                            $("#profile2 .question_container").prepend(preg_html);
                             $("#myquestions .question_container").prepend(preg_html);
			}
		});
	}
	
});
$('#tree1').ace_tree({
			dataSource: treeDataSource ,
			loadingHTML:'<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
			'open-icon' : 'ace-icon fa fa-minus',
			'close-icon' : 'ace-icon fa fa-plus',
			'selectable' : false,
			'selected-icon' : null,
			'unselected-icon' : null
			
		});
setTimeout(function(){$(".tree-folder-name").click()},300);
function resetQuestionForm(){
	
	$(".chosen-select").val("").trigger('chosen:updated');
	document.getElementById("question-form").reset();
        $("#form-field-tags").val("");
	$(".tags span").remove();
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
        var ciudad=$("#filter_ciudad").val();
        var temas=JSON.stringify($("#tema_filter").val());
        
        var inst=$("#inst_filter").val();
	$("#search_list").empty();
        $("#load_prof").show();
	$.ajax({
		url:"../Usuarios/buscarProfe",
		method:"POST",
		data:{area:ar,ciudad:ciudad,temas:temas,inst:inst,tipo:$("#search_type").val()},
		success:function(response){
			
                     
				$("#search_list").hide();
			var data=$.parseJSON(response).data;
			
                        $("#wid-results .widget-title").html("Resultados de Búsqueda ("+data.length+" Resultados)");
			$(data).each(function(){
				var usr=$(this)[0].Usuario;
                                var inst=$(this)[0].Instituto;
                                var res=$(this)[0][0];
                                res.mres==null?mres=0:mres=res.mres;
                                var instname="Independiente";
                                if(inst.instituto){
                                   instname=inst.instituto.toString();
                                }
					var src='data:image/jpeg;base64,'+usr.p_avatar;
				console.log(usr.id+" "+usr.nombre+" "+usr.p_avatar);
				if(usr.p_avatar==null){
				src="../assets/avatars/profile-pic.jpg";
				}
                            var tipo='  <i class="ace-icon fa fa-briefcase grey"></i> Profesor<br/>';
                            var stars=' <input id="input-id" type="number" class="stars" min=0 max=5 data-size="xs">';
                            if(usr.tipo!=3){
                              tipo='<i class="ace-icon fa fa-graduation-cap grey"></i> Estudiante<br/>';
                              stars='<div class="">Preguntas hechas: <span>'+res.pregs+'</span></div>';
                            }
			$("#search_list").append('\
			<li class="dd-item" data-id="1">\
			<div class="dd-handle">\
                                <div id="prof_img_container">\
				<img class="li_img" src="'+src+'">\
                               </div>\
				<div class="search_cont">\
				<h4 class="capitalize">'+$(this).capitalize(usr.nombre," ")+' '+$(this).capitalize(usr.apellido," ")+'</h4>\
				<p class="grey">\
                                '+tipo+'\
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
                                '+stars+'\
                                <div class="">Preguntas respondidas: <span>'+res.count+'</span></div>\
                                <div class="">Mejores respuestas: <span>'+mres+'</span></div>\
				</div>\
				<div id="button_inside" class="col-sm-3">\
				<a class="btn btn-primary btn-block" href="../Usuarios/profile?uid='+usr.id+'">Ver perfil...</a>\
				\
				</div>\
			</div>\
		</li>');
                          
                $(".stars").rating({showClear:false,step:1,disabled:true});
		$("#wid-results").show("slide");		
		$("#search_list").show("fade");
		$('#contactar-'+usr.id).on(ace.click_event, function(){contactar(usr)});
		$.ajax({
		url:"../ProfesorAreas/areaProfe",
		method:"POST",
		data:{prof_id:usr.id,area:ar},
		success:function(response){
			
				var data=$.parseJSON(response);
                                var size=data.size;
                                data=data.data;
		
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
                $("#load_prof").hide();
		},
		error:function(i,e,x){
                     $("#load_prof").hide();$("#search_list").hide();
                var res=$.parseJSON(i.responseText).message;
					bootbox.alert({
						message: res,
                                                title:"Error"
					  }
					);
				
			
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
        url: "../Usuarios/getThemes",
        type: 'post',
        data: {area:id},
        success: function (data) {
          
		$("#tema_title").html(tema);
		var temas=$.parseJSON(data);
		temas=temas.temas;	
		$("#temas").html($(this).capitalize(temas,','));
		$("#row_temas").css("display","table-row");
        }
    	});
        
}

$.fn.capitalize = function (schar,char) {
	if(schar!==null&&schar!==undefined&&schar!==""){
        var split =schar.split(char);
        console.log(split);
        for (var i = 0, len = split.length; i < len; i++) {
        	split[i]=split[i].trim(); 
                if(split[i].slice(1).indexOf(".")===-1){
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1).toLowerCase();}
        }
		
      
        var res = split.join(char);
        return res;
        }
    return schar;
};


function getAge(dateString) {
    var dob=dateString;
var year=dob.substr(6,4);
var month=(dob.substr(3,2));
var day=(dob.substr(0,2));
var today = new Date();
console.log(month+"-"+day+"-"+year);
    var birthDate = new Date(month+"-"+day+"-"+year);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
return age;
}
function confirm(title,msj,result){
        bootbox.confirm({
						message: msj,
                                                title:title,
                                                buttons: {
						  confirm: {
							 label: "OK",
							 className: "btn-primary btn-sm"
						  },
						  cancel: {
							 label: "Cancelar",
							 className: "btn-sm"
						  }
						},
                                                callback:result
                                                
					  }
					);
}
function contactar(id){
    console.log(confirm("¿Estas seguro?","¿Deseas contactar a este usuario?",function(result){
        if(result){
        $.ajax({
                    url:"../Usuarios/contactar",
                    data:{id:id},
                    method:'POST',
                    success:function(data){
                        
                        data=$.parseJSON(data);
                          $("#info_container").html(data.html);
                        gritter(data.title,data.text,data.class,data.avatar);
                        follow(id);
                        $("#contact-"+id).html(' <i class="ace-icon fa fa-hand-o-down bigger-120 blue"></i>\
                                                    Contactado');
                        $("#contact-"+id).removeClass("contact_user");
                        $("#contact-"+id).addClass("contacted_user");
                    }
                });}
    }));}
function follow(id){
    console.log(confirm("¿Estas seguro?","¿Deseas seguir a este usuario?",function(result){
        if(result){
        $.ajax({
                    url:"../Usuarios/seguir",
                    data:{id:id},
                    method:'POST',
                    success:function(data){
                        data=$.parseJSON(data);
                        gritter(data.title,data.text,data.class,data.avatar);
                       
                        $("#follow-"+id).html('<i class="ace-icon fa fa-minus-circle bigger-120 red"></i>\
                                                   Dejar de Seguir');
                        $( ".follow_user").unbind( "click" );
                        $("#follow-"+id).removeClass("follow_user");
                        $("#follow-"+id).addClass("unfollow-user");
                        $("#seguidores").html(parseInt($("#seguidores").html())+1);
                        $(".unfollow-user").click(function(){
                        var id=$(this).attr("id").split("-")[1];
                       unfollow(id);
                    });

                    }
                });}
    }));}
function unfollow(id){
    console.log(confirm("¿Estas seguro?","¿Deseas dejar de seguir a este usuario?",function(result){
        if(result){
        $.ajax({
                    url:"../Usuarios/dejar",
                    data:{id:id},
                    method:'POST',
                    success:function(data){
                        data=$.parseJSON(data);
                        gritter(data.title,data.text,data.class,data.avatar);
                        $("#follow-"+id).html('<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>\
                                                   Seguir');
                        $( ".unfollow-user").unbind( "click" );
                        $("#follow-"+id).removeClass("unfollow-user");
                        $("#follow-"+id).addClass("follow_user");
                          $("#seguidores").html(parseInt($("#seguidores").html())-1);
                        $(".follow_user").click(function(){
                        var id=$(this).attr("id").split("-")[1];
                      
                       follow(id);
                    });
                    }
                });}
    }));}
function gritter(title, message, class_name,src){
    if(class_name===undefined){
        class_name='gritter-info';
    }
    if(src===undefined){
        src=false;
    }else{
        src='data:image/jpeg;base64,'+src;
    }
$.gritter.add({
                title: title,
                text: message,
                image: src,
                sticky: false,
                time: 2000,
                before_open: function(){

                },

                class_name: class_name
        });
}  
function upvote_p(id){
    var antv=parseInt($("#pregunta_votes").html());
    $.ajax({
        url:"../Pregunta/votarPos",
        method:"POST",
        data:{pid:id},
        success:function(data){
           data=$.parseJSON(data);
            $("#downvote_btn i").removeClass("fa-thumbs-down");
               $("#downvote_btn i").addClass("fa-thumbs-o-down");
           $("#pregunta_votes").html(data.votes.voto);
           if(parseInt($("#pregunta_votes").html())>0){
               $("#pregunta_votes").removeClass("red");
               $("#pregunta_votes").addClass("green");
           }
           if(data.votes.type==="1"){
               $("#upvote_btn i").removeClass("fa-thumbs-o-up");
               $("#upvote_btn i").addClass("fa-thumbs-up");
           }else{
                $("#upvote_btn i").removeClass("fa-thumbs-up");
               $("#upvote_btn i").addClass("fa-thumbs-o-up");
           }
        }
    });
}
function upvote_r(id){
   
    $.ajax({
        url:"../Pregunta/votarPosRes",
        method:"POST",
        data:{rid:id},
        success:function(data){
           data=$.parseJSON(data);
            $("#downvote-"+id+" i").removeClass("fa-thumbs-down");
               $("#downvote-"+id+" i").addClass("fa-thumbs-o-down");
           $("#votes-"+id).html(data.votes.voto);
           if(parseInt( $("#votes-"+id).html())>0){
               $("#votes-"+id).removeClass("red");
                $("#votes-"+id).addClass("green");
           }
           if(data.votes.type==="1"){
               $("#upvote-"+id+" i").removeClass("fa-thumbs-o-up");
               $("#upvote-"+id+" i").addClass("fa-thumbs-up");
           }else{
                $("#upvote-"+id+" i").removeClass("fa-thumbs-up");
               $("#upvote-"+id+" i").addClass("fa-thumbs-o-up");
           }
        }
    });
}
function downvote_r(id){
    $.ajax({
        url:"../Pregunta/votarNegRes",
        method:"POST",
        data:{rid:id},
        success:function(data){
           data=$.parseJSON(data);
           $("#votes-"+id).html(data.votes.voto);
           $("#upvote-"+id+" i").removeClass("fa-thumbs-up");
               $("#upvote-"+id+" i").addClass("fa-thumbs-o-up");
                  if(parseInt( $("#votes-"+id).html())<0){
                $("#votes-"+id).removeClass("green");
                $("#votes-"+id).addClass("red");
           }
             if(data.votes.type==="-1"){
               $("#downvote-"+id+" i").removeClass("fa-thumbs-o-down");
                $("#downvote-"+id+" i").addClass("fa-thumbs-down");
           }else{
                 $("#downvote-"+id+" i").removeClass("fa-thumbs-down");
                $("#downvote-"+id+" i").addClass("fa-thumbs-o-down");
           }
        }
    });
}

function bestAnswer(id){
    $.ajax({
        url:"../Pregunta/bestAnswer",
        method:"POST",
        data:{rid:id},
        success:function(data){
            data=$.parseJSON(data);
             gritter(data.title,data.text);
             var bid=$("#responses .btn-danger").attr("id");
            
             if(bid!==undefined){
            var sel="#"+bid;
             bid=bid.split("-")[1];
            $(sel).html("Marcar como Mejor respuesta"); 
           $(sel).attr("onclick","bestAnswer("+bid+")");
             $(sel).addClass("btn-primary");
            $(sel).removeClass("btn-danger");
             $(".bestanswer").removeClass("bestanswer");
             $(".bestanswer_chk").remove();
           }
            var selector= $("#bestAnswer-"+id).attr("id")|| $("#unBestAnswer-"+id).attr("id")
             $("#"+selector).html("Desmarcar como Mejor respuesta");
             $("#"+selector).parent().parent().addClass("bestanswer");
              $("#respuesta-"+id+" .center").append('<span class="badge badge-transparent bestanswer_chk" title="El usuario que pregunto, marcó esta como la mejor respuesta.">\
									<i class="ace-icon fa fa-check green fa-2x"></i>\
								</span>');
             $("#"+selector).attr("onclick","unBestAnswer("+id+")");
             $("#"+selector).removeClass("btn-primary");
              $("#"+selector).addClass("btn-danger");
        }});
}
function unBestAnswer(id){
    $.ajax({
        url:"../Pregunta/delBestAnswer",
        method:"POST",
        data:{rid:id},
        success:function(data){
            data=$.parseJSON(data);
             gritter(data.title,data.text);
             $("#responses .btn-danger").html("Marcar como Mejor Respuesta");
             var bid=$("#responses .btn-danger").attr("id");
             bid=bid.split("-")[1];
             $("#responses .btn-danger").attr("onclick","bestAnswer("+bid+")");
              $("#responses .btn-danger").addClass("btn-primary");
             $("#responses .btn-danger").removeClass("btn-danger");
             $(".bestanswer").removeClass("bestanswer");
             $(".bestanswer_chk").remove();
            
        }});
}
function downvote_p(id){
    $.ajax({
        url:"../Pregunta/votarNeg",
        method:"POST",
        data:{pid:id},
        success:function(data){
           data=$.parseJSON(data);
           $("#pregunta_votes").html(data.votes.voto);
            $("#upvote_btn i").removeClass("fa-thumbs-up");
               $("#upvote_btn i").addClass("fa-thumbs-o-up");
                  if(parseInt($("#pregunta_votes").html())<0){
               $("#pregunta_votes").removeClass("green");
               $("#pregunta_votes").addClass("red");
           }
             if(data.votes.type==="-1"){
               $("#downvote_btn i").removeClass("fa-thumbs-o-down");
               $("#downvote_btn i").addClass("fa-thumbs-down");
           }else{
                $("#downvote_btn i").removeClass("fa-thumbs-down");
               $("#downvote_btn i").addClass("fa-thumbs-o-down");
           }
        }
    });
}
function changeType(){
    var val=$("#search_type").val();
    if(val==2){
    $("#area_search").attr("data-placeholder","Busco un profesor de...(Área*)");
     $("#tema_filter").attr("data-placeholder","Que sepa de...(Temas)");
    $("#search_type").val(3);
     $("#change_type_button").html("Buscar Estudiantes");
     $(".chosen-select").trigger("chosen:updated");
    }
    else{
    $("#area_search").attr("data-placeholder","Busco estudiantes interesados en...(Área*)");
     $("#tema_filter").attr("data-placeholder","Que quieran saber de...(Temas)");
    $("#search_type").val(2);
     $("#change_type_button").html("Buscar Profesores");
        $(".chosen-select").trigger("chosen:updated");
    }
}
$.fn.startLoading=function(){
    var name=$(this).selector;
var a='<div style="position: absolute;z-index: 90000;font-size: 60px;top: 10%;left: 30%;" class="ajax-loading-overlay"><i class="ajax-loading-icon fa fa-spin fa-spinner fa-2x purple"></i> </div>';    
$(this).html(a);
}
$.fn.stopLoading=function(){
    
$(".ajax-loading-overlay").remove();
}
$.fn.scrollTo = function( target, options, callback ){
  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
  var settings = $.extend({
    scrollTarget  : target,
    offsetTop     : 50,
    duration      : 500,
    easing        : 'swing'
  }, options);
  return this.each(function(){
    var scrollPane = $(this);
    var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
    var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
    scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
      if (typeof callback == 'function') { callback.call(this); }
    });
  });
}
function question_search(){
    var area=$("#area_search").val();
    var tags=$("#tema_filter").val();
     
                $("#question_search_container").startLoading();
    $.ajax({
        url:"buscarPregunta",
        method:"POST",
        data:{area:area,tags:tags},
        success:function(data){
            data=$.parseJSON(data);
            if(data.preg.length>0){
               $("#question_search_container").empty();

            $.each(data.preg,function(){
                console.log($(this));
                $preg=$(this)[0];
            
                
                  var cont='<a href="Post?pid='+$preg['ip_pregunta']['id']+'"><li class="question_li">';
                                          $cres=$preg['0']['crespuesta'];
                                           $votes=$preg['0']['numpreg'];
                                            if($votes===null){$votes=0;}
                                          cont+= '<div class="votes"><div class="respuestas_n center">\
                                                                            <p>Respuestas<br/>\
                                                                             <span style="font-weight:bold;font-size:15px">'+$cres+'</span></p>\
                                                                        </div>';
                                        $class='';
                                        if($votes>0){$class='class="green"';}else if($votes<0){$class='class="red"';}
                                          cont+='<div class="puntuacion_n center">\
                                                                            <p>Puntuacion<br/>\
                                                                             <span style="font-weight:bold;font-size:15px" '+$class+'>'+$votes+'</span></p>\
                                                                        </div></div><div class="question_rest">';                                            
                                          $title=$preg['ip_pregunta']['titulo'];
                                          cont+='<h4 class="blue">'+$title+'</h4><p class="hashtags">';

                                          $.each(data.p_tags,function(){
                                              $tag=$(this)[0];
                                            
                                               if($tag['PreguntaTag']['pregunta']==$preg['ip_pregunta']['id']){
                                                  $t=$tag['Tags']['tag'];
                                                  cont+='<span class="label label-sm label-purple">'+$t+'</span> ';
                                              }
                                          });
                                           
                                          cont+='</p><p class="area">';
                
                                              $autor=$preg['ip_usuario']['nombre']+" "+$preg['ip_usuario']['apellido'];
                                              $fecha=$preg['ip_pregunta']['fecha_pregunta'];
                                              cont+=$preg['ip_area']['area']+'</p><p class="autor">'+$autor+'</p><p class="fecha">'+$fecha+'</p>\
                                        </div></li></a>';
 
            $("#question_search_container").append(cont);
            });
             $("#question_search_container").stopLoading();
            $(".active").removeClass("active");
            $("#search_tab").show();
            $("#search_tab").addClass("active");
            
             $("#search_tabpane").addClass("active");
            }else{
              $("#question_search_container").stopLoading();
              bootbox.alert({
						message: "No hay preguntas que coincidan con tu Búsqueda.",
                                                title:"Lo sentimos!"
					  }
					);
                                $("#question_search_container").append("No hay resultados para mostrar");
            }
           
        }
    });
}
function addCalendar(title,description){
    $.ajax({url:"../Calendar/add",method:"POST",data:{title:title,description:description},success:
                function(data){
            
    }});
}
function updateCalendar(id,title,description){
     $.ajax({url:"../Calendar/update",method:"POST",data:{title:title,description:description},success:
                function(data){
            
    }});
}
function deleteCalendar(id){
     $.ajax({url:"../Calendar/delete",method:"POST",data:{title:title,description:description},success:
                function(data){
            
    }});
}
function renderCalendar(){
     $.ajax({url:"../Calendar/render",method:"POST",data:{title:title,description:description},success:
                function(data){
            
    }});
}