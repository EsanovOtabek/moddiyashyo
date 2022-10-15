
<div class="modal fade" id="modal-addCategory">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route(auth()->user()->role . '.categories.store') }}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Kategoriya qo'shish</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form-group">
					<input type="text" name="name"  class="form-control" id="name" required placeholder="Kategoriya nomi">
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Bekor qilish</button>
					<button type="submit" class="btn btn-primary">Saqlash</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@foreach($categories as $category)
<div class="modal fade" id="modal-editCategory-{{ $category->id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route(auth()->user()->role . '.categories.update',['category'=>$category->id]) }}">
				@csrf
				@method('PUT')
				<div class="modal-header">
					<h4 class="modal-title">{{ $category->name }} kategoriyasini tahrirlash</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form-group">
					<input type="text" name="name"  class="form-control" id="category_name" required placeholder="Kategoriya nomi" value="{{ $category->name }}">
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Bekor qilish</button>
					<button type="submit" class="btn btn-primary">Saqlash</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->
@endforeach
