@extends('layouts.user.app')


@section('section-title')
<div class="section-title">
    <h2>Konsultasi</h2>

</div>
@endsection

@section('content')



<div class="card" style="margin-bottom: 5rem !important">
    <div class="card-body ">
        <form action="{{route('user.konsultasi.simpan')}}" method="post">
            <div class="row">
                @csrf
                @foreach (auth()->user()->konsultasi as $item)
                <input type="hidden" value="{{$item->id}}" name="konsultasi_id">
                @endforeach
                @foreach ($variabel as $var)
                <div class="col-md-4">



                    <div class="form-group">
                        <input type="hidden" value="{{$var->id}}" name="variabel_id[]">
                        <label for="">[{{$var->kode}}]</label>
                        <label for="">{{$var->nama}}</label>
                        <input type="text" name="nilai[]" class="form-control">
                    </div>



                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
