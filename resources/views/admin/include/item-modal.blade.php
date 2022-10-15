<div class="modal fade" id="modal-addItem">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route(auth()->user()->role . '.items.store') }}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Jihoz qo'shish</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form-group">
					<div class="form-group">
						<label for="name">Jihoz nommi</label>
						<input type="text" name="name"  class="form-control" id="name" required placeholder="Jihoz nomi" value="{{old('name')}}">
					</div>
					<div class="form-group">
						<label for="category_id">Kategoriyani tanlang</label>
						<select class="form-control" name="category_id" required>
							<option selected disabled>-- Kategoriyani tanlang --</option>
							@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="amount">Miqdori</label>
						<input type="number" name="amount"  class="form-control" id="amount" required placeholder="0" value="0" min="0">
					</div>
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

@foreach($items as $item)
<div class="modal fade" id="modal-editItem-{{ $item->id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route(auth()->user()->role . '.items.update',['item'=>$item->id]) }}">
				@csrf
				@method('PUT')
				<div class="modal-header">
					<h4 class="modal-title">{{ $item->name }} Jihoz tahrirlash</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form-group">
					<div class="form-group">
						<label for="name">Jihoz nommi</label>
						<input type="text" name="name"  class="form-control" id="name" required placeholder="Jihoz nomi" value="{{ $item->name }}">
					</div>
					<div class="form-group">
						<label for="category_id">Kategoriyani tanlang</label>
						<select class="form-control" name="category_id" required>
							<option selected disabled>-- Kategoriyani tanlang --</option>
							@foreach($categories as $category)
							@if($item->category_id==$category->id)
							<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
							<option value="{{ $category->id }}" >{{ $category->name }}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="amount">Miqdori</label>
						<input type="number" name="amount"  class="form-control" id="amount" required placeholder="0" value="{{ $item->amount }}" min="0">
					</div>
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
