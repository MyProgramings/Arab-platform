@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    {{ $title }}
@endsection

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="videos-table" class="table table-stribed text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>اسم المادة</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($materials as $material)
                        <tr>
                            <td>{{ $material->title }}</td>
                            <td>
                                <form method="POST" action="#" style="display:inline-block">
                                    @method('delete')
                                    @csrf
                                    <div class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> حذف </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#videos-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
                }
            });
        });
    </script>
@endsection
