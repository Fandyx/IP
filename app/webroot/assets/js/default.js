jQuery(function($) {
    var Base64Binary = {
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	
	/* will return a  Uint8Array type */
	decodeArrayBuffer: function(input) {
		var bytes = (input.length/4) * 3;
		var ab = new ArrayBuffer(bytes);
		this.decode(input, ab);
		
		return ab;
	},
	
	decode: function(input, arrayBuffer) {
		//get last chars to see if are valid
		var lkey1 = this._keyStr.indexOf(input.charAt(input.length-1));		 
		var lkey2 = this._keyStr.indexOf(input.charAt(input.length-2));		 
	
		var bytes = (input.length/4) * 3;
		if (lkey1 == 64) bytes--; //padding chars, so skip
		if (lkey2 == 64) bytes--; //padding chars, so skip
		
		var uarray;
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		var j = 0;
		
		if (arrayBuffer)
			uarray = new Uint8Array(arrayBuffer);
		else
			uarray = new Uint8Array(bytes);
		
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		
		for (i=0; i<bytes; i+=3) {	
			//get the 3 octects in 4 ascii chars
			enc1 = this._keyStr.indexOf(input.charAt(j++));
			enc2 = this._keyStr.indexOf(input.charAt(j++));
			enc3 = this._keyStr.indexOf(input.charAt(j++));
			enc4 = this._keyStr.indexOf(input.charAt(j++));
	
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
	
			uarray[i] = chr1;			
			if (enc3 != 64) uarray[i+1] = chr2;
			if (enc4 != 64) uarray[i+2] = chr3;
		}
	
		return uarray;	
	}
}
    $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
    _title: function(title) {
        if (!this.options.title ) {
            title.html("&#160;");
        } else {
            title.html(this.options.title);
        }
    }
}));
    $('[data-rel=popover]').popover({html:true});
             $('[data-rel=popover]').hover(function(){

                  $(this).popover("show");
             },function(){
                 $(this).popover("hide");
             });
            //editables on first profile page
            $.fn.editable.defaults.mode = 'inline';
            $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    

            //editables 

            //text editable
        $('#username')
            .editable({
                    type: 'text',
                    name: 'username'
        });
        $( "#siguiendo" ).click( function(e) {
					e.preventDefault();
			
					var dialog = $( "#siguiendo-dialog" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> Siguiendo</h4></div>",
						
						buttons: [ 
							
							{
								text: "OK",
								"class" : "btn btn-primary btn-xs",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
                                    });
                $( "#seguidores" ).click( function(e) {
					e.preventDefault();
			
					var dialog = $( "#seguidores-modal" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [ 
							{
								text: "Cancel",
								"class" : "btn btn-xs",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							},
							{
								text: "OK",
								"class" : "btn btn-primary btn-xs",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
                                    });
$( ".bestanswer_chk" ).tooltip({
					show: null,
					position: {
						my: "left top",
						at: "left bottom"
					},
					open: function( event, ui ) {
						ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
					}
				});

            /* initialize the external events CALENDAR
-----------------------------------------------------------------*/

$('#external-events div.external-event').each(function() {

// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
// it doesn't need to have a start or end
var eventObject = {
    title: $.trim($(this).text()) // use the element's text as the event title
};

// store the Event Object in the DOM element so we can get to it later
$(this).data('eventObject', eventObject);

// make the event draggable using jQuery UI
$(this).draggable({
    zIndex: 999,
    revert: true,      // will cause the event to go back to its
    revertDuration: 0  //  original position after the drag
});

});






/* initialize the calendar
-----------------------------------------------------------------*/

var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();
 
var calendar = $('#calendar').fullCalendar({
//isRTL: true,
buttonHtml: {
    prev: '<i class="ace-icon fa fa-chevron-left"></i>',
    next: '<i class="ace-icon fa fa-chevron-right"></i>'
},

header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
},
events: [
{
    title: ' Clase matemáticas',
    description:'Una clase mas aburrida',
    start: new Date(y, m, 1,22,30),
    className: 'label-important'
},
{
    title: ' Clase Guitarra',
    start: new Date(y, m, d-5,12,00),
    end: new Date(y, m, d-2,12,00),
    className: 'label-success'
},
{
    title: 'Pitch Final Apps.co',
    description:'El pitch final de apps.co donde pasamos al demo day',
    start: new Date(y, m, 14, 11, 0),
    allDay: false,
    className:'label-grey'
}
]
,
editable:true,
droppable:true, // this allows things to be dropped onto the calendar !!!
selectable: true,

selectHelper: true,
select: function(start, end, allDay) {
 var modal = 
                '<div class="modal fade">\
      <div class="modal-dialog">\
       <div class="modal-content"> <form class="no-margin">\
             <div class="modal-body">\
               <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
              \
                      <div><label>Titulo del evento &nbsp;</label>\
                      <br/><input class="col-sm-12" name="title" id="title" autocomplete="off" type="text"/></div>\
                        <br/> <div><label>Descripción del evento &nbsp;</label>\
                      <textarea class="width-100" id="description" autocomplete="off"/></textarea></div>\
            \<label>Duración del evento &nbsp;</label>\
            <div class="input-daterange input-group">\
            <input type="text" class="date-picker input-sm form-control" name="start">\
            <span class="input-group-addon">\
                    <i class="fa fa-exchange"></i>\
            </span>\
            <input type="text" class="date-picker input-sm form-control" name="end">\
    </div>       \
              \
             </div>\
             <div class="modal-footer">\
                    <button type="submit" id="send_event" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Guardar</button>\
                    <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
             </div>\
       </form></div>\
     </div>\
    </div>';
     var modal = $(modal).appendTo('body');
     $('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				});
  $('.input-daterange').datepicker({autoclose:true});    
    $('#send_event').click(function(ev){
            ev.preventDefault();

           var title = $("#title").val();
           console.log(title);
           var description = $("#description").val();
           modal.modal("hide");
                if (title !== null) {
                    addCalendar(title,description);
                    calendar.fullCalendar('renderEvent',
                            {       
                                    title: title,
                                    description:description,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                            },
                            true // make the event "stick"
                    );
            }
    });
    modal.find('button[data-action=delete]').on('click', function() {
            calendar.fullCalendar('removeEvents' , function(ev){
                    return (ev._id == calEvent._id);
            })
            modal.modal("hide");
    });

    modal.modal('show').on('hidden', function(){
            modal.remove();
    });



    calendar.fullCalendar('unselect');
}
,
eventRender: function(event, element) { 
            element.find('.fc-event-title').append("<br/><hr style='margin:0'>" + event.description); 
        } ,
eventClick: function(calEvent, jsEvent, view) {

    //display a modal
    var modal = 
                            '<div class="modal fade">\
      <div class="modal-dialog">\
       <div class="modal-content">\
             <div class="modal-body">\
               <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
               <form class="no-margin">\
                      <label>Cambiar nombre del evento &nbsp;</label>\
                      <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
                      <br/> <div><label>Descripción del evento &nbsp;</label>\
                      <textarea class="width-100" id="description" autocomplete="off">'+calEvent.description+'</textarea></div>\<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Guardar</button>\
               </form>\
             </div>\
             <div class="modal-footer">\
                    <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Borrar Evento</button>\
                    <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
             </div>\
      </div>\
     </div>\
    </div>';


    var modal = $(modal).appendTo('body');
    modal.find('form').on('submit', function(ev){
            ev.preventDefault();

            calEvent.title = $(this).find("input[type=text]").val();
            calEvent.description=$("#description").val();
            updateCalendar(calEvent.id,calEvent.title,calEvent.description);
            calendar.fullCalendar('updateEvent', calEvent);
            modal.modal("hide");
    });
    modal.find('button[data-action=delete]').on('click', function() {
            removeCalendar(calEvent.id);
            calendar.fullCalendar('removeEvents' , function(ev){
                    return (ev._id == calEvent._id);
            })
            modal.modal("hide");
    });

    modal.modal('show').on('hidden', function(){
            modal.remove();
    });


    //console.log(calEvent.id);
    //console.log(jsEvent);
    //console.log(view);

    // change the border color just for fun
    //$(this).css('border-color', 'red');

}

});

            //select2 editable
           

            // *** editable avatar *** //
            try {//ie8 throws some harmless exceptions, so let's catch'em

                    //first let's add a fake appendChild method for Image element for browsers that have a problem with this
                    //because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
                    try {
                            document.createElement('IMG').appendChild(document.createElement('B'));
                    } catch(e) {
                            Image.prototype.appendChild = function(el){}
                    }

                    var last_gritter
                    $('.avatar').editable({
                            type: 'image',
                            name: 'avatar',
                            value: null,
                            image: {
                                    //specify ace file input plugin's options here
                                    btn_choose: 'Cambiar foto',
                                    droppable: true,
                                    maxSize: 1100000,//~100Kb

                                    //and a few extra ones here
                                    name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                                    on_error : function(error_type) {//on_error function will be called when the selected file has a problem
                                            if(last_gritter) $.gritter.remove(last_gritter);
                                            if(error_type == 1) {//file format error
                                                    last_gritter = $.gritter.add({
                                                            title: 'El archivo no es una imagen!!',
                                                            text: 'Escoge un archivo jpg|gif|png!',
                                                            class_name: 'gritter-error gritter-center'
                                                    });
                                            } else if(error_type == 2) {//file size rror
                                                    last_gritter = $.gritter.add({
                                                            title: 'Archivo demasiado grande!',
                                                            text: 'Imagen demasiado grande, no debe exceder 1MB!',
                                                            class_name: 'gritter-error gritter-center'
                                                    });
                                            }
                                            else {//other error
                                            }
                                    },
                                    on_success : function() {
                                            $.gritter.removeAll();
                                    }
                            },
                        url: function(params) {
                                    // ***UPDATE AVATAR HERE*** //
                                    //for a working upload example you can replace the contents of this function with 
                                    //examples/profile-avatar-update.js
    //this is similar to the file-upload.html example
//replace the code inside profile page where it says ***UPDATE AVATAR HERE*** with the code below

// ***UPDATE AVATAR HERE*** //

var submit_url = 'saveProfileImg';//please modify submit_url accordingly
var deferred = null;
var avatar = this;

//if value is empty (""), it means no valid files were selected
//but it may still be submitted by x-editable plugin
//because "" (empty string) is different from previous non-empty value whatever it was
//so we return just here to prevent problems
var value = $(avatar).next().find('input[type=hidden]:eq(0)').val();
if(!value || value.length == 0) {
deferred = new $.Deferred
deferred.resolve();
return deferred.promise();
}

var $form = $(avatar).next().find('.editableform:eq(0)')
var file_input = $form.find('input[type=file]:eq(0)');
var pk = $(avatar).attr('data-pk');//primary key to be sent to server

var ie_timeout = null


if( "FormData" in window ) {
var formData_object = new FormData();//create empty FormData object

//serialize our form (which excludes file inputs)
$.each($form.serializeArray(), function(i, item) {
//add them one by one to our FormData 
formData_object.append(item.name, item.value);							
});
//and then add files
$form.find('input[type=file]').each(function(){
var field_name = $(this).attr('name');
var files = $(this).data('ace_input_files');
if(files && files.length > 0) {
    formData_object.append(field_name, files[0]);
}
});

//append primary key to our formData
formData_object.append('pk', pk);
var url=$(".editable-image img").css("background-image").split("(")[1].split(",")[1];
var imgurl=url.substring(0,url.length -1)
deferred = $.ajax({
            url: submit_url,
       type: 'post',
       data: {url:imgurl}
})
}
else {
deferred = new $.Deferred

var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
var temp_iframe = 
    $('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
    frameborder="0" width="0" height="0" src="about:blank"\
    style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
    .insertAfter($form);

$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');

//append primary key (pk) to our form
$('<input type="hidden" name="pk" />').val(pk).appendTo($form);

temp_iframe.data('deferrer' , deferred);
//we save the deferred object to the iframe and in our server side response
//we use "temporary-iframe-id" to access iframe and its deferred object

$form.attr({
      action: submit_url,
      method: 'POST',
     enctype: 'multipart/form-data',
      target: temporary_iframe_id //important
});

$form.get(0).submit();

//if we don't receive any response after 30 seconds, declare it as failed!
ie_timeout = setTimeout(function(){
ie_timeout = null;
temp_iframe.attr('src', 'about:blank').remove();
deferred.reject({'status':'fail', 'message':'Timeout!'});
} , 30000);
}


//deferred callbacks, triggered by both ajax and iframe solution
deferred
.done(function(result) {//success
console.log();
var res = $.parseJSON(result);//the `result` is formatted by your server side response and is arbitrary
console.log(res);
if(res.message == 'ok') $(avatar).get(0).src = res.url;
else alert(res.message);
})
.fail(function(result) {//failure
alert("Hubo un error");
})
.always(function() {//called on both success and failure
if(ie_timeout) clearTimeout(ie_timeout)
ie_timeout = null;	
});

return deferred.promise();
// ***END OF UPDATE AVATAR HERE*** //
                                    var deferred = new $.Deferred

                                    var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                                    if(!value || value.length == 0) {
                                            deferred.resolve();
                                            return deferred.promise();
                                    }


                                    //dummy upload
                                    setTimeout(function(){
                                            if("FileReader" in window) {
                                                    //for browsers that have a thumbnail of selected image
                                                    var thumb = $('#avatar').next().find('img').data('thumb');
                                                    if(thumb) $('#avatar').get(0).src = thumb;
                                            }

                                            deferred.resolve({'status':'OK'});

                                            if(last_gritter) $.gritter.remove(last_gritter);
                                            last_gritter = $.gritter.add({
                                                    title: 'Avatar Updated!',
                                                    text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                                                    class_name: 'gritter-info gritter-center'
                                            });

                                     } , parseInt(Math.random() * 800 + 800))

                                    return deferred.promise();

                                    // ***END OF UPDATE AVATAR HERE*** //
                            },

                            success: function(response, newValue) {
                            }
                    })
            }catch(e) {}

            var tag_input = $('#form-field-tags');
            try{
                    tag_input.tag(
                      {
                            placeholder:tag_input.attr('placeholder'),
                            //enable typeahead by specifying the source array
                            source: ['Matemáticas','Inglés','Sociales','Música','Biologia','Física','Química','Literatura']//defined in ace.js >> ace.enable_search_ahead
                            /**
                            //or fetch data from database, fetch those that match "query"
                            source: function(query, process) {
                              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                              .done(function(result_items){
                                    process(result_items);
                              });
                            }
                            */
                      }
                    )
                    $('.area_temas').tag(
                      {
                            placeholder:$('.area_temas').attr('placeholder'),
                            //enable typeahead by specifying the source array
                            source: ['Matemáticas','Inglés','Sociales','Música','Biologia','Física','Química','Literatura']//defined in ace.js >> ace.enable_search_ahead
                            /**
                            //or fetch data from database, fetch those that match "query"
                            source: function(query, process) {
                              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                              .done(function(result_items){
                                    process(result_items);
                              });
                            }
                            */
                      }
                    );
                    //programmatically add a new
                    //var $tag_obj = $('#form-field-tags').data('tag');
                    //$tag_obj.add('Programmatically Added');
            }
            catch(e) {
console.log(e);
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //$('#form-field-tags').autosize({append: "\n"});
            }
                                    if(!$.browser.mobile){    
    $('.chosen-select').chosen({allow_single_deselect:true});
     $('.chosen-select').change(function(evt, params) {
         console.log($(this).val());
        
         var h=$('.chosen-choices')[0].scrollHeight;
         console.log(h);
    $('.chosen-choices').scrollTo(h-60);
  });
    }else{
     $('.chosen-select').addClass("normal-select");
    $('.chosen-select').removeClass("chosen-select");

    }
            //resize the chosen on window resize

            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                    $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                    })
            }).trigger('resize.chosen');


            $('#chosen-multiple-style').on('click', function(e){
                    var target = $(e.target).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                     else $('#form-field-select-4').removeClass('tag-input-style');
            });
            //another option is using modals
            $('#avatar2').on('click', function(){
                    var modal = 
                    '<div class="modal fade">\
                      <div class="modal-dialog">\
                       <div class="modal-content">\
                            <div class="modal-header">\
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                    <h4 class="blue">Change Avatar</h4>\
                            </div>\
                            \
                            <form class="no-margin">\
                             <div class="modal-body">\
                                    <div class="space-4"></div>\
                                    <div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
                             </div>\
                            \
                             <div class="modal-footer center">\
                                    <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Enviar</button>\
                                    <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
                             </div>\
                            </form>\
                      </div>\
                     </div>\
                    </div>';


                    var modal = $(modal);
                    modal.modal("show").on("hidden", function(){
                            modal.remove();
                    });

                    var working = false;

                    var form = modal.find('form:eq(0)');
                    var file = form.find('input[type=file]').eq(0);
                    file.ace_file_input({
                            style:'well',
                            btn_choose:'Click to choose new avatar',
                            btn_change:null,
                            no_icon:'ace-icon fa fa-picture-o',
                            thumbnail:'small',
                            before_remove: function() {
                                    //don't remove/reset files while being uploaded
                                    return !working;
                            },
                            allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                            allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
                    });

                    form.on('submit', function(){
                            if(!file.data('ace_input_files')) return false;

                            file.ace_file_input('disable');
                            form.find('button').attr('disabled', 'disabled');
                            form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");

                            var deferred = new $.Deferred;
                            working = true;
                            deferred.done(function() {
                                    form.find('button').removeAttr('disabled');
                                    form.find('input[type=file]').ace_file_input('enable');
                                    form.find('.modal-body > :last-child').remove();

                                    modal.modal("hide");

                                    var thumb = file.next().find('img').data('thumb');
                                    if(thumb) $('#avatar2').get(0).src = thumb;

                                    working = false;
                            });


                            setTimeout(function(){
                                    deferred.resolve();
                            } , parseInt(Math.random() * 800 + 800));

                            return false;
                    });

            });



            //////////////////////////////
            $('#profile-feed-1').ace_scroll({
                    height: '250px',
                    mouseWheelLock: true,
                    alwaysVisible : true
            });
            $('.scrollable').each(function () {
                    var $this = $(this);
                    $(this).ace_scroll({
                            size: 500
                            //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
                    });
            });
            $('a[ data-original-title]').tooltip();

            $('.easy-pie-chart.percentage').each(function(){
            var barColor = $(this).data('color') || '#555';
            var trackColor = '#E2E2E2';
            var size = parseInt($(this).data('size')) || 72;
            $(this).easyPieChart({
                    barColor: barColor,
                    trackColor: trackColor,
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: parseInt(size/10),
                    animate:false,
                    size: size
            }).css('color', barColor);
            });

            ///////////////////////////////////////////

            //right & left position
            //show the user info on right or left depending on its position
            $('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
                    var $this = $(this);
                    var $parent = $this.closest('.tab-pane');

                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $this.offset();
                    var w2 = $this.width();

                    var place = 'left';
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';

                    $this.find('.popover').removeClass('right left').addClass(place);
            }).on('click', function(e) {
                    e.preventDefault();
            });
            $('textarea.limited').inputlimiter({
                    remText: '%n Caracteres restantes...',
                    limitText: 'maximo permitido : %n.'
            });

            ///////////////////////////////////////////
            $('#user-profile-3')
            .find('input[type=file]').ace_file_input({
                    style:'well',
                    btn_choose:'Cambiar avatar',
                    btn_change:null,
                    no_icon:'ace-icon fa fa-picture-o',
                    thumbnail:'large',
                    droppable:true,

                    allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                    allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
            })
            .end().find('button[type=reset]').on(ace.click_event, function(){
                    $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
            })
            .end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
                    $(this).prev().focus();
            })




            ////////////////////
            //change profile
            $('[data-toggle="buttons"] .btn').on('click', function(e){
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    $('.user-profile').parent().addClass('hide');
                    $('#user-profile-'+which).parent().removeClass('hide');
            });
                                    $('[data-rel=tooltip]').tooltip();

            $(".select2").css('width','200px').select2({allowClear:true})
            .on('change', function(){
                    $(this).closest('form').validate().element($(this));
            }); 


            var $validation = false;
            $('#fuelux-wizard')
            .ace_wizard({
                    //step: 2 //optional argument. wizard will jump to step "2" at first
            })
            .on('change' , function(e, info){
                    if(info.step == 1 && $validation) {
                            if(!$('#validation-form').valid()) return false;
                    }
            })
            .on('finished', function(e) {
                    bootbox.dialog({
                            message: "Thank you! Your information was successfully saved!", 
                            buttons: {
                                    "success" : {
                                            "label" : "OK",
                                            "className" : "btn-sm btn-primary"
                                    }
                            }
                    });
            }).on('stepclick', function(e){
                    //e.preventDefault();//this will prevent clicking and selecting steps
            });


            //jump to a step
            $('#step-jump').on('click', function() {
                    var wizard = $('#fuelux-wizard').data('wizard')
                    wizard.currentStep = 3;
                    wizard.setState();
            })
            //determine selected step
            //wizard.selectedItem().step



            //hide or show the other form which requires validation
            //this is for demo only, you usullay want just one form in your application
jQuery(".ciudad").autocomplete(
{source: ciudades,
minLength: 3,
select: function (event, ui) {
var selectedObj = ui.item;
jQuery(".ciudad").val(selectedObj.value);
return false;
},
open: function () {
jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
},
close: function () {
jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
}
});




jQuery(".instituto").autocomplete("option", "delay", 100);
jQuery(".ciudad").autocomplete("option", "delay", 100);


    $('[data-rel=tooltip]').tooltip({container:'body'});
            $('[data-rel=popover]').popover({container:'body'});
            //documentation : http://docs.jquery.com/Plugins/Validation/validate


            $.mask.definitions['~']='[+-]';
            $('#phone').mask('9999999999');
            $("#precio").mask("$99999?9");
            jQuery.validator.addMethod("phone", function (value, element) {
                    return this.optional(element) || /^\d{10}( x\d{1,6})?$/.test(value);
            }, "Ingresa un numero de telefono válido.");
    $.validator.addMethod(
"normalDate",
function(value, element) {

return value.match(/^\d\d?\-\d\d?\-\d\d\d\d$/);
},
"Por favor ingresa una fecha valida."
);
            $('#profile_form').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                       direccion: {
                          required: true

                            },
                            email: {
                                    required: true,
                                    email:true
                            },
                            instituto:{
                                required:true
                            },
                            documento:{
                                required:true
                            },
                            name: {
                                    required: true
                            },
                            telefono1: {
                                    required: true,
                                    phone: 'required'
                            },
                            ciudad: {
                                    required: true
                            },
                            fecha_nacimiento: {
                                    required: true,
                                    normalDate:'required'
                            },
                            username: {
                                    required: true,
                                    minlength:6
                            },
                            platform: {
                                    required: true
                            },
                            subscription: {
                                    required: true
                            },
                            sexo: {
                                    required: true,
                            },
                            agree: {
                                    required: true,
                            }
                    },

                    messages: {
                            email: {
                                    required: "Ingresa un email válido.",
                                    email: "Ingresa un email válido."
                            },

                            ciudad: "Por favor escoge una ciudad",
                            direccion: "Ingresa una dirección valida",
                            subscription: "Por favor escoge al menos una opción",
                            instituto:"Este campo es obligatorio",
                            documento:"Ingresa un documento de identidad válido",
                            sexo: "Selecciona un genero",
                            phone:"Ingresa un telefono válido",
                            username: "El nombre de usuario no puede contener menos de 6 caracteres."
                    },


                    highlight: function (e) {
                            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },

                    success: function (e) {
                            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                            $(e).remove();
                    },

                    errorPlacement: function (error, element) {
                            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                                    var controls = element.closest('div[class*="col-"]');
                                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                            }
                            else if(element.is('.select2')) {
                                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                            }
                            else if(element.is('.chosen-select')) {
                                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                            }
                            else error.insertAfter(element.parent());
                    },

                    submitHandler: function (form) {
                    },
                    invalidHandler: function (form) {
                    }
            });




            $('#modal-wizard .modal-header').ace_wizard();
            $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
            		});	
function autoCompleteUniversidad(){
$(".universidad").autocomplete({source: function (request, response) {

   var ciudad=$(".ciudad").val();

   console.log(ciudad);
    jQuery.ajax({
     url:"../Institutos/getUniversidades",
     method:"POST",
     data:{ciudad:ciudad,term:request.term},
     success:function (data) {
        // assuming data is a JavaScript array such as
        // ["one@abc.de", "onf@abc.de","ong@abc.de"]
        // and not a string
        var res=[];
        data=$.parseJSON(data);
        $.each(data.universidades,function(){

            var nombre=$(this)[0].Universidad.nombre;
            var ciudad=$(this)[0].Universidad.ciudad;
            var resp=$(this).capitalize(nombre," ")+", "+$(this).capitalize(ciudad," ");
            res.push(resp);
        });

         response(res);
    }
});
},
minLength: 3,
select: function (event, ui) {
var selectedObj = ui.item;
jQuery(this).val(selectedObj.value);
return false;
},
open: function () {
jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
},
close: function () {
jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
}
});}
function autoCompleteColegio(){
    $(".colegio").autocomplete({source: function (request, response) {

   var ciudad=$(".ciudad").val();

   console.log(ciudad);
    jQuery.ajax({
     url:"../Institutos/getColegios",
     method:"POST",
     data:{ciudad:ciudad,term:request.term},
     success:function (data) {
        // assuming data is a JavaScript array such as
        // ["one@abc.de", "onf@abc.de","ong@abc.de"]
        // and not a string
        var res=[];
        data=$.parseJSON(data);

        $.each(data.colegios,function(){
           var nombre=$(this)[0].Colegio.nombre;
            var ciudad=$(this)[0].Colegio.ciudad;
            var resp=$(this).capitalize(nombre," ")+", "+$(this).capitalize(ciudad," ");
            res.push(resp);
        });
         response(res);
    }
});
},
minLength: 3,
select: function (event, ui) {
var selectedObj = ui.item;
jQuery(this).val(selectedObj.value);
return false;
},
open: function () {
jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
},
close: function () {
jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
}
});
}
function autoCompleteInstituto(){
    $(".instituto").autocomplete({source: function (request, response) {

   var ciudad=$(".ciudad").val();
   if(ciudad!==""){
   console.log(ciudad);
    jQuery.ajax({
     url:"../Institutos/getInstitutos",
     method:"POST",
     data:{ciudad:ciudad,term:request.term},
     success:function (data) {
        // assuming data is a JavaScript array such as
        // ["one@abc.de", "onf@abc.de","ong@abc.de"]
        // and not a string
        var res=[];
        data=$.parseJSON(data);
        $.each(data.universidades,function(){

            var nombre=$(this)[0].Universidad.nombre;
            console.log(nombre);
            res.push(nombre);
        });
        $.each(data.colegios,function(){

            var nombre=$(this)[0].Colegio.nombre;
            console.log(nombre);
            res.push(nombre);
        });
         response(res);
    }
});
}else{
bootbox.alert({message: 'Especifíca una ciudad',title:"Error" });

}},
minLength: 3,
select: function (event, ui) {
var selectedObj = ui.item;
$(this).val(selectedObj.value);
return false;
},
open: function () {
jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
},
close: function () {
jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
}
});
}


