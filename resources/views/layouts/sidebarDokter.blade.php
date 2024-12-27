<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dokter.dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Data Management -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#kelolaData" aria-expanded="false" aria-controls="kelolaData">
                <i class="menu-icon mdi mdi-database"></i>
                <span class="menu-title">Kelola Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="kelolaData">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokter.edit') }}">
                            <i class="mdi mdi-account-circle-outline"></i> Data Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokter.schedule') }}">
                            <i class="mdi mdi-calendar"></i> Jadwal
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Pemeriksaan -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('periksa.list') }}">
                <i class="mdi mdi-stethoscope menu-icon"></i>
                <span class="menu-title">Pemeriksaan</span>
            </a>
        </li>

        <!-- Riwayat Pemeriksaan -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('periksa.riwayat') }}">
                <i class="mdi mdi-history menu-icon"></i>
                <span class="menu-title">Riwayat Pemeriksaan</span>
            </a>
        </li>
        {{-- Riwayat Pasien --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dokter.riwayatPasien') }}">
                <i class="mdi mdi-account-group-outline menu-icon"></i>
                <span class="menu-title
                ">Riwayat Pasien</span>
            </a>
        </li>
        
        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
