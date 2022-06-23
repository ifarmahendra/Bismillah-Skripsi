<!DOCTYPE html>
<html>
<head>
	<title>Laporan Nilai</title>
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
		<h5>Laporan Nilai</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Golongan</th>
                <th>Tanggal Perkuliahan</th>
                <th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($form as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama}}</td>
				<td>{{$p->golongan}}</td>
				<td>{{date_format(date_create($p->tanggal), 'd-M-Y H:i T')}}</td>
				<td id="nilai-{{$p->id}}">
                @php
                $nilai = round($new::where('formjawaban_id', $p->id)->first()->nilai_cosine,2)*100
                @endphp
                @if ($nilai >= 81)
                A
                @elseif ($nilai >= 76 AND $nilai <= 80) 
                AB 
                @elseif ($nilai>= 71 AND $nilai <= 75) 
                B 
                @elseif ($nilai>= 66 AND $nilai <= 70) 
                BC 
                @elseif ($nilai>= 56 AND $nilai <= 65) 
                C 
                @elseif ($nilai>= 46 AND $nilai <= 55) 
                D 
                @elseif ($nilai>= 0 AND $nilai <= 45) 
                E
                @else Nilai Masih Diproses 
                @endif </td> 
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>