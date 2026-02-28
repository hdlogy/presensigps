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
    margin: 20px auto;
   
    margin-top: 20px;
    border-collapse: collapse;
}

.tabelpresensi tr th{
    border: 1px solid #131212;
    padding: 8px;
    background:rgb(158, 158, 158);
    font-size: 10px;
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
<body class="A4 landscape">

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
<td>
<img src="{{ asset('assets/img/headerppsdm.png') }}"  style="width:100%; height:auto; display:block;">
</td>
</tr>
</table>

<!-- GARIS PEMISAH -->
<hr style="border:2px solid black; margin:0;">
<hr style="border:1px solid black; margin:2px 0;">

<!-- JUDUL LAPORAN -->
<p class="judul-laporan" style="text-align:center; font-weight:bold; font-size:16px; line-height:1.5; margin-top:10px;">
    REKAPITULASI PRESENSI KARYAWAN <br>
    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
</p>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">Nik</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
        </tr>
        <tr>
            <?php
            for($i=1; $i<=31; $i++){
            ?>
            <th> {{ $i }}</th>
            <?php
            }
            ?>
        </tr>
            @foreach ($rekap as $d)
            <tr>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->nama_lengkap }}</td>

                <?php
                $totalhadir = 0;
                $totalterlambat = 0;
                for($i=1; $i<=31; $i++){
                $tgl = "tgl_".$i;
                if(empty($d->$tgl)){
                    $hadir = ['',''];
                    $totalhadir += 0;
                }else{
                    $hadir = explode("-",$d->$tgl);
                    $totalhadir += 1;
                    if($hadir[0] > "08:00:00"){
                        $totalterlambat += 1;
                    }
                }
            ?>

            <td> 
                <span style="color:{{ $hadir[0]>"08:00:00" ? "red" : "" }}">{{ $hadir[0] }}</span><br>
                <span style="color:{{ $hadir[1]<"16:00:00" ? "red" : "" }}">{{ $hadir[1] }}</span><br>
            </td>
            <?php
            }
            ?>

            <td>{{ $totalhadir }}</td>
            <td>{{ $totalterlambat }}</td>
            @endforeach
        </tr>
    </table>

</section>

</body>

</html>