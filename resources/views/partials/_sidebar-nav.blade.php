<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('dashboard')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <div class="pcoded-navigatio-lavel">Policy Documentation</div>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-car-alt-4"></i></span>
                    <span class="pcoded-mtext">Motor Policy</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ url('/policy/create-motor-policy') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">Add New Motor</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/policy/motor') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">All Motors</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-plane-ticket"></i></span>
                    <span class="pcoded-mtext">Non-motor Policy</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ url('/policy/create') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">Add New Non-motor</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/policy') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">All Non-motors</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{url('policy/debit-notes')}}">
                    <span class="pcoded-micon"><i class="icofont icofont-notepad"></i></span>
                    <span class="pcoded-mtext">Debit Notes</span>
                </a>
            </li>
            <li class="">
                <a href="/policy/credit-notes">
                    <span class="pcoded-micon"><i class="icofont icofont-notepad"></i></span>
                    <span class="pcoded-mtext">Credit Notes</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-user"></i></span>
                    <span class="pcoded-mtext">Clients</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ url('/policy/add-client') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">Add New Client</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/policy/clients') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">All Clients</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-certificate-alt-1"></i></span>
                    <span class="pcoded-mtext">Claims</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{ url('/policy/claim/new') }}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">Add New Claim</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('/policy/claims')}}">
                            <span class="pcoded-micon"><i class="ti-users"></i></span>
                            <span class="pcoded-mtext">All Claims</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <div class="pcoded-navigatio-lavel">Administration</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-brainstorming"></i></span>
                    <span class="pcoded-mtext">Human Resource</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ url('/human-resource/add-new-employee') }}">
                            <span class="pcoded-mtext">Add New Employee</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ url('/human-resource') }}">
                            <span class="pcoded-mtext">All Employees</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/human-resource/manage-roles')}}">
                            <span class="pcoded-mtext">Roles</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/human-resource/manage-roles')}}">
                            <span class="pcoded-mtext">Permissions</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ url('/human-resource/settings') }}">
                            <span class="pcoded-mtext"> Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Accounting</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-money-bag"></i></span>
                    <span class="pcoded-mtext">Accounting</span>
                </a>

                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('accounting')}}">
                            <span class="pcoded-mtext">Chart of Accounts</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('accounting/journal-voucher')}}">
                            <span class="pcoded-mtext">Journal Voucher</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/accounting/trial-balance')}}">
                            <span class="pcoded-mtext">Trial Balance</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/accounting/balance-sheet')}}">
                            <span class="pcoded-mtext">Balance Sheet</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/accounting/profit-or-loss')}}">
                            <span class="pcoded-mtext">Profit/Loss</span>
                        </a>
                    </li>
                </ul>

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="icofont icofont-barcode"></i></span>
                        <span class="pcoded-mtext">Customers</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{url('/accounting/generate-receipt')}}">
                                <span class="pcoded-mtext">Generate Receipt</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('/accounting/receipts')}}">
                                <span class="pcoded-mtext">All Receipts</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <div class="pcoded-navigatio-lavel">Reports</div>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="icofont icofont-chart-bar-graph"></i></span>
                        <span class="pcoded-mtext">Reports</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{route('show-naicom-report')}}">
                                <span class="pcoded-mtext">NAICOM</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Motor</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Non-Motor</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Debit Note</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Credit Note</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Claims</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);" onclick="alert('Currently disabled. Contact Admin');">
                                <span class="pcoded-mtext">Clients</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <div class="pcoded-navigatio-lavel">Settings</div>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="icofont icofont-settings-alt"></i></span>
                        <span class="pcoded-mtext">Settings</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="{{url('/company-settings')}}">
                                <span class="pcoded-mtext">General Settings</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('policy/policy-settings')}}">
                                <span class="pcoded-mtext">Policy Settings</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{url('accounting/account-settings')}}">
                                <span class="pcoded-mtext">Account Settings</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{url('human-resource/settings')}}">
                                <span class="pcoded-mtext">HR Settings</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class=" ">
                    <a href="{{route('logout')}}">
                        <span class="pcoded-micon"><i class="icofont icofont-ui-power text-danger"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </li>
        </ul>
    </div>
</nav>
