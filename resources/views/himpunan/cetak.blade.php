<html>
<head>
	<title>Laporan Data Himpunan</title>
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
		<h5>DATA HIMPUNAN SISTEM PAKAR ISPA</h4>
		<h6>Tanggal : {{$date}}</h6>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Variabel</th>
				<th>Himpunan</th>
				<th>Domain</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $row)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $row->variabel->nama }}</td>
				<td>{{ $row->nama }}</td>
				<td>{{ $row->domain }}</td>

			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
