<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pasien.dashboard') }}">
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
                        <a class="nav-link" href="{{ route('poli.schedule') }}">
                            <i class="mdi mdi-doctor"></i> Daftar Poli
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
