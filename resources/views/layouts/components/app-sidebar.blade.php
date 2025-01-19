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
                {{-- <li class="side-item side-item-category">Main</li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z" />
                        </svg>
                        <span class="side-menu__label">Dashboards</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Dashboards</a></li>
                        <li><a class="slide-item" href="{{url('index')}}">Dashboard-1</a></li>
                    </ul>
                </li> --}}

                {{-- menu --}}
                <li class="side-item side-item-category">@lang('app.menu')</li>
                @can('view_shipment')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-truck pe-3"></i>
                        <span class="side-menu__label">@lang('app.awb')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create_shipment')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awbs.create'))}}"
                                href="{{route('awbs.create')}}">@lang('app.new_shipment')</a></li>
                        @endcan
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awbs.index'))}}"
                                href="{{route('awbs.index')}}">@lang('app.prepare_shipment')</a></li>
                        @if (auth()->user()->type == App\Enums\UsersType::SUPERADMIN->value)
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('awbs.created_shipments.show'))}}"
                                href="{{route('awbs.created_shipments.show')}}">@lang('app.created_shipment')</a></li>
                        @endif
                    </ul>
                </li>
                @endcan

                @if(Auth::user()->type != \App\Enums\UsersType::ADMIN->value)
                @if (auth()->user()->type == 4)
                <li class="slide">
                <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awbs.operation_awbs'))}}"
                        href="{{route('awbs.operation_awbs')}}">@lang('app.pickup_requests')</a></li>
                <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awbs.office_awbs'))}}"
                        href="{{route('awbs.office_awbs')}}">@lang('app.delivery_requests')</a></li>
                <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awbs.collected_awbs'))}}"
                        href="{{route('awbs.collected_awbs')}}">@lang('app.all_awbs')</a></li>
                </li>
                @endif

                @can('create_users')
                {{-- courier_sheet --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-address-book pe-3"></i>
                        <span class="side-menu__label">@lang('app.courier_sheet')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create_users')
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('courier-sheets.index'))}}"
                                href="{{route('courier-sheets.index')}}">@lang('app.courier_sheet')</a></li>
                        @endcan
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('courier-sheets.admin'))}}"
                                href="{{route('courier-sheets.admin')}}">@lang('courier admin')</a></li>
                    </ul>
                </li>
                @endcan

                @can('view_settings')
                {{-- accounting --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fas fa-calculator pe-3"></i>
                        <span class="side-menu__label">@lang('app.accounting')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create_users')
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('invoices.create'))}}"
                                href="{{route('invoices.create')}}">@lang('create invoice')</a></li>
                        <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('invoices.index'))}}"
                                href="{{route('invoices.index')}}">@lang('all invoices')</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @endif



                <li class="side-item side-item-category">@lang('app.companies_receivers')</li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-building pe-3"></i>
                        <span class="side-menu__label">@lang('app.companies_receivers')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        @can('view_receivers')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('receivers.index'))}}"
                                href="{{route('receivers.index')}}">@lang('app.receivers')</a></li>
                        @endcan
                        @if(Auth::user()->type != \App\Enums\UsersType::ADMIN->value)
                        @can('view_companies')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('companies.index'))}}"
                                href="{{route('companies.index')}}">@lang('app.companies')</a></li>
                        @endcan
                        @endif
                    </ul>
                </li>

                @if(Auth::user()->type != \App\Enums\UsersType::ADMIN->value)
                @can('view_price_tables')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-money-bill-alt pe-3"></i>
                        <span class="side-menu__label">@lang('app.price_table')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        @can('create_price_tables')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('prices.create'))}}"
                                href="{{route('prices.create')}}">@lang('app.new_price_table')</a></li>
                        @endcan
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('prices.index'))}}"
                                href="{{route('prices.index')}}">@lang('app.price_tables')</a></li>
                    </ul>
                </li>
                @endcan


                @can('view_shipment_status')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-exchange-alt pe-3"></i>
                        <span class="side-menu__label">@lang('app.awb_status')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        @can('create_shipment_status')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awb-status.create'))}}"
                                href="{{route('awb-status.create')}}">@lang('app.new_awb_status')</a></li>
                        @endcan
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('awb-status.index'))}}"
                                href="{{route('awb-status.index')}}">@lang('app.all_status')</a></li>
                    </ul>
                </li>
                @endcan

                @endif

                {{-- @can('view_shipment_status') --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-file-import pe-3"></i>
                        <span class="side-menu__label">@lang('app.imports_logs')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('import-logs.index'))}}"
                                href="{{route('import-logs.index')}}">@lang('app.imports_logs')</a></li>
                    </ul>
                </li>
                {{-- @endcan --}}
                @if(Auth::user()->type != \App\Enums\UsersType::ADMIN->value)
                <li class="side-item side-item-category">@lang('app.users')</li>

                @can('view_users')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-users pe-3"></i>
                        <span class="side-menu__label">@lang('app.users')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        @can('create_users')
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('users.create'))}}"
                                href="{{route('users.create')}}">@lang('app.new_user')</a></li>
                        @endcan
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('users.index'))}}"
                                href="{{route('users.index')}}">@lang('app.users')</a></li>
                    </ul>
                </li>
                @endcan

                @can('view_users')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-industry pe-3"></i>
                        <span class="side-menu__label">@lang('app.offices')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('offices.create'))}}"
                                href="{{route('offices.create')}}">@lang('app.new_office')</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('offices.index'))}}"
                                href="{{route('offices.index')}}">@lang('app.offices')</a></li>
                    </ul>
                </li>
                @endcan

                @can('view_settings')
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z" />
                            <path
                                d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z" />
                            <path
                                d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z" />
                        </svg>
                        <span class="side-menu__label">@lang('app.settings')</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">@lang('app.settings')</a></li>
                        {{-- <li><a class="sub-side-menu__item"
                                href="{{route('switcherpage')}}">@lang('app.dashboard_settings')</a></li> --}}

                        <li><a class="slide-item" href="{{route('languages.translations.index',
                        config('app.locale'))}}">@lang('app.translation')</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('locations.index'))}}"
                                href="{{route('locations.index')}}">@lang('app.locations')</a></li>
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('services.index'))}}"
                                href="{{route('services.index')}}">@lang('app.services')</a></li>
                        {{-- <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('payments.index'))}}"
                                href="{{route('payments.index')}}">@lang('app.payments')</a></li> --}}
                        <li><a class="slide-item" data-is_active="{{request()->fullUrlIs(route('roles.index'))}}"
                                href="{{route('roles.index')}}">@lang('app.roles')</a></li>
                        {{-- <li><a class="slide-item"
                                data-is_active="{{request()->fullUrlIs(route('permissions.index'))}}"
                                href="{{route('permissions.index')}}">@lang('app.permissions')</a></li> --}}
                    </ul>
                </li>
                @endcan
                @endif
                {{-- start suport board --}}
                <li class="slide text-center">
                    @if(Auth::user()->type == \App\Enums\UsersType::SUPERADMIN->value)
                    <a href="http://app.ufs-eg.com/supportboard/admin.php"
                        class="btn btn-default text-primary border-primary">
                        @lang('app.support_and_docs')</a>
                    @else
                    <a href="{{ route('users.support') }}" class="btn btn-default text-primary border-primary">
                        @lang('app.support_and_docs')</a>
                    @endif
                </li>
                {{-- end support board --}}
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
<!-- main-sidebar -->
