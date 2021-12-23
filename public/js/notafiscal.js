$('#transmitir').click(() => {
	$('.spinner-border').css('display', 'inline-block')
	let venda_id = $('#venda_id').val()
	let nf = {
		_token: $('#token').val(),
		venda_id: venda_id
	}
	$.post('/notafiscal/transmitir', nf)
	.done((success) => {
		console.log(success)
		swal("Sucesso", "NFe gerada com sucesso [recibo] = " + success, "success")
		.then(() => {
			window.open("/notafiscal/imprimir/"+venda_id, "_blank");
			location.href = "/vendas/show/"+venda_id
		})
		$('.spinner-border').css('display', 'none')
	})
	.fail((err) => {
		console.log(err)
		try{
			swal("Erro", err.responseJSON.message, "error")
		}catch{
			swal("Erro", err.responseJSON, "error")
		}
		$('.spinner-border').css('display', 'none')
	})
})

$('#btn-corrigir').click(() => {
	$('.spinner-correcao').css('display', 'inline-block')
	let venda_id = $('#venda_id').val()
	let justificativa = $('#correcao').val()

	if(justificativa.length < 15){
		swal("Alerta", "Informe no minímo 15 caracteres!", "warning")
	}else{
		let correcao = {
			_token: $('#token').val(),
			venda_id: venda_id,
			justificativa: justificativa
		}
		$.post('/notafiscal/cartaCorrecao', correcao)
		.done((success) => {
			console.log(success)
			swal("Sucesso", "Evento registrado", "success")
			.then(() => {
				window.open("/notafiscal/imprimirCorrecao/"+venda_id, "_blank");
				location.href = "/vendas/show/"+venda_id
			})
			$('.spinner-correcao').css('display', 'none')
		})
		.fail((err) => {
			console.log(err)
			try{
				swal("Erro", err.responseJSON.retEvento.infEvento.xMotivo, "error")
			}catch{
				swal("Erro", err, "error")
			}
			$('.spinner-correcao').css('display', 'none')
		})
	}
})

$('#btn-cancelar').click(() => {
	$('.spinner-cancelar').css('display', 'inline-block')
	let venda_id = $('#venda_id').val()
	let justificativa = $('#justificativa').val()

	if(justificativa.length < 15){
		swal("Alerta", "Informe no minímo 15 caracteres!", "warning")
	}else{
		let cancelamento = {
			_token: $('#token').val(),
			venda_id: venda_id,
			justificativa: justificativa
		}
		$.post('/notafiscal/cancenlarNFe', cancelamento)
		.done((success) => {
			console.log(success)
			swal("Sucesso", "Evento registrado", "success")
			.then(() => {
				window.open("/notafiscal/imprimirCancelamento/"+venda_id, "_blank");
				location.href = "/vendas/show/"+venda_id
			})
			$('.spinner-cancelar').css('display', 'none')
		})
		.fail((err) => {
			console.log(err)
			try{
				swal("Erro", err.responseJSON.retEvento.infEvento.xMotivo, "error")
			}catch{
				swal("Erro", err, "error")
			}
			$('.spinner-cancelar').css('display', 'none')
		})
	}
})

