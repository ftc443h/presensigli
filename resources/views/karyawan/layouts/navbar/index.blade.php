<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
        <div class="container-xl">
            <div class="row flex-column flex-md-row flex-fill align-items-center">
                <div class="col">
                    <!-- BEGIN NAVBAR MENU -->
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::is('dashboard-karyawan/dashboard') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('karyawan.dashboard') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg></span>
                                <span class="nav-link-title"> Home </span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ (Request::is('rekap-presensi/rekap-harian') ? 'active' : '' || Request::is('rekap-presensi/rekap-bulanan')) ? 'active' : '' }} dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-notes">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                        <path d="M9 7l6 0" />
                                        <path d="M9 11l6 0" />
                                        <path d="M9 15l4 0" />
                                    </svg>
                                </span>
                                <span class="nav-link-title"> Rekap Presensi </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{ route('rekap-harian.karyawan.index') }}">
                                            Rekap Harian
                                        </a>
                                        <a class="dropdown-item" href="{{ route('rekap-bulanan.karyawan.index') }}">
                                            Rekap Bulanan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item {{ Request::is('ketidakhadiran/ketidakhadiran') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ketidakhadiran.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square-rounded">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                        <path d="M12 8v4" />
                                        <path d="M12 16h.01" />
                                    </svg>
                                </span>
                                <span class="nav-link-title"> Ketidakhadiran </span>
                            </a>
                        </li>
                    </ul>
                    <!-- END NAVBAR MENU -->
                </div>
                <div class="col col-md-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="nav-link" href=""
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                            <path d="M9 12h12l-3 -3" />
                                            <path d="M18 15l3 -3" />
                                        </svg></span>
                                    <span class="nav-link-title"> Log Out </span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
