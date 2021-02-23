@extends('adminlte::page')

@section('title', 'Manage Aturan')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
      <div class="d-flex align-items-center">
        <span class="text-primary mr-2"><i class="fas fa-bars"></i></span>
        <h6 class="text-primary mt-2">Manage Aturan</h6>
      </div>

      <div>
        <div class="btn-group btn-group-justified">

            <div class="btn-group">
              <a href="{{route('aturan.create')}}" class="btn btn-primary" role="button">
                <i class="fas fa-plus-square"></i>
                <span class="ml-2">Tambah</span></a>
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
              <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search mr-2"></i>Button
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-4">
        <div class="my-4 mb-2">
          @if (session('pesan'))
          <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
            <strong>Hore!</strong> {{session('pesan')}}.
            <button type="button" class="close py-2 px-2" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="table-responsive mt-2">
      <table class="table text-dark">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Aturan</th>
            <th scope="col">Aturan</th>
            <th scope="col">Keputusan</th>
            <th scope="col">CF</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($aturan as $key=>$row)
          <tr>
            <th scope="row" class="text-dark">{{$aturan->firstItem() + $key}}</th>
            <td>{{$row->kode}}</td>
            <td class="">
              <ul class="list-group">
                <li class="list-group-item active">IF</li>
                @foreach ($row->himpunan as $item)
                <li class="list-group-item">[{{$item->variabel->kode}}]{{ $item->variabel->nama }} <span
                    class="font-weight-bold">{{$item->nama}}</span></li>
                @endforeach

              </ul>


            </td>
            <td>[{{$row->keputusan->kode}}]{{$row->keputusan->nama}}</td>
            <td>{{$row->certainty_factor}}</td>
            <td>
              <div class="btn-group bg-primary" role="group" aria-label="Basic example">

                <a href="{{route('aturan.himpunan', $row->id)}}">
                  <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    title="detail aturan">
                    <i class="fas fa-border-all"></i>
                  </button>

                </a>
                <a href="{{route('aturan.edit', $row->id)}}">
                  <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    title="edit aturan">
                    <i class="far fa-edit text-white"></i>
                  </button>

                </a>
                <a href="{{route('edit.detailaturan', $row->id)}}">
                  <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    title="edit detail aturan">
                    <i class="fas fa-tools"></i>
                  </button>

                </a>
                <form action="{{route('aturan.destroy', $row->id)}}" method="post"
                  onsubmit='return confirm("Are you sure you want to delete?");'>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    title="hapus aturan">
                    <i class="fas fa-trash text-white"></i>
                  </button>

                </form>
              </div>

            </td>
          </tr>
          @empty

          @endforelse


        </tbody>
      </table>
      {{$aturan->links()}}
    </div>
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
  $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop
