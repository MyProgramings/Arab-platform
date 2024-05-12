@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="card mb-2 col-md-8">
                <div class="card-header text-center">
                    إضافة مادة جديدة
                </div>
                @isset(auth()->user()->block)
                    @if (auth()->user()->block)
                        <div class="alert alert-danger" role="alert">
                            للأسف لا تستطيع إضافة مادة يرجى التواصل مع الإدارة لمعرفة السبب
                        </div>
                    @else
                        <div class="card-body">
                            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="d-none" type="text" id="department_id" name="department_id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="title">اسم المادة</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
