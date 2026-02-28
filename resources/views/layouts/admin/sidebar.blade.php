<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark bg-dark shadow-lg">
  <div class="container-fluid">

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Logo -->
    <a href="/" class="navbar-brand navbar-brand-autodark text-center py-3">
      <img src="{{ asset('tabler/dist/img/ppsdm1.png') }}" alt="Logo" class="navbar-brand-image" width="170">
    </a>

    <!-- Sidebar Menu -->
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="navbar-nav pt-lg-3">

        <!-- HOME -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('panel/dashboardadmin') ? 'active' : '' }}" href="/panel/dashboardadmin" aria-current="page">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
              </svg>
            </span>
            <span class="nav-link-title">Home</span>
          </a>
        </li>

        <!-- MASTER DATA DROPDOWN -->
        @php
          $masterActive = request()->is('karyawan') || request()->is('departemen');
        @endphp
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#interfaceMenuMaster" role="button" aria-expanded="{{ $masterActive ? 'true' : 'false' }}" aria-controls="interfaceMenuMaster">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
              </svg>
            </span>
            <span class="nav-link-title">Master Data</span>
          </a>
          <div class="collapse {{ $masterActive ? 'show' : '' }}" id="interfaceMenuMaster">
            <ul class="nav nav-sm flex-column ms-3 sidebar-submenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('karyawan') ? 'active' : '' }}" href="/karyawan">
                  <span class="bullet"></span>Karyawan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('departemen') ? 'active' : '' }}" href="/departemen">
                  <span class="bullet"></span>Department
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- ATTENDANCE MONITORING -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('presensi/monitoring') ? 'active' : '' }}" href="/presensi/monitoring">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10" />
                <path d="M7 20h10" />
                <path d="M9 16v4" />
                <path d="M15 16v4" />
                <path d="M7 10h2l2 3l2 -6l1 3h3" />
              </svg>
            </span>
            <span class="nav-link-title">Attendance Monitoring</span>
          </a>
        </li>

        <!-- LEAVE REQUEST -->
        <li class="nav-item">
          <a class="nav-link {{ request()->is('presensi/izinsakit') ? 'active' : '' }}" href="/presensi/izinsakit">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10" />
                <path d="M7 20h10" />
                <path d="M9 16v4" />
                <path d="M15 16v4" />
                <path d="M7 10h2l2 3l2 -6l1 3h3" />
              </svg>
            </span>
            <span class="nav-link-title">Leave Request</span>
          </a>
        </li>

        <!-- REPORT DROPDOWN -->
        @php
          $reportActive = request()->is('presensi/laporan') || request()->is('presensi/rekap');
        @endphp
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#interfaceMenuReport" role="button" aria-expanded="{{ $reportActive ? 'true' : 'false' }}" aria-controls="interfaceMenuReport">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                <path d="M9 17h6" />
                <path d="M9 13h6" />
              </svg>
            </span>
            <span class="nav-link-title">Report</span>
          </a>
          <div class="collapse {{ $reportActive ? 'show' : '' }}" id="interfaceMenuReport">
            <ul class="nav nav-sm flex-column ms-3 sidebar-submenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('presensi/laporan') ? 'active' : '' }}" href="/presensi/laporan">
                  <span class="bullet"></span>Attendance Report
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('presensi/rekap') ? 'active' : '' }}" href="/presensi/rekap">
                  <span class="bullet"></span>Attendance Record
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- CONFIGURATION DROPDOWN -->
        @php
          $configActive = request()->is('konfigurasi/lokasikantor');
        @endphp
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#interfaceMenuConfig" role="button" aria-expanded="{{ $configActive ? 'true' : 'false' }}" aria-controls="interfaceMenuConfig">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065" />
                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
              </svg>
            </span>
            <span class="nav-link-title">Configuration</span>
          </a>
          <div class="collapse {{ $configActive ? 'show' : '' }}" id="interfaceMenuConfig">
            <ul class="nav nav-sm flex-column ms-3 sidebar-submenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->is('konfigurasi/lokasikantor') ? 'active' : '' }}" href="/konfigurasi/lokasikantor">
                  <span class="bullet"></span>Office Location
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</aside>

<!-- Tambahkan CSS yang telah ditingkatkan -->
<style>
  :root {
    --sidebar-bg: #1a1e24;
    --sidebar-hover: rgba(255, 255, 255, 0.05);
    --sidebar-active-bg: linear-gradient(90deg, rgba(13,110,253,0.2) 0%, rgba(13,110,253,0.05) 100%);
    --sidebar-active-border: #0d6efd;
    --sidebar-icon-color: #a0a8b8;
    --sidebar-text-color: #e0e5ec;
    --sidebar-submenu-bg: rgba(0, 0, 0, 0.2);
  }

  .navbar-vertical {
    background-color: var(--sidebar-bg) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
  }

  .navbar-vertical .nav-link {
    position: relative;
    border-radius: 0.5rem;
    margin: 0.25rem 0.5rem;
    padding: 0.75rem 1rem;
    color: var(--sidebar-text-color);
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .navbar-vertical .nav-link:hover {
    background-color: var(--sidebar-hover);
    transform: translateX(4px);
    color: #ffffff;
  }

  .navbar-vertical .nav-link:hover .nav-link-icon {
    color: #ffffff;
    opacity: 1;
  }

  /* Active link dengan garis tepi kiri dan gradasi */
  .navbar-vertical .nav-link.active {
    background: var(--sidebar-active-bg);
    border-left: 4px solid var(--sidebar-active-border);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    color: #ffffff;
    font-weight: 500;
  }

  .navbar-vertical .nav-link.active .nav-link-icon {
    color: var(--sidebar-active-border);
    opacity: 1;
  }

  .navbar-vertical .nav-link .nav-link-icon {
    color: var(--sidebar-icon-color);
    opacity: 0.9;
    transition: all 0.2s;
    width: 1.5rem;
    text-align: center;
  }

  .nav-link-title {
    flex: 1;
  }

  /* Dropdown toggle arrow styling */
  .dropdown-toggle::after {
    border: none;
    content: "›";
    font-size: 1.2rem;
    line-height: 1;
    transform: rotate(90deg);
    transition: transform 0.2s;
    vertical-align: middle;
    color: var(--sidebar-icon-color);
  }

  .dropdown-toggle[aria-expanded="true"]::after {
    transform: rotate(270deg);
  }

  /* Submenu styling */
  .sidebar-submenu {
    background-color: var(--sidebar-submenu-bg);
    border-radius: 0.5rem;
    margin-top: 0.25rem;
    margin-bottom: 0.25rem;
    padding: 0.25rem 0;
    list-style: none;
  }

  .sidebar-submenu .nav-link {
    padding: 0.5rem 1rem 0.5rem 2rem;
    margin: 0.125rem 0.25rem;
    font-size: 0.9rem;
    border-left: none;
    background: transparent;
    position: relative;
  }

  .sidebar-submenu .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.05);
    transform: translateX(2px);
  }

  .sidebar-submenu .nav-link.active {
    background: rgba(13, 110, 253, 0.1);
    border-left: 3px solid var(--sidebar-active-border);
    font-weight: 500;
  }

  .bullet {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: currentColor;
    margin-right: 0.5rem;
    opacity: 0.6;
    transition: all 0.2s;
  }

  .sidebar-submenu .nav-link:hover .bullet {
    opacity: 1;
    transform: scale(1.2);
  }

  .sidebar-submenu .nav-link.active .bullet {
    background-color: var(--sidebar-active-border);
    opacity: 1;
  }

  /* Tambahkan garis pemisah antar menu (opsional) */
  .navbar-nav > .nav-item:not(:last-child) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.03);
    margin-bottom: 0.25rem;
    padding-bottom: 0.25rem;
  }

  /* Scrollbar halus untuk sidebar yang panjang */
  .navbar-vertical {
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.2) transparent;
  }

  .navbar-vertical::-webkit-scrollbar {
    width: 5px;
  }

  .navbar-vertical::-webkit-scrollbar-track {
    background: transparent;
  }

  .navbar-vertical::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.2);
    border-radius: 20px;
  }
</style>