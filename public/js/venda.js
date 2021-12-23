var _itens = []
var _produto = null
var _fatura = []

$('#produto').change(() => {
	_produto = $('#produto').val() ? JSON.parse($('#produto').val()) : null
	if(_produto != null){
		$('#valor').val(formatReal(_produto.valor))
		$('#quantidade').val('1')
	}
})

function formatReal(valor){
	return valor.toLocaleString('pt-BR',{minimumFractionDigits: 2}).replace('.', ',');
}

$('#adicionar-produto').click(() => {
	let quantidade = $('#quantidade').val();
	let valor = $('#valor').val().replace(',', '.');
	_produto = $('#produto').val() ? JSON.parse($('#produto').val()) : null

	if(quantidade && valor && _produto){
		let item = {
			quantidade: quantidade,
			valor: valor,
			id: _produto.id,
			rand: Math.floor(Math.random() * (999999999 - 10)) + 10
		}
		let html = montaLinhaProduto(item)
		_itens.push(item)
		let total = totaliza()
		$('.total').html('R$ ' + formatReal(total))
		$('#tbl-produtos').append(html)
	}else{
		swal("Alerta", "Informe o produto, quantidade e valor", "warning")
	}
})

function montaLinhaProduto(item){
	let html = '';

	html += '<tr class="l_'+item.rand+'">'
	html += '<td>'+ _produto.nome +'</td>'
	html += '<td>'+ item.quantidade +'</td>'
	html += '<td>'+ formatReal(item.quantidade*item.valor) +'</td>'
	html += '<td><button onclick="deleteItem('+item.rand+')" class="btn btn-danger btn-sm"><i class="la la-trash">'
	html += '</i></button></td>'
	html += '</tr>'
	return html;
}

function totaliza(){
	let soma = 0;
	_itens.map((x) => {
		soma += parseFloat(x.valor)
	})
	return soma;
}

function deleteItem(rand){
	let temp = _itens.filter((x) => {
		if(x.rand != rand){
			return x
		}else{
			$('.l_'+rand).remove()
		}
	})
	_itens = temp
	let total = totaliza()
	$('.total').html('R$ ' + formatReal(total))

}

function deletePag(rand){
	let temp = _fatura.filter((x) => {
		if(x.rand != rand){
			return x
		}else{
			$('.p_'+rand).remove()
		}
	})
	_fatura = temp
}

$('#forma_pagamento').change(() => {
	$('#valor_pag').val(formatReal(totaliza()))
	var data = new Date();
	var dia = String(data.getDate()).padStart(2, '0');
	var mes = String(data.getMonth() + 1).padStart(2, '0');
	var ano = data.getFullYear();
	dataAtual = dia + '/' + mes + '/' + ano;
	$('#data').val(dataAtual)
})
$('#adicionar-pagamento').click(() => {
	let forma_pagamento = $('#forma_pagamento').val()
	let valor_pag = $('#valor_pag').val().replace(',', '.')
	let data = $('#data').val()
	if(_itens.length == 0){
		swal("Alerta", "Adicione produtos na venda", "warning")
	}else if(!forma_pagamento || !data || !valor_pag){
		swal("Alerta", "Informe a forma de pagamento, valor e data", "warning")
	}else{
		if(somaPagamentos(valor_pag)){
			let pagamento = {
				valor: valor_pag,
				forma_pagamento: forma_pagamento,
				data: data,
				rand: Math.floor(Math.random() * (999999999 - 10)) + 10
			}

			let html = montaLinhaPagameto(pagamento)
			_fatura.push(pagamento)
			$('#tbl-pagamentos').append(html)
		}else{
			swal("Alerta", "Informe os valores de pagamento corretamente", "warning")

		}
	}
})

function montaLinhaPagameto(item){
	let html = '';

	html += '<tr class="p_'+item.rand+'">'
	html += '<td>'+ getFormaPagmento(item.forma_pagamento) +'</td>'
	html += '<td>'+ item.data +'</td>'
	html += '<td>'+ formatReal(item.valor) +'</td>'
	html += '<td><button onclick="deletePag('+item.rand+')" class="btn btn-danger btn-sm"><i class="la la-trash">'
	html += '</i></button></td>'
	html += '</tr>'
	return html;
}

function somaPagamentos(valor){
	let total = totaliza()
	let soma = parseFloat(valor)

	_fatura.map((x) => {
		soma += parseFloat(x.valor)
	})

	console.log(soma)
	console.log(total)

	if(total != soma){
		return false
	}
	return true
}

function getFormaPagmento(forma){
	let formas = {
		'01': 'Dinheiro',
		'02': 'Cheque',
		'03': 'Cartão de Crédito',
		'04': 'Cartão de Débito',
		'05': 'Crédito Loja',
		'10': 'Vale Alimentação',
		'11': 'Vale Refeição',
		'12': 'Vale Presente',
		'13': 'Vale Combustível',
		'14': 'Duplicata Mercantil',
		'15': 'Boleto Bancário',
		'16': 'Depósito Bancário',
		'17': 'Pagamento Instantâneo (PIX)',
		'90': 'Sem pagamento',
		'99': 'Outros',
	}
	return formas[forma];
}

$('#btn-salvar').click(() => {
	let cliente = $('#cliente').val()

	if(!cliente){
		swal("Atenção", "Informe um cliente", "error")
	}else if(_itens.length == 0){
		swal("Atenção", "Informe produtos para venda", "error")
	}else if(_fatura.length == 0){
		swal("Atenção", "Informe os pagamentos para venda", "error")
	}else{
		let venda = {
			itens: _itens,
			fatura: _fatura,
			cliente_id: cliente,
			total: totaliza()
		}
		console.log(venda)
		$.post('/vendas/save', {
			_token: $('#token').val(),
			venda: venda
		})
		.done((success) => {
			console.log(success)
			swal("Sucesso", "Venda salva", "success")
			.then(() => {
				location.href = "/vendas";
			})
		})
		.fail((err) => {
			console.log(err)
			swal("Ops", "algo deu errado", "error")
		})
	}
})

