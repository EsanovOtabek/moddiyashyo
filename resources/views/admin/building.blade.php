@extends('admin.admin')

@section('title', $building->name . " binosi")

@section('content_name', $building->name)

@section('main_content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center text-secondary">
                                        <i class="fas fa-building" style="font-size: 50px;"></i>
                                    </div>

                                    <h3 class="profile-username text-center ">{{ $building->name }}</h3>

                                    <p class="text-muted text-center"><i class="fas fa-map-maker"></i>{{ $building->location }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Mas'ul:</b> <a class="float-right">{{ $user->name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Tel:</b> <a class="float-right">{{ $user->phone  }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Qavatlar:</b> <a class="float-right">{{ $building->floor }}</a>
                                        </li>

                                        <li class="list-group-item">
                                            <b>Xonalar:</b> <a class="float-right">{{ $rooms_count }}</a>
                                        </li>

                                        @if(auth()->user()->role == 'admin')
                                            <li class="list-group-item">
                                                <a href="{{ route(auth()->user()->role . '.buildings.edit',['building'=>$building->id]) }}"
                                                   class='btn btn-gradient btn-primary d-block'
                                                >
                                                    <i class="fas fa-edit"></i>
                                                    Tahrirlash
                                                </a>
                                            </li>
                                        @endif

                                    </ul>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->

                        <div class="col-sm-7 col-md-8 col-lg-9">
                            <div class="card">
                                <div class="card-header text-center row">
                                    <b class="col-sm-9">Xonalar</b>
                                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'komendant')
                                        <a href="{{ route(auth()->user()->role . '.room.create') }}" class="btn btn-primary col-sm-3 text-bold"><i class="fas fa-plus"></i> Xona qo'shish</a>
                                    @endif
                                </div><!-- /.card-header -->
                                <div class="card-body p-3">
                                    @for($i=1;$i<=$building->floor;$i++)
                                        <div class="m-0 info-box card card-primary card-outline bg-light bg-gradient">
                                            <div class="card-header p-0">
                                                {{$i}}-qavat
                                            </div>

                                            <div class="row card-body pl-1 pr-0 ">
                                                @foreach($rooms as $room)
                                                    @if($room->floor==$i)
                                                        <div class="m-1" style="width:72px">
                                                            <a href="{{ route(auth()->user()->role . '.buildings.room',['building'=>$room->building_id,'room' => $room->room_no]) }}"
                                                               class="info-box-icon bg-info"
                                                               title="{{$room->employee}}"
                                                            >
                                                                {{$room->room_no}}</a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                        <!-- /.info-box -->
                                    @endfor
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.card -->

@endsection
