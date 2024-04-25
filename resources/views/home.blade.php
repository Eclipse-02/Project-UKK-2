@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
@role('admin|employee')
<div class="row g-6 g-xl-9 mb-5">
  <div class="col-sm-6 col-lg-4">
    <!--begin::Card-->
    <div class="card">
      <!--begin::Card body-->
      <div class="card-body p-9 pb-3">
        <!--begin::Heading-->
        <div class="fs-2hx fw-bolder">{{ $upl_book }}</div>
        <div class="fs-4 fw-bold text-gray-400 mb-7">Uploaded Book</div>
        <!--end::Heading-->
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
  <div class="col-sm-6 col-lg-4">
    <!--begin::Card-->
    <div class="card">
      <!--begin::Card body-->
      <div class="card-body p-9 pb-3">
        <!--begin::Heading-->
        <div class="fs-2hx fw-bolder">{{ $phy_book - $borrowed }}</div>
        <div class="fs-4 fw-bold text-gray-400 mb-7">Physical Book</div>
        <!--end::Heading-->
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
  <div class="col-sm-6 col-lg-4">
    <!--begin::Card-->
    <div class="card">
      <!--begin::Card body-->
      <div class="card-body p-9 pb-3">
        <!--begin::Heading-->
        <div class="fs-2hx fw-bolder">{{ $borrowed }}</div>
        <div class="fs-4 fw-bold text-gray-400 mb-7">Book Being Borrowed</div>
        <!--end::Heading-->
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Card-->
  </div>
</div>
@endrole

<div class="card card-xxl-stretch mb-5">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">Notifications</span>
            <span class="text-muted fw-bold fs-7">Notifikasi</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
      @role('admin')
      @if ($admin_notifications->isEmpty())
          <div class="overflow-auto pb-5">
            <!--begin::Record-->
            <div class="d-flex align-items-center justify-content-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
              <!--begin::Title-->
              <a class="fs-5 text-dark text-hover-primary fw-bold my-5">Important messages in progress will appear here</a>
              <!--end::Title-->
            </div>
            <!--end::Record-->
          </div>
      @else
            @foreach ($admin_notifications as $i)
            <div class="overflow-auto pb-5">
              <!--begin::Record-->
              <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                <!--begin::Title-->
                <a class="fs-5 text-dark text-hover-primary fw-bold w-375px min-w-200px">Borrowing Book</a>
                <!--end::Title-->
                <!--begin::Label-->
                <div class="min-w-200px pe-2">
                  <span class="badge badge-light text-muted">{{ $i->book->title }} - {{ $i->book->writer }}</span>
                </div>
                <!--end::Label-->
                <!--begin::Progress-->
                <div class="min-w-175px pe-2">
                  <span class="badge @if(now()->diffInDays(Carbon\Carbon::parse($i->return_date)) >= 4)badge-light-primary @elseif(now()->diffInDays(Carbon\Carbon::parse($i->return_date)) >= 2)badge-light-warning @else badge-light-danger @endif">
                  @if (now()->diffInDays(Carbon\Carbon::parse($i->return_date)) < 0)
                    {{ now()->diffInDays(Carbon\Carbon::parse($i->return_date)) }} day(s) left
                  @elseif (now()->diffInDays(Carbon\Carbon::parse($i->return_date)) == 0)
                    Final Day
                  @else
                    {{ now()->diffInDays(Carbon\Carbon::parse($i->return_date)) }} day(s) passed
                  @endif
                  </span>
                </div>
                <!--end::Progress-->
                <!--begin::Action-->
                <a href="{{ route('borrowings.show', $i->id) }}" class="btn btn-sm btn-light btn-active-light-primary">View Details</a>
                <!--end::Action-->
              </div>
              <!--end::Record-->
            </div>
            @endforeach
            @endif
          @endrole
        @role('user')
        @if ($notifications->isEmpty())
          <div class="overflow-auto pb-5">
            <!--begin::Record-->
            <div class="d-flex align-items-center justify-content-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
              <!--begin::Title-->
              <a class="fs-5 text-dark text-hover-primary fw-bold my-5">Important messages in progress will appear here</a>
              <!--end::Title-->
            </div>
            <!--end::Record-->
          </div>
        @else
            @foreach ($notifications as $i)
            <div class="overflow-auto pb-5">
              <!--begin::Record-->
              <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                <!--begin::Title-->
                <a class="fs-5 text-dark text-hover-primary fw-bold w-375px min-w-200px">Borrowing Book</a>
                <!--end::Title-->
                <!--begin::Label-->
                <div class="min-w-200px pe-2">
                  <span class="badge badge-light text-muted">{{ $i->book->title }} - {{ $i->book->writer }}</span>
                </div>
                <!--end::Label-->
                <!--begin::Progress-->
                <div class="min-w-175px pe-2">
                  <span class="badge @if(now()->diffInDays(Carbon\Carbon::parse($i->return_date)) >= 4)badge-light-primary @elseif(now()->diffInDays(Carbon\Carbon::parse($i->return_date)) >= 2)badge-light-warning @else badge-light-warning @endif">{{ now()->diffInDays(Carbon\Carbon::parse($i->return_date)) }} day(s) left</span>
                </div>
                <!--end::Progress-->
                <!--begin::Action-->
                <a href="{{ route('reads.show', $i->id) }}" class="btn btn-sm btn-light btn-active-light-primary">View Book Details</a>
                <!--end::Action-->
              </div>
              <!--end::Record-->
            </div>
            @endforeach
          @endif
        @endrole
    </div>
    <!--end: Card Body-->
</div>

@role('user')
<div class="card card-xxl-stretch">
  <!--begin::Header-->
  <div class="card-header align-items-center border-0 mt-4">
      <h3 class="card-title align-items-start flex-column">
          <span class="fw-bolder mb-2 text-dark">Borrowing History</span>
          <span class="text-muted fw-bold fs-7">Riwayat Peminjaman</span>
      </h3>
  </div>
  <!--end::Header-->
  <!--begin::Body-->
  <div class="card-body pt-5">
      @if ($histories->isEmpty())
        <div class="overflow-auto pb-5">
          <!--begin::Record-->
          <div class="d-flex align-items-center justify-content-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
            <!--begin::Title-->
            <a class="fs-5 text-dark text-hover-primary fw-bold my-5">You haven't borrowed any books</a>
            <!--end::Title-->
          </div>
          <!--end::Record-->
        </div>
      @else
        @foreach ($histories as $i)
        <div class="row">
          <div class="col-lg-6 col-sm-12">
            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
              <!--begin::Avatar-->
              <div class="me-5">
                <img src="{{ asset('storage/storage/covers/' . $i->book->cover) }}" class="w-125px h-175px" alt="">
              </div>
              <!--end::Avatar-->
              <div class="row">
                <!--begin::Text-->
                <div class="col-12 mb-2">
                  <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $i->book->title }}</a>
                  <span class="text-muted d-block fw-bold">{{ $i->book->writer }}</span>
                </div>
                <!--end::Text-->
                <!--begin::Text-->
                <div class="col-12 mb-2">
                  <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Status</a>
                  <span class="text-muted d-block fw-bold">
                    @if ($i->status == 'B')
                        Borrowed
                    @else
                        Returned
                    @endif
                  </span>
                </div>
                <!--end::Text-->
                <!--begin::Text-->
                <div class="col-12">
                  <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Borrow-Return Date</a>
                  <span class="text-muted d-block fw-bold">{{ Carbon\Carbon::parse($i->borrow_date)->isoFormat('dddd, D MMMM Y') }} - {{ Carbon\Carbon::parse($i->return_date)->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <!--end::Text-->
              </div>
            </div>
          </div>
        </div>
        @endforeach
      @endif
  </div>
  <!--end: Card Body-->
</div>
@endrole
@endsection

