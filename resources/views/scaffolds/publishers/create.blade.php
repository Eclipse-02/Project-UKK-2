@extends('layouts.admin')

@section('title', 'Publishers')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Create Publishers</span>
            <span class="text-muted fw-bold fs-7">Membuat Penerbit</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('publishers.index') }}" class="btn btn-sm btn-primary fw-bolder">
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
    <form class="form" action="{{ route('publishers.store') }}" method="POST">
        @csrf

        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Publisher Name</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('name')is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('name')
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
                    <span>Description</span>
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
