@extends('layouts.main')

@section('content')
    <div class="mx-4">
        <button type="submit" class="btn btn-secondary mt-1 mr-2" data-toggle="modal" data-target="#exampleModal"
            style="float: inline-end">إضافة مادة</button>


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="{{ route('departments.index') }}">الأقسام / </a></li>
                    @isset($department->id)
                <li aria-current="page">&nbsp;{{ $department->department->name }}</li>
                @endisset
            </ol>
        </nav>
        <div class="row">
            @foreach ($materials as $material)
                <div class="col-sm-6 col-md-4 col-lg-3 pb-3">
                    <div class="card"
                        style="background: rgb(3,47,79);
                                background: linear-gradient(90deg, rgba(4, 51, 85, 0.432) 0%, rgba(0, 255, 195, 0.548) 100%);">
                        <a href="{{ route('materials.show', $material->id) }}" class="text-white">
                            <div class="card-icons p-3">
                                @php
                                    $words = explode(' ', $material->title);
                                    $acronym = '';
                                    foreach ($words as $w) {
                                        $acronym .= mb_substr($w, 0, 1);
                                    }
                                @endphp
                                <strong style="font-size: 50px">{{ $acronym }}</strong>
                                <i class="fas fa-2x"></i>
                            </div>
                            <div class="card-footer">
                                <strong class="text-muted">
                                    <span>{{ $material->title }}</span>
                                </strong>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card col-md-12">
                            <div class="card-header text-center">إضافة مادة جديدة</div>
                            @isset(auth()->user()->block)
                                @if (auth()->user()->block)
                                    <div class="alert alert-danger" role="alert">
                                        للأسف لا تستطيع إضافة مادة يرجى التواصل مع الإدارة لمعرفة السبب
                                    </div>
                                @else
                                    <div class="card-body">
                                        <form action="{{ route('materials.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input class="d-none" type="text" id="department_id" name="department_id"
                                                value="{{ $id }}">
                                            <div class="form-group">
                                                <label for="title">اسم المادة</label>
                                                <input type="text" id="title" name="title"
                                                    placeholder="ادخل الاسم كاملاً" value="{{ old('title') }}"
                                                    class="form-control @error('title') is-invalid @enderror">
                                                @error('title')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-4 mt-2">
                                                    <button type="submit" class="btn btn-secondary">رفع
                                                        المادة</button>
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
