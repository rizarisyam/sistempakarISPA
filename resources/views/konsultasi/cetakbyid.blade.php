<html>
<head>
	<title>Laporan Data Penyakit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Hasil Konsultasi</h4>
        @foreach ($konsultasi as $row)
            @dump($row)
        @endforeach
		<h6>Tanggal : {{$date}}</h6>
	</center>

	<table class="table table-bordered">

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
</div>

<div>
    <h6 class="font-weight-bold">Hasil</h6>
    <table class="table table-hover">
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

</body>
</html>
