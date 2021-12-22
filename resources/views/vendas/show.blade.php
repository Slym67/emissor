@extends('default')
@section('body')

<style type="text/css">
	table{ height: 200px; overflow-y: scroll;display:block;}
	th { width: 100%;}

	.bl-info{
		border-left: 3px solid #3F3E91;
	}

	.bl-danger{
		border-left: 3px solid #FF2121;
	}
</style>
<div class="col-xl-12">
	<input type="hidden" value="{{csrf_token()}}" id="token">
	<div class="card">
		<div class="card-body">
			<div class="row">

				<div class="form-group col-xl-12">
					<h4>{{$venda->cliente->nome}}</h4>
					<h4>{{$venda->cliente->rua}}, {{$venda->cliente->numero}} - {{$venda->cliente->bairro}}</h4>
					<h4>{{$venda->cliente->cep}} - {{$venda->cliente->telefone}}</h4>
					<h4>{{$venda->cliente->cidade->nome}} - {{$venda->cliente->cidade->uf}}</h4>
					<h4>{{$venda->cliente->cpf_cnpj}} - {{$venda->cliente->ie_rg}}</h4>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="col-xl-6" style="margin-top: 10px;">
	<div class="card bl-info">
		<div class="card-body">
			<div class="row" style="height: 235px;">
				<div class="form-group col-xl-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>
										Produto
									</th>
									<th>
										Quantidade
									</th>
									<th>
										Subtotal
									</th>
								
								</tr>
							</thead>
							<tbody>
								@foreach($venda->itens as $item)
								<tr>
									<td>{{$item->produto->nome}}</td>
									<td>{{$item->quantidade}}</td>
									<td>{{number_format($item->quantidade*$item->valor, 2, ',', '.')}}</td>

								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<h5>Soma produtos: <strong class="total">R$ {{number_format($venda->valor, 2, ',', '.')}}</strong></h5>
		</div>
	</div>
</div>



<div class="col-xl-6" style="margin-top: 10px;">
	<div class="card bl-danger">
		<div class="card-body">
			<div class="row" style="height: 255px;">
				<div class="form-group col-xl-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>
										Forma de pagamento
									</th>
									<th>
										Valor
									</th>
									<th>
										Data
									</th>
								
								</tr>
							</thead>
							<tbody>
								@foreach($venda->fatura as $item)
								<tr>
									<td>{{App\Models\Venda::getFormaPagamento($item->forma_pagamento)}}</td>
									<td>{{number_format($item->valor, 2, ',', '.')}}</td>
									<td>
										{{\Carbon\Carbon::parse($item->vencimento)->format('d/m/Y')}}
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xl-3" style="margin-top: 10px;">
	<button id="transmitir" class="btn btn-success w-100">
		<i class="la la-refresh"></i>
		Transmitir
	</button>
</div>
<div class="col-xl-3" style="margin-top: 10px;">
	<a href="/notafiscal/gerarXml/{{$venda->id}}" class="btn btn-info w-100">
		<i class="la la-file"></i>
		XML Temporário
	</a>
</div>

@section('javascript')
<script type="text/javascript" src="/js/venda.js"></script>
@endsection
@endsection