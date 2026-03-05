@extends('layouts.presensi')
@section('content')
<style>
    /* === Custom Style untuk Dashboard Modern === */
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --info: #4895ef;
        --warning: #f72585;
        --danger: #e63946;
        --light: #f8f9fa;
        --dark: #212529;
        --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 10px 40px rgba(0,0,0,0.08);
        --hover-shadow: 0 15px 50px rgba(0,0,0,0.12);
    }

    body {
        background: #f5f7ff;
        font-family: 'Inter', sans-serif;
    }

    /* Header User */
    #user-section {
        background: var(--bg-gradient);
        padding: 25px 20px 35px 20px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        position: relative;
        box-shadow: var(--card-shadow);
        margin-bottom: 20px;
        color: white;
    }
    .logout {
        position: absolute;
        top: 20px;
        right: 20px;
        color: rgba(255,255,255,0.8) !important;
        font-size: 28px;
        transition: all 0.3s;
        z-index: 10;
    }
    .logout:hover {
        color: white !important;
        transform: scale(1.1);
    }
    #user-detail {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .avatar {
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        overflow: hidden;
        width: 70px;
        height: 70px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    #user-info h2 {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 0;
        letter-spacing: 0.5px;
    }
    #user-info span {
        font-size: 0.9rem;
        opacity: 0.9;
        display: block;
        margin-top: 4px;
    }

    /* Menu Section */
    #menu-section .card {
        background: transparent;
        border: none;
        box-shadow: none;
    }
    .list-menu {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 10px;
    }
    .item-menu {
        flex: 1 1 auto;
        min-width: 70px;
        background: white;
        border-radius: 20px;
        padding: 15px 5px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s;
    }
    .item-menu:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }
    .menu-icon a {
        display: block;
        color: var(--primary) !important;
        transition: color 0.3s;
    }
    .menu-icon a:hover {
        color: var(--secondary) !important;
    }
    .menu-name span {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--dark);
    }

    /* Presence Cards */
    .todaypresence .card {
        border: none;
        border-radius: 25px;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s;
    }
    .todaypresence .card:hover {
        transform: scale(1.02);
    }
    .gradasigreen {
        background: linear-gradient(145deg, #2ecc71, #27ae60);
        color: white;
    }
    .gradasired {
        background: linear-gradient(145deg, #e74c3c, #c0392b);
        color: white;
    }
    .presencecontent {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .iconpresence ion-icon {
        font-size: 48px;
        color: rgba(255,255,255,0.9);
    }
    .iconpresence img {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid white;
    }
    .presencedetail h4 {
        font-size: 1rem;
        margin: 0;
        font-weight: 500;
        opacity: 0.9;
    }
    .presencedetail span {
        font-size: 1.4rem;
        font-weight: 700;
        display: block;
        line-height: 1.2;
    }

    /* Rekap Presensi */
    #rekappresensi h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 25px 0 15px 0;
    }
    #rekappresensi .card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    #rekappresensi .card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }
    #rekappresensi .card-body {
        position: relative;
        z-index: 2;
    }
    #rekappresensi .badge {
        font-size: 0.7rem;
        padding: 4px 6px;
        border-radius: 50px;
    }
    #rekappresensi ion-icon {
        font-size: 2rem;
        margin-bottom: 8px;
        color: var(--primary);
    }
    #rekappresensi span[style*="font-size: 0.8rem"] {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--dark);
    }

    /* Tabs */
    .presencetab .nav-tabs {
        border: none;
        background: white;
        border-radius: 30px;
        padding: 5px;
        box-shadow: var(--card-shadow);
    }
    .presencetab .nav-tabs .nav-link {
        border: none;
        color: var(--dark);
        font-weight: 500;
        padding: 10px 25px;
        border-radius: 30px;
        transition: all 0.3s;
    }
    .presencetab .nav-tabs .nav-link.active {
        background: var(--bg-gradient);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* Listview */
    .listview.image-listview {
        background: transparent;
    }
    .listview .item {
        background: white;
        border-radius: 15px;
        padding: 12px 15px;
        margin-bottom: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s;
        display: flex;
        align-items: center;
    }
    .listview .item:hover {
        box-shadow: var(--card-shadow);
        transform: translateX(5px);
    }
    .icon-box {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-gradient);
        color: white;
        font-size: 24px;
        margin-right: 15px;
    }
    .listview .in {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .listview .in div {
        font-weight: 500;
        color: var(--dark);
    }
    .listview .badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    /* Leaderboard */
    #profile .item img.image {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid var(--primary);
    }
    #profile .badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 500;
    }
    .bg-success {
        background: linear-gradient(145deg, #2ecc71, #27ae60) !important;
    }
    .bg-danger {
        background: linear-gradient(145deg, #e74c3c, #c0392b) !important;
    }

    /* Bottom spacing */
    .tab-content {
        margin-bottom: 80px;
    }
</style>

<!-- === USER SECTION === -->
<div class="section" id="user-section">
    <a href="/proseslogout" class="logout">
        <ion-icon name="log-out-outline"></ion-icon>
    </a>
    <div id="user-detail">
        <div class="avatar">
            @if(!empty(Auth::guard('karyawan')->user()->foto))
                @php
                    $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
                @endphp
                <img src="{{ url($path) }}" alt="avatar">
            @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
        </div>
    </div>
</div>

<!-- === MENU SECTION === -->
<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/editprofile" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span>Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/izin" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span>Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/histori" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span>Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span>Lokasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- === PRESENCE SECTION === -->
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if($presensihariini !== null)
                                    @php 
                                        $path = Storage::url('uploads/absensi/' . $presensihariini->foto_in);  
                                    @endphp
                                    <img src="{{ url($path) }}" alt="">
                                @else 
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4>Masuk</h4>
                                <span>{{ $presensihariini !== null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if($presensihariini !== null && $presensihariini->jam_out !== null)
                                    @php 
                                        $path = Storage::url('uploads/absensi/' . $presensihariini->foto_out);  
                                    @endphp
                                    <img src="{{ url($path) }}" alt="">
                                @else 
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4>Pulang</h4>
                                <span>{{ $presensihariini !== null && $presensihariini->jam_out !== null ? $presensihariini->jam_out : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- REKAP PRESENSI -->
    <div id="rekappresensi">
        <h3>📊 Rekapitulasi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="badge bg-danger" style="position: absolute; top:8px; right:8px;">{{ $rekappresensi->jmlhadir }}</span>
                        <ion-icon name="accessibility-outline" class="text-primary"></ion-icon>
                        <br>
                        <span>Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="badge bg-danger" style="position: absolute; top:8px; right:8px;">{{ $rekapizin->jmlizin }}</span>
                        <ion-icon name="newspaper-outline" class="text-success"></ion-icon>
                        <br>
                        <span>Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="badge bg-danger" style="position: absolute; top:8px; right:8px;">{{ $rekapizin->jmlsakit }}</span>
                        <ion-icon name="medkit-outline" class="text-warning"></ion-icon>
                        <br>
                        <span>Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="badge bg-danger" style="position: absolute; top:8px; right:8px;">{{ $rekappresensi->jmlterlambat }}</span>
                        <ion-icon name="alarm-outline" class="text-danger"></ion-icon>
                        <br>
                        <span>Telat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB BULAN INI & LEADERBOARD -->
    <div class="presencetab mt-3">
        <ul class="nav nav-tabs style1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">📅 Bulan Ini</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">🏆 Leaderboard</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- TAB BULAN INI -->
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($historibulanini as $d)
                        @php
                            $path = Storage::url('uploads/absensi/'.$d->foto_in);
                        @endphp
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</div>
                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                    <span class="badge badge-danger">{{ $d->jam_out ?? 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- TAB LEADERBOARD -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="image">
                                <div class="in">
                                    <div>
                                        <b>{{ $d->nama_lengkap }}</b><br>
                                        <small class="text-muted">{{ $d->jabatan }}</small>
                                    </div>
                                    <span class="badge {{ substr($d->jam_in,0,5) <= '08:00' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $d->jam_in }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection