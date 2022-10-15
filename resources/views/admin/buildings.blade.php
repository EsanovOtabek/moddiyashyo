@extends('admin.admin')

@section('title', "Binolar ro'yxati")

@section('content_name', "Binolar ro'yxati")

@section('main_content')
    <!-- Default box -->
    <div class="card card-solid">

        @if(auth()->user()->role == 'admin')
            <div class="card-header text-right">
                <a href="{{ route(auth()->user()->role . '.buildings.create') }}" class="btn btn-primary ">+ Bino qo'shish</a>
            </div>
        @endif

        <div class="card-body pb-0">
            <div class="row">
                @foreach($buildings as $building)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card small-box bg-light d-flex flex-fill">
                            <div class="card-body pt-2 inner">
                                <h4>{{ $building->name }}</h4>
                                <p class="text-muted text-sm"><b>Mas'ul: </b>{{ $building->fio }} </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marker"></i></span> Manzil: {{ $building->location }}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Tel : {{ $building->phone }}</li>
                                </ul>
                                <div class="icon">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="card-footer">

                                <div class="text-right">
                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route(auth()->user()->role . '.buildings.show',['building'=>$building->id]) }}" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route(auth()->user()->role . '.buildings.edit',['building'=>$building->id]) }}" class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route(auth()->user()->role . '.buildings.destroy', $building->id) }}" method="POST" onsubmit="return confirm('Binoni o\'chirmoqchimisiz?')" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route(auth()->user()->role . '.buildings.show',['building'=>$building->id]) }}" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{-- <nav aria-label="">
                <ul class="pagination justify-content-center m-0">
                    {{ $buildings->links() }}
                </ul>
            </nav> --}}
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

@endsection
