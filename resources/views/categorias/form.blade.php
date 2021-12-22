@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<form method="post" @isset($categoria) action="/categorias/update" @else action="/categorias/save" @endif>
				@csrf
				<input type="hidden" name="id" value="{{isset($categoria) ? $categoria->id : 0}}">

				<div class="form-group col-xl-4">
					<label for="exampleInputUsername1">Nome</label>
					<input type="text" class="form-control @if($errors->has('nome')) is-invalid @endif" value="{{isset($categoria) ? $categoria->nome : old('nome')}}" id="nome" placeholder="Nome" name="nome">
					@if($errors->has('nome'))
					<div class="invalid-feedback">
						{{ $errors->first('nome') }}
					</div>
					@endif
				</div>

				<div class="col-12">
					<a class="btn btn-danger" href="/categorias">Cancelar</a>
					<button type="submit" class="btn btn-success mr-2">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection