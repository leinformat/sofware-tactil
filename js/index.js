$(document).ready(function()
{
	// Venta de Productos
	$('#search').focus()
	$('#search').on('keyup',function(){
		var search = $('#search').val()
		$.ajax({
			type: 'POST' ,
			url: 'php/codigo_ajax.php' ,
			data: {'search' : search}
		})
		.done(function(resultado){
			const result = $('.content-wrapper__search-result');
			result.html(resultado);
			result.addClass('active');
		})
		.fail(function(){
			alert('Hubo un error :(' )
		})

	})

	// Compra de Productos
	$('#search_ingreso').focus()
	$('#search_ingreso').on('keyup',function(){
		var search = $('#search_ingreso').val()
		$.ajax({
			type: 'POST' ,
			url: 'php/codigo_ajax.php' ,
			data: {'search_ingreso' : search}
		})
		.done(function(resultado){
			const result = $('.content-wrapper__search-result');
			result.html(resultado);
			result.addClass('active');
		})
		.fail(function(){
			alert('Hubo un error :(' )
		})
	})

	// Salida por Comcepto de Planillas
	$('#search_planilla').focus()

	$('#search_planilla').on('keyup',function(){
		var search = $('#search_planilla').val()
		$.ajax({
			type: 'POST' ,
			url: 'php/codigo_ajax.php' ,
			data: {'search_planilla' : search}
		})
		.done(function(resultado){
			$('#result').html(resultado)
		})
		.fail(function(){
			alert('Hubo un error :(' )
		})

	})

})
// document.getElementById('ocultar').style.display='none';