
<div class="modal fade" id="modal-addSection">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route(auth()->user()->role . '.sections.store') }}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Bo'lim(Fakultet) qo'shish</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body form-group">
                    <div class="form-group">
                        <label for="name">Bo'lim(Fakultet) nomi</label>
                        <input type="text" name="name" class="form-control" id="name" required placeholder="Bo'lim(Fakultet) nomi">
                    </div>
                    <div class="form-group">
                        <label for="director">Bo'lim(Fakultet) boshlig'i</label>
                        <input type="text" name="director" class="form-control" id="director" required placeholder="F.I.Sh">
                    </div>
                    <div class="form-group">
                        <label for="employee">Javobgarni tanlang</label>
                        <select name="user_id" class="form-control select2" id="employee" required style="width: 100%">
                            <option selected disabled>-- Javobgar foydalanuvchini tanlang --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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

<div class="modal fade" id="modal-section-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="formUpdate">
				@csrf
				@method('PUT')
				<div class="modal-header">
					<h4 class="modal-title" id="modal_name">ni tahrirlash</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body form-group">
                    <div class="form-group">
                        <label for="name">Bo'lim(Fakultet) nomi</label>
                        <input type="text" name="name" class="form-control" id="modal-edit-name" required>
                    </div>
                    <div class="form-group">
                        <label for="director">Bo'lim(Fakultet) boshlig'i</label>
                        <input type="text" name="director" class="form-control" id="modal-edit-director" required>
                    </div>
                    <div class="form-group">
                        <label for="employee">Javobgarni tanlang</label>
                        <select name="user_id" class="form-control select2" id="modal-edit-employee" required style="width: 100%">
                            <option selected disabled>-- Javobgar foydalanuvchini tanlang --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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
