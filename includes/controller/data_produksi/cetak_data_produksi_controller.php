<?php
require_once __DIR__.'\..\..\..\vendor\autoload.php';
require_once('../../koneksi.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SELECT pp.*, k.nama_kecamatan 
          FROM produksi_padi pp
          LEFT JOIN kecamatan k ON pp.kode_kecamatan = k.id";

$result = pg_query($conn, $query);

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul kolom
$header = ['Tahun', 'Jenis Padi','Luas Tanam', 'Luas Panen', 'Produktivitas', 'Produksi Padi', 'Kecamatan'];
$sheet->fromArray($header, NULL, 'A1');

// Set font tebal untuk header
$spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

// Set data dari database
$rowNumber = 2; // Baris mulai dari baris ke-2 (karena baris pertama adalah header)
while ($row = pg_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['tahun']);
    $sheet->setCellValue('B' . $rowNumber, $row['jenis_padi']);
    $sheet->setCellValue('C' . $rowNumber, $row['luas_tanam']);
    $sheet->setCellValue('D' . $rowNumber, $row['luas_panen']);
    $sheet->setCellValue('E' . $rowNumber, $row['produktivitas']);
    $sheet->setCellValue('F' . $rowNumber, $row['produksi_padi']);
    $sheet->setCellValue('G' . $rowNumber, $row['nama_kecamatan']);
    $rowNumber++;
}

// Buat writer untuk menyimpan file ke format Excel (.xlsx)
$writer = new Xlsx($spreadsheet);

// Set header untuk unduhan file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="produksi_padi.xlsx"');
header('Cache-Control: max-age=0');

// Simpan file Excel ke output (unduh file)
$writer->save('php://output');
exit;
?>
