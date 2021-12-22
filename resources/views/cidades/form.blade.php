@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<form method="post" @isset($cidade) action="/cidades/update" @else action="/cidades/save" @endif>
				@csrf
				<input type="hidden" name="id" value="{{isset($cidade) ? $cidade->id : 0}}">

				<div class="row">
					<div class="form-group col-xl-4">
						<label for="exampleInputUsername1">Nome</label>
						<input type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" value="{{isset($cidade) ? $cidade->nome : old('nome')}}" id="nome" placeholder="Nome" name="nome">
						@if($errors->has('nome'))
						<div class="invalid-feedback">
							{{ $errors->first('nome') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">UF</label>
						<select name="uf" class="form-control @if($errors->has('uf')) is-invalid @endif">
							<option value="">Selecione</option>
							@foreach(App\Models\Cidade::estados() as $uf)
							<option @isset($cidade)@if($cidade->uf == $uf)
								selected
								@endif
								@else
								@if(old('uf') == $uf)
								selected
								@endif
								@endif
								value="{{$uf}}">
								{{$uf}}
							</option>
							@endforeach
						</select>
						@if($errors->has('uf'))
						<div class="invalid-feedback">
							{{ $errors->first('uf') }}
						</div>
						@endif
					</div>

					<div class="form-group col-xl-2">
						<label for="exampleInputUsername1">Código</label>
						<input type="text" class="form-control @if($errors->has('codigo')) is-invalid @endif" value="{{isset($cidade) ? $cidade->codigo : old('codigo')}}" id="codigo" placeholder="Código" name="codigo">
						@if($errors->has('codigo'))
						<div class="invalid-feedback">
							{{ $errors->first('codigo') }}
						</div>
						@endif
					</div>
				</div>

				<div class="col-12">
					<a class="btn btn-danger" href="/cidades">Cancelar</a>
					<button type="submit" class="btn btn-success mr-2">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection