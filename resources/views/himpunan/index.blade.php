
@extends('adminlte::page')

@section('title', 'Manage Himpunan')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
            <div class="d-flex align-items-center">
                <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
                <h6 class="text-primary mt-2">Manage Himpunan</h6>
            </div>

            <div>
                <div>
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-file-import"></i>
                                <span class="ml-2">Import</span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <a href="{{route('himpunan.create')}}" class="btn btn-primary" role="button">
                                <i class="fas fa-plus-square"></i>
                                <span class="ml-2">Tambah</span></a>
                        </div>

                      </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('himpunan.excel') }}" method="post" enctype="multipart/form-data">
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
                <a href="{{route('print.himpunan')}}">
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
            <table class="table text-dark">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Variabel</th>
                        <th scope="col">Himpunan</th>
                        <th scope="col">Domain himpunan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($himpunan as $key=>$row)
                    <tr>
                        <th scope="row" class="text-dark">{{$himpunan->firstItem() + $key}}</th>

                        <td>{{$row->variabel->nama}}</td>
                        <td>

                            <p>{{$row->nama}}</p>

                        </td>
                        <td>
                            @foreach (json_decode($row->domain) as $domain)
                            <p>{{$domain}}</p>
                            @endforeach

                        </td>
                        <td>
                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                                <a href="{{route('himpunan.edit', $row->id)}}">
                                    <button type="button" class="btn btn-primary"><i
                                            class="far fa-edit text-white"></i></button>
                                </a>
                                <form action="{{route('himpunan.destroy', $row->id)}}" method="post"
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
            {{$himpunan->links()}}
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
