@extends('layouts.presensi')
@section('header')
<!-- App Header (tetap seperti aslinya) -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Attendance History</div>
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
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
        --shadow-md: 0 10px 25px -5px rgba(0,0,0,0.1);
    }

    /* Latar belakang halus */
    body {
        background: #f4f7fd;
    }

    /* Membuat header lebih elegan (opsional, bisa disesuaikan) */
    .appHeader {
        background: var(--gradient-primary) !important;
        box-shadow: 0 10px 25px -5px rgba(102,126,234,0.5);
        border-bottom: none;
    }
    .appHeader .pageTitle {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Kontainer utama dengan jarak yang pas */
    .container-custom {
        padding: 20px 16px;
        margin-top: 60px; /* agar tidak tertutup header */
    }

    /* Card filter dengan efek glass */
    .filter-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--glass-border);
        margin-bottom: 25px;
    }

    /* Style untuk form group */
    .form-group {
        margin-bottom: 18px;
    }

    /* Label (opsional, jika ingin ditambahkan) */
    .form-label {
        font-weight: 600;
        color: #2d3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }

    /* Select boxes modern */
    .form-control {
        background: rgba(255,255,255,0.8);
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 20px;
        height: 54px;
        padding: 0 20px;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        transition: all 0.2s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234b5563' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 16px;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67,97,238,0.15);
        outline: none;
        background: white;
    }

    /* Tombol search premium */
    .btn-search {
        background: var(--gradient-primary);
        border: none;
        border-radius: 30px;
        height: 56px;
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 15px 25px -8px rgba(102,126,234,0.5);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .btn-search:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -8px #667eea;
    }

    .btn-search:active {
        transform: scale(0.97);
    }

    .btn-search ion-icon {
        font-size: 1.3rem;
    }

    /* Area hasil */
    #showhistori {
        margin-top: 10px;
    }

    /* Card hasil presensi (akan muncul dari AJAX) – kita beri gaya dasar */
    .history-card {
        background: white;
        border-radius: 25px;
        padding: 16px;
        margin-bottom: 12px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.02);
        transition: 0.2s;
    }
    .history-card:hover {
        transform: translateX(5px);
        box-shadow: var(--shadow-md);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .filter-card {
            padding: 18px;
        }
    }
</style>

<div class="container-custom">
    <!-- Card Filter -->
    <div class="filter-card">
        <div class="form-group">
            <label class="form-label">Month</label>
            <select name="bulan" id="bulan" class="form-control">
                <option value="">Select Month</option>
                @for ($i=1; $i<=12; $i++)
                    <option value="{{ $i }}" {{ date("m") == $i ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Year</label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="">Select Year</option>
                @php
                    $tahunmulai = 2025;
                    $tahunskrg = date("Y");
                @endphp
                @for ($tahun=$tahunmulai; $tahun<= $tahunskrg; $tahun++)
                    <option value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <button class="btn-search" id="getdata">
                <ion-icon name="search-outline"></ion-icon> Search
            </button>
        </div>
    </div>

    <!-- Tempat hasil pencarian -->
    <div id="showhistori"></div>
</div>

<!-- Script (tetap sama) -->
@push('myscript')
<script>
    $(function(){
        $("#getdata").click(function(e) {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type:'POST',
                url:'/gethistori',
                data:{
                    _token:"{{ csrf_token() }}",
                    bulan:bulan,
                    tahun:tahun
                },
                cache:false,
                success:function(respond) {
                    $("#showhistori").html(respond);
                }
            });
        });
    });
</script>
@endpush

@endsection