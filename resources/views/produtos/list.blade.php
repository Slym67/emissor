@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<a class="btn btn-primary" href="/produtos/new">Novo produto</a>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								Nome
							</th>
							<th>
								Valor
							</th>
							<th>
								Código de barras
							</th>
							<th>
								Categoria
							</th>
							<th>
								Ações
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($produtos as $p)
						<tr>
							<td class="py-1">
								{{$p->nome}}
							</td>
							<td class="py-1">
								{{$p->valor}}
							</td>
							<td class="py-1">
								{{$p->codigo_barras == "" ? 'SEM GTIN' : $p->codigo_barras}}
							</td>
							<td class="py-1">
								{{$p->categoria->nome}}
							</td>
							<td>
								<form id="form-delete" action="/produtos/delete/{{$p->id}}" method="post">
									@csrf
									@method('delete')
									
									<a class="btn btn-sm btn-warning"
									href="/produtos/edit/{{$p->id}}">
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