@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card mb-2 col-md-8">
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
                            <form action="{{ route('lecture.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="material_id" class="mb-2">المادة</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="material_id" name="material_id" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror">
                                    </div>
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
                                    <input type="file" id="file_path" accept="image/*" onchange="readCoverImage(this);"
                                        name="file_path" class="form-control @error('file_path') is-invalid @enderror">
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

        function readVideo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.readAsDataURL(input.files[0]);
                $(".video-name").html('\
                                    <div class="alert alert-primary">\
                                        تم اختيار المحاضرة بنجاح ' + input.files[0].name + '\
                                    </div>');
            }
        }
    </script>
@endsection
