 jQuery(function($) {	

toggleTable("users");
toggleTable("profe");
toggleTable("est");
toggleTable("pad");
$('.page-content-area').prevAll('.ajax-loading-overlay').remove();
		
	});
	
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
	alert(3);
});
