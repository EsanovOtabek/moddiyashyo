<div class="modal fade" id="modal-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buyurtmani holatini o'zgartirish</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body row" method="POST" id="formAccept">
                @csrf
                @method('put')
                <div class="col-md-3"><b>Jihoz: </b></div>
                <div class="col-md-9"><p id="modal_item"></p></div>
                <hr>
                <div class="col-md-3"><b>Miqdori: </b></div>
                <div class="col-md-9 form-group">
                    <input type="number" class="form-control" id="modal_quantity" name="quantity" required>
                </div>
                <hr>
                <div class="col-md-3"><b>Buyurtmachi: </b></div>
                <div class="col-md-9 form-group" >
                    <input type="text" class="form-control" id="modal_user" disabled>
                </div>
                <hr>
                <div class="col-md-3"><b>Bino: </b></div>
                <div class="col-md-9 form-group">
                    <input type="text" class="form-control" id="modal_building" disabled>
                </div>
            </form>
            <div class="modal-footer justify-content-between">
                <form method="POST" id="formReject">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger">Rad etish</button>
                </form>

                <button type="submit" class="btn btn-primary" form="formAccept">Tasdiqlash</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{--Batafsil modal --}}
<div class="modal fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="mi-date"></span> vaqtda kelib tushgan buyurtma</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4"><b>Buyurtmachi: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-user">
                </div>
                <hr>
                <div class="col-md-4"><b>Buyurtma qilingan jihoz: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-item">
                </div>
                <hr>
                <div class="col-md-4"><b>Buyurtma miqdori: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-quantity">
                </div>
                <hr class="col-md-12 h-0">
                <div class="col-md-4"><b>Beriladigan jihoz: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-new-item">
                </div>
                <hr>
                <div class="col-md-4"><b>Beriladigan jihoz miqdori: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-new-quantity">
                </div>
                <hr>
                <div class="col-md-4"><b>Bino: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-building">
                </div>
                <hr>
                <div class="col-md-4"><b>Bo'lim yoki fakultet: </b></div>
                <div class="col-md-8 form-group">
                    <input type='text' class='form-control' disabled id="mi-section">
                </div>
                <hr>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Orqaga</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
