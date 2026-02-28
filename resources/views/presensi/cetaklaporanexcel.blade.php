<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
@page {
    size: A4;
    margin: 0cm;
}

body {
    margin: 0cm;
    padding: 0cm;

    /* 🔥 FONT RESMI */
    font-family: "Times New Roman", Times, serif;
    font-size: 12pt;
}

.sheet {
    padding: 0 !important;
}

/* Judul laporan */
.judul-laporan {
    text-align: center;
    font-weight: bold;
    font-size: 14pt;
    line-height: 1.5;
    margin-top: 10px;
}

.tabeldatakaryawan {
    margin-top: 10px;
    margin-left: 40px;
}

.tabeldatakaryawan td {
    padding: 5px;
}

.tabelpresensi {
    width: calc(100% - 80px);
    margin-left: 40px;
    margin-right: 40px;
    margin-top: 20px;
    border-collapse: collapse;
}

.tabelpresensi tr th{
    border: 1px solid #131212;
    padding: 8px;
    background:rgb(158, 158, 158);
}

.tabelpresensi tr td{
    border: 1px solid #131212;
    padding: 5px;
    font-size: 14px;
}

.foto{
    width: 50px;
    height: 40px;
    object-fit: cover;
    border: 1px solid black;
    padding: 1px;
    display: block;
    margin: auto;
}
.tabelpresensi th,
.tabelpresensi td {
    text-align: center;
    vertical-align: middle;
}
.tabeldatakaryawan img {
    border: 2px solid black;     /* border resmi */
    padding: 3px;                /* frame jarak */
    background: white;           /* background foto */
    box-shadow: 2px 2px 5px rgba(0,0,0,0.25); /* efek profesional */
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ":" . round($sisamenit2);
    }
    ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

  <!-- HEADER IMAGE -->
  <table width="100%" cellpadding="0" cellspacing="0">
<tr>

</tr>
</table>

<!-- GARIS PEMISAH -->
<hr style="border:2px solid black; margin:0;">
<hr style="border:1px solid black; margin:2px 0;">

<!-- JUDUL LAPORAN -->
<p class="judul-laporan" style="text-align:center; font-weight:bold; font-size:16px; line-height:1.5; margin-top:10px;">
    LAPORAN PRESENSI KARYAWAN <br>
    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
</p>

    <table class="tabeldatakaryawan">
        <tr>
            <td rowspan="6">
                @php 
                $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{ url($path) }}" alt="" width="120px" height="150">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $karyawan->nama_dept }}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp }}</td>
        </tr>
    </table>
        <table class="tabelpresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Keterangan</th>
                <th>Jam Kerja</th>
            </tr>
            @foreach ($presensi as $d)
            @php 
            $jamterlambat = selisih('08:00:00',$d->jam_in);
            @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</td>
                    <td>{{ $d->jam_in }}</td>
                    <td>{{ $d->jam_out !== null ? $d->jam_out : 'Belum Absen' }}</td>
                    <td>
                        @if ($d->jam_in > '08:00')
                        Terlambat {{ $jamterlambat }}
                        @else
                        Tepat Waktu
                        @endif
                    </td>
                    <td>
                        @if ($d->jam_out !== null)
                            @php
                                $jmljamkerja = selisih($d->jam_in,$d->jam_out);
                            @endphp
                            @else
                            @php 
                            $jmljamkerja = 0;
                            @endphp
                        @endif
                        {{ $jmljamkerja }}
                    </td>
                </tr>
            @endforeach
        </table>

        
</section>

</body>

</html>