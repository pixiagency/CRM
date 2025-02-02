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

                @canany(['create industries', 'view industries'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-suitcase pe-3"></i>
                        <span class="side-menu__label">@lang('app.industry')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create industries')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('industries.create'))}}"
                                href="{{route('industries.create')}}">@lang('app.new_industry')</a></li>
                        @endcan

                        @can('view industries')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('industries.index'))}}"
                                href="{{route('industries.index')}}">@lang('app.all_industries')</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Service Menu -->
                @canany(['create services', 'view services'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-cogs pe-3"></i> <!-- Icon for Services -->
                        <span class="side-menu__label">@lang('app.services')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create services')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('services.create')) }}"
                                href="{{ route('services.create') }}">@lang('app.new_service')</a>
                        </li>
                        @endcan
                        @can('view services')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('services.index')) }}"
                                href="{{ route('services.index') }}">@lang('app.all_services')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Reason Menu -->
                @canany(['create reasons', 'view reasons'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-clipboard-list pe-3"></i> <!-- Icon for Reasons -->
                        <span class="side-menu__label">@lang('app.reasons')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create reasons')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('reasons.create')) }}"
                                href="{{ route('reasons.create') }}">@lang('app.new_reason')</a>
                        </li>
                        @endcan
                        @can('view reasons')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('reasons.index')) }}"
                                href="{{ route('reasons.index') }}">@lang('app.all_reasons')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['create locations', 'view locations'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-map pe-3"></i>
                        <span class="side-menu__label">@lang('app.location')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create locations')
                        {{-- <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('locations.create'))}}"
                                href="{{route('locations.create')}}">@lang('app.new_location')</a></li> --}}
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('locations.countries.create'))}}"
                                href="{{route('locations.countries.create')}}">@lang('app.new_country')</a></li>
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('locations.governorates.create'))}}"
                                href="{{route('locations.governorates.create')}}">@lang('app.new_governorate')</a></li>
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('locations.cities.create'))}}"
                                href="{{route('locations.cities.create')}}">@lang('app.new_city')</a></li>
                        @endcan
                        @can('view locations')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('locations.index'))}}"
                                href="{{route('locations.index')}}">@lang('app.all_locations')</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- source Menu -->
                @canany(['create sources', 'view sources'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-box pe-3"></i> <!-- Icon for Resources -->
                        <span class="side-menu__label">@lang('app.sources')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create sources')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('resources.create')) }}"
                                href="{{ route('resources.create') }}">@lang('app.new_source')</a>
                        </li>
                        @endcan
                        @can('view sources')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('resources.index')) }}"
                                href="{{ route('resources.index') }}">@lang('app.all_sources')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Custom Fields Menu -->
                @canany(['create customFields', 'view customFields'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-list-alt pe-3"></i> <!-- Icon for Custom Fields -->
                        <span class="side-menu__label">@lang('app.custom_fields')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create customFields')
                        <li>
                            <a class="slide-item"
                                data-is_active="{{ request()->fullUrlIs(route('custom-fields.create')) }}"
                                href="{{ route('custom-fields.create') }}">@lang('app.new_custom_field')</a>
                        </li>
                        @endcan
                        @can('view customFields')
                        <li>
                            <a class="slide-item"
                                data-is_active="{{ request()->fullUrlIs(route('custom-fields.index')) }}"
                                href="{{ route('custom-fields.index') }}">@lang('app.all_custom_fields')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Client Menu -->
                @canany(['create clients', 'view clients'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-users pe-3"></i> <!-- Icon for Clients -->
                        <span class="side-menu__label">@lang('app.clients')</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create clients')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('clients.create')) }}"
                                href="{{ route('clients.create') }}">@lang('app.new_client')</a>
                        </li>
                        @endcan
                        @can('view clients')
                        <li>
                            <a class="slide-item" data-is_active="{{ request()->fullUrlIs(route('clients.index')) }}"
                                href="{{ route('clients.index') }}">@lang('app.all_clients')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Role Permissions Menu -->
                @canany(['view role-permissions', 'create role-permissions'])
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-lock pe-3"></i>
                        <span class="side-menu__label">@lang('app.permissions')</span><i
                            class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('view role-permissions')
                        <li>
                            <a class="slide-item"
                                data-is_active="{{ request()->fullUrlIs(route('role-permissions.index')) }}"
                                href="{{ route('role-permissions.index') }}">@lang('app.role_permissions')</a>
                        </li>
                        @endcan
                        @can('create role-permissions')
                        <li>
                            <a class="slide-item"
                                data-is_active="{{ request()->fullUrlIs(route('role-permissions.create')) }}"
                                href="{{ route('role-permissions.create') }}">@lang('app.create_role')</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany


            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
<!-- main-sidebar -->
