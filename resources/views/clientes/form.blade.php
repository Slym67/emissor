@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<form method="post" @isset($cliente) action="/clientes/update" @else action="/clientes/save" @endif>
				@csrf
				<input type="hidden" name="id" value="{{isset($cliente) ? $cliente->id : 0}}">

				<div class="row">

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">CPF/CNPJ</label>
						<input type="text" class="form-control @if($errors->has('cpf_cnpj')) is-invalid @endif cpf_cnpj" value="{{isset($cliente) ? $cliente->cpf_cnpj : old('cpf_cnpj')}}" id="cpf_cnpj" placeholder="CPF/CNPJ" name="cpf_cnpj">
						@if($errors->has('cpf_cnpj'))
						<div class="invalid-feedback">
							{{ $errors->first('cpf_cnpj') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Nome</label>
						<input type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" value="{{isset($cliente) ? $cliente->nome : old('nome')}}" id="nome" placeholder="Nome" name="nome">
						@if($errors->has('nome'))
						<div class="invalid-feedback">
							{{ $errors->first('nome') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">IE/RG</label>
						<input type="text" class="form-control @if($errors->has('ie_rg')) is-invalid @endif" value="{{isset($cliente) ? $cliente->ie_rg : old('ie_rg')}}" id="ie_rg" placeholder="IE/RG" name="ie_rg">
						@if($errors->has('ie_rg'))
						<div class="invalid-feedback">
							{{ $errors->first('ie_rg') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">Cidade</label>
						<select name="cidade_id" class="form-control @if($errors->has('cidade_id')) is-invalid @endif">
							<option value="">Selecione</option>
							@foreach($cidades as $c)
							<option @isset($cliente)@if($cliente->cidade_id == $c->id)
								selected
								@endif
								@else
								@if(old('cidade_id') == $c->id)
								selected
								@endif
								@endif
								value="{{$c->id}}">
								{{$c->nome}}-{{$c->uf}}
							</option>
							@endforeach
						</select>
						@if($errors->has('cidade_id'))
						<div class="invalid-feedback">
							{{ $errors->first('cidade_id') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-5">
						<label for="exampleInputUsername1">Rua</label>
						<input type="text" class="form-control @if($errors->has('rua')) is-invalid @endif" value="{{isset($cliente) ? $cliente->rua : old('rua')}}" id="rua" placeholder="Rua" name="rua">
						@if($errors->has('rua'))
						<div class="invalid-feedback">
							{{ $errors->first('rua') }}
						</div>
						@endif
					</div>
					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">Número</label>
						<input type="text" class="form-control @if($errors->has('numero')) is-invalid @endif" value="{{isset($cliente) ? $cliente->numero : old('numero')}}" id="numero" placeholder="Número" name="numero">
						@if($errors->has('numero'))
						<div class="invalid-feedback">
							{{ $errors->first('numero') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Bairro</label>
						<input type="text" class="form-control @if($errors->has('bairro')) is-invalid @endif" value="{{isset($cliente) ? $cliente->bairro : old('bairro')}}" id="bairro" placeholder="Bairro" name="bairro">
						@if($errors->has('bairro'))
						<div class="invalid-feedback">
							{{ $errors->first('bairro') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">CEP</label>
						<input type="text" class="form-control @if($errors->has('cep')) is-invalid @endif cep" value="{{isset($cliente) ? $cliente->cep : old('cep')}}" id="cep" placeholder="CEP" name="cep">
						@if($errors->has('cep'))
						<div class="invalid-feedback">
							{{ $errors->first('cep') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-5">
						<label for="exampleInputUsername1">Complemento</label>
						<input type="text" class="form-control @if($errors->has('complemento')) is-invalid @endif" value="{{isset($cliente) ? $cliente->complemento : old('complemento')}}" id="complemento" placeholder="Complemento" name="complemento">
						@if($errors->has('complemento'))
						<div class="invalid-feedback">
							{{ $errors->first('complemento') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">Telefone/Celular</label>
						<input type="text" class="form-control @if($errors->has('telefone')) is-invalid @endif fone" value="{{isset($cliente) ? $cliente->telefone : old('telefone')}}" id="telefone" placeholder="Telefone/Celular" name="telefone">
						@if($errors->has('telefone'))
						<div class="invalid-feedback">
							{{ $errors->first('telefone') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<div class="form-group">
							<br>
							<div class="form-check form-check-primary">
								<label class="form-check-label">
									<input type="checkbox" name="contribuinte" class="form-check-input" @isset($cliente)@if($cliente->contribuinte) checked @endif @else @if(old('contribuinte')) checked @endif @endif>
									Contribuinte
									<i class="input-helper"></i></label>
								</div>

							</div>

						</div>
					</div>

					<div class="col-12">
						<a class="btn btn-danger" href="/clientes">Cancelar</a>
						<button type="submit" class="btn btn-success mr-2">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@section('javascript')
	<script type="text/javascript" src="/js/cliente.js"></script>
	@endsection
	@endsection