@extends('layouts.admin')

@section('title', 'Books')

@section('content')
<div class="card card-xxl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Books DataTable</span>
            <span class="text-muted fw-bold fs-7">Tabel Data Buku</span>
        </h3>
        <div class="d-flex">
            <div class="card-toolbar">
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary fw-bolder me-2">
                    Create
                </a>
            </div>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Table-->
        {{ $dataTable->table() }}
        <!--end::Table-->
    </div>
    <!--end: Card Body-->
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush