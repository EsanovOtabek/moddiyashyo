@extends('admin.admin')

@section('title', "Jihoz qo'shish")

@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@section('content_name', "Jihoz qo'shish")

@section('main_content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Jihoz qo'shish</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body row">
                            <div class="form-group col-sm-12 pr-4">
                                <label for="name">Jihoz nomini yozing <b class="text-danger"> (agar ro'yxatda chiqmasa yozavering yangi qo'shiladi)</b></label>
                                <select class="form-control items_select" id="items_select" name="name" onchange="addItem()">
                                    <option selected disabled> -- Jihoz nomini yozing -- </option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <form id="edititem-div" class="col-sm-12 row d-none" method="POST">
                                @csrf
                                <div class="form-group col-sm-6">
                                    <label for="location">Kategoriya</label>
                                    <input type="text" name="category" id="category" class="form-control" disabled>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="location">Yangi jihozlar <span class="text-warning" id="item_amount"></span></label>
                                    <input type="number" name="amount" min="0" class="form-control" id="add_amount" required placeholder="0">
                                </div>
                            </form>

                            <form id="additem-div" class="col-sm-12 row d-none" method="POST" action="{{ route(auth()->user()->role . '.items.store') }}">
                                @csrf
                                <input type="hidden" name="name" id="item_name">
                                <div class="form-group col-sm-6">
                                    <label for="location">Kategoriyani tanlang</label>
                                    <select class="form-control" name="category_id" >
                                        <option selected disabled> -- Kategoriyani yozing -- </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="location">Jihozlar soni</label>
                                    <input type="number" name="amount" min="0" class="form-control" id="amount" required placeholder="0">
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary pl-5 pr-5 d-none" id="edititem-button" form="edititem-div">Saqlash</button>
                            <button type="submit" class="btn btn-primary pl-5 pr-5 d-none" id="additem-button" form="additem-div">Saqlash</button>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('page_js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">

        var items = @json($items);
        var categories = @json($categories);

        $('.items_select').select2({
            tags: true,
            placeholder: 'Jihoz nomini yozing!',
            allowClear: true
        });

        function addItem() {
            var item_select = $('#items_select').val();
            var item_select_html = $('#items_select').html();
            // edit item
            if(Number(item_select)>0 && item_select_html!=item_select){

                $('#edititem-div').attr('action',"{{ route(auth()->user()->role . '.item.add') }}"+"/"+item_select);
                $('#edititem-div').removeClass('d-none');
                $('#edititem-button').removeClass('d-none');

                if(!$('#additem-div').hasClass('d-none')){
                    $('#additem-div').addClass('d-none');
                }
                if(!$('#additem-button').hasClass('d-none')){
                    $('#additem-button').addClass('d-none');
                }

                var selectItem;
                items.forEach(function(it) {
                    // console.log(it);
                    if(Number(it['id']) == Number(item_select)){
                        selectItem=it;
                        return;
                    }
                })

                var category_id = selectItem['category_id'];

                categories.forEach(function(category) {
                    if(Number(category['id'])==Number(category_id))  $('#category').val(category['name']);
                });
                // console.log(selectItem);
                $('#item_amount').html("(Jihozning hozirgi soni: " + selectItem['amount'] + ")");
            }
            // add item
            if((typeof item_select) == "string" && !(Number(item_select)>0) ){
                $('#additem-div').removeClass('d-none');
                $('#additem-button').removeClass('d-none');
                if(!$('#edititem-div').hasClass('d-none')){
                    $('#edititem-div').addClass('d-none');
                }

                if(!$('#edititem-button').hasClass('d-none')){
                    $('#edititem-button').addClass('d-none');
                }

                $('#item_name').val(item_select);
            }
        }
    </script>
@endpush
