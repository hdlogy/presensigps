@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Permit / Permission</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<style>
    /* ===== VARIABEL WARNA ===== */
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --primary-dark: #3f37c9;
        --success: #4cc9f0;
        --warning: #f8961e;
        --danger: #f94144;
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-success: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --gradient-warning: linear-gradient(135deg, #f9d423 0%, #f83600 100%);
        --gradient-danger: linear-gradient(135deg, #f43b47 0%, #453a94 100%);
        --card-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
        --shadow-md: 0 10px 25px -5px rgba(0,0,0,0.1);
    }

    /* Latar belakang halus */
    body {
        background: #f4f7fd;
    }

    /* Header lebih elegan */
    .appHeader {
        background: var(--gradient-primary) !important;
        box-shadow: 0 10px 25px -5px rgba(102,126,234,0.5);
        border-bottom: none;
    }
    .appHeader .pageTitle {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Container utama dengan jarak */
    .container-custom {
        padding: 20px 16px;
        margin-top: 60px; /* agar tidak tertutup header */
    }

    /* Alert modern */
    .alert {
        border-radius: 20px;
        padding: 16px 20px;
        font-weight: 600;
        border: none;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
    }
    .alert-success {
        background: rgba(76, 201, 240, 0.2);
        color: #0b5e7e;
        border: 1px solid rgba(76,201,240,0.3);
    }
    .alert-danger {
        background: rgba(249, 65, 68, 0.1);
        color: #b91c1c;
        border: 1px solid rgba(249,65,68,0.2);
    }

    /* Listview card style */
    .listview {
        background: transparent;
        padding: 0;
    }
    .listview li {
        background: white;
        border-radius: 25px;
        margin-bottom: 12px;
        padding: 0;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }
    .listview li:hover {
        transform: translateX(5px);
        box-shadow: var(--shadow-md);
    }

    .item {
        display: flex;
        align-items: center;
        padding: 16px 18px;
        gap: 15px;
    }

    /* Icon status (opsional, menambah kesan visual) */
    .item::before {
        content: "";
        width: 10px;
        height: 100%;
        background: var(--primary);
        border-radius: 30px;
        margin-right: 5px;
    }
    /* Warna garis sesuai status */
    .item[data-status="0"]::before { background: var(--warning); }
    .item[data-status="1"]::before { background: var(--success); }
    .item[data-status="2"]::before { background: var(--danger); }

    .in {
        flex: 1;
    }
    .in div b {
        font-size: 1.1rem;
        color: #1e293b;
    }
    .in small {
        font-size: 0.85rem;
        color: #64748b;
        display: block;
        margin-top: 4px;
    }

    /* Badge status */
    .badge {
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.3px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }
    .badge.bg-warning {
        background: linear-gradient(135deg, #f9d423 0%, #f83600 100%) !important;
        color: white;
    }
    .badge.bg-success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
        color: white;
    }
    .badge.bg-danger {
        background: linear-gradient(135deg, #f43b47 0%, #453a94 100%) !important;
        color: white;
    }

    /* Floating action button premium */
    .fab-button {
        position: fixed;
        bottom: 80px;
        right: 20px;
        z-index: 1000;
    }
    .fab {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        box-shadow: 0 15px 30px -5px rgba(102,126,234,0.6);
        transition: all 0.3s;
        border: 2px solid rgba(255,255,255,0.3);
    }
    .fab:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 20px 40px -5px #667eea;
    }
    .fab:active {
        transform: scale(0.95);
    }
    .fab ion-icon {
        --ionicon-stroke-width: 48px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .fab {
            width: 60px;
            height: 60px;
            font-size: 2.2rem;
        }
    }
</style>

<div class="container-custom">
    <!-- Alert Messages -->
    <div class="row">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if(Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>

    <!-- Daftar Izin -->
    <div class="row">
        <div class="col">
            @foreach ($dataizin as $d)
                <ul class="listview image-listview">
                    <li>
                        <div class="item" data-status="{{ $d->status_approved }}">
                            <div class="in">
                                <div>
                                    <b>{{ date("d-m-Y", strtotime($d->tgl_izin)) }} ({{ $d->status == "s" ? "Sick" : "Permit" }})</b><br>
                                    <small class="text-muted">{{ $d->keterangan }}</small>
                                </div>
                                @if ($d->status_approved == 0)
                                    <span class="badge bg-warning">Waiting</span>  
                                @elseif($d->status_approved == 1) 
                                    <span class="badge bg-success">Approved</span>   
                                @elseif($d->status_approved == 2) 
                                    <span class="badge bg-danger">Declined</span>             
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="fab-button bottom-right" style="margin-bottom:70px">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>

@endsection