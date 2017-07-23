$(function(){
	var base_url = $("#base_url").val();

	$("[data-toggle=\"tooltip\"], .acoes").tooltip();

	// VALIDAÇÃO DADOS FORM USUARIO E PLATAFORMA
	$("#formCadUser, #formCadDoc, #formCadGrupo, #formCadTipo").submit(function(){

		var valida = 0;

		$("input:not(input[type='hidden']):not(input[type='file'])").each(function(){
			if ( $(this).val() == "" ) {

				valida++;
			}
		});

		if( valida > 0 ){

			$(".alert-form").fadeIn("slow").removeClass("hide");
			return false;
		} else {

			return true;
		}
	});

	// PREENCHE O INPUT ESCONDIDO E MOSTRA MODAL DE CONFIRMAÇÃO DE EXCLUSÃO
	$(".excluir").click(function(e){
		e.preventDefault();
		var id = $(this).prop("rel");

		$("#codigo").val(id);
		$('#modal_confirmacao').modal();
	});

	// MOSTRAR MODAL DE RECUPERAÇÃO DE SENHA
	$("#recuperarSenha").click(function(e){
		e.preventDefault();
		$('#modal_recuperarSenha').modal();
	});

	// VALIDAÇÃO DADOS FORM RECUPERAÇÃO DE SENHA
	$("#formRecupSenha").submit(function(){

		if ( $('input[name="nm_email"]').val() == "" ) {

			$(".alert-form").fadeIn("slow").removeClass("hide");
			return false;
		} else {

			return true;
		}
	});

	$(document).ready(function(){
		$('.cnpj').mask('000.000.000/0000-00', {reverse: true});
		$('.tel').mask('(00)0000-0000', {reverse: true});
		$('.datas').datepicker({format : 'dd/mm/yyyy'});
	});
});