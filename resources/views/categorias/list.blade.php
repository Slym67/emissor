@extends('default')
@section('body')
<div class="col-xl-12">

	<div class="card">
		<div class="card-body">
			<a class="btn btn-primary" href="/categorias/new">Nova categoria</a>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								Nome
							</th>
							<th>
								Ações
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categorias as $c)
						<tr>
							<td class="py-1">
								{{$c->nome}}
							</td>
							<td>
								<form id="form-delete" action="/categorias/delete/{{$c->id}}" method="post">
									@csrf
									@method('delete')
									
									<a class="btn btn-sm btn-warning"
									href="/categorias/edit/{{$c->id}}">
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