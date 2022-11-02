@extends('admin.admin')

@section('title')
    {{$room->room_no}}-xona jihozlari
@endsection

@section('content_name')
    {{$room->room_no}}-xona jihozlari
@endsection
@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush


@section('main_content')
    <!-- Default box -->
    <div class="card card-solid">

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant')
            <div class="card-header text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addBitem">
                    + Jihoz qo'shish
                </button>
            </div>
        @endif

        <div class="card-body pb-0 table-responsive">
            <table class="table table-bordered table-striped mb-5 text-nowrap">
                <thead>
                <tr style="border: 1px solid #333;">
                    <th style="width: 10px">#</th>
                    <th>Jihoz</th>
                    <th>Jihoz kodi</th>
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant')
                        <th>Edit | Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($bitems as $bitem)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                            <h4><span class="badge badge-light">{{ $bitem->name }}</span></h4>
                        </td>
                        <td>
                            <h4><span class="badge badge-dark">{{ $bitem->code }}</span></h4>
                        </td>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant')
                            <td style="width: 20%">
                                <button onclick="editBitem({{ $bitem->id }})" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </button>
                                |
                                <form action="{{ route(auth()->user()->role . '.bitems.destroy', $bitem->id) }}" method="POST" onsubmit="return confirm('Jihozni o\'chirmoqchimisiz?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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
    @if(auth()->user()->role == 'admin')
        @include('admin.include.bitem-modal')
    @endif
@endsection

@push('page_js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        var bitems = @json($bitems);
        $('.select2').select2()

        function editBitem(id){
            var bitem;
            bitems.forEach(function(b) {
                if(Number(b['id']) === Number(id)){
                    bitem=b;
                    return;
                }
            })

            $('#edit_item_code').val(bitem['code']);
            $('#edit_item_id').val(bitem['item_id']).trigger('change');
            $('#formBEdit').attr('action', "{{ url(auth()->user()->role . '/bitems') }}/"+id );

            $('#modal-editBitem').modal('toggle');

        }

    </script>
@endpush



