@extends('admin.admin')

@section('title', "Foydalanuvchi rollari ro'yxati")

@section('content_name', "Foydalanuvchi rollari ro'yxati")

@section('main_content')
    <!-- Default box -->
    <div class="card card-solid">

        @if(auth()->user()->role == 'admin')
            <div class="card-header text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addRole">
                    + Yangi rol qo'shish
                </button>
            </div>
        @endif

        <div class="card-body pb-0 table-responsive">
            <table class="table table-bordered table-striped mb-5 text-nowrap">
                <thead>
                <tr style="border: 1px solid #333;">
                    <th style="width: 10px">#</th>
                    <th>Nomi</th>
                    <th>Deskription</th>
                    <th>Edit | Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td style="width: 20%">
                            <button onclick="editRole({{ $role->id }})" class="btn btn-warning" data-toggle="modal" data-target="#modal-editRole-{{ $role->id }}">
                                <i class="fa fa-edit"></i>
                            </button>
                            |
                            <form action="{{ route(auth()->user()->role . '.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Foydalanuvchi rolini o\'chirmoqchimisiz?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @include('admin.include.role-modal')

@endsection
