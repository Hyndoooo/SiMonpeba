<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Perkembangan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Histori Perkembangan</h1>
    <h3>Nama: {{ $histori->first()->nama ?? 'Tidak diketahui' }}</h3>
    <h3>NIS: {{ $histori->first()->nis ?? 'Tidak diketahui' }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jadwal Pelajaran</th>
                <th>Penjelasan Perkembangan</th>
                <th>Catatan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histori as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->jadwal_pelajaran }}</td>
                    <td>{{ $item->penjelasan_perkembangan }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>{{ $item->waktu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
