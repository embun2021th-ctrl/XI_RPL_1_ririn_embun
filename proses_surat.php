<?php
//masukan library DomPDF
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//instasiasi objek dompdf
if($_SERVER['REQUEST_METHOD'] == 'POST');{
    //ambil data dari form html
    $nama            = htmlspecialchars($_POST['nama']);
    $nis              = htmlspecialchars($_POST['nis']);
    $kelas            = htmlspecialchars($_POST['kelas']);
    $alasan           = htmlspecialchars($_POST['alasan']);
    $tanggal_mulai    = date('d F Y', strtotime($_POST['tanggal_mulai']));
    $tanggal_selesai  = date('d F Y', strtotime($_POST['tanggal_selesai']));
    $keterangan       = htmlspecialchars($_POST['keterangan']);
    $tanggal_sekarang = date('d F Y');


//templete halaman pdf
$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
    body{
        font-family: "Times New Roman";
        font-size: 12pt;
        margin: 0;
    }
        .kop{
        font-family: "Century Gothic";
        text-align: center;
        border-bottom: 3px double #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
        }
        .kop h2{
            margin: 0;
            font-size: 20pt;
            text-transform: uppercase;
        }
            .kop p{
            margin: 2px;
            font-size: 10pt;
        }
            .title{
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }
            .content{
            line-height: 1.6;
            text-align: justify;
        }
            table-data{
            margin-top: 15px 0 15px 30;
            width: 100%;
        }
            .table-data td{
            padding: 4px;
            vertical-align: top;
        }
            .ttd-container{
            width: 100%;
            margin-top: 50px;
        }
            .ttd-box{
            float: right;
            width: 200px;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="kop">
    <h2>SMK TEXMACO SEMARANG</h2>
    <p>Jl. Raya Mangkang Kulon |Telp: (024) 1234567</p>
</div>
<div class="title">SURAT IZIN MENINGGALKAN KELAS</div>

<div class="content">
<p>Yang bertanda tangan dibawah ini:</p>
<table class="table-data">

    <tr>
        <td width="130">Nama</td>
        <td width="20">:</td>
        <td><b>'.$nama.'</b></td>
    </tr>
    <tr>
        <td width="130">NIS</td>
        <td width="20">:</td>
        <td><b>'.$nis.'</b></td>
    </tr>
    <tr>
        <td width="130">Kelas</td>
        <td width="20">:</td>
        <td><b>'.$kelas.'</b></td>
    </tr>
    </table>
    <p>Bermaksud untuk mengajukan izin meninggalkan kelas pada tanggal <b>'.$tanggal_mulai.'</b>
     sampai dengan tanggal <b>'.$tanggal_selesai.'</b>
     dikeranakan <b>'.$alasan.'</b>
     </p>
     ' . ($keterangan ? '<p> Detail Keterangan: <b>'.$keterangan.'</b></p>' : '') . '
     <p>Demikian surat izin ini saya buat.
      atas perhatian Bapak/Ibu Guru,
      saya ucapkan terima kasih.
      </p>
</div>

<div class="ttd-container">
    <div class="ttd-box">
        <p>Semarang, '.$tanggal_sekarang.' <br>Hormat Saya,</p>
        <br><br><br>
        <p><b>('.$nama.')</b></p>
        </div>
    </div>
</body>
</html>
';

// 3. konfigurasi  dan inisialisasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Meungkinkan load gambar jika ada
$dompdf = new Dompdf($options);

// 4. Render HTML ke PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 5. Stream PDF ke Browser
$dompdf->stream("Surat_Izin_". str_replace(' ','_',$nama) . ".pdf",["attachment" => false]); // false agar langsung tampil di browser
}
?>