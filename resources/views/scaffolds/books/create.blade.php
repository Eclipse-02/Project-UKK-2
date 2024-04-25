@extends('layouts.admin')

@section('title', 'Books')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Create Books</span>
            <span class="text-muted fw-bold fs-7">Membuat Buku</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary fw-bolder">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr002.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="black"/>
                        <path opacity="0.3" d="M9.6 20V4L2.3 11.3C1.9 11.7 1.9 12.3 2.3 12.7L9.6 20Z" fill="black"/>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                Return
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">File</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="Only accepts files of type .epub & .pdf"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('file')is-invalid @enderror" type="file" id="file" name="file" accept="application/pdf, application/epub" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('file')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Cover</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="Only accepts files of type .jpg & .png"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('cover')is-invalid @enderror" type="file" id="cover" name="cover" accept="application/png, application/jpg" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('cover')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Title</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('title')is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('title')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Writer Name</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('writer')is-invalid @enderror" type="text" id="writer" name="writer" value="{{ old('writer') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('writer')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Publisher</span>
                </label>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-solid @error('publisher')is-invalid @enderror" name="publisher" id="publisher" data-control="select2" data-placeholder="Select Publisher">
                    <option></option>
                    @foreach ($publishers as $i)
                        <option value="{{ $i->id }}" {{ old('publisher') == $i->id ? 'selected' : '' }}>{{ $i->name }}</option>
                    @endforeach
                </select>
                <!--end::Select-->
                <!--begin::Error-->
                @error('publisher')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Category</span>
                </label>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-solid @error('category')is-invalid @enderror" name="category" id="category" data-control="select2" data-placeholder="Select Category">
                    <option></option>
                    @foreach ($categories as $i)
                        <option value="{{ $i->id }}" {{ old('category') == $i->id ? 'selected' : '' }}>{{ $i->name }}</option>
                    @endforeach
                </select>
                <!--end::Select-->
                <!--begin::Error-->
                @error('category')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Description</span>
                </label>
                <!--end::Label-->
                <!--begin::Textarea-->
                <textarea class="form-control form-control form-control-solid @error('desc')is-invalid @enderror" id="desc" name="desc" data-kt-autosize="true">{{ old('desc') }}</textarea>
                <!--end::Textarea-->
                <!--begin::Error-->
                @error('desc')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Release Year</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="Min 1900 & max {{ Carbon\Carbon::now()->year }}"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('year')is-invalid @enderror" type="text" id="year" name="year" value="{{ old('year') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('year')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span>ISBN</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="13 Digit"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('isbn')is-invalid @enderror" type="number" id="isbn" name="isbn" value="{{ old('isbn') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('isbn')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Number of Books</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="Physical book that can be borrow. Min 0. Max 999.999"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('book_count')is-invalid @enderror" type="text" id="book_count" name="book_count" value="{{ old('book_count') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('book_count')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!--end::Error-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <!--end::Card footer-->
    </form>
    <!--end:Form-->
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            Inputmask('numeric', {
                "rightAlignNumerics": false,
                "min": 1900,
                "max": {{ Carbon\Carbon::now()->year }},
            }).mask("#year");

            $('#year').css('text-align', 'left');

            Inputmask({
                "mask": "9",
                "repeat": 6,
                "greedy": false
            }).mask("#book_count");
        })
    </script>
@endpush