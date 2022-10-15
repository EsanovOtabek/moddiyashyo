<div class="modal fade" id="modal-addRole">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route(auth()->user()->role . '.roles.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Foydalanuvchi roli qo'shish</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-group">
                    <div class="form-group">
                        <label for="name">Rol</label>
                        <input type="text" name="name" class="form-control" id="name" required placeholder="Rol nomi" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Deskription</label>
                        <input type="text" name="description" class="form-control" id="description" required placeholder="Rol descriptioni" value="{{ old('description') }}">
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

@foreach($roles as $role)
    <div class="modal fade" id="modal-editRole-{{ $role->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route(auth()->user()->role . '.roles.update',['role'=>$role->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $role->name }} rolini tahrirlash</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <label for="name">Rol</label>
                        <input type="text" name="name" class="form-control" id="name" required placeholder="Rol nomi" value="{{ $role->name }}">
                    </div>
                    <div class="modal-body form-group">
                        <label for="name">Deskription</label>
                        <input type="text" name="description" class="form-control" id="description" required placeholder="Rol descriptioni" value="{{ $role->description }}">
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
