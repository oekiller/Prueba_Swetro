var modal = document.getElementById('miModal');
var btnAbrir = document.getElementById('abrirModal');
var btnCerrar = document.getElementById('cerrarModal');

$(document).ready(function() {    
    $('#example').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},

			{
				text:      '<i class="fa fa-database"></i> ',
				titleAttr: 'Mostrar Registros Sospechosos de Trampa',
				className: 'btn btn-warning',
				action: function () {
					$('#example1').DataTable().destroy();
					$('#example1').DataTable({
						language: {
							"lengthMenu": "Mostrar _MENU_ registros",
							"zeroRecords": "No se encontraron resultados",
							"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
							"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
							"infoFiltered": "(filtrado de un total de _MAX_ registros)",
							"sSearch": "Buscar:",
							"oPaginate": {
								"sFirst": "Primero",
								"sLast":"Último",
								"sNext":"Siguiente",
								"sPrevious": "Anterior"
							 },
							 "sProcessing":"Procesando...",
						},
					}),
					modal.style.display = 'block';
				}
			}
		]	        
    });     
});

// Cuando se haga clic en el botón de cerrar, cerrar el modal
btnCerrar.onclick = function() {
  modal.style.display = 'none';
}

// // También cerrar el modal si se hace clic fuera del contenido del modal
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = 'none';
//   }
// }
