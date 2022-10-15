@extends('admin.admin')

@section('title', "Kategoriyalar ro'yxati")

@section('content_name', "Kategoriyalar ro'yxati")

@section('main_content')
    <!-- Default box -->
    <div class="card card-solid">

        @if(auth()->user()->role == 'admin')
            <div class="card-header text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addCategory">
                    + Kategoriya qo'shish
                </button>
            </div>
        @endif

        <div class="card-body pb-0 table-responsive">
            <table class="table table-bordered table-striped mb-5 text-nowrap">
                <thead>
                <tr style="border: 1px solid #333;">
                    <th style="width: 10px">#</th>
                    <th>Nomi</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Edit | Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{ $category->name }}</td>
                        @if(auth()->user()->role == 'admin')
                            <td style="width: 20%">
                            <button onclick="editCat({{ $category->id }})" class="btn btn-warning" data-toggle="modal" data-target="#modal-editCategory-{{ $category->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            |
                            <form action="{{ route(auth()->user()->role . '.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Kategoriyani o\'chirmoqchimisiz?')" style="display: inline;">
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
        @include('admin.include.category-modal')
    @endif
@endsection
