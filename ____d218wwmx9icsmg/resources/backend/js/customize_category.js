function removeVariation(that){
	$(that).parent().parent().remove();
}

function moreDescp(that)
{

	$.post(base_url+'admin/categories/view_option',{data:true},function(data){
		$("#add_more_descps_in_me").append(data);
	});
}
function moreImage(that,mlang)
{

	$.post(base_url+'admin/categories/view_more_image/',{data:true},function(data){
		$("#add_more_images_in_me").append(data);
		$('.dropify').dropify();
	});
}


function morecVariation(that)
{

	$.post(base_url+'admin/categories/view_cvariation_section',{data:true},function(data){
		$("#add_more_cvariation_in_me").append(data);
		$('.dropify').dropify();
	});
}

function removeOption(that)
{
	$(that).parent().remove();
}

function moreOption(that,var_t)
{

	$.post(base_url+'admin/categories/more_option/'+var_t,{data:true},function(data){
		$("#add_more_option_in_me"+var_t).append(data);
	});
}
function toggleBottom(that)
{
	$(that).parent().parent().parent().parent().find(".card-body").toggle();
}

$(document).ready(function(){
    var colors = $("#colors").val();
    var faces = $("#faces").val();
    more_table_price_option(colors,faces);
})
function more_table_price_option(that,values)
{
    var colors = $("#colors").val();
    var faces = $("#faces").val();

    // var colorss  = $("#colors").attr('data-colors');
    // var facess   = $("#faces").attr('data-faces');
    
    $.post(base_url+'admin/categories/show_price_tables_dynamic/'+colors+"/"+faces,{data:true},function(datas){
        $("#show_table_price").html('');
        $("#show_table_price").append(datas);
    });

}
function newRow(id=0,table_id)
{
	$.post(base_url+"admin/categories/get_new_rowv2",{id:id,table_id:table_id},function(data){
		$(".append_rows_in_here"+table_id).append(data);
	})
}
function morePrice()
{
	var prints = $(".prints").val();
	var faces = $(".faces").val();
	$.post(base_url+"admin/categories/get_new_table",{prints:prints,faces:faces},function(data){
		$("#add_more_tables_in_me").append(data);
	});
}
function morePriceV2()
{
	$.post(base_url+"admin/categories/get_new_table_v2",{data:1},function(data){
		$("#add_more_tables_in_me").append(data);
	});
}
function newPrint(table_id)
{
	const el = document.querySelector('.table_id_of_'+table_id);
	var scrollLeft = el.scrollLeft;


	$.post(base_url+"admin/categories/add_new_print",{table_id:table_id},function(data){
		$(".table_id_of_"+table_id).html(data);
		el.scrollLeft = scrollLeft+180;
	});
}
function removePrint(table_id,key)
{
	const el = document.querySelector('.table_id_of_'+table_id);
	var scrollLeft = el.scrollLeft;


	$.post(base_url+"admin/categories/remove_print",{table_id:table_id,key:key},function(data){
		$(".table_id_of_"+table_id).html(data);
		el.scrollLeft = scrollLeft+180;
	});
}


function removeRow(table_id,row_id)
{
	

	$.post(base_url+"admin/categories/remove_row",{table_id:table_id,row_id:row_id},function(data){
		$(".table_id_of_"+table_id).html(data);
	});
}

function faceChanged(table_id,value)
{
	const el = document.querySelector('.table_id_of_'+table_id);
	var scrollLeft = el.scrollLeft;


	$.post(base_url+"admin/categories/face_changed",{table_id:table_id,value:value},function(data){
		$(".table_id_of_"+table_id).html(data);
		el.scrollLeft = scrollLeft+180;
	});
}

function whgChanged(row_id,value)
{
	$.post(base_url+"admin/categories/whg_changed",{row_id:row_id,value:value},function(data){
		
	});
}
function qtyChanged(table_id,value)
{
	$.post(base_url+"admin/categories/qty_changed",{table_id:table_id,value:value},function(data){
		
	});
}
function plainPriceChanged(row_id,value)
{
	$.post(base_url+"admin/categories/plain_price_changed",{row_id:row_id,value:value},function(data){
		
	});
}
function columnChanged(row_id,print_key,face_key,value)
{
	$.post(base_url+"admin/categories/column_changed",{row_id,print_key,face_key,value},function(data){
		
	});
}