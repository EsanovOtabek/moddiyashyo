
<div class="modal fade" id="modal-addBitem">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Jihozni xonaga biriktirish</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    <div class="form-group">
                        <label for="code">Jihoz kodi</label>
                        <input type="text" name="code" class="form-control" id="item_code" required placeholder="Jihoz kodi">
                    </div>
                    <div class="form-group">
                        <label for="code">Jihozni tanlang</label>
                        <select  class="form-control select2" style="width: 100%"  name="item_id" id="item_id" required>
                            <option disabled selected>-- Tanlang --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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

<div class="modal fade" id="modal-editBitem">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="formBEdit">
				@csrf
				@method('PUT')
				<div class="modal-header">
					<h4 class="modal-title">Jihozni tahrirlash</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">Jihoz kodi</label>
                        <input type="text" name="code" class="form-control" id="edit_item_code" required placeholder="Jihoz kodi">
                    </div>
                    <div class="form-group">
                        <label for="code">Jihozni tanlang</label>
                        <select class="form-control select2" style="width: 100%" name="item_id" id="edit_item_id" required>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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
