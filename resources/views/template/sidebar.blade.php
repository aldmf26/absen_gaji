<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('/') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assets') }}/img/logo.jpg" width="80%" alt="">
            </div>
            <div class="sidebar-brand-text mx-3"><span style="font-size: 15px">KOPERASI HARUM MANIS</span></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Home -->
        @if (Auth::user()->role_id == 3)
            <li class="nav-item {{ Request::is('welcome') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('welcome') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>

            <li class="nav-item {{ Request::is('absen') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('absen') }}">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Absensi</span></a>
            </li>
            <li class="nav-item {{ Request::is('rGajiKaryawan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('rGajiKaryawan') }}">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Rekap Gaji</span></a>
            </li>
            <li class="nav-item {{ Request::is('gaji') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gaji') }}">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Data Karyawan</span></a>
            </li>
            <li class="nav-item {{ Request::is('kasbon') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kasbon') }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Data Kasbon</span></a>
            </li>
            <li class="nav-item {{ Request::is('denda') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('denda') }}">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Data Denda</span></a>
            </li>
            <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-key"></i>
                    <span>Manajemen User</span></a>
            </li>
        @endif
        @if (Auth::user()->role_id == 1)
            <li class="nav-item {{ Request::is('welcome') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('welcome') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span></a>
            </li>

            <li class="nav-item {{ Request::is('absen') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('absen') }}">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Absensi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('karyawan') ? 'active' : '' }}"
                            href="{{ route('karyawan') }}">Data Karyawan</a>
                        <a class="collapse-item {{ Request::is('gaji') ? 'active' : '' }}"
                            href="{{ route('gaji') }}">Data Gaji</a>
                        <a class="collapse-item {{ Request::is('kasbon') ? 'active' : '' }}"
                            href="{{ route('kasbon') }}">Data Kasbon</a>
                        <a class="collapse-item {{ Request::is('denda') ? 'active' : '' }}"
                            href="{{ route('denda') }}">Data Denda</a>
                        <a class="collapse-item {{ Request::is('status') ? 'active' : '' }}"
                            href="{{ route('status') }}">Status Absen</a>
                        <a class="collapse-item {{ Request::is('lokasi') ? 'active' : '' }}"
                            href="{{ route('lokasi') }}">Lokasi</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Laporan</span>
                </a>
                <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item {{ Request::is('view') ? 'active' : '' }}"
                            href="{{ route('view', ['menu' => 'rAbsen']) }}">Rekap Absen</a>
                        <a class="collapse-item {{ Request::is('view') ? 'active' : '' }}"
                            href="{{ route('view', ['menu' => 'rGaji']) }}">Rekap Gaji</a>
                            <a class="collapse-item {{ Request::is('lapKasbon') ? 'active' : '' }}"
                                href="{{ route('lapKasbon') }}">Rekap Kasbon</a>
                            <a class="collapse-item {{ Request::is('lapDenda') ? 'active' : '' }}"
                                href="{{ route('lapDenda') }}">Rekap Denda</a>
                        <a class="collapse-item {{ Request::is('lapKaryawan') ? 'active' : '' }}"
                            href="{{ route('lapKaryawan') }}">Data Karyawan</a>
                        <a class="collapse-item {{ Request::is('lapAbsen') ? 'active' : '' }}"
                            href="{{ route('lapAbsen') }}">Data Absensi</a>
                        <a class="collapse-item {{ Request::is('lapDataKasbon') ? 'active' : '' }}"
                            href="{{ route('lapDataKasbon') }}">Data Kasbon</a>
                        <a class="collapse-item {{ Request::is('lapDataDenda') ? 'active' : '' }}"
                            href="{{ route('lapDataDenda') }}">Data Denda</a>
                        <a class="collapse-item {{ Request::is('laporanKaryawan') ? 'active' : '' }}"
                            href="{{ route('laporanKaryawan') }}">Gaji Karyawan</a>
                        <a class="collapse-item {{ Request::is('laporanLokasi') ? 'active' : '' }}"
                            href="{{ route('laporanLokasi') }}">lokasi</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-key"></i>
                    <span>Manajemen User</span></a>
            </li>
        @endif
        @if (Auth::user()->role_id == 2)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Laporan</span>
                </a>
                <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item {{ Request::is('view') ? 'active' : '' }}"
                            href="{{ route('view', ['menu' => 'rAbsen']) }}">Rekap Absen</a>
                        <a class="collapse-item {{ Request::is('view') ? 'active' : '' }}"
                            href="{{ route('view', ['menu' => 'rGaji']) }}">Rekap Gaji</a>
                            <a class="collapse-item {{ Request::is('lapKasbon') ? 'active' : '' }}"
                                href="{{ route('lapKasbon') }}">Rekap Kasbon</a>
                            <a class="collapse-item {{ Request::is('lapDenda') ? 'active' : '' }}"
                                href="{{ route('lapDenda') }}">Rekap Denda</a>
                        <a class="collapse-item {{ Request::is('lapKaryawan') ? 'active' : '' }}"
                            href="{{ route('lapKaryawan') }}">Data Karyawan</a>
                        <a class="collapse-item {{ Request::is('lapAbsen') ? 'active' : '' }}"
                            href="{{ route('lapAbsen') }}">Data Absensi</a>
                        <a class="collapse-item {{ Request::is('lapDataKasbon') ? 'active' : '' }}"
                            href="{{ route('lapDataKasbon') }}">Data Kasbon</a>
                        <a class="collapse-item {{ Request::is('lapDataDenda') ? 'active' : '' }}"
                            href="{{ route('lapDataDenda') }}">Data Denda</a>
                        <a class="collapse-item {{ Request::is('laporanKaryawan') ? 'active' : '' }}"
                            href="{{ route('laporanKaryawan') }}">Gaji Karyawan</a>
                        <a class="collapse-item {{ Request::is('laporanLokasi') ? 'active' : '' }}"
                            href="{{ route('laporanLokasi') }}">lokasi</a>
                    </div>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link btn" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                <span>Logout</span></a>
        </li>





    </ul>
    <!-- End of Sidebar -->
