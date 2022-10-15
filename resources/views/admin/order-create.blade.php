@extends('admin.admin')

@section('title', "Buyurtma berish")

@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@section('content_name', "Buyurtma berish")

@section('main_content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buyurtma berish</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route(auth()->user()->role.'.orders.store') }}">
                            <div class="card-body row">
                                <div class="form-group col-sm-6">
                                    <label> Jihozni tanlang</label>
                                    <select class="form-control select2" name="item_id" required>
                                        <option selected disabled>-- Tanlang --</option>
                                        @foreach($items as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="quantity">Jihoz miqdorini yozing</label>
                                    <input type="number" min="1" name="quantity"  class="form-control" id="quantity" required value="{{ old('quantity') }}" placeholder="0">
                                </div>

                                <hr>


                                <div class="form-group col-sm-6">
                                    <label>Binoni tanlang</label>
                                    <select class="form-control" name="building_id" required>
                                        <option selected disabled>-- Tanlang --</option>
                                        @foreach($buildings as $building)
                                            <option value="{{$building->id}}">{{ $building->name }} </option>
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
