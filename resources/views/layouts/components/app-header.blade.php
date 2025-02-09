<!-- main-header -->
<div class="main-header side-header sticky nav nav-item">
    <div class=" main-container container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{url('/')}}" class="header-logo">
                    <img style="max-height: 40px !important" src="{{asset('assets/images/brand/logo.png')}}"
                        class="mobile-logo wd-25p" alt="logo">
                </a>
            </div>
            <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                <a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
            </div>
            <div class="logo-horizontal">
                <a href="{{url('/')}}" class="header-logo">
                    <img style="max-height: 40px !important" src="{{asset('assets/images/brand/logo.png')}}"
                        class="mobile-logo wd-25p" alt="logo">
                </a>
            </div>
        </div>
        <div class="main-header-right">
            <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fe fe-more-vertical "></span>
            </button>
            <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <ul class="nav nav-item header-icons navbar-nav-right ms-auto">
                        <li class="nav-link search-icon d-block">
                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                        <button type="reset" class="btn btn-default">

                                        </button>
                                        <button type="submit" class="btn btn-default nav-link resp-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                class="header-icon-svgs" viewBox="0 0 24 24" width="24px"
                                                fill="#000000">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </li>
                        <li class="dropdown nav-item mt-2">
                            <a class="new nav-link" data-bs-target="#country-selector" data-bs-toggle="modal"
                                href=""><svg class="header-icon-svgs" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm7.931 9h-2.764a14.67 14.67 0 0 0-1.792-6.243A8.013 8.013 0 0 1 19.931 11zM12.53 4.027c1.035 1.364 2.427 3.78 2.627 6.973H9.03c.139-2.596.994-5.028 2.451-6.974.172-.01.344-.026.519-.026.179 0 .354.016.53.027zm-3.842.7C7.704 6.618 7.136 8.762 7.03 11H4.069a8.013 8.013 0 0 1 4.619-6.273zM4.069 13h2.974c.136 2.379.665 4.478 1.556 6.23A8.01 8.01 0 0 1 4.069 13zm7.381 6.973C10.049 18.275 9.222 15.896 9.041 13h6.113c-.208 2.773-1.117 5.196-2.603 6.972-.182.012-.364.028-.551.028-.186 0-.367-.016-.55-.027zm4.011-.772c.955-1.794 1.538-3.901 1.691-6.201h2.778a8.005 8.005 0 0 1-4.469 6.201z" />
                                </svg></a>
                        </li>

                        <li class="nav-item ">
                            <div class="mt-2 p-2 mx-auto">
                                <h6>@lang("app.hi") {{auth()->user()->name}}</h6>
                            </div>
                        </li>
                        <li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
                            <a class="new nav-link profile-user d-flex main-img-user" href=""
                                data-bs-toggle="dropdown"><img alt="" src="{{ asset(Auth::user()->profileImage??'assets/images/users/default.png') }}"
                                    class=""></a>
                            <div class="dropdown-menu">
                                <div class="menu-header-content p-3 border-bottom">
                                    <div class="d-flex wd-100p">
                                        <div class="main-img-user"><img alt=""
                                                src="{{ asset(Auth::user()->profileImage??'assets/images/users/default.png') }}" class=""></div>
                                        <div class="ms-3 my-auto">
                                            <h6 class="tx-15 font-weight-semibold mb-0">{{auth()->user()->name}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{route('profile.index')}}"><i
                                        class="far fa-user-circle"></i>Profile</a>
                                <a class="dropdown-item" href="{{route('logout')}}"><i
                                        class="far fa-arrow-alt-circle-left"></i> Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--place for switcher icon-->
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->