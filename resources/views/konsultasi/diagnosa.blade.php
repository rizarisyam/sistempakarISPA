@extends('adminlte::page')

@section('title', 'Konsultasi')

@section('content')
<div class="row d-flex justify-content-center">
  <div class="col-8">

    <div class="card">
      <div class="card-header">
        <h5>{{ \auth()->user()->name }}</h5>
      </div>
      <div class="card-body">
        <h5 class="card-title">Anda Menjawab : </h5>
        
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Gejala</th>
              <th scope="col">Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($konsultasi->variabel as $row)
            <tr>
              <td>{{$row->nama}}</td>
              <td>{{$row->pivot->nilai}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="my-5">

          <h4>Anda terdiagnosa penyakit {{$penyakit}}</h4>
          <h4>Sebesar {{$persentase}} %</h4>
        </div>

      </div>
    </div>

  </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
