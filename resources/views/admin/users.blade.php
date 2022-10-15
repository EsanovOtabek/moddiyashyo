@extends('admin.admin')
@section('title', "Foydalanuvchilar ro'yxati")
@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content_name', "Foydalanuvchilar ro'yxati")

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(auth()->user()->role == 'admin')
                    <div class="card-header text-right">
                        <a href="{{ route(auth()->user()->role . '.users.create') }}" class="btn btn-primary ">+ Foydalanuvchi qo'shish</a>
                    </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="users_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>T/R</th>
                            <th>F.I.O</th>
                            <th>Phone</th>
                            <th>Foydalanuvchi roli</th>
                            <th>Login</th>
                            <th>View @if(auth()->user()->role == 'admin') | Edit | Delete @endif</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role_description }}</td>
                                <td>{{ $user->login }}</td>
                                <td>
                                    <a href="{{ route(auth()->user()->role . '.users.show',['user'=>$user->id]) }}" class="btn btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route(auth()->user()->role . '.users.edit',['user'=>$user->id]) }}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route(auth()->user()->role . '.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Foydalanuvchini o\'chirmoqchimisiz?')" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
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
            $("#users_table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#users_table_wrapper .col-md-6:eq(0)');
        });

    </script>

@endpush
