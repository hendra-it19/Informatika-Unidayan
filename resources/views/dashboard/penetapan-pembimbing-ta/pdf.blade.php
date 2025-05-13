<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{ public_path('favicon.ico') }}" type="image/x-icon">
    <title>Export Judul Dan Pembimbing Tugas Akhir</title>

    <style>
        * {
            border: 0;
            box-sizing: border-box;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td {
            padding: 4px;
            font-size: 10px;
        }

        table thead tr td {
            text-align: center;
        }

        table,
        table thead,
        table tr,
        table tr td {
            border: 1px solid black
        }
    </style>
</head>

<body style="padding: 10px;">

    <small style="font-size:10px;">Dari {{ $tgl_awal }} sampai {{ $tgl_akhir }}</small>

    <div style="width: 100%; text-align: center;margin-bottom:12px;">
        <img src="{{ public_path('assets/image/logo/unidayan.png') }}" alt="Logo Unidayan" style="width: 70px;">
        <div style="margin-top: 4px;">
            <h4>DAFTAR JUDUL TUGAS AKHIR MAHASISWA</h4>
            <h5>UNIVERSITAS DAYANU IKHSANUDDIN BAUBAU</h5>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <td>NO</td>
                    <td>NIM</td>
                    <td>NAMA</td>
                    <td>JUDUL</td>
                    <td>PEMBIMBING UTAMA</td>
                    <td>PEMBIMBING PENDAMPING</td>
                </tr>
            </thead>
            @forelse ($data as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->mahasiswa->identitas }}</td>
                    <td>{{ $row->mahasiswa->nama }}</td>
                    <td>{{ $row->judul }}</td>
                    <td>{{ $row->pembimbing_utama->nama }}</td>
                    <td>{{ $row->pembimbing_pendamping->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak Ada Data Yang Dapat Ditampilkan!</td>
                </tr>
            @endforelse
        </table>
    </div>

    <div style="margin-top: 20px; text-align: right;">
        <div style="font-size: 10pt;">
            <p>
                Baubau, {{ date('d F Y') }}
            </p>
            <p>
                Kepala Program Studi Teknik Informatika Unidayan
            </p>
        </div>
        <div style="margin-top: 45px; font-size: 10pt;">
            <span style="text-decoration: underline;"> {{ $kaprodi->nama }}</span>
            <br>
            {{ $kaprodi->identitas }}
        </div>
    </div>


</body>

</html>
