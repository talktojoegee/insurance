        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="icofont icofont-navigation-menu"></i>
                    </a>
                    <a href="index-1.htm">
                        <img class="img-fluid" style="width: 154px; height: 44px;" src="/assets/attachments/assets/logo/{{\Modules\CompanySettings\Entities\SettingsGeneral::getCompanyGeneralSettings()->company_logo ?? 'logo.jpg'}}" alt="{{ config('app.name') }}">
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">

                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{url('storage/'.Auth::user()->avatar ?? '\assets\images\male.jpeg')}} " class="img-radius" alt="{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}">
                                    <span>{{Auth::user()->first_name ?? ''}} {{Auth::user()->last_name ?? ''}}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="{{route('employee-settings', Auth::user()->url)}}">
                                            <i class="feather icon-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('employee-profile', Auth::user()->url)}}">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('logout')}}">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
