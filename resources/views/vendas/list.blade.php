@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<a class="btn btn-primary" href="/vendas/new">Nova venda</a>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								Cliente
							</th>
							<th>
								Valor
							</th>
							<th>
								Número NFe
							</th>
							<th>
								Chave
							</th>
							<th>
								Estado
							</th>
							<th>
								Ações
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($vendas as $v)
						<tr>
							<td class="py-1">
								{{$v->cliente->nome}}
							</td>

							<td class="py-1">
								{{number_format($v->valor, 2, ',', '.')}}
							</td>

							<td class="py-1">
								{{$v->numero_nfe}}
							</td>

							<td class="py-1">
								{{$v->chave}}
							</td>

							<td class="py-1">
								@if($v->estado == 'Novo')
								<label class="badge badge-info">Novo</label>
								@elseif($v->estado == 'Rejeitado')
								<label class="badge badge-warning">Rejeitado</label>
								@elseif($v->estado == 'Cancelado')
								<label class="badge badge-danger">Cancelado</label>
								@else
								<label class="badge badge-success">Aprovado</label>
								@endif
							</td>
							<td>
								<form id="form-delete" action="/vendas/delete/{{$v->id}}" method="post">
									@csrf
									@method('delete')
									<a class="btn btn-sm btn-primary" href="/vendas/show/{{$v->id}}">
										<i class="la la-file"></i>	
									</a>
									@if($v->estado == 'Novo' || $v->estado == 'Rejeitado')
									<button type="button" class="btn btn-sm btn-danger btn-delete">
										<i class="la la-trash"></i>
									</button>
									@endif
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