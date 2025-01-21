<!-- main-sidebar -->
<div class="sticky">
    <aside class="app-sidebar">
        <div class="main-sidebar-header active">
            <a class="header-logo active" href="{{url('/')}}">
                <img style="max-height: 40px !important" src="{{asset('assets/images/brand/logo.png')}}"
                    class="main-logo" alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">

                {{-- menu --}}
                <li class="side-item side-item-category">@lang('app.menu')</li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-suitcase pe-3"></i>
                        <span class="side-menu__label">@lang('app.industry')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('industries.create'))}}"
                                href="{{route('industries.create')}}">@lang('app.new_industry')</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('industries.index'))}}"
                                href="{{route('industries.index')}}">@lang('app.all_industries')</a></li>
                    </ul>
                </li>

                <!-- Service Menu -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-cogs pe-3"></i> <!-- Icon for Services -->
                        <span class="side-menu__label">@lang('app.services')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('services.create')) }}"
                                href="{{ route('services.create') }}">@lang('app.new_service')</a>
                        </li>
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('services.index')) }}"
                                href="{{ route('services.index') }}">@lang('app.all_services')</a>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-map pe-3"></i>
                        <span class="side-menu__label">@lang('app.location')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('locations.create'))}}"
                                href="{{route('locations.create')}}">@lang('app.new_location')</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('locations.index'))}}"
                                href="{{route('locations.index')}}">@lang('app.all_locations')</a></li>
                    </ul>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
<!-- main-sidebar -->