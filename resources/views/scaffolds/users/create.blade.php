@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Create Users</span>
            <span class="text-muted fw-bold fs-7">Membuat Pengguna</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary fw-bolder">
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
    <form class="form" action="{{ route('users.store') }}" method="POST">
        @csrf

        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">User Name</span>
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
                    <span class="required">Email</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('email')is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('email')
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
                    <span class="required">Password</span>
                </label>
                <!--end::Label-->
                <!--begin::Input group-->
                <!--begin::Wrapper-->
                <div class="mb-1" data-kt-password-meter="true">
                    <!--begin::Input wrapper-->
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="new-password" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <!--end::Input wrapper-->
                    <!--begin::Meter-->
                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                    </div>
                    <!--end::Meter-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Hint-->
                <div class="text-muted">Use 8 or more characters.</div>
                <!--end::Hint-->
                @error('password')
                    <!--begin::Error-->
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <!--end::Error-->
                @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Role</span>
                </label>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-solid @error('role')is-invalid @enderror" name="role" id="role" data-control="select2" data-placeholder="Select role">
                    <option></option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                <!--end::Select-->
                <!--begin::Error-->
                @error('role')
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
                    <span>Address</span>
                </label>
                <!--end::Label-->
                <!--begin::Textarea-->
                <textarea class="form-control form-control form-control-solid @error('address')is-invalid @enderror" id="address" name="address" data-kt-autosize="true">{{ old('address') }}</textarea>
                <!--end::Textarea-->
                <!--begin::Error-->
                @error('address')
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
                    <span>Phone Number</span>
                    <i class="fas fa-question-circle ms-2 fs-6" data-bs-toggle="tooltip" title="Max 13 digit"></i>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('phone')is-invalid @enderror" type="number" id="phone" name="phone" value="{{ old('phone') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('phone')
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
