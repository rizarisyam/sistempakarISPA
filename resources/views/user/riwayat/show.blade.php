@extends('layouts.user.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-history mr-3"></i><span>Data Riwayat</span>
    </div>
    <div class="card-body">
        <div>
            <div class="mb-3 d-flex justify-content-between">
                <div><h6 class="font-weight-bold">Data Konsultasi</h6></div>
                <div>
                    <form action="" method="post">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-print mr-3"></i>Print</button>
                    </form>
                </div>
            </div>

            <table class="table table-hover">
                {{-- <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead> --}}
                <tbody>
                    @foreach ($konsultasi as $row)
                    @foreach ($row->variabel as $row)

                    <tr>
                        <td>{{$row->nama}}</td>
                        <td>{{$row->pivot->nilai ?? 0}}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h6 class="font-weight-bold">Hasil</h6>
            <table class="table table-hover">
                {{-- <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead> --}}
                <tbody>
                   @foreach ($keputusan as $key => $row)
                    @if ($maxIndex == $key)
                        <tr>
                            <td>Terdiagnosa</td>
                            <td>{{$row->nama}}</td>
                        </tr>
                        <tr>
                            <td>Persentase</td>
                            <td>{{number_format(($maxValue * 100), 2)}} %</td>
                        </tr>
                    @endif
                   @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
