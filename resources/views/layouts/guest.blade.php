<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>Foliate - Digital Library</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="id_ID" />
		<link rel="shortcut icon" href="{{ asset('master/dist/assets/media/logos/favicon.ico') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('master/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('master/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Header Section-->
			<div class="mb-0" id="home">
				<!--begin::Wrapper-->
				<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(master/dist/assets/media/svg/illustrations/landing.svg)">
					<!--begin::Header-->
					<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Wrapper-->
							<div class="d-flex align-items-center justify-content-between">
								<!--begin::Logo-->
								<div class="d-flex align-items-center flex-equal">
									<!--begin::Mobile menu toggle-->
									<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
										<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
										<span class="svg-icon svg-icon-2hx">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
												<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</button>
									<!--end::Mobile menu toggle-->
									<!--begin::Logo image-->
									<a href="{{ route('welcome') }}">
										<img alt="Logo" src="{{ asset('master/dist/assets/media/logos/logo-landing.svg') }}" class="logo-default h-50px h-lg-55px" />
										<img alt="Logo" src="{{ asset('master/dist/assets/media/logos/logo-landing-dark.svg') }}" class="logo-sticky h-45px h-lg-50px" />
									</a>
									<!--end::Logo image-->
								</div>
								<!--end::Logo-->
								<!--begin::Menu wrapper-->
								<div class="d-lg-block" id="kt_header_nav_wrapper">
									<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
										<!--begin::Menu-->
										<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6 {{ request()->is('/') ? 'active' : '' }}" href="{{ route('welcome') }}" data-kt-drawer-dismiss="true">Home</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6 {{ request()->is('shelves') ? 'active' : '' }}" href="{{ route('bookshelves.index') }}" data-kt-drawer-dismiss="true">Bookshelf</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item">
												<!--begin::Menu link-->
												<a class="menu-link nav-link py-3 px-4 px-xxl-6 {{ request()->is('explore') ? 'active' : '' }}" href="{{ route('explore') }}" data-kt-drawer-dismiss="true">Explore</a>
												<!--end::Menu link-->
											</div>
											<!--end::Menu item-->
										</div>
										<!--end::Menu-->
									</div>
								</div>
								<!--end::Menu wrapper-->
								<!--begin::Toolbar-->
								<div class="flex-equal text-end ms-1">
                                    @guest
										<!--begin::Toolbar-->
										<div class="flex-equal text-end ms-1">
											<a href="{{ route('register') }}" class="btn btn-primary me-2">Sign Up</a>
											<a href="{{ route('login') }}" class="btn btn-success">Sign In</a>
										</div>
										<!--end::Toolbar-->
										@else
										<!--begin::Toolbar-->
										<div class="flex-equal text-end ms-1">
											<!--begin::Avatar-->
											<a href="{{ route('home') }}">
												<div class="symbol symbol-40px me-5">
													<div class="symbol-label fs-2 fw-bold bg-success text-inverse-success">{{ auth()->user()->name[0] }}</div>
												</div>
											</a>
											<!--end::Avatar-->
										</div>
										<!--end::Toolbar-->
									@endguest
								</div>
								<!--end::Toolbar-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
                    @if (request()->is('/'))
                        <!--begin::Landing hero-->
                        <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                            @guest
							<!--begin::Heading-->
                            <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                                <!--begin::Title-->
                                <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">Read Your Book With
                                <br />
                                <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                    <span id="kt_landing_hero_text">The Best Digital Library</span>
                                </span></h1>
                                <!--end::Title-->
                                <!--begin::Action-->
                                <a href="{{ route('login') }}" class="btn btn-primary">Try Foliate Now</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Heading-->
							@else
							<!--begin::Heading-->
                            <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                                <!--begin::Title-->
                                <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">You Can Pick Up Where You Left Off
                                <br />
                                <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                    <span id="kt_landing_hero_text">With Just A Few Clicks</span>
                                </span></h1>
                                <!--end::Title-->
                                <!--begin::Action-->
                                <a href="{{ route('bookshelves.index') }}" class="btn btn-primary">Go to your Bookshelf</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Heading-->
							@endguest
                            <!--begin::Clients-->
                            {{-- <div class="d-flex flex-center flex-wrap position-relative px-5">
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                                    <img src="master/dist/assets/media/svg/brand-logos/fujifilm.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                                    <img src="master/dist/assets/media/svg/brand-logos/vodafone.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
                                    <img src="master/dist/assets/media/svg/brand-logos/kpmg.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                                    <img src="master/dist/assets/media/svg/brand-logos/nasa.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                                    <img src="master/dist/assets/media/svg/brand-logos/aspnetzero.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="AON - Empower Results">
                                    <img src="master/dist/assets/media/svg/brand-logos/aon.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
                                    <img src="master/dist/assets/media/svg/brand-logos/hp-3.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                                <!--begin::Client-->
                                <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                                    <img src="master/dist/assets/media/svg/brand-logos/truman.svg" class="mh-30px mh-lg-40px" alt="" />
                                </div>
                                <!--end::Client-->
                            </div> --}}
                            <!--end::Clients-->
                        </div>
                        <!--end::Landing hero-->
                    @endif
				</div>
				<!--end::Wrapper-->
				<!--begin::Curve bottom-->
				<div class="landing-curve landing-dark-color mb-10 mb-lg-20">
					<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
					</svg>
				</div>
				<!--end::Curve bottom-->
			</div>
			<!--end::Header Section-->
			@yield('content')
			<!--begin::Footer Section-->
			<div class="mb-0">
				<!--begin::Wrapper-->
				<div class="landing-dark-bg pt-5">
					<!--begin::Separator-->
					<div class="landing-dark-separator"></div>
					<!--end::Separator-->
					<!--begin::Container-->
					<div class="container">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
							<!--begin::Copyright-->
							<div class="d-flex align-items-center order-2 order-md-1">
								<!--begin::Logo-->
								<a href="{{ route('welcome') }}">
									<img alt="Logo" src="{{ asset('master/dist/assets/media/logos/logo-landing.svg') }}" class="h-15px h-md-20px" />
								</a>
								<!--end::Logo image-->
								<!--begin::Logo image-->
								<span class="mx-5 fs-6 fw-bold text-gray-600 pt-1" href="#">© 2024 Folicate Inc.</span>
								<!--end::Logo image-->
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							<ul class="menu menu-gray-600 menu-hover-primary fw-bold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
								<li class="menu-item">
									<a href="#" target="_blank" class="menu-link px-2">About</a>
								</li>
								<li class="menu-item mx-5">
									<a href="#" target="_blank" class="menu-link px-2">Support</a>
								</li>
								<li class="menu-item">
									<a href="" target="_blank" class="menu-link px-2">Purchase</a>
								</li>
							</ul>
							<!--end::Menu-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Footer Section-->
			<!--begin::Scrolltop-->
			<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
				<span class="svg-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
						<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Scrolltop-->
		</div>
		<!--end::Main-->
		<script>var hostUrl = "master/dist/assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('master/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('master/dist/assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{ asset('master/dist/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
		<script src="{{ asset('master/dist/assets/plugins/custom/typedjs/typedjs.bundle.js') }}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('master/dist/assets/js/custom/landing.js') }}"></script>
		<script src="{{ asset('master/dist/assets/js/custom/pages/company/pricing.js') }}"></script>
		@stack('scripts')
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>