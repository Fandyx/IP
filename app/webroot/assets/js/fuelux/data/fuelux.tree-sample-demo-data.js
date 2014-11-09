var DataSourceTree = function(options) {
	this._data 	= options.data;
	this._delay = options.delay;
}

DataSourceTree.prototype.data = function(options, callback) {
	var self = this;
	var $data = null;

	if(!("name" in options) && !("type" in options)){
		$data = this._data;//the root tree
		callback({ data: $data });
		return;
	}
	else if("type" in options && options.type == "folder") {
		if("additionalParameters" in options && "children" in options.additionalParameters)
			$data = options.additionalParameters.children;
		else $data = {}//no data
	}
	
	if($data != null)//this setTimeout is only for mimicking some random delay
		setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);

	//we have used static data here
	//but you can retrieve your data dynamically from a server using ajax call
	//checkout examples/treeview.html and examples/treeview.js for more info
};

var tree_data={};
var t={};
var ace_icon = ace.vars['icon'];
if(typeof u_area!=="undefined"){
$.each(u_area,function(){
   console.log($(this)[0]);
    var area=$(this)[0].ip_area;
    var id=area.area_id;
    var name="area-"+id;
   t={name: area.area, type: 'folder'};
   tree_data[name]=t;
   console.log(id);
   $.ajax({url:"../Areas/dataAreas",data:{area_id:id},method:'POST',success:function(data){
          data=$.parseJSON(data);
      var t={name:'<a href="../Pregunta/?area='+id+'"><i class="'+ace_icon+' fa fa-pencil-square-o grey"></i>'+data.temas+' Temas</a>', type:'item'};
      tree_data[name]['additionalParameters']['children']['temas']=t;
      var t={name:'&nbsp;<a href="../Pregunta/?area='+id+'"><i class="'+ace_icon+' fa fa-question grey"></i>    '+data.preguntas+' Preguntas</a>', type:'item'};
      tree_data[name]['additionalParameters']['children']['preguntas']=t;
      var t={name:'<a onclick="busca_tree_estprof('+id+')"><i class="'+ace_icon+' fa fa-users grey"></i>'+data.profesores+'</a>', type:'item'};
      tree_data[name]['additionalParameters']['children']['profesores']=t;
  }
   });
   tree_data[name]['additionalParameters']={'children':{
           
   }};
   
});


}
var treeDataSource = new DataSourceTree({data: tree_data});
