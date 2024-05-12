@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
@endsection

@section('content')
    <div class="mx-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('departments.index') }}">الأقسام / </a></li>
                <li><a
                        href="{{ route('material_by_department', $material->department->id) }}">&nbsp;{{ $material->department->name }}&nbsp;</a>
                </li>
                <li aria-current="page"> / {{ $material->title }}</li>
            </ol>
        </nav>
        <div class="card text-center mt-2">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <table id="videos-table" class="table table-stribed text-right bg-white" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="border-0">#</th>
                                    <th class="border-0">العنوان</th>
                                    <th class="border-0">المحاضر</th>
                                    <th class="border-0">الملف المرفق</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($delivereds as $delivered)
                                    @if ($delivered->material_id == $material->id)
                                        <tr>
                                            <td>{{ $delivered->id }}</td>
                                            <td>{{ $delivered->title }}</td>
                                            <td>{{ $delivered->user->user_name }}</td>
                                            <td>
                                                @if ($delivered->file_path != 'No File')
                                                    <a href="{{ route('delivered-file', $delivered->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fa fa-download"></i> {{ $delivered->file_path }}
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

