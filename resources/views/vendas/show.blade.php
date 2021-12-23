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

	.spinner-border{
		width: 20px;
		height: 20px;
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

					@if($venda->estado == 'Aprovado')
					<h4>Chave: <strong class="text-primary">{{$venda->chave}}</strong></h4>
					<h4>Número NFe: <strong class="text-primary">{{$venda->numero_nfe}}</strong></h4>
					@endif
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
<input type="hidden" value="{{csrf_token()}}" id="token">
<input type="hidden" value="{{$venda->id}}" id="venda_id">
<div class="col-12" style="margin-top: 10px;">
	<div class="row">
		@if($venda->estado == 'Novo' || $venda->estado == 'Rejeitado')
		<div class="col-xl-3">
			<button id="transmitir" class="btn btn-success w-100">
				<div style="display: none" class="spinner-border" role="status">
				</div>
				<i class="la la-paper-plane"></i>
				Transmitir
			</button>
		</div>
		<div class="col-xl-3">
			<a href="/notafiscal/gerarXml/{{$venda->id}}" class="btn btn-info w-100">
				<i class="la la-file-code"></i>
				XML Temporário
			</a>
		</div>
		@endif

		@if($venda->estado == 'Aprovado')
		<div class="col-xl-3">
			<button data-toggle="modal" data-target="#modal-print" class="btn btn-info w-100">
				<i class="la la-print"></i>
				Imprimir
			</button>
		</div>
		<div class="col-xl-3">
			<a href="/notafiscal/download/{{$venda->id}}" class="btn btn-primary w-100">
				<i class="la la-download"></i>
				Download Xml
			</a>
		</div>
		<div class="col-xl-3">
			<button data-toggle="modal" data-target="#modal-correcao" class="btn btn-warning w-100">
				<i class="la la-eraser"></i>
				Carta de correção
			</button>
		</div>

		<div class="col-xl-3">
			<button data-toggle="modal" data-target="#modal-cancelar" class="btn btn-danger w-100">
				<i class="la la-close"></i>
				Cancelar
			</button>
		</div>
		@endif

		@if($venda->estado == 'Cancelado')
		<div class="col-xl-3">
			<a href="/notafiscal/imprimirCancelamento/{{$venda->id}}" class="btn btn-danger w-100">
				<i class="la la-print"></i>
				Imprimir cancelamento
			</a>
		</div>
		
		@endif

	</div>
</div>

<div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Escolha a impressão</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-6">
						<a class="btn btn-info w-100" href="/notafiscal/imprimir/{{$venda->id}}">
							<i class="la la-print"></i>
							Imprimir Danfe
						</a>
					</div>
					<div class="col-xl-6">

						<a class="btn btn-primary w-100" href="/notafiscal/imprimirSimples/{{$venda->id}}">
							<i class="la la-print"></i>
							Imprimir Danfe Simples
						</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Escolha a impressão</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-6">
						<a class="btn btn-info w-100" href="/notafiscal/imprimir/{{$venda->id}}">
							<i class="la la-print"></i>
							Imprimir Danfe
						</a>
					</div>
					<div class="col-xl-6">

						<a class="btn btn-primary w-100" href="/notafiscal/imprimirSimples/{{$venda->id}}">
							<i class="la la-print"></i>
							Imprimir Danfe Simples
						</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-correcao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Correção NFe <strong>{{$venda->numero_nfe}}</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group col-xl-12">
					<label for="exampleInputUsername1">Correção</label>
					<input type="text" class="form-control" id="correcao" placeholder="Correção">
				</div>
				@if($venda->sequencia_evento > 0)
				<a class="btn btn-warning" href="/notafiscal/imprimirCorrecao/{{$venda->id}}">
					<i class="la la-print"></i>
					Imprimir Correção anterior
				</a>
				@endif
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
				<button id="btn-corrigir" type="button" class="btn btn-warning">
					<div style="display: none" class="spinner-border spinner-correcao" role="status">
					</div>
					Corrigir
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-cancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cancelar NFe <strong>{{$venda->numero_nfe}}</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group col-xl-12">
					<label for="exampleInputUsername1">Justificativa</label>
					<input type="text" class="form-control" id="justificativa" placeholder="Justificativa">
				</div>
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
				<button id="btn-cancelar" type="button" class="btn btn-danger">
					<div style="display: none" class="spinner-border spinner-cancelar" role="status">
					</div>
					Cancelar
				</button>
			</div>
		</div>
	</div>
</div>

@section('javascript')
<script type="text/javascript" src="/js/notafiscal.js"></script>
@endsection
@endsection