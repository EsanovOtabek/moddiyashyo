@extends('master')

  @section('title', 'Tizimga kirish')

  @push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  @endpush



</head>

@section('body')

<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Tizimga kirish</b></a>
    </div>
    <div class="card-body">

      @if ($errors->any())
      <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
      </script>
      @endif

      <form action="" method="post">
          @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="login" placeholder="Login">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-block">Kirish</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="#">Parolni unutdingizmi?</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection
