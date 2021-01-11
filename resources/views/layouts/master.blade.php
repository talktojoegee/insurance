@include('partials._header')

<body>
@include('partials._loader')
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('partials._top-bar')

            <!-- sidebar chat was here -->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('partials._sidebar-nav')

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
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
