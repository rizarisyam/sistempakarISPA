@extends('adminlte::page')

@section('title', 'Manage Keputusan')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
            <div class="d-flex align-items-center">
                <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                <h6 class="text-primary mt-2">Manage Keputusan</h6>
            </div>

            <div>
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-file-import"></i>
                            <span class="ml-2">Import</span>
                        </button>
                    </div>
                    <div class="btn-group">
                        <a href="{{route('keputusan.create')}}" class="btn btn-primary" role="button">
                            <i class="fas fa-plus-square"></i>
                            <span class="ml-2">Tambah</span></a>
                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('keputusan.excel') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data with excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label for="">Pilih file excel</label>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-4">
                <form action="" method="GET">

                    <div class="input-group my-4 mb-2">
                        <input type="text" class="form-control" name="search" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit"><i
                                    class="fas fa-search mr-2"></i>Button</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col d-flex align-items-center justify-content-end">
                <a href="{{route('print.keputusan')}}">
                    <button type="button" class="btn btn-primary">Print</button>
                </a>
            </div>
            @if (session('pesan'))
            <div class="col-4">
                <div class="my-4 mb-2">
                    <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                        <strong>Hore!</strong> {{session('pesan')}}.
                        <button type="button" class="close py-2 px-2" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="table-responsive mt-2">
            <table class="table text-dark" id="tableKeputusan">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Saran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($keputusan as $key=>$row)
                    <tr>
                        <th scope="row" class="text-dark">{{$keputusan->firstItem() + $key}}</th>
                        <td>{{$row->kode}}</td>
                        <td>{{$row->nama}}</td>
                        <td style="text-align: justify">
                            @empty($row->keterangan)
                            N/A
                            @endempty
                            {!! $row->keterangan !!}
                        </td>
                        <td style="text-align: justify">
                            @empty($row->saran)
                            N/A
                            @endempty
                            {!! $row->saran !!}
                        <td>
                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                                <a href="{{route('keputusan.edit', $row->id)}}">
                                    <button type="button" class="btn btn-primary"><i
                                            class="far fa-edit text-white"></i></button>
                                </a>
                                <form action="{{route('keputusan.destroy', $row->id)}}" method="post"
                                    onsubmit='return confirm("Are you sure you want to delete?");'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fas fa-trash text-white"></i></button>
                                </form>
                            </div>

                        </td>
                    </tr>
                    @empty

                    @endforelse


                </tbody>
            </table>
            {{-- {{$variabel->render()}} --}}
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* #tableKeputusan {
        width: 100%;
        table-layout: fixed;
    } */
</style>
@stop

@section('js')

@stop
