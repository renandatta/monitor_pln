<!DOCTYPE html>
<html lang="en" >
<head><base href="../../">
    <meta charset="utf-8"/>
    <title>@yield('title') {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}"/>
    <style>

    </style>
    @stack('styles')
</head>
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled page-loading"  >

<div id="kt_header_mobile" class="header-mobile bg-primary  header-mobile-fixed " >
    <a href="">
        <img alt="Logo" src="{{ asset('assets/media/logos/logo-letter-9.png') }}" class="max-h-30px"/>
    </a>

    <div class="d-flex align-items-center">

        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>

        <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
			<span class="svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                </svg>
            </span>
        </button>
    </div>
</div>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <div id="kt_header" class="header flex-column  header-fixed " >
                <div class="header-top">
                    <div class=" container ">
                        <div class="d-none d-lg-flex align-items-center mr-3">
                            <a href="" class="mr-20">
                                <img alt="Logo" src="{{ asset('img/logo.png') }}" class="max-h-35px"/>
                            </a>
                        </div>

                        <div class="topbar">
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                    <div class="d-flex flex-column text-right pr-3">
                                        <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline">{{ Auth::user()->name }}</span>
                                        <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{ Auth::user()->user_level }}</span>
                                    </div>
                                    <img alt="Logo" src="{{ asset('img/user.png') }}" class="max-h-35px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-bottom">
                    <div class="container">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a href="{{ route('/') }}" class="menu-link">
                                            <span class="menu-text">Home</span>
                                            <span class="menu-desc">Ringkasan Informasi</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                            <span class="menu-text">Master</span>
                                            <span class="menu-desc">Data Utama</span>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('kontraktor') }}" class="menu-link"><span class="menu-text">Kontraktor</span></a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('petugas') }}" class="menu-link"><span class="menu-text">Petugas</span></a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('grup_slo') }}" class="menu-link"><span class="menu-text">Grup SLO</span></a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('item_kelengkapan') }}" class="menu-link"><span class="menu-text">Item Kelengkapan</span></a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('item_progres') }}" class="menu-link"><span class="menu-text">Item Progres</span></a>
                                                </li>
                                                <li class="menu-item" aria-haspopup="true">
                                                    <a href="{{ route('user') }}" class="menu-link"><span class="menu-text">User</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a href="{{ route('jalur') }}" class="menu-link">
                                            <span class="menu-text">Jalur</span>
                                            <span class="menu-desc">Gardu Induk</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a href="{{ route('instalasi') }}" class="menu-link">
                                            <span class="menu-text">Instalasi</span>
                                            <span class="menu-desc">Lingkup Instalasi</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a href="{{ route('/') }}" class="menu-link">
                                            <span class="menu-text">Kelengkapan</span>
                                            <span class="menu-desc">Kelengkapan Instalasi</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a href="{{ route('/') }}" class="menu-link">
                                            <span class="menu-text">Progres</span>
                                            <span class="menu-desc">Progres Instalasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
                <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">2020&copy;</span>
                        <a class="text-dark-75 text-hover-primary">PLN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            User Profile
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>

    <div class="offcanvas-content pr-5 mr-n5">
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('{{ asset('img/user.png') }}')"></div>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {{ Auth::user()->name }}
                </a>
                <div class="text-muted mt-1">
                    {{ Auth::user()->user_level }}
                </div>
                <div class="navi mt-2">
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#0BB783",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#D7F9EF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js?v=7.0.6') }}"></script>

<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js?v=7.0.6') }}"></script>

<script src="{{ asset('assets/js/pages/widgets.js?v=7.0.6') }}"></script>

<script>
    $('.select2').select2();
    $('.kt-selectpicker').selectpicker();
</script>
@stack('scripts')
</body>
</html>
