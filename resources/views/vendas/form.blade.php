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

				<div class="form-group col-xl-8">
					<label for="exampleInputUsername1">Cliente</label>
					<select id="cliente" class="js-example-basic-single w-100">
						<option value="">Selecione o cliente</option>
						@foreach($clientes as $c)
						<option value="{{$c->id}}">{{$c->nome}} | {{$c->cpf_cnpj}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xl-5" style="margin-top: 10px;">
	<div class="card bl-info">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-xl-12">
					<label for="exampleInputUsername1">Produto</label>
					<select id="produto" class="js-example-basic-single w-100">
						<option value="">Selecione o produto</option>
						@foreach($produtos as $p)
						<option value="{{$p}}">{{$p->nome}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-xl-6">
					<label for="exampleInputUsername1">Quantidade</label>
					<input type="text" id="quantidade" class="form-control">
				</div>
				<div class="form-group col-xl-6">
					<label for="exampleInputUsername1">Valor</label>
					<input type="text" id="valor" class="form-control money">
				</div>

				<div class="form-group col-xl-12">
					<button id="adicionar-produto" class="btn btn-primary w-100">
						Adicionar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xl-7" style="margin-top: 10px;">
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
									<th>
										Ações
									</th>
								</tr>
							</thead>
							<tbody id="tbl-produtos">
								

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<h5>Soma produtos: <strong class="total">R$ 0,00</strong></h5>
		</div>
	</div>
</div>

<div class="col-xl-5" style="margin-top: 10px;">
	<div class="card bl-danger">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-xl-12">
					<label for="exampleInputUsername1">Forma pagamento</label>
					<select id="forma_pagamento" class="js-example-basic-single w-100">
						<option value="">Selecione a forma de pagamento</option>
						@foreach(App\Models\Venda::formasPagamento() as $key => $f)
						<option value="{{$key}}">{{$f}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-xl-6">
					<label for="exampleInputUsername1">Data</label>
					<input type="text" id="data" class="form-control date">
				</div>
				<div class="form-group col-xl-6">
					<label for="exampleInputUsername1">Valor</label>
					<input type="text" id="valor_pag" class="form-control money">
				</div>

				<div class="form-group col-xl-12">
					<button id="adicionar-pagamento" class="btn btn-danger w-100">
						Adicionar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xl-7" style="margin-top: 10px;">
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
									<th>
										Ações
									</th>
								</tr>
							</thead>
							<tbody id="tbl-pagamentos">
								

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xl-4 offset-xl-2" style="margin-top: 10px;">
	<a href="/vendas" class="btn btn-danger w-100">
		<i class="la la-close"></i>
		Cancelar
	</a>
</div>
<div class="col-xl-4" style="margin-top: 10px;">
	<button id="btn-salvar" class="btn btn-success w-100">
		<i class="la la-check"></i>
		Salvar
	</button>
</div>

@section('javascript')
<script type="text/javascript" src="/js/venda.js"></script>
@endsection
@endsection