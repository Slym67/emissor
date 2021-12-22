$('#cpf_cnpj').blur(() => {
	let cnpj = $('#cpf_cnpj').val()
	if(cnpj.length == 18){
		consultaAlternativa(cnpj)
	}
})

function consultaAlternativa(cnpj){
	cnpj = cnpj.replace('.', '');
	cnpj = cnpj.replace('.', '');
	cnpj = cnpj.replace('-', '');
	cnpj = cnpj.replace('/', '');
	$.ajax({

		url: 'https://www.receitaws.com.br/v1/cnpj/'+cnpj, 
		type: 'GET', 
		crossDomain: true, 
		dataType: 'jsonp', 
		success: function(data) 
		{ 
			console.log(data);
			if(data.status == "ERROR"){
				swal(data.message, "", "error")
			}else{
				$('#nome').val(data.nome)
				$('#rua').val(data.logradouro)
				$('#bairro').val(data.bairro)
				$('#numero').val(data.numero)
				$('#cep').val(data.cep.replace('.', ''))
				$('#complemento').val(data.complemento)
			}

		}, 
		error: function(e) { 
			swal("Erro", "", "error")
		},
	});
}

var options = {
    onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'];
        $('.cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
}
$('.cpf_cnpj').val().length > 11 ? $('.cpf_cnpj').mask('00.000.000/0000-00', options) : $('.cpf_cnpj').mask('000.000.000-00#', options);

var op2 = {
    onKeyPress: function (fone, ev, el, op) {
    	console.log(fone.length)
        var masks = ['00 0000-0000', '00 00000-0000'];
        $('.fone').mask((fone.length > 12) ? masks[1] : masks[0], op);
    }
}
$('.fone').val().length > 12 ? $('.fone').mask('00 00000-0000', op2) : $('.fone').mask('00 0000-0000#', op2);
