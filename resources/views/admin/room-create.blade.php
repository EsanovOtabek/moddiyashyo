@extends('admin.admin')

@section('title', "Xona qo'shish")

@push('page_css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@section('content_name', "Xona qo'shish")

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
            <h3 class="card-title">Xona qo'shish</h3>
          </div>
          @if ($errors->any())
          <script>
            @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
          </script>
          @endif
          <!-- /.card-header -->
          <!-- form start -->
          <form method="POST" action="{{ route(auth()->user()->role . '.room.store') }}">
            @csrf
            <div class="card-body row">
              <div class="form-group col-sm-12">
                <label>Binoni tanlang</label>
                <select class="form-control " style="width: 100%;" name="building_id" id="building_id" onchange="floorSelect()" required >
                  <option selected disabled>-- Tanlang --</option>
                  @foreach($buildings as $building)
                  <option value="{{$building->id}}">{{ $building->name }} </option>
                  @endforeach
                </select>
              </div>
               @foreach($buildings as $building)
                  <input type="hidden" id="floor_{{$building->id}}" value="{{$building->floor}}">
                @endforeach
              <div class="form-group col-sm-6">
                <label for="name">Qavatni tanlang</label>
                <select class="form-control select2" style="width: 100%;" name="floor" id="floor" required>
                  <option selected disabled>-- Qavatni tanlang --</option>
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="name">Xona nomi</label>
                <input type="name" name="room_no"  class="form-control" id="room_no" required value="{{ old('room_no') }}" placeholder="Nomi">
              </div>

              <hr>

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
  function floorSelect() {
    var floor = $('#floor_'+$('#building_id').val()).val();
    console.log($('#building_id').val());
    var str = "<option selected disabled>-- Qavatni tanlang --</option>";
    for(var i=1;i<=floor;i++){
      str+="<option value='"+i+"'>"+i+"-qavat</option>";
    }
    $('#floor').html(str);

  }
  @if (session()->has('select_msg'))
    $('#building_id').val({{ session('select_msg') }});
    floorSelect();
  @endif
</script>
@endpush
