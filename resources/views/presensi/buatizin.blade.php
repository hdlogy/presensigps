@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    /* Kustomisasi Materialize Datepicker agar sesuai tema */
    .datepicker-modal {
        max-height: 400px !important;
        border-radius: 30px 30px 0 0 !important;
        overflow: hidden;
    }
    .datepicker-date-display {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white;
    }
    .datepicker-cancel, .datepicker-done {
        color: #667eea !important;
        font-weight: 600;
    }
    .datepicker-table td.is-today {
        background-color: rgba(102, 126, 234, 0.1);
    }
    .datepicker-table td.is-selected {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white;
    }
    .month-prev svg, .month-next svg {
        fill: #667eea;
    }

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
        font-family: 'Inter', sans-serif;
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

    /* Container utama */
    .container-custom {
        padding: 20px 16px;
        margin-top: 60px; /* agar tidak tertutup header */
    }

    /* Card form */
    .form-card {
        background: white;
        border-radius: 35px;
        padding: 28px 22px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(0,0,0,0.02);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* Title dalam card (opsional) */
    .form-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Form group */
    .form-group {
        margin-bottom: 22px;
    }

    /* Label */
    .form-label {
        font-weight: 600;
        color: #2d3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 0.95rem;
    }

    /* Input, select, textarea modern */
    .form-control, .datepicker, select, textarea {
        background: rgba(248, 250, 252, 0.9);
        border: 1px solid #e2e8f0;
        border-radius: 24px !important;
        height: 56px;
        padding: 0 22px;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        transition: all 0.2s;
        width: 100%;
        outline: none;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
    }

    /* Perbaikan khusus untuk input datepicker agar teks tidak terpotong */
    .form-control.datepicker {
        padding-right: 40px; /* ruang untuk kemungkinan ikon */
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    textarea {
        height: auto;
        padding: 16px 22px;
        border-radius: 28px !important;
        resize: vertical;
    }

    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234b5563' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 22px center;
        background-size: 16px;
    }

    .form-control:focus, select:focus, textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
        background: white;
    }

    /* Tombol submit premium */
    .btn-submit {
        background: var(--gradient-primary);
        border: none;
        border-radius: 40px;
        height: 60px;
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 15px 25px -8px rgba(102,126,234,0.5);
        transition: all 0.3s;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.2);
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -8px #667eea;
    }

    .btn-submit:active {
        transform: scale(0.97);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .form-card {
            padding: 22px 18px;
        }
    }
</style>

<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Permission Form</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="container-custom">
    <div class="form-card">
        <div class="form-title">📋 Apply for Permission</div>

        <form method="POST" action="/presensi/storeizin" id="frmIzin">
            @csrf

            <div class="form-group">
                <label class="form-label">Date</label>
                <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker" placeholder="Select date">
            </div>

            <div class="form-group">
                <label class="form-label">Type</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Izin / Sakit</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control" placeholder="Explain your reason..."></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Submit Request</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        // Inisialisasi datepicker Materialize
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            yearRange: [currYear, currYear + 5], // contoh rentang tahun
            i18n: {
                months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                weekdays: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
                weekdaysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                weekdaysAbbrev: ["M", "S", "S", "R", "K", "J", "S"],
                today: 'Hari Ini',
                clear: 'Bersihkan',
                close: 'Tutup',
                done: 'Pilih',
                labelMonthNext: 'Bulan depan',
                labelMonthPrev: 'Bulan sebelumnya',
                labelMonthSelect: 'Pilih bulan',
                labelYearSelect: 'Pilih tahun'
            }
        });

        // Cek pengajuan izin duplikat
        $("#tgl_izin").change(function(e) {
            var tgl_izin = $(this).val();
            $.ajax({
                type: 'POST',
                url: '/presensi/cekpengajuanizin',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_izin: tgl_izin
                },
                cache: false,
                success: function(respond) {
                    if (respond == 1) {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'The permission has already been made on that date!',
                            icon: 'warning'
                        }).then((result) => {
                            $('#tgl_izin').val("");
                        });
                    }
                }
            });
        });

        // Validasi form sebelum submit
        $("#frmIzin").submit(function() {
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();

            if (tgl_izin == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Date must be Filled In!',
                    icon: 'warning'
                });
                return false;
            } else if (status == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Status must be Filled In!',
                    icon: 'warning'
                });
                return false;
            } else if (keterangan == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Description must be Filled In!',
                    icon: 'warning'
                });
                return false;
            }
        });
    });
</script>
@endpush