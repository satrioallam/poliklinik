<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>

        <!-- Data Management -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#datamaster" aria-expanded="false" aria-controls="datamaster">
                <i class="menu-icon mdi mdi-folder-multiple"></i>
                <span class="menu-title">Kelola Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="datamaster">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokter.index') }}">
                            <i class="mdi mdi-doctor"></i> Data Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.index') }}">
                            <i class="mdi mdi-account-multiple"></i> Data Pasien
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('poli.index') }}">
                            <i class="mdi mdi-hospital-building"></i> Data Poli
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('obat.index') }}">
                            <i class="mdi mdi-pill"></i> Data Obat
                        </a>
                    </li>
                </ul>
            </div>
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