@extends('layouts.admin')

@section('title', 'Borrowing')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Create Borrowings</span>
            <span class="text-muted fw-bold fs-7">Membuat Peminjaman</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-primary fw-bolder">
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
    <form class="form" action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Book Title</span>
                </label>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="form-select form-select-solid @error('book')is-invalid @enderror" name="book" id="book" data-control="select2" data-placeholder="Select Book">
                    <option></option>
                    @foreach ($books as $i)
                        <option value="{{ $i->id }}" {{ old('book') == $i->id ? 'selected' : '' }}>{{ $i->title }}</option>
                    @endforeach
                </select>
                <!--end::Select-->
                <!--begin::Error-->
                @error('book')
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
                    <span class="required">Date</span>
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control form-control-solid @error('date')is-invalid @enderror" type="text" id="date" name="date" value="{{ old('date') }}" />
                <!--end::Input-->
                <!--begin::Error-->
                @error('date')
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
            $('#date').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'MM-DD-YYYY',
                    cancelLabel: 'Clear'
                }
            });

            $('#date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('#date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        })
    </script>
@endpush