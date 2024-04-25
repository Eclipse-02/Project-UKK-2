@extends('layouts.guest')

@section('content')
	<!--begin::Staff Recommendation-->
	<div class="mb-n10 mb-lg-n20">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Heading-->
			<div class="text-start mb-17">
				<!--begin::Title-->
				<h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">Latest Upload</h3>
				<!--end::Title-->
			</div>
			<!--end::Heading-->
			<!--begin::Row-->
			<div class="row d-flex justify-content-center w-100 gy-10 mb-20">
				@if ($books->isEmpty())
					<!--begin::Col-->
					<div class="col-md-12 px-2">
						<div class="card border border-dashed border-gray-300 rounded">
							<div class="card-body text-center">
								{{-- <p class="card-text">{{ $i->writer }}</p> --}}
								<h5 class="card-title">There isn't any book available. Please add a book</h5>
							</div>
						</div>
					</div>
					<!--end::Col-->
				@else
					@foreach ($books as $i)
						<!--begin::Col-->
						<div class="col-md-3 px-2">
							<div class="card">
								<img src="{{ asset('storage/storage/covers/' . $i->cover) }}" class="card-img-top w-250px" alt="{{ $i->title }}">
								<div class="card-body">
									@guest
										
									@else
										<div class="d-flex justify-content-end">
											<input type="hidden" id="book_id" value="{{ $i->id }}">
											<div id="later_div_{{ $i->id }}" class="card-toolbar">
												<!--begin::Menu-->
												@if (\App\Models\Bookshelf::where([
													['book_id', '=', $i->id],
													['user_id', '=', auth()->user()->id],
												])->first())
												<a href="{{ route('bookshelves.index') }}" class="btn btn-sm btn-icon btn-active-light-info" data-bs-toggle="tooltip" title="Check Bookshelf">
													<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
													<span class="svg-icon svg-icon-muted svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
															<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
														</svg>
													</span>
													<!--end::Svg Icon-->
												</a>
												@endif
												<a href="{{ route('reads.read', $i->id) }}" class="btn btn-sm btn-icon btn-active-light-success" data-bs-toggle="tooltip" title="Read Now">
													<!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen054.svg-->
													<span class="svg-icon svg-icon-muted svg-icon-2">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path opacity="0.5" d="M18 2H9C7.34315 2 6 3.34315 6 5H8C8 4.44772 8.44772 4 9 4H18C18.5523 4 19 4.44772 19 5V16C19 16.5523 18.5523 17 18 17V19C19.6569 19 21 17.6569 21 16V5C21 3.34315 19.6569 2 18 2Z" fill="black"/>
															<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7857 7.125H6.21429C5.62255 7.125 5.14286 7.6007 5.14286 8.1875V18.8125C5.14286 19.3993 5.62255 19.875 6.21429 19.875H14.7857C15.3774 19.875 15.8571 19.3993 15.8571 18.8125V8.1875C15.8571 7.6007 15.3774 7.125 14.7857 7.125ZM6.21429 5C4.43908 5 3 6.42709 3 8.1875V18.8125C3 20.5729 4.43909 22 6.21429 22H14.7857C16.5609 22 18 20.5729 18 18.8125V8.1875C18 6.42709 16.5609 5 14.7857 5H6.21429Z" fill="black"/>
														</svg>
													</span>
													<!--end::Svg Icon-->
												</a>
												<!--end::Menu-->
											</div>
										</div>
									@endguest
									<p class="card-text">{{ $i->writer }}</p>
									<h5 class="card-title">{{ $i->title }}</h5>
									<a href="{{ route('reads.show', $i->id) }}" class="btn btn-light-primary w-100 mt-5">See More</a>
								</div>
							</div>
						</div>
						<!--end::Col-->
					@endforeach
				@endif
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Staff Recommendation-->
@endsection