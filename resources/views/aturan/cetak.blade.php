<html>
<head>
	<title>Laporan Data Basis Pengetahuan</title>
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
		<h5>DATA BASIS PENGETAHUAN SISTEM PAKAR ISPA</h4>
		<h6>Tanggal : {{$date}}</h6>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Aturan</th>
				<th>Keputusan</th>
				<th>CF</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $aturan)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $aturan->kode }}</td>
				<td>
                    @foreach ($aturan->himpunan as $row)
                       [{{$row->variabel->kode}}]  {{$row->variabel->nama}}  <strong> {{$row->nama}} </strong>,
                    @endforeach
                </td>
				<td>

                        [{{$aturan->keputusan->kode}}] {{$aturan->keputusan->nama}}

                </td>
                <td>{{$aturan->certainty_factor}}</td>

			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
