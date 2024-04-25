<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-0 pb-0">
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ request()->is('profiles') ? 'active' : '' }}" href="{{ route('profiles.index') }}">Overview</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ request()->is('profiles/change-profile') ? 'active' : '' }}" href="{{ route('profiles.change.profile') }}">Change Profile</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ request()->is('profiles/change-password') ? 'active' : '' }}" href="{{ route('profiles.change.password') }}">Change Password</a>
                </li>
                <!--end::Nav item-->
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->