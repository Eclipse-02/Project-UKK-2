@extends('layouts.guest')

@section('title', 'Publishers')

@section('content')
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rate:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rate:not(:checked) > label:before {
        content: '★ ';
        }
        .rate > input:checked ~ label {
        color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
        .star-rating-complete{
           color: #c59b08;
        }
        .rating-container .form-control:hover, .rating-container .form-control:focus{
        background: #fff;
        border: 1px solid #ced4da;
        }
        .rating-container textarea:focus, .rating-container input:focus {
        color: #000;
        }
        .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rated:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rated:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ffc700;
        }
        .rated:not(:checked) > label:before {
        content: '★ ';
        }
        .rated > input:checked ~ label {
        color: #ffc700;
        }
        .rated:not(:checked) > label:hover,
        .rated:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rated > input:checked + label:hover,
        .rated > input:checked + label:hover ~ label,
        .rated > input:checked ~ label:hover,
        .rated > input:checked ~ label:hover ~ label,
        .rated > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
</style>  
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            <div class="flex-lg-auto min-w-lg-300px">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-8">
                        <img src="{{ asset('storage/storage/covers/' . $data->cover) }}" class="card-img-top w-250px mb-3" alt="{{ $data->title }}">
                        @if (auth()->check())
                            @if ($is_reading)
                                <a href="{{ route('reads.read', $data->id) }}" class="btn btn-success w-100 mb-3">Read From Start</a>
                                <a href="{{ route('reads.read', $data->id) }}" class="btn btn-warning w-100 mb-3">Continue Reading</a>
                            @else
                                <a href="{{ route('reads.read', $data->id) }}" class="btn btn-success w-100 mb-3">Read Now</a>
                            @endif
                        @else
                            <a href="{{ route('reads.read', $data->id) }}" class="btn btn-success w-100 mb-3">Read Now</a>
                        @endif
                        <div id="later_div" class="d-flex flex-col">
                            @if (auth()->check())
                                @if ($is_shelved)
                                    <a href="{{ route('bookshelves.index', $data->id) }}" class="btn btn-light-info w-50 me-2">Bookshelf</a>
                                @else
                                    <button onclick="later()" id="later" class="btn btn-light-warning w-50 me-2">Read Later</button>
                                @endif
                            @else
                                <a href="{{ route('reads.later', $data->id) }}" class="btn btn-light-warning w-50 me-2">Read Later</a>
                            @endif
                            <a href="{{ route('reads.download', $data->file_name) }}" class="btn btn-light-primary w-50">Download</a>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Sidebar-->
            <!--begin::Content-->
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-12">
                        <div class="d-flex flex-equal fw-row text-nowrap row">
                            <span class="fs-4 fw-normal text-gray-500 col-12">{{ $data->writer }}</span>
                            <span class="fs-2x fw-bolder text-gray-800 col-12">{{ $data->title }}</span>
                        </div>
                        <!--begin::Separator-->
                        <div class="separator my-2"></div>
                        <!--end::Separator-->
                        <!--end::Top-->
                        <!--begin::Wrapper-->
                        <div class="mb-0">
                            <!--begin::Descriptions-->
                            <div class="gx-10 mb-5">
                                <label class="form-label fs-6 fw-bolder text-gray-700 my-3">DESCRIPTION</label>
                                <div class="mb-5">
                                    <span class="text-muted fs-5">{{ $data->desc }}</span>
                                </div>
                            </div>
                            <!--end::Descriptions-->
                            <!--begin::Details-->
                            <div class="row gx-10 mb-5">
                                <label class="form-label fs-6 fw-bolder text-gray-700 my-3">DETAILS</label>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label fs-5 fw-bold text-gray-600 mb-3">Publisher</label>
                                    <div class="mb-5">
                                        <span class="text-muted fs-5">{{ $data->publisher->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label fs-5 fw-bold text-gray-600 mb-3">Year Released</label>
                                    <div class="mb-5">
                                        <span class="text-muted fs-5">{{ $data->year }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label fs-5 fw-bold text-gray-600 mb-3">Category</label>
                                    <div class="mb-5">
                                        <span class="text-muted fs-5">{{ $data->category->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="form-label fs-5 fw-bold text-gray-600 mb-3">ISBN</label>
                                    <div class="mb-5">
                                        <span class="text-muted fs-5">{{ $data->isbn ?? '-' }}</span>
                                    </div>
                                </div>
                                @if (auth()->check())
                                <div class="col-md-6 mb-5">
                                    <label class="form-label fs-5 fw-bold text-gray-600 mb-3">Available Book (Offline)</label>
                                    <div class="mb-5">
                                        <span class="text-muted fs-5">{{ $data->book_count }} / <span id="available">{{ $data->book_count - $brw_books }}</span></span>
                                        @if (auth()->user()->address == null || auth()->user()->phone == null)
                                            @if (!$borrowed && ($data->book_count - $brw_books) != 0)
                                                <span id="borrow">
                                                    <a href="{{ route('profiles.change.profile') }}" class="ms-2 btn btn-sm btn-light-success">Borrow Book</a>
                                                </span>
                                            @elseif ($borrowed)
                                                <button class="ms-2 btn btn-sm btn-info">Borrowed</button>
                                            @elseif (($data->book_count - $brw_books) == 0)
                                                <button class="ms-2 btn btn-sm btn-light-secondary">Unavailable</button>
                                            @endif
                                        @else
                                            @if (!$borrowed && ($data->book_count - $brw_books) != 0)
                                                <span id="borrow">
                                                    <button onclick="borrow()" class="ms-2 btn btn-sm btn-light-success">Borrow Book</button>
                                                </span>
                                            @elseif ($borrowed)
                                                <button class="ms-2 btn btn-sm btn-info">Borrowed</button>
                                            @elseif (($data->book_count - $brw_books) == 0)
                                                <button class="ms-2 btn btn-sm btn-light-secondary">Unavailable</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end::Details-->
                            <!--begin::Separator-->
                            <div class="separator my-2"></div>
                            <!--end::Separator-->
                            <!--begin::Reviews-->
                            <div class="row gx-10 mb-5">
                                <label class="form-label fs-6 fw-bolder text-gray-700 my-3">REVIEWS</label>
                                @foreach ($reviews as $i)
                                    <!--begin::Review Message-->
                                    <div class="row">
                                        <div class="col mx-5 mt-4">
                                            <span class="text-muted fs-5">{{ $i->user->name }}</span>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <div class="rated">
                                                    @for($j=1; $j<=$i->star_rating; $j++)
                                                        <label class="star-rating-complete" title="text">{{$j}} stars</label>
                                                    @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-4">
                                                <div class="col">
                                                    <p>{{ $i->comments }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Review Message-->
                                @endforeach
                            </div>
                            <!--begin::Separator-->
                            <div class="separator my-2"></div>
                            <!--end::Separator-->
                            <!--begin::Review Form-->
                            <div class="row gx-10 mb-5">
                                <div class="col mt-4">
                                    <form class="py-2 px-4" action="{{ route('reviews.store') }}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                                    @csrf

                                        <div class="form-group row">
                                            <input type="hidden" name="book_id" value="{{ $data->id }}">
                                            <div class="col">
                                                <div class="rate">
                                                    <input type="radio" id="star5" class="rate" name="star_rating" value="5"/>
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" class="rate" name="star_rating" value="4"/>
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" class="rate" name="star_rating" value="3"/>
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" class="rate" name="star_rating" value="2">
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" class="rate" name="star_rating" value="1"/>
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4">
                                            <div class="col">
                                                <textarea class="form-control" name="comments" data-kt-autosize="true" placeholder="(Optional)"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end::Review Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection

@push('scripts')
    <script>
        @if (auth()->check())
        $(function() {
            later = () => {
                $.ajax({
                    url: "{{ route('reads.later', $data->id) }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "book_id": "{{ $data->id }}",
                    },
                    success: function () {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "success",
                            title: "Stored Successfully!"
                        });

                        $('#later_div').empty();
                        // $('#later_div').remove();
                        $('#later_div').append('<a href="{{ route('bookshelves.index') }}" class="btn btn-light-info w-50 me-2">Bookshelf</a><a href="{{ route('reads.download', $data->file_name) }}" class="btn btn-light-primary w-50">Download</a>')

                    }
                })
            }

            borrow = () => {
                $.ajax({
                    url: "{{ route('reads.borrow', $data->id) }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "book_id": "{{ $data->id }}",
                    },
                    success: function () {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "success",
                            title: "Success!"
                        });

                        let available = $('#available').html()

                        $('#borrow').empty();
                        $('#available').empty()
                        $('#borrow').append('<a class="ms-2 btn btn-sm btn-info">Borrowed</a>')
                        $('#available').html(available - 1)

                    },
                    error: function () {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });

                        Toast.fire({
                            icon: "error",
                            title: "Failed to borrow!"
                        });
                    }
                })
            }
        })
        @endif
    </script>
@endpush