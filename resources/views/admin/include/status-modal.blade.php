<div class="modal fade" id="modal-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buyurtmani holatini o'zgartirish</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-3"><b>Jihoz: </b></div>
                <div class="col-md-9"><p id="modal_item"></p></div>
                <hr>
                <div class="col-md-3"><b>Miqdori: </b></div>
                <div class="col-md-9"><p id="modal_quantity"></p></div>
                <hr>
                <div class="col-md-3"><b>Buyurtmachi: </b></div>
                <div class="col-md-9"><p id="modal_user"></p></div>
                <hr>
                <div class="col-md-3"><b>Bino: </b></div>
                <div class="col-md-9"><p id="modal_building"></p></div>
            </div>
            <div class="modal-footer justify-content-between">
                <form method="POST" id="formReject">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger">Rad etish</button>
                </form>
                <form method="POST" id="formAccept">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary">Tasdiqlash</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


