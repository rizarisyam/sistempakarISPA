@extends('adminlte::page')

@section('title', 'Konsultasi')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">

                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <p class="font-weight-bold">Data Pengguna</p>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <a href="{{route('users.pdf')}}">
                                        <button type="button" class="btn btn-primary">Print</button>
                                    </a>
                                </div>
                            </div>
                          </div>
                        <div class="card-body">


                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $key => $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                                                <a href="{{route('users.show', $row->id)}}">
                                                    <button type="button" class="btn btn-primary"><i
                                                            class="fas fa-eye-slash"></i></button>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
