@extends('layouts.user.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-history mx-3"></i><span>Data Riwayat</span>
    </div>
    <div class="card-body">
        <div class="table-responsive mt-2">
            <table class="table text-dark" id="tableVariabel">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $key=>$row)
                    <tr>
                        <th scope="row" class="text-dark">{{$user->firstItem() + $key}}</th>
                        <td>{{$row->nama ?? auth()->user()->name}}</td>
                        <td>{{$row->created_at}}</td>


                        <td>
                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                                <a href="{{route('history-user.show', $row->id)}}">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-eye-slash"></i></button>
                                </a>

                            </div>

                        </td>
                    </tr>
                    @empty

                    @endforelse


                </tbody>
            </table>
            {{$user->links()}}
        </div>
    </div>
  </div>
@endsection
