$(function(){
	'use strict';
	$('#example23').DataTable({
		dom: 'Bfrtip',
		"ordering": false,
		buttons: [
			{
				extend: 'csvHtml5',
			},
			{
				extend: 'excelHtml5',
			
			},
			{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				pageSize: 'A4', //formato stampa
			    alignment: "center", //non serve a nnt ma gli dice di stampare giustificando centralmente
			    titleAttr: 'PDF',   //titolo bottone
				exportOptions: {
					columns: [0,1,2,3,4,5,6]
				},
			    customize: function(doc) {
				    doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
				    doc.defaultStyle.alignment = 'center';
				    doc.styles.tableHeader.alignment = 'center';
				},
			},
		],
		
	});
});