<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> @yield('title')  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Page styles  -->
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  @stack('page_css')
  <!-- end Page styles  -->

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

</head>

@yield('body')



@stack('page_js')

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
    </script>
@endif

<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

@if(Session::has('success_msg'))
  <script>toastr.success("{{session('success_msg')}}")</script>
@endif
@if(Session::has('error_msg'))
  <script>toastr.error("{{session('error_msg')}}")</script>
@endif

</html>
