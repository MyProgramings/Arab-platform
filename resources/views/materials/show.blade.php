@extends('layouts.main')

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
        @auth
            @if (auth()->user()->administration_level > 0)
                <div class="row" style="justify-content: center;">
                    <div class="col-sm-6 col-md-4 col-lg-3 p-0">
                        <div class="card"
                            style="height: 100px; border-radius: 0 5rem 5rem 0; text-align: center; justify-content: center;">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-secondary">
                                <div class="card-icons p-3">
                                    <strong style="font-size: 25px"><i class="fas fa-upload"></i> رفع محاضرة</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-0">
                        <div class="card"
                            style="height: 100px; border-radius: 5rem 0 0 5rem; text-align: center; justify-content: center;">
                            <a href="#" data-toggle="modal" data-target="#homeworkModal" class="text-secondary">
                                <div class="card-icons p-3">
                                    <strong style="font-size: 25px"><i class="fas fa-upload"></i> إضافة تكليف</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
        <div class="card text-center mt-2">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('homework*') ? '' : 'active' }}"
                            href="{{ route('materials.show', $material->id) }}">المحاضرات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('materials*') ? '' : 'active' }}"
                            href="{{ route('homework.show', $material->id) }}"> التكاليف</a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <table id="videos-table" class="table table-stribed text-right bg-white" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="border-0">#</th>
                                    <th class="border-0">المحاضرة</th>
                                    <th class="border-0">الوصف</th>
                                    <th class="border-0">المحاضر</th>
                                    <th class="border-0">الملف المرفق</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lectures as $lecture)
                                    @if ($lecture->material_id == $material->id)
                                        <tr>
                                            <td>{{ $lecture->id }}</td>
                                            <td>{{ $lecture->title }}</td>
                                            <td>{{ $lecture->description }}</td>
                                            <td>{{ $lecture->user->user_name }}</td>
                                            <td>
                                                @if ($lecture->file_path != 'No File')
                                                    <a href="{{ route('lecture.download_file', $lecture->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fa fa-download"></i> {{ $lecture->file_path }}
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
    {{-- Lecture Model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card col-md-12 border-0">
                            <div class="card-header text-center">
                                رفع محاضرة جديدة
                            </div>
                            @isset(auth()->user()->block)
                                @if (auth()->user()->block)
                                    <div class="alert alert-danger" role="alert">
                                        للأسف لا تستطيع رفع محاضرة يرجى التواصل مع الإدارة لمعرفة السبب
                                    </div>
                                @else
                                    <div class="card-body">
                                        <form action="{{ route('lecture.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="material_id" name="material_id"
                                                    value="{{ $material->id }}" class="d-none">
                                            </div>
                                            <div class="form-group">
                                                <label for="title">عنوان المحاضرة</label>
                                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                                    class="form-control @error('title') is-invalid @enderror">
                                                @error('title')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">وصف المحاضرة</label>
                                                <textarea cols="30" rows="5" id="description" name="description" value="{{ old('description') }}"
                                                    class="form-control @error('description') is-invalid @enderror"></textarea>
                                                @error('description')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group file-area">
                                                <label for="file_path">ملف المحاضرة</label>
                                                <input type="file" id="file_path" accept=""
                                                    onchange="readCoverImage(this);" name="file_path"
                                                    class="form-control @error('file_path') is-invalid @enderror">
                                                <div class="input-title">اسحب الملف إلى هنا أو انقر للاختيار يدويًا</div>

                                                @error('file_path')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <img id="cover-image-thumb" class="col-2" width="100" height="100">
                                                <span class="input-name col-6"></span>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-secondary">رفع المحاضرة</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Homework Model --}}
    <div class="modal fade" id="homeworkModal" tabindex="-1" aria-labelledby="homeworkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card col-md-12 border-0">
                            <div class="card-header text-center">
                                رفع تكليف جديد
                            </div>
                            @isset(auth()->user()->block)
                                @if (auth()->user()->block)
                                    <div class="alert alert-danger" role="alert">
                                        للأسف لا تستطيع رفع تكليف يرجى التواصل مع الإدارة لمعرفة السبب
                                    </div>
                                @else
                                    <div class="card-body">
                                        <form action="{{ route('homework.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="material_id" name="material_id"
                                                    value="{{ $material->id }}" class="d-none">
                                            </div>

                                            <div class="form-group">
                                                <label for="title">العنوان*</label>
                                                <input type="text" id="title" name="title"
                                                    value="{{ old('title') }}"
                                                    class="form-control @error('title') is-invalid @enderror">
                                                @error('title')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="deadline">آخر موعد للتسليم*</label>
                                                <input type="datetime-local" id="deadline" name="deadline"
                                                    value="{{ old('deadline') }}"
                                                    class="form-control @error('deadline') is-invalid @enderror">
                                                @error('deadline')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">المطلوب</label>
                                                <textarea cols="30" rows="5" id="description" name="description" value="{{ old('description') }}"
                                                    class="form-control @error('description') is-invalid @enderror"></textarea>
                                                @error('description')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group file-area">
                                                <label for="file_path">الملف المرفق</label>
                                                <input type="file" id="file_path" accept=""
                                                    onchange="readCoverImage(this);" name="file_path"
                                                    class="form-control @error('file_path') is-invalid @enderror">
                                                <div class="input-title">اسحب الملف إلى هنا أو انقر للاختيار يدويًا</div>

                                                @error('file_path')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <img id="cover-image-homework" class="col-2" width="100" height="100">
                                                <span class="input-name col-6"></span>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-secondary">رفع التكليف</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-image-thumb').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $(".input-name").html(input.files[0].name);
            }
        }

        function readCoverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-image-homework').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $(".input-name").html(input.files[0].name);
            }
        }
    </script>
@endsection
