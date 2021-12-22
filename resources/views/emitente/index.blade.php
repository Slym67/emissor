@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<form class="forms-sample" method="post" action="/emitente/save" enctype="multipart/form-data">
				@csrf
				
				<div class="row">

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">CPF/CNPJ</label>
						<input type="text" class="form-control @if($errors->has('cpf_cnpj')) is-invalid @endif cpf_cnpj" value="{{isset($emitente) ? $emitente->cpf_cnpj : old('cpf_cnpj')}}" id="cpf_cnpj" placeholder="CPF/CNPJ" name="cpf_cnpj">
						@if($errors->has('cpf_cnpj'))
						<div class="invalid-feedback">
							{{ $errors->first('cpf_cnpj') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Razão social</label>
						<input type="text" class="form-control @if($errors->has('razao_social')) is-invalid @endif" value="{{isset($emitente) ? $emitente->razao_social : old('razao_social')}}" id="razao_social" placeholder="Razão social" name="razao_social">
						@if($errors->has('razao_social'))
						<div class="invalid-feedback">
							{{ $errors->first('razao_social') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Nome fantasia</label>
						<input type="text" class="form-control @if($errors->has('nome_fantasia')) is-invalid @endif" value="{{isset($emitente) ? $emitente->nome_fantasia : old('nome_fantasia')}}" id="nome_fantasia" placeholder="Nome fantasia" name="nome_fantasia">
						@if($errors->has('nome_fantasia'))
						<div class="invalid-feedback">
							{{ $errors->first('nome_fantasia') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">IE/RG</label>
						<input type="text" class="form-control @if($errors->has('ie_rg')) is-invalid @endif" value="{{isset($emitente) ? $emitente->ie_rg : old('ie_rg')}}" id="ie_rg" placeholder="IE/RG" name="ie_rg">
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
							<option @isset($emitente)@if($emitente->cidade_id == $c->id)
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
						<input type="text" class="form-control @if($errors->has('rua')) is-invalid @endif" value="{{isset($emitente) ? $emitente->rua : old('rua')}}" id="rua" placeholder="Rua" name="rua">
						@if($errors->has('rua'))
						<div class="invalid-feedback">
							{{ $errors->first('rua') }}
						</div>
						@endif
					</div>
					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">Número</label>
						<input type="text" class="form-control @if($errors->has('numero')) is-invalid @endif" value="{{isset($emitente) ? $emitente->numero : old('numero')}}" id="numero" placeholder="Número" name="numero">
						@if($errors->has('numero'))
						<div class="invalid-feedback">
							{{ $errors->first('numero') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Bairro</label>
						<input type="text" class="form-control @if($errors->has('bairro')) is-invalid @endif" value="{{isset($emitente) ? $emitente->bairro : old('bairro')}}" id="bairro" placeholder="Bairro" name="bairro">
						@if($errors->has('bairro'))
						<div class="invalid-feedback">
							{{ $errors->first('bairro') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">CEP</label>
						<input type="text" class="form-control @if($errors->has('cep')) is-invalid @endif cep" value="{{isset($emitente) ? $emitente->cep : old('cep')}}" id="cep" placeholder="CEP" name="cep">
						@if($errors->has('cep'))
						<div class="invalid-feedback">
							{{ $errors->first('cep') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-5">
						<label for="exampleInputUsername1">Complemento</label>
						<input type="text" class="form-control @if($errors->has('complemento')) is-invalid @endif" value="{{isset($emitente) ? $emitente->complemento : old('complemento')}}" id="complemento" placeholder="Complemento" name="complemento">
						@if($errors->has('complemento'))
						<div class="invalid-feedback">
							{{ $errors->first('complemento') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="exampleInputUsername1">Telefone/Celular</label>
						<input type="text" class="form-control @if($errors->has('telefone')) is-invalid @endif fone" value="{{isset($emitente) ? $emitente->telefone : old('telefone')}}" id="telefone" placeholder="Telefone/Celular" name="telefone">
						@if($errors->has('telefone'))
						<div class="invalid-feedback">
							{{ $errors->first('telefone') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">Ulitmo número NFe</label>
						<input type="text" class="form-control @if($errors->has('ultimo_numero_nfe')) is-invalid @endif" value="{{isset($emitente) ? $emitente->ultimo_numero_nfe : old('ultimo_numero_nfe')}}" id="ultimo_numero_nfe" placeholder="Número de série NFe" name="ultimo_numero_nfe">
						@if($errors->has('ultimo_numero_nfe'))
						<div class="invalid-feedback">
							{{ $errors->first('ultimo_numero_nfe') }}
						</div>
						@endif
					</div>
					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">Número de série NFe</label>
						<input type="text" class="form-control @if($errors->has('numero_serie_nfe')) is-invalid @endif" value="{{isset($emitente) ? $emitente->numero_serie_nfe : old('numero_serie_nfe')}}" id="numero_serie_nfe" placeholder="Número de série NFe" name="numero_serie_nfe">
						@if($errors->has('numero_serie_nfe'))
						<div class="invalid-feedback">
							{{ $errors->first('numero_serie_nfe') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-6">
						<label>Certificado digital</label>
						<input accept=".bin,.pfx" type="file" name="certificado" class="file-upload-default">
						<div class="input-group col-xs-12">
							<input type="text" class="form-control file-upload-info @if($errors->has('certificado')) is-invalid @endif" disabled="" placeholder="Upload de arquivo">
							<span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
							</span>
						</div>
						@if($errors->has('certificado'))
						<span style="font-size: 13px;" class="text-danger">
							{{ $errors->first('certificado') }}
						</span>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="">Senha do certificado</label>
						<input type="password" class="form-control @if($errors->has('senha')) is-invalid @endif" value="{{old('senha')}}" id="senha" placeholder="Senha" name="senha">
						@if($errors->has('senha'))
						<div class="invalid-feedback">
							{{ $errors->first('senha') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-3">
						<label for="">Ambiente</label>
						<select class="form-control @if($errors->has('ambiente')) is-invalid @endif" name="ambiente">
							<option value="">Selecione</option>
							@foreach(App\Models\Emitente::ambientes() as $key => $a)
							<option @isset($emitente)@if($emitente->ambiente == $key)
								selected
								@endif
								@else
								@if(old('ambiente') == $key)
								selected
								@endif
								@endif
								value="{{$key}}">
								{{$key}} - {{$a}}
							</option>
							@endforeach
						</select>
						@if($errors->has('ambiente'))
						<div class="invalid-feedback">
							{{ $errors->first('ambiente') }}
						</div>
						@endif
					</div>

					<div class="col-12">
						<a class="btn btn-danger" href="/emitente">Cancelar</a>
						<button type="submit" class="btn btn-success mr-2">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@section('javascript')
	<script type="text/javascript" src="/js/emitente.js"></script>
	@endsection
	@endsection