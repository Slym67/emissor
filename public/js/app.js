$('.btn-delete').click((e) => {

	e.preventDefault();
	
	swal({
		title: "Você está certo?",
		text:
		"Uma vez deletado, você não poderá recuperar esse item novamente!",
		icon: "warning",
		buttons: true,
		buttons: ["Cancelar", "Excluir"],
		dangerMode: true
	}).then(isConfirm => {
		if (isConfirm) {
			$('#form-delete').submit();
		} else {
			swal("Este item está salvo!");
		}
	});

})

$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
$('.cep').mask('00000-000');
$('.date').mask('00/00/0000');
$('.ncm').mask('0000.00.00');
$('.cfop').mask('0000');
$('.money').mask('00000000000,00', {reverse: true});

