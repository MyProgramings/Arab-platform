@extends('layouts.main')

@section('content')
    <div class="mx-4">
        @auth
            @if (auth()->user()->administration_level > 0)
                <button type="submit" class="btn btn-secondary mt-1 mr-2" data-toggle="modal" data-target="#exampleModal"
                    style="float: inline-end">إضافة قسم</button>
            @endif
        @endauth
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li aria-current="page">الأقسام</li>
            </ol>
        </nav>
        <div class="row">
            @foreach ($departments as $department)
                <div class="col-sm-6 col-md-4 col-lg-3 pb-3">
                    <div class="card"
                        style="background: rgb(3,54,79);
                    background: linear-gradient(90deg, rgba(3, 54, 79, 0.473) 0%, rgba(0, 213, 255, 0.486) 100%);">
                        <a href="{{ route('material_by_department', $department->id) }}" class="text-white">
                            <div class="card-icons p-3" style="height: 120px;">
                                @php
                                    $words = explode(' ', $department->name);
                                    $acronym = '';
                                    foreach ($words as $w) {
                                        $acronym .= mb_substr($w, 0, 1);
                                    }
                                @endphp
                                <strong style="font-size: 22px">{{ $department->name }}</strong>
                                <i class="fas fa-2x"></i>
                            </div>
                            <div class="card-footer" style="height: 50px;">
                                <strong class="text-muted" style="float: right;">
                                    <span style="font-size: 22px">{{ $acronym }}</span>
                                </strong>
                                @auth
                                    @if ($department->user_id == auth()->user()->id || auth()->user()->administration_level > 0)
                                        @if (!auth()->user()->block)
                                            <form method="POST" action="{{ route('departments.destroy', $department->id) }}"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف القسم هذا؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="float-left"><i
                                                        class="far fa-trash-alt text-danger fa-lg"></i></button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card col-md-12">
                            <div class="card-header text-center">
                                إضافة قسم جديد
                            </div>
                            @isset(auth()->user()->block)
                                @if (auth()->user()->block)
                                    <div class="alert alert-danger" role="alert">
                                        للأسف لا تستطيع إضافة مادة يرجى التواصل مع الإدارة لمعرفة السبب
                                    </div>
                                @else
                                    <div class="card-body">
                                        <form action="{{ route('departments.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input class="d-none" type="text" id="department_id" name="department_id"
                                                value="">
                                            <div class="form-group">
                                                <label for="name">اسم القسم</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="ادخل الاسم كاملاً" value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-secondary">رفع القسم</button>
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
