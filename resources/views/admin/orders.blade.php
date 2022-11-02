<?php
use App\Http\Controllers\OrderController;
$orb = new OrderController;
?>

@extends('admin.admin')
@section('title', "Buyurtmalar ro'yxati")
@section('content_name', "Buyurtmalar ro'yxati")
@push('page_css')
    <style>
        .badges{
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 0;
            font-size: 28px;
            border: 1px solid #333;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(auth()->user()->role == 'komendant' || auth()->user()->role == 'employee')
                    <div class="card-header">
                        <div class="text-right">
                            <a href="{{ route(auth()->user()->role.'.orders.create') }}" class="btn btn-primary">
                                + Buyurtma berish
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                @endif
                <div class="card-body table-responsive p-1">
                    <table id="items_table" class="table table-bordered table-striped mb-5 text-nowrap">
                        <thead>
                        <tr>
                            <th>T/R</th>
{{--                            <th>Jihoz</th>--}}
{{--                            <th>Miqdori</th>--}}
                            <th>Buyurtmachi</th>
                            <th>Vaqti</th>
                            <th>Ma'lumot</th>
                            <th>Status</th>
                            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant' || auth()->user()->role == 'employee')
                                <th>O'chirish</th>
                            @else
                                <th>Holat</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                                <? $status = 'secondary' ?>
                            @if($order->status_1=='accepted' && $order->status_2=='accepted' && $order->status_3=='accepted')
                                    <? $status = 'success' ?>
                            @endif
                            @if($order->status_1=='rejected' || $order->status_2=='rejected' || $order->status_3=='rejected')
                                    <?$status = 'danger'?>
                            @endif
                            <tr class="">
                                <td>{{ $loop->index+1 }}</td>
{{--                                <td>--}}
{{--                                    <h4><span class="badge badge-light">{{ $order->itemname }}</span></h4>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <h4><span class="badge badge-light">{{ $order->quantity }} ta</span></h4>--}}
{{--                                </td>--}}
                                <td>
                                    <h4><span class="badge badge-light">{{ $order->username }}</span></h4>
                                </td>
                                <td>
                                    <h4><span class="badge badge-light">{{ $order->created_at }}</span></h4>
                                </td>
{{--                                @if(is_null($order->sectionname))--}}
{{--                                    <td>--}}
{{--                                        <h4><span class="badge badge-light">{{ $order->buildingname }}</span></h4>--}}
{{--                                    </td>--}}
{{--                                @endif--}}
{{--                                @if(is_null($order->buildingname))--}}
{{--                                    <td>--}}
{{--                                        <h4><span class="badge badge-light">{{ $order->sectionname }}</span></h4>--}}
{{--                                    </td>--}}
{{--                                @endif--}}

                                <td class="bg-light">
                                    <button type="submit" class="btn btn-info" id="get_info" onclick="getInfo({{ $order->id }})">
                                        <i class="fa fa-info-circle"></i> Batafsil
                                    </button>
                                </td>

                                <td class="bg-gradient-{{$status}}">
                                    <!--status1-->
                                    <button class="badges bg-{{ $orb->status_class($order->status_1)['class'] }}"><i class="fas fa-{{ $orb->status_class($order->status_1)['icon'] }}"></i></button>
                                    <!--status2-->
                                    <button class="badges bg-{{ $orb->status_class($order->status_2)['class'] }}"><i class="fas fa-{{ $orb->status_class($order->status_2)['icon'] }}"></i></button>
                                    <!--status3-->
                                    <button class="badges bg-{{ $orb->status_class($order->status_3)['class'] }}"><i class="fas fa-{{ $orb->status_class($order->status_3)['icon'] }}"></i></button>
                                </td>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant' || auth()->user()->role == 'employee')
                                    <td>
                                        <form action="{{ route(auth()->user()->role.'.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Buyurtmani bekor qilmoqchimisiz?')" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td class="bg-light">
                                        <button type="submit" class="btn btn-info" id="status" onclick="statusEdit({{ $order->id }})">
                                            <i class="fa fa-check"></i>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @include('admin.include.status-modal')

@endsection

@push('page_js')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

    <script>
        $(function () {
            $("#items_table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#users_table_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        var orders = @json($orders);
        var items = @json($new_items);
        function statusEdit(id) {
            var order;

            orders.forEach(function(o) {
                if(Number(o['id']) === Number(id)){
                    order=o;
                    return;
                }
            })

            var select = "<select id='modal_item_id' name='item_id' class='form-control' required>";
            var cat_id;
            items.forEach(function (it){
                if(Number(it['id']) === Number(order['item_id'])){
                    cat_id=it['category_id'];
                    return;
                }
            })

            items.forEach(function (it){
                if(Number(it['category_id']) === Number(cat_id)){
                    select += "<option value='"+it['id']+"'" + (it['id']===order['new_item_id']?'selected':'') + ">"+it['name']+"</option>";
                }
            });

            $('#modal_item').html(select+"</select>");
            $('#modal_quantity').val(order['new_quantity']);
            $('#modal_user').val(order['username']);
            $('#modal_building').val(order['buildingname']);
            $('#modal-status').modal('toggle');
            $('#formReject').attr('action', "{{ route(auth()->user()->role . '.orders.index') }}/"+id+"/reject" );
            $('#formAccept').attr('action', "{{ route(auth()->user()->role . '.orders.index') }}/"+id+"/accept" );

            @if(auth()->user()->role == 'warehouse')
                $('#modal_quantity').prop('disabled',true);
                $('#modal_item_id').prop('disabled',true);
            @endif
        }

        function getInfo(id) {
            var order;
            orders.forEach(function(o) {
                if(Number(o['id']) === Number(id)){
                    order=o;
                    return;
                }
            })

            $('#mi-date').html(order['created_at']);
            $('#mi-item').val(order['itemname']);
            $('#mi-quantity').val(order['quantity']);
            $('#mi-user').val(order['username']);
            $('#mi-building').val(order['buildingname']);
            $('#mi-section').val(order['sectionname']);

            $('#mi-new-item').val(order['newitemname']);
            $('#mi-new-quantity').val(order['new_quantity']);
            $('#modal-info').modal('toggle');
        }

    </script>

@endpush
