@extends('admin.admin')

@section('title', "Foydalanuvchi qo'shish")

@section('content_name', "Foydalanuvchi qo'shish")

@section('main_content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Foydalanuvchi qo'shish</h3>
                        </div>
                        <!-- form start -->
                        <form method="POST" action="{{ route(auth()->user()->role . '.users.store') }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fio">F.I.Sh</label>
                                    <input type="name" name="name"  class="form-control" id="name" required value="{{ old('name') }}" placeholder="F.I.Sh">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefon raqam</label>
                                    <input type="phone" name="phone"  class="form-control" id="phone" required value="{{ old('phone') }}" placeholder="Telefon raqam">
                                </div>

                                <div class="form-group">
                                    <label>Foydalanuvchi roli</label>
                                    <select class="form-control" name="role" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="login">Login</label>
                                    <input type="name" name="login"  class="form-control" id="login" required value="{{ old('login') }}" placeholder="Login">
                                </div>

                                @csrf

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"  class="form-control" id="password" required placeholder="Password">
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

