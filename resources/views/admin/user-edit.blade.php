@extends('admin.admin')

@section('title', "Foydalanuvchi ma'lumotlarini tahrirlash")

@section('content_name')
    <b>{{ $user->name }}</b> foydalanuvchi ma'lumotlarini tahrirlash.
@endsection

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
                            <h3 class="card-title"><b>{{ $user->name }}</b> foydalanuvchi ma'lumotlarini tahrirlash</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route(auth()->user()->role . '.users.update',['user' => $user->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="form-group col-sm-6">
                                    <label for="fio">F.I.Sh</label>
                                    <input type="name" name="name"  class="form-control" id="name" required value="{{ $user->name }}" placeholder="F.I.Sh">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phone">Telefon raqam</label>
                                    <input type="phone" name="phone"  class="form-control" id="phone" required value="{{ $user->phone }}" placeholder="Telefon raqam">
                                </div>


                                <div class="form-group col-sm-6">
                                    <label for="login">Login</label>
                                    <input type="name" name="login"  class="form-control" id="login" required value="{{ $user->login }}" placeholder="Login">
                                </div>


                                <div class="form-group col-sm-6">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"  class="form-control" id="password" required placeholder="Password">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Foydalanuvchi roli</label>
                                    <select class="form-control" name="role" required id="user_role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{$role->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Saqlash</button>
                            </div>
                        </form>
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
    <script type="text/javascript">
        $('#user_role').val('{{ $user->role }}')
    </script>
@endpush
