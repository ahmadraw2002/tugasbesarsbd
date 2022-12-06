@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mobil Deleted</h2>
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                       <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID Mobil</th>
            <th>Merk</th>
            <th>Tahun</th>
            <th>Harga</th>
            <th>KTP PEMBELI</th>
            <th>KTP PEMILIK</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($mobils as $mobil)
        <tr>
            <td>{{ $mobil->id_mobil }}</td>
            <td>{{ $mobil->merk }}</td>
            <td>{{ $mobil->tahun }}</td>
            <td>{{ $mobil->harga }}</td>
            <td>{{ $mobil->ktp_pembeli }}</td>
            <td>{{ $mobil->ktp_pemilik }}</td>
            <td>
                <form>
                    @can('mobil-delete')
                    <a class="btn btn-primary" href="trash/{{ $mobil ->id_mobil }}/restore">Restore</a>
                    @endcan
                    @csrf
                    @can('mobil-delete')
                    <a class="btn btn-danger" href="trash/{{ $mobil->id_mobil }}/forcedelete">Force Delete</a>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $mobils->links() !!}
@endsection