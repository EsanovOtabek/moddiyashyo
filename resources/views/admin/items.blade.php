@extends('admin.admin')

@section('title', "Jihozlar ro'yxati")

@section('content_name', "Jihozlar ro'yxati")

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row card-header">
                    <form class="col-sm-9 row">
                        <div class="col-sm-5 p-1 form-group">
                            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                <option value="0" selected>HAMMASI</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5 p-1 form-group">
                            <input type="search" class="form-control" name="search" placeholder="Jihozni qidirish ..." value="{{ $search}}">
                        </div>
                        <div class="col-sm-2 p-1 ">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <div class="col-sm-3 text-right">
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addItem">
                                + Jihoz qo'shish
                            </button>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-1">
                    <table id="items_table" class="table table-bordered table-striped mb-5 text-nowrap">
                        <thead>
                        <tr>
                            <th>T/R</th>
                            <th>Nomi</th>
                            <th>Kategoriya</th>
                            <th>Jami miqdori</th>
                            <th>Mavjud</th>
                            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
                                <th>Edit | Delete</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)

                            <tr class="{{ $item->amount == $item->minus_amount ? 'bg-gradient-danger ':''}}" >
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
                                        <div id="additem-{{ $item->id }}" class="additemdiv">
                                            <h3 class="d-inline"><span class="badge badge-info"> {{ $item->amount }}</span></h3>
                                            <button class="btn btn-primary" onclick='addItem({{ $item->id }})'>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <form id="formadditem-{{ $item->id }}" class="d-none formitem" method="POST" action="{{ route(auth()->user()->role . '.items.add',['id'=>$item->id]) }}">
                                            @csrf
                                            <input type="number" style="width:80px;" name="amount" min='0' placeholder="0">
                                            <button class="btn btn-primary">ok</button>
                                        </form>
                                    @else
                                        <h3 class="d-inline"><span class="badge badge-info"> {{ $item->amount }}</span></h3>
                                    @endif
                                </td>
                                <td><h3 class="d-inline">
                                        <span class="badge badge-light"> {{ $item->amount - $item->minus_amount }}</span>
                                    </h3></td>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
                                    <td>
                                        <button type="button"
                                                class="btn btn-warning"
                                                data-toggle="modal"
                                                data-target="#modal-editItem-{{$item->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <form action="{{ route(auth()->user()->role . '.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Jihozni o\'chirmoqchimisiz?')" style="display: inline;">
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
                <div class="card-footer">
                    <hr>
                    <a href="{{ route($this->role.".items.accepted") }}">Tasdiqlangan buyurtmalar</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
        @include('admin.include.item-modal')
    @endif
@endsection

@if(auth()->user()->role == 'admin' || auth()->user()->role == 'warehouse')
    @push('page_js')
        <script type="text/javascript">
            $('#category').val({{ $category_id }})
            function addItem(id) {
                $('.additemdiv').removeClass('d-none');
                $('.formitem').addClass('d-none');
                $('#additem-'+id).addClass('d-none');
                $('#formadditem-'+id).removeClass('d-none');
            }
        </script>
    @endpush
@endif
