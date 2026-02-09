<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10mm; /* Margin halaman lebih kecil (10 milimeter) untuk menghemat ruang */
            font-size: 10pt; /* Ukuran font dasar lebih kecil (10 point) */
        }

        .header img {
            width: 80px; /* Ukuran logo lebih kecil */
            border-radius: 50%; /* Membuat logo berbentuk lingkaran */
            margin-bottom: 5px; /* Spasi bawah logo lebih kecil */
        }

        .header {
            text-align: center; /* Memusatkan teks di dalam header */
            margin-bottom: 10px; /* Spasi bawah header */
        }

        h2, h3 {
            margin: 2px 0; /* Margin atas dan bawah heading lebih kecil */
            font-size: 12pt; /* Ukuran font h2 */
        }
        h3{
            font-size: 11pt; /* Ukuran font h3 */
        }

        table {
            width: 100%; /* Lebar tabel 100% dari container */
            border-collapse: collapse; /* Menggabungkan border sel tabel */
            margin-bottom: 20px; /* Spasi bawah tabel */
            font-size: 9pt; /* Ukuran font tabel lebih kecil */
        }

        th, td {
            border: 1px solid #000; /* Border sel tabel */
            padding: 4px; /* Padding sel lebih kecil */
            text-align: left; /* Teks dalam sel rata kiri */
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang header tabel */
        }

        .footer {
            text-align: center; /* Memusatkan teks di footer */
            border-top: 1px solid #000; /* Border atas footer */
            padding: 5px 0; /* Padding atas dan bawah footer lebih kecil */
            margin-top: 80px; /* Margin atas footer */
            font-size: 9pt; /* Ukuran font footer lebih kecil */
        }

        .signature-section {
            width: 100%; /* Lebar section tanda tangan 100% */
            margin-top: 20px; /* Spasi atas section tanda tangan */
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%; /* Lebar setiap kolom tanda tangan 50% */
            vertical-align: top; /* Meratakan konten sel ke atas */
            padding: 5px;
            text-align: center; /* Teks dalam sel tanda tangan dipusatkan */
            border: none; /* Menghilangkan border tabel tanda tangan */
        }

        .signature-line {
            border-top: 1px solid #000; /* Garis tanda tangan */
            margin: 80px auto 5px; /* Margin atas, kiri-kanan auto (pusat), margin bawah */
            width: 180px; /* Lebar garis tanda tangan */
        }

        .signature-details {
            margin-top: 2px; /* Spasi atas nama penanda tangan */
        }

        .nip-npwp {
            font-size: 9pt; /* Ukuran font NIP/NPWP */
            margin-top: 2px; /* Spasi atas NIP/NPWP */
        }

        .date {
            text-align: right; /* Teks tanggal rata kanan */
            margin-top: 60px;
            margin-bottom: 60px;
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/maqna.jpg') }}" alt="Company Logo">
            <h2>Maqna Tech Lab</h2>
            <h3>Penggajian Karyawan</h3>
        </div>

        <div class="info mb-2">
            <p><strong>Nama Karyawan:</strong> {{ $penggajian->karyawan->nama }}</p>
            <p><strong>Tanggal Penggajian:</strong> {{ $penggajian->tanggal_penggajian }}</p>
            <p><strong>Periode Penggajian:</strong> {{ $penggajian->periode_penggajian }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Jumlah (IDR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>{{ number_format($penggajian->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Tunjangan</td>
                    <td>{{ number_format($penggajian->tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Upah Lembur</td>
                    <td>{{ number_format($penggajian->upah_lembur, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>{{ number_format($penggajian->bonus, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Potongan</td>
                    <td>{{ number_format($penggajian->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Gaji Bersih</strong></td>
                    <td><strong>{{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="date">
            <p>Bangkalan, ... Januari 2024</p>
        </div>

        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td>
                        <p>Karyawan</p>
                        <div class="signature-details">
                            <div class="signature-line"></div>
                            <p>{{ $penggajian->karyawan->nama }}</p>
                            <p class="nip-npwp">NPWP: {{ $penggajian->karyawan->npwp }}</p>
                        </div>
                    </td>
                    <td>
                        <p>Manager</p>
                        <div class="signature-details">
                            <div class="signature-line"></div>
                            <p>Dimas Wicaksono,S.T.,M.Eng</p>
                            <p class="nip-npwp">NIP: 198765342006055001</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <br>
            <p>Terima kasih atas kerja sama Anda.</p>
            <p>Alamat Perusahaan: Jl. Kelud No 06, Kab. Bangkalan, Jawa Timur, 69116</p>
            <p>Telepon: 0021044521</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
