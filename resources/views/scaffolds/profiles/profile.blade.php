@extends('layouts.admin')

@section('title', 'Profiles')

@section('content')
@include('scaffolds.profiles.navbar')
<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Change Profile Details</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <form action="{{ route('profiles.update.profile') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted required">Full Name</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Input-->
                    <input class="form-control form-control form-control-solid @error('name')is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') ? old('name') : auth()->user()->name }}" />
                    <!--end::Input-->
                    <!--begin::Error-->
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end::Error-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw-bolder fs-6 text-gray-800 me-2">{{ auth()->user()->email }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Contact Phone
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Required for borrowing books"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Input-->
                    <input class="form-control form-control form-control-solid @error('phone')is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') ? old('phone') : auth()->user()->phone }}" />
                    <!--end::Input-->
                    <!--begin::Error-->
                    @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end::Error-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Address
                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Required for borrowing books"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::TextArea-->
                    <textarea class="form-control form-control form-control-solid @error('address')is-invalid @enderror" type="text" id="address" name="address" data-kt-autosize="true">{{ old('address') ? old('address') : auth()->user()->address }}</textarea>
                    <!--end::TextArea-->
                    <!--begin::Error-->
                    @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!--end::Error-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Submit-->
                <button type="submit" class="btn btn-primary">Change Profile</button>
                <!--end::Submit-->
            </div>
            <!--end::Input group-->
        </div>
    </form>
    <!--end::Card body-->
</div>
<!--end::details View-->
@endsection