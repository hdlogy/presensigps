<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/presensi/histori" class="item {{ request()->is('presensi/histori') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline"></ion-icon>
            <strong>History</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/presensi/izin" class="item {{ request()->is('presensi/izin') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline"></ion-icon>
            <strong>Permission</strong>
        </div>
    </a>
    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->

<!-- Ionicons CDN (jika belum ada) -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<style>
/* ===== BOTTOM NAVIGASI ELEGAN ===== */
.appBottomMenu {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 -5px 20px -5px rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 0 10px;
    z-index: 1000;
}

.appBottomMenu .item {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #94a3b8;
    transition: all 0.2s ease;
    padding: 8px 0;
    border-radius: 40px;
    position: relative;
}

.appBottomMenu .item:hover {
    color: #3b82f6;
    transform: translateY(-2px);
}

/* Active state yang elegan */
.appBottomMenu .item.active {
    color: #3b82f6;
    font-weight: 500;
}

.appBottomMenu .item.active ion-icon {
    transform: scale(1.05);
    filter: drop-shadow(0 2px 4px rgba(59,130,246,0.3));
}

.appBottomMenu .item .col {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.appBottomMenu .item ion-icon {
    font-size: 24px;
    transition: transform 0.2s, color 0.2s;
}

.appBottomMenu .item strong {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    opacity: 0.9;
    transition: color 0.2s;
}

/* Tombol kamera istimewa */
.appBottomMenu .item .action-button {
    width: 58px;
    height: 58px;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
    box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.5);
    transform: translateY(-12px);
    transition: 0.2s;
    border: 2px solid rgba(255, 255, 255, 0.8);
}

.appBottomMenu .item .action-button:hover {
    transform: translateY(-14px) scale(1.02);
    box-shadow: 0 15px 25px -5px rgba(59, 130, 246, 0.7);
}

.appBottomMenu .item .action-button.large ion-icon {
    font-size: 32px;
}

/* Warna icon dan teks saat active */
.appBottomMenu .item.active ion-icon,
.appBottomMenu .item.active strong {
    color: #3b82f6;
}

/* Responsive */
@media (max-width: 576px) {
    .appBottomMenu {
        height: 70px;
    }
    .appBottomMenu .item ion-icon {
        font-size: 22px;
    }
    .appBottomMenu .item strong {
        font-size: 10px;
    }
    .appBottomMenu .item .action-button {
        width: 52px;
        height: 52px;
        font-size: 24px;
        transform: translateY(-10px);
    }
    .appBottomMenu .item .action-button.large ion-icon {
        font-size: 28px;
    }
}

/* Beri ruang konten agar tidak tertutup menu */
body {
    padding-bottom: 80px;
}
@media (max-width: 576px) {
    body {
        padding-bottom: 70px;
    }
}
</style>