<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        thead {
            background-color: #f4f9f9;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>

<body>

    <h2>Laporan Data Pengguna Sistem Pakar ISPA</h2>
    <div style="max-width: 300px; margin-bottom: 2rem;">

        <table>
            <tbody>
                <tr>
                    <td>Oleh</td>
                    <td>{{Auth::user()->name}}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>{{date('d-m-Y')}}</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div style="overflow-x:auto;">
        <table>
            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tangal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->date ?? 'N/A'}}</td>
                    <td>
                        @if ($row->gender == 'L')
                            {{"Laki-laki"}}
                        @elseif($row->gender == 'P')
                            {{"Perempuan"}}
                        @else
                            {{"N/A"}}
                        @endif
                    </td>
                    <td>{{$row->email}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</body>

</html>
