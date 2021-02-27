<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0 2rem;
        }
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

    <h2 style="text-align: center">Laporan Hasil Konsultasi</h2>
    <div style="max-width: 300px; margin-bottom: 2rem;">
        <table>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>{{\Auth::user()->name}}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>{{date('d-m-Y')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- <h3>Nama : {{\Auth::user()->name}}</h3>
    <h3>Tanggal {{date('d-m-Y')}}</h3> --}}

    <div style="overflow-x:auto;">
        <p><strong> Data Diagnosa</strong></p>
        <table>
            {{-- <thead>

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tangal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                </tr>
            </thead> --}}
            <tbody>
                @foreach ($konsultasi as $row)

                @foreach ($row->variabel as $row)

                <tr>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->pivot->nilai ?? 0}}</td>
                </tr>
                @endforeach
                @endforeach
            </tbody>

        </table>

        <div style="max-width: 500px">
            <h4>Hasil</h4>
            <table>
                {{-- <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead> --}}
                <tbody>
                   @foreach ($keputusan as $key => $row)
                    @if ($maxIndex == $key)
                        <tr>
                            <td>Terdiagnosa</td>
                            <td>{{$row->nama}}</td>
                        </tr>
                        <tr>
                            <td>Persentase</td>
                            <td>{{number_format(($maxValue * 100), 2)}} %</td>
                        </tr>
                        <tr>
                            <td>Solusi</td>
                            <td>{{$row->saran}}</td>
                        </tr>
                    @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
