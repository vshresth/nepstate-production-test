function toggleMe(that)
{
	$(that).parent().parent().find(".card-body").toggle();
	var already = $(that).find("span").html();
	if(already=="+") already="-"; else already = "+";
	$(that).find("span").html(already);
}

var inter;

function assignDesigner(order_id)
{
	$("#myModal").modal("show");
	$.post(base_url+"admin/corders/get_online_drivers",{order_id:order_id},function(data){
			var htmlData = data;
			$(".driver_modal_body").html(htmlData);
		});
	inter = setInterval(function(){
		$.post(base_url+"admin/corders/get_online_drivers",{order_id:order_id},function(data){
			var htmlData = data;
			$(".driver_modal_body").html(htmlData);
		});
	},60000);

}
function closeModal()
{
	clearInterval(inter);
}