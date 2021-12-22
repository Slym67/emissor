@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<a class="btn btn-primary" href="/clientes/new">Novo cliente</a>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								Nome
							</th>
							<th>
								CPF/CNPJ
							</th>
							<th>
								Rua
							</th>
							<th>
								Número
							</th>
							<th>
								Bairro
							</th>
							<th>
								Cidade
							</th>
							<th>
								Ações
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($clientes as $c)
						<tr>
							
							<td class="py-1">
								{{$c->nome}}
							</td>
							<td class="py-1">
								{{$c->cpf_cnpj}}
							</td>
							<td class="py-1">
								{{$c->rua}}
							</td>
							<td class="py-1">
								{{$c->numero}}
							</td>
							<td class="py-1">
								{{$c->bairro}}
							</td>
							<td class="py-1">
								{{$c->cidade->nome}}-{{$c->cidade->uf}}
							</td>
							<td>
								<form id="form-delete" action="/clientes/delete/{{$c->id}}" method="post">
									@csrf
									@method('delete')
									
									<a class="btn btn-sm btn-warning"
									href="/clientes/edit/{{$c->id}}">
										<i class="la la-edit"></i>
									</a>

									<button type="button" class="btn btn-sm btn-danger btn-delete">
										<i class="la la-trash"></i>
									</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
@endsection