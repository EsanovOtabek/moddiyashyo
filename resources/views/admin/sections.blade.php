@extends('admin.admin')
@section('title', "Bo'lim va Fakultetlar ro'yxati")
@push('page_css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content_name', "Bo'lim va Fakultetlar ro'yxati")

@section('main_content')
    <!-- Default box -->
    <div class="card card-solid">

        @if(auth()->user()->role == 'admin')
            <div class="card-header text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addSection">
                    + Bo'lim(Fakultet) qo'shish
                </button>
            </div>
        @endif

        <div class="card-body pb-0 table-responsive">
            <table class="table table-bordered table-striped mb-5 text-nowrap">
                <thead>
                <tr style="border: 1px solid #333;">
                    <th style="width: 10px">#</th>
                    <th>Nomi</th>
                    <th>Rahbar</th>
                    <th>Javobgar (tel)</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Edit | Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($sections as $section)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{ $section->name }}</td>
                        <td>{{ $section->director }}</td>
                        <td>
                            <p><b>{{ $section->fio }}</b><br>
                                <b>Telefon:</b> {{ $section->phone }}
                            </p>
                        </td>

                        @if(auth()->user()->role == 'admin')
                            <td style="width: 20%">
                                <button onclick="editSection({{ $section->id }})" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </button>
                                |
                                <form action="{{ route(auth()->user()->role . '.sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Bo\'lim(Fakultet)ni  o\'chirmoqchimisiz?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @if(auth()->user()->role == 'admin')
        @include('admin.include.section-modal')
    @endif
@endsection
@if(auth()->user()->role == 'admin')

    @push('page_js')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

        <script>
            $('.select2').select2()

            var sections = @json($sections);
            function editSection(id) {
                var section;

                sections.forEach(function(s) {
                    // console.log(it);
                    if(Number(s['id']) === Number(id)){
                        section=s;
                        return;
                    }
                })

                $('#modal_name').html(section['name']);
                $('#modal-edit-name').val(section['name']);
                $('#modal-edit-director').val(section['director']);
                $('#modal-edit-employee').val(section['user_id']).trigger('change');
                $('#modal-section-edit').modal('toggle');
                $('#formUpdate').attr('action', "{{ route(auth()->user()->role . '.sections.index') }}/"+id );
            }
        </script>
    @endpush
@endif
