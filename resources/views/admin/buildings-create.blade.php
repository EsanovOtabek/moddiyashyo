@extends('admin.admin')

@section('title', "Bino qo'shish")

@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@section('content_name', "Bino qo'shish")

@section('main_content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-11">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bino qo'shish</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route(auth()->user()->role . '.buildings.store') }}">
                            <div class="card-body row">
                                <div class="form-group col-sm-6">
                                    <label for="name">Bino nomi</label>
                                    <input type="name" name="name"  class="form-control" id="name" required value="{{ old('name') }}" placeholder="Nomi">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="location">Bino manzili</label>
                                    <input type="text" name="location"  class="form-control" id="location" required value="{{ old('location') }}" placeholder="Bino manzili">
                                </div>

                                <hr>

                                <div class="form-group col-sm-6">
                                    <label for="location">Bino qavatlari</label>
                                    <input type="number" name="floor"  class="form-control" id="floor" required value="{{ old('floor') }}" placeholder="Qavatlar soni">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label>Bino nazoratchisi (Komendant)</label>
                                    <select class="form-control select2" style="width: 100%;" name="user_id" required>
                                        <option selected disabled>-- Tanlang --</option>
                                        @foreach($komendant as $employee)
                                            <option value="{{$employee->id}}">{{ $employee->name }} ({{ $employee->phone }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                @csrf
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary pl-5 pr-5">Saqlash</button>
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        $('.select2').select2()

    </script>
@endpush
