@include('partials._header')

<body>
@include('partials._loader')
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('partials._top-bar')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('partials._sidebar-nav')
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="row align-items-end mb-3">
                                        <div class="col-lg-12">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>@yield('current-page')</h4>
                                                    <span>@yield('current-page-brief')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        @yield('main-content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@yield('dialog-section')
@include('partials._footer-scripts')
