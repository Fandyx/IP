  jQuery(function($) { 
      var grid_selector = "#grid-edu";
        var pager_selector = "#edu-pager";
        var colNames=['Tipo','Tipo de Institucion','Nombre','Titulo obtenido','Año'];
        var cModel=[

                        {name:'tipo',index:'tipo', width:60},
                        {name:'instituto_tipo',index:'instituto_tipo',width:120},
                        {name:'instituto_nombre',index:'instituto_nombre', width:200},
                        {name:'titulo',index:'titulo', width:200},
                        {name:'ano',index:'ano', width:80}
                        ];
        table("../Profesor/getEducacion",grid_selector,pager_selector,colNames,cModel);
         grid_selector = "#grid-exp";
       pager_selector = "#edu-exp";
       colNames=['Tipo','Nombre de la institucion','Rol','Años'];
        cModel=[

                        {name:'tipo',index:'tipo', width:60},
                       
                        {name:'nombre',index:'nombre', width:200},
                        {name:'rol',index:'rol', width:200},
                        {name:'anos',index:'anos', width:80}
                        ];
        table("../Profesor/getExperiencia",grid_selector,pager_selector,colNames,cModel);
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
});

        function aceSwitch( cellvalue, options, cell ) {
                setTimeout(function(){
                        $(cell) .find('input[type=checkbox]')
                                .addClass('ace ace-switch ace-switch-5')
                                .after('<span class="lbl"></span>');
                }, 0);
        }
        //enable datepicker
        function pickDate( cellvalue, options, cell ) {
                setTimeout(function(){
                        $(cell) .find('input[type=text]')
                                        .datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
                }, 0);
        }






        function style_edit_form(form) {
                //enable datepicker on "sdate" field and switches for "stock" field
                form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
                        .end().find('input[name=stock]')
                                .addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
                                   //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
                                  //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

                //update buttons classes
                var buttons = form.next().find('.EditButton .fm-button');
                buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
                buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
                buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

                buttons = form.next().find('.navButton a');
                buttons.find('.ui-icon').hide();
                buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
                buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');		
        }

        function style_delete_form(form) {
                var buttons = form.next().find('.EditButton .fm-button');
                buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
                buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
                buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
        }

        function style_search_filters(form) {
                form.find('.delete-rule').val('X');
                form.find('.add-rule').addClass('btn btn-xs btn-primary');
                form.find('.add-group').addClass('btn btn-xs btn-success');
                form.find('.delete-group').addClass('btn btn-xs btn-danger');
        }
        function style_search_form(form) {
                var dialog = form.closest('.ui-jqdialog');
                var buttons = dialog.find('.EditTable')
                buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
                buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
                buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
        }

        function beforeDeleteCallback(e) {
                var form = $(e[0]);
                if(form.data('styled')) return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_delete_form(form);

                form.data('styled', true);
        }

        function beforeEditCallback(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
        }



        //it causes some flicker when reloading or navigating grid
        //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
        //or go back to default browser checkbox styles for the grid
        function styleCheckbox(table) {

                $(table).find('input:checkbox').addClass('ace')
                .wrap('<label />')
                .after('<span class="lbl align-top" />')


                $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
                .find('input.cbox[type=checkbox]').addClass('ace')
                .wrap('<label />').after('<span class="lbl align-top" />');

        }


        //unlike navButtons icons, action icons in rows seem to be hard-coded
        //you can change them like this in here if you want
        function updateActionIcons(table) {

                var replacement = 
                {
                        'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
                        'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
                        'ui-icon-disk' : 'ace-icon fa fa-check green',
                        'ui-icon-cancel' : 'ace-icon fa fa-times red'
                };
                $(table).find('.ui-pg-div span.ui-icon').each(function(){
                        var icon = $(this);
                        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
                        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                })

        }

        //replace icons with FontAwesome icons like above
        function updatePagerIcons(table) {
            console.log(3);
                var replacement = 
                {
                        'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                        'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                        'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                        'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
                };
                $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                        var icon = $(this);
                        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                })
        }

        function enableTooltips(table) {
                $('.navtable .ui-pg-button').tooltip({container:'body'});
                $(table).find('.ui-pg-div').tooltip({container:'body'});
        }
        function table(url,grid_selector,pager_selector,colNames,cModel){
                    //resize to fit page size
        $(window).on('resize.jqGrid', function () {
                $(grid_selector).jqGrid( 'setGridWidth', $(".tab-content").width() );
        })
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="tab-"]');
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
                if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                        //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
                        setTimeout(function() {
                                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
                        }, 0);
                }
        })



        jQuery(grid_selector).jqGrid({

                url:url,
                postData:{user:user_id},
                datatype: "json",
                mtype:"POST",
                height: 250,
                colNames:colNames,
                   jsonReader : {
                            root: "table_data",
                            page: "page",
                            total: "total",
                            records: "records"

                 },
                colModel:cModel, 

                viewrecords : true,
                rowNum:10,
                rowList:[10,20,30],
                pager : pager_selector,
           loadComplete : function() {
                        var table = this;

                        setTimeout(function(){
                                styleCheckbox(table);

                                updateActionIcons(table);
                                updatePagerIcons(table);
                                enableTooltips(table);
                        }, 0);
                }
});
        }